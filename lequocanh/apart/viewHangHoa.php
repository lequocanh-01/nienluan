<script>
    function goBack() {
        window.history.back();
    }
</script>

<?php
require_once './administrator/elements_LQA/mod/hanghoaCls.php';
require_once './administrator/elements_LQA/mod/thuoctinhhhCls.php';
require_once './administrator/elements_LQA/mod/thuoctinhCls.php';
$hanghoa = new hanghoa();

if (isset($_GET['reqHanghoa'])) {
    $idhanghoa = $_GET['reqHanghoa'];
    $obj = $hanghoa->HanghoaGetbyId($idhanghoa);
    
    // Thêm truy vấn để lấy thông tin thuộc tính hàng hóa
    $thuocTinhHHObj = new ThuocTinhHH(); 
    $listThuocTinh = $thuocTinhHHObj->thuoctinhhhGetbyIdHanghoa($idhanghoa); 
}
?>

<div class="card mb-3">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="data:image/png;base64,<?php echo $obj->hinhanh; ?>" class="img-fluid rounded-start"
                alt="<?php echo $obj->tenhanghoa; ?>">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title"><?php echo $obj->tenhanghoa; ?></h5>
                <p class="card-text">Số lượng: <strong><?php echo isset($obj->soluong) ? $obj->soluong : 'N/A'; ?></strong></p>
                <p class="card-text"><?php echo $obj->mota; ?></p>
                <p class="card-text"><small class="text-muted">Giá bán: <?php echo $obj->giathamkhao; ?></small></p>
                
                <!-- Hiển thị thông tin thuộc tính hàng hóa -->
                <?php if (!empty($listThuocTinh)): ?>
                    <h6>Thông số kỹ thuật:</h6>
                    <ul>
                        <?php foreach ($listThuocTinh as $tt): ?>
                            <?php
                            // Lấy tên thuộc tính từ bảng thuoctinh
                            $thuocTinhObj = new ThuocTinh();
                            $thuocTinh = $thuocTinhObj->thuoctinhGetbyId($tt->idThuocTinh);
                            ?>
                            <li>
                                <strong><?php echo htmlspecialchars($thuocTinh->tenThuocTinh); ?>:</strong> 
                                <?php echo htmlspecialchars($tt->tenThuocTinhHH); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                
                <!-- Add the Buy button here -->
                <a href="./purchase.php?productId=<?php echo $obj->idhanghoa; ?>" class="btn btn-success">Mua</a>
                <button onclick="goBack()" class="btn btn-secondary">Quay lại</button>
            </div>
        </div>
    </div>
</div>