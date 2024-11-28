<?php
if (!isset($_SESSION['ADMIN'])) {
    header('Location: ../../userLogin.php');
    exit();
}

require_once './elements_LQA/mod/giohangCls.php';
require_once './elements_LQA/mod/userCls.php';

$giohang = new GioHang();
$user = new user();
$users = $user->UserGetAll();

// Đếm tổng số giỏ hàng và tổng giá trị
$totalCartsValue = 0;
$activeCartsCount = 0;
$totalItemsCount = 0;

foreach ($users as $u) {
    if ($u->username !== 'admin') {
        $cart = $giohang->getCartByUserId($u->username);
        if (!empty($cart)) {
            $activeCartsCount++;
            foreach ($cart as $item) {
                $totalCartsValue += $item['giathamkhao'] * $item['quantity'];
                $totalItemsCount += $item['quantity'];
            }
        }
    }
}
?>

<div class="container-fluid px-4 py-4">
    <!-- Dashboard Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Tổng giỏ hàng đang hoạt động</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $activeCartsCount; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Tổng giá trị giỏ hàng</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo number_format($totalCartsValue, 0, ',', '.'); ?>₫
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Tổng số sản phẩm</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalItemsCount; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Quản lý giỏ hàng người dùng</h6>
            <div class="d-flex gap-2">
                <button class="btn btn-sm btn-outline-primary" onclick="printReport()">
                    <i class="fas fa-print me-2"></i>In báo cáo
                </button>
                <button class="btn btn-sm btn-outline-success" onclick="exportExcel()">
                    <i class="fas fa-file-excel me-2"></i>Xuất Excel
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="cartTable">
                    <thead class="table-light">
                        <tr>
                            <th>Người dùng</th>
                            <th>Sản phẩm</th>
                            <th class="text-center">Hình ảnh</th>
                            <th class="text-end">Đơn giá</th>
                            <th class="text-center">Số lượng</th>
                            <th class="text-end">Thành tiền</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach ($users as $u):
                            if ($u->username === 'admin') continue;
                            $cart = $giohang->getCartByUserId($u->username);
                            if (empty($cart)) continue;
                            
                            foreach ($cart as $index => $item):
                                $subtotal = $item['giathamkhao'] * $item['quantity'];
                        ?>
                            <tr>
                                <?php if ($index === 0): ?>
                                    <td rowspan="<?php echo count($cart); ?>" class="align-middle">
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold"><?php echo htmlspecialchars($u->hoten); ?></span>
                                            <small class="text-muted"><?php echo htmlspecialchars($u->username); ?></small>
                                        </div>
                                    </td>
                                <?php endif; ?>
                                <td class="align-middle"><?php echo htmlspecialchars($item['tenhanghoa']); ?></td>
                                <td class="text-center">
                                    <img src="data:image/jpeg;base64,<?php echo $item['hinhanh']; ?>" 
                                         alt="<?php echo htmlspecialchars($item['tenhanghoa']); ?>" 
                                         class="rounded"
                                         style="width: 40px; height: 40px; object-fit: cover;">
                                </td>
                                <td class="text-end align-middle">
                                    <?php echo number_format($item['giathamkhao'], 0, ',', '.'); ?>₫
                                </td>
                                <td class="text-center align-middle">
                                    <span class="badge bg-secondary">
                                        <?php echo $item['quantity']; ?>
                                    </span>
                                </td>
                                <td class="text-end align-middle">
                                    <?php echo number_format($subtotal, 0, ',', '.'); ?>₫
                                </td>
                                <td class="text-center align-middle">
                                    <button class="btn btn-sm btn-outline-danger" 
                                            onclick="removeItem('<?php echo $u->username; ?>', <?php echo $item['product_id']; ?>)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php 
                            endforeach;
                        endforeach; 
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
function printReport() {
    window.print();
}

function exportExcel() {
    alert('Tính năng đang được phát triển');
}

function removeItem(userId, productId) {
    if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?')) {
        // Thêm code xử lý xóa sản phẩm ở đây
        alert('Tính năng đang được phát triển');
    }
}

// CSS cho chế độ in
const style = document.createElement('style');
style.textContent = `
    @media print {
        .btn, nav, footer {
            display: none !important;
        }
        .card {
            border: none !important;
            box-shadow: none !important;
        }
        .container-fluid {
            width: 100% !important;
            padding: 0 !important;
        }
        .table {
            width: 100% !important;
        }
        @page {
            size: landscape;
        }
    }
`;
document.head.appendChild(style);
</script>

<style>
.border-left-primary {
    border-left: 4px solid #4e73df !important;
}
.border-left-success {
    border-left: 4px solid #1cc88a !important;
}
.border-left-info {
    border-left: 4px solid #36b9cc !important;
}
.card {
    transition: all 0.3s ease;
}
.card:hover {
    transform: translateY(-2px);
}
.table > :not(caption) > * > * {
    padding: 0.75rem;
}
.btn-sm {
    padding: 0.25rem 0.5rem;
}
</style> 