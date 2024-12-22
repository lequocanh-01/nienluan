<?php
require_once("./elements_LQA/mod/hanghoaCls.php");
$hanghoa = new hanghoa();
$list_hinhanh = $hanghoa->GetAllHinhAnh();
$total = count($list_hinhanh);
?>

<head>
    <link rel="stylesheet" type="text/css" href="../public_files/mycss.css">
</head>

<div class="admin-title">
    <h1>Quản lý hình ảnh</h1>
</div>

<div class="admin-content">
    <!-- Form upload hình ảnh -->
    <div class="upload-form">
        <h3>Thêm hình ảnh mới</h3>
        <form action="./elements_LQA/mhinhanh/hinhanhAct.php?reqact=addnew" method="post" enctype="multipart/form-data">
            <input type="file" name="files[]" multiple accept="image/*" required>
            <input type="submit" value="Upload" class="btn btn-primary">
        </form>
    </div>

    <!-- Hiển thị danh sách hình ảnh -->
    <div class="image-list">
        <div class="list-header">
            <h3>Danh sách hình ảnh (<?php echo $total; ?> hình ảnh)</h3>
            <button id="delete-selected" class="btn btn-danger" style="display: none;">Xóa đã chọn</button>
        </div>

        <table class="image-table">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>ID</th>
                    <th>Hình ảnh</th>
                    <th>Tên file</th>
                    <th>Kích thước</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list_hinhanh as $img): ?>
                    <tr>
                        <td><input type="checkbox" class="select-item" value="<?php echo $img->id; ?>"></td>
                        <td><?php echo $img->id; ?></td>
                        <td>
                            <?php
                            $image_src = $img->duong_dan;
                            if (strlen($image_src) > 100 && strpos($image_src, ',') !== false) {
                                $image_src = $image_src;
                            } else if (file_exists($image_src)) {
                                $image_src = $image_src;
                            } else if (file_exists("./" . $image_src)) {
                                $image_src = "./" . $image_src;
                            } else {
                                $image_src = "./img_LQA/no-image.png";
                            }
                            ?>
                            <img src="<?php echo $image_src; ?>"
                                alt="<?php echo htmlspecialchars($img->ten_file); ?>"
                                class="preview-image">
                        </td>
                        <td><?php echo htmlspecialchars($img->ten_file); ?></td>
                        <td><?php echo $img->kich_thuoc; ?></td>
                        <td>
                            <button class="delete-btn" data-id="<?php echo $img->id; ?>">Xóa</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
   
</div>

<script src="../../js_LQA/jscript.js"></script>
    