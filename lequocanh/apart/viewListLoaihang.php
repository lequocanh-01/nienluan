<?php
require_once dirname(dirname(__FILE__)) . '/administrator/elements_LQA/mod/hanghoaCls.php';
$hanghoa = new hanghoa();

if (isset($_GET['reqView'])) {
    $idloaihang = $_GET['reqView'];
    $list_hanghoa = $hanghoa->HanghoaGetbyIdloaihang($idloaihang);
} else {
    $list_hanghoa = $hanghoa->HanghoaGetAll();
}

// Lấy 5 sản phẩm mới nhất cho carousel
$carousel_items = array_slice($list_hanghoa, 0, 5);

// Debug: Kiểm tra số lượng sản phẩm
// echo "Số sản phẩm trong carousel: " . count($carousel_items);
?>

<div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php 
        if (!empty($carousel_items)) {
            foreach($carousel_items as $index => $item): 
        ?>
            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>" data-bs-interval="3000">
                <a href="./index.php?reqHanghoa=<?php echo $item->idhanghoa; ?>">
                    <img src="data:image/png;base64,<?php echo $item->hinhanh; ?>" 
                         class="d-block" 
                         alt="<?php echo $item->tenhanghoa; ?>">
                </a>
                <div class="carousel-caption">
                    <h5 class="m-0"><?php echo $item->tenhanghoa; ?></h5>
                    <p class="m-0"><?php echo number_format($item->giathamkhao, 0, ',', '.') . ' VNĐ'; ?></p>
                </div>
            </div>
        <?php 
            endforeach;
        } else {
            echo '<div class="alert alert-warning">Không có sản phẩm nào để hiển thị</div>';
        }
        ?>
    </div>

    <?php if (count($carousel_items) > 1): ?>
        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    <?php endif; ?>
</div>

<!-- Thêm script khởi tạo carousel -->
<script src="administrator/elements_LQA/js_LQA/jscript.js"></script>

<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php
    foreach ($list_hanghoa as $v) {
    ?>
        <div class="col">
            <div class="card h-100">
                <img src="data:image/png;base64,<?php echo $v->hinhanh; ?>" class="card-img-top" alt="<?php echo $v->tenhanghoa; ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $v->tenhanghoa; ?></h5>
                    <p class="card-text text-danger fw-bold">
                        <?php echo number_format($v->giathamkhao, 0, ',', '.') . ' VNĐ'; ?>
                    </p>
                    <a href="./index.php?reqHanghoa=<?php echo $v->idhanghoa; ?>" class="btn btn-outline-primary">Xem chi tiết</a>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>
