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

<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php
    foreach ($list_hanghoa as $v) {
    ?>
        <div class="col">
            <div class="card h-100">
                <img src="data:image/png;base64,<?php echo $v->hinhanh; ?>" class="card-img-top" alt="<?php echo $v->tenhanghoa; ?>">
                <div class="card-body">
                    <h5 class="card-title text-primary"><?php echo $v->tenhanghoa; ?></h5>
                    <p class="card-text text-muted">Giá bán: <span class="text-danger font-weight-bold"><?php echo $v->giathamkhao; ?></span></p>
                    <a href="./index.php?reqHanghoa=<?php echo $v->idhanghoa; ?>" class="btn btn-outline-primary">Xem chi tiết</a>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>
