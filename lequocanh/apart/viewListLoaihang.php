<?php
require_once './administrator/elements_LQA/mod/hanghoaCls.php';
$hanghoa = new hanghoa();

if (isset($_GET['reqView'])) {
    $idloaihang = $_GET['reqView'];
    $list_hanghoa = $hanghoa->HanghoaGetbyIdloaihang($idloaihang);
    $s = count($list_hanghoa);
} else {
    $list_hanghoa = $hanghoa->HanghoaGetAll();
    $s = count($list_hanghoa);
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


<div id="carouselExample" class="carousel slide mb-4" data-bs-ride="carousel" data-bs-interval="3000">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="./administrator/img_LQA/Xiaomi-12T.png" class="d-block w-100" alt="Slide 1">
        </div>
        <div class="carousel-item">
            <img src="./administrator/img_LQA/iphone 13.png" class="d-block w-100" alt="Slide 2">
        </div>
        <div class="carousel-item">
            <img src="./administrator/img_LQA/galaxy s21.png" class="d-block w-100" alt="Slide 3">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

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
