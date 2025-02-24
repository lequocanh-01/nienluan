<div class="admin-title">Quản lý hàng hóa</div>
<hr>
<?php
require_once './elements_LQA/mod/loaihangCls.php';
require_once './elements_LQA/mod/hanghoaCls.php';

$lhobj = new loaihang();
$hanghoaObj = new hanghoa();

$list_lh = $lhobj->LoaihangGetAll();
$list_thuonghieu = $hanghoaObj->GetAllThuongHieu();
$list_donvitinh = $hanghoaObj->GetAllDonViTinh();
$list_nhanvien = $hanghoaObj->GetAllNhanVien();
$list_hinhanh = $hanghoaObj->GetAllHinhAnh();
?>

<head>
    <link rel="stylesheet" type="text/css" href="../public_files/mycss.css">
</head>
<div class="admin-form">
    <h3>Thêm hàng hóa mới</h3>
    <form name="newhanghoa" id="formaddhanghoa" method="post" action='./elements_LQA/mhanghoa/hanghoaAct.php?reqact=addnew' enctype="multipart/form-data">
        <table>
            <tr>
                <td>Tên hàng hóa</td>
                <td><input type="text" name="tenhanghoa" required /></td>
            </tr>
            <tr>
                <td>Giá tham khảo</td>
                <td><input type="number" name="giathamkhao" required /></td>
            </tr>
            <tr>
                <td>Mô tả</td>
                <td><input type="text" name="mota" /></td>
            </tr>
            <tr>
                <td>Hình ảnh</td>
                <td>
                    <select name="id_hinhanh" required>
                        <option value="">-- Chọn hình ảnh --</option>
                        <?php
                        foreach ($list_hinhanh as $img) {
                        ?>
                            <option value="<?php echo $img->id; ?>">
                                <?php echo htmlspecialchars($img->ten_file); ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                    <div class="image-preview">
                        <?php
                        foreach ($list_hinhanh as $img) {
                            $image_src = $img->duong_dan;
                            // Kiểm tra xem có phải là base64 không
                            if (strlen($image_src) > 100 && strpos($image_src, ',') !== false) {
                                $image_src = $image_src; // Giữ nguyên nếu là base64
                            } else if (file_exists($image_src)) {
                                $image_src = $image_src; // Giữ nguyên nếu file tồn tại
                            } else if (file_exists("./" . $image_src)) {
                                $image_src = "./" . $image_src; // Thêm ./ nếu cần
                            } else {
                                $image_src = "./img_LQA/no-image.png"; // Ảnh mặc định nếu không tìm thấy
                            }
                        ?>
                            <div class="preview-item">
                                <img src="<?php echo $image_src; ?>"
                                    class="preview-img"
                                    data-id="<?php echo $img->id; ?>"
                                    alt="<?php echo htmlspecialchars($img->ten_file); ?>"
                                    title="<?php echo htmlspecialchars($img->ten_file); ?>">
                                <div class="preview-info">
                                    <span class="preview-name"><?php echo htmlspecialchars($img->ten_file); ?></span>
                                    
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Chọn loại hàng:</td>
                <td>
                    <?php
                    if (!empty($list_lh)) {
                        foreach ($list_lh as $l) {
                    ?>
                            <input type="radio" name="idloaihang" value="<?php echo $l->idloaihang; ?>" required>
                            <img class="iconbutton" src="data:image/png;base64,<?php echo $l->hinhanh; ?>">
                            <br>
                    <?php
                        }
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Chọn thương hiệu:</td>
                <td>
                    <select name="idThuongHieu">
                        <option value="">-- Chọn thương hiệu --</option>
                        <?php
                        foreach ($list_thuonghieu as $th) {
                        ?>
                            <option value="<?php echo $th->idThuongHieu; ?>"><?php echo $th->tenTH; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Chọn đơn vị tính:</td>
                <td>
                    <select name="idDonViTinh">
                        <option value="">-- Chọn đơn vị tính --</option>
                        <?php
                        foreach ($list_donvitinh as $dvt) {
                        ?>
                            <option value="<?php echo $dvt->idDonViTinh; ?>"><?php echo $dvt->tenDonViTinh; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Chọn nhân viên:</td>
                <td>
                    <select name="idNhanVien">
                        <option value="">-- Chọn nhân viên --</option>
                        <?php
                        foreach ($list_nhanvien as $nv) {
                        ?>
                            <option value="<?php echo $nv->idNhanVien; ?>"><?php echo $nv->tenNV; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><input type="submit" id="btnsubmit" value="Tạo mới" /></td>
                <td><input type="reset" value="Làm lại" /><b id="noteForm"></b></td>
            </tr>
        </table>
    </form>
</div>

<hr />
<?php
$list_hanghoa = $hanghoaObj->HanghoaGetAll();
$l = count($list_hanghoa);
?>
<div class="content_hanghoa">
    <div class="admin-info">
        Tổng số hàng hóa: <b><?php echo $l; ?></b>
    </div>

    <table class="content-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên hàng hóa</th>
                <th>Giá tham khảo</th>
                <th>Mô tả</th>
                <th>Hình ảnh</th>
                <th>Thương Hiệu</th>
                <th>Đơn Vị Tính</th>
                <th>Nhân Viên</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($l > 0) {
                foreach ($list_hanghoa as $u) {
            ?>
                    <tr>
                        <td><?php echo $u->idhanghoa; ?></td>
                        <td><?php echo htmlspecialchars($u->tenhanghoa); ?></td>
                        <td><?php echo number_format($u->giathamkhao, 0, ',', '.'); ?> đ</td>
                        <td><?php echo htmlspecialchars($u->mota); ?></td>
                        <td align="center">
                            <?php
                            $hinhanh = $hanghoaObj->GetHinhAnhById($u->hinhanh);
                            if ($hinhanh) {
                                $image_src = $hinhanh->duong_dan;

                                // Xác định đường dẫn tương đối từ thư mục gốc
                                $base_path = dirname(dirname(dirname(__FILE__))); // Đường dẫn tới thư mục administrator

                                // Kiểm tra các trường hợp đường dẫn
                                if (strpos($image_src, 'data:image') === 0) {
                                    // Nếu là base64, giữ nguyên
                                    $display_src = $image_src;
                                } else {
                                    // Thử các đường dẫn khác nhau
                                    $possible_paths = [
                                        $base_path . '/uploads/' . basename($image_src),
                                        $base_path . '/img_LQA/' . basename($image_src),
                                        './uploads/' . basename($image_src),
                                        '../uploads/' . basename($image_src),
                                        '../../uploads/' . basename($image_src),
                                        $image_src
                                    ];

                                    $display_src = './img_LQA/no-image.png'; // Đường dẫn mặc định
                                    foreach ($possible_paths as $path) {
                                        if (file_exists($path)) {
                                            // Chuyển đường dẫn tuyệt đối thành tương đối
                                            $display_src = str_replace($base_path, '.', $path);
                                            if (strpos($display_src, './') !== 0) {
                                                $display_src = './' . $display_src;
                                            }
                                            break;
                                        }
                                    }
                                }
                            ?>
                                <img class="iconbutton"
                                    src="<?php echo $display_src; ?>"
                                    alt="<?php echo htmlspecialchars($hinhanh->ten_file); ?>"
                                    title="<?php echo htmlspecialchars($hinhanh->ten_file); ?>"
                                    onerror="this.src='./img_LQA/no-image.png'">
                            <?php
                            } else {
                                echo '<img class="iconbutton" src="./img_LQA/no-image.png" alt="No image">';
                            }
                            ?>
                        </td>
                        <td><?php echo htmlspecialchars($u->idThuongHieu ?? 'Chưa chọn'); ?></td>
                        <td><?php echo htmlspecialchars($u->idDonViTinh ?? 'Chưa chọn'); ?></td>
                        <td><?php echo htmlspecialchars($u->idNhanVien ?? 'Chưa chọn'); ?></td>
                        <td align="center">
                            <?php
                            if (isset($_SESSION['ADMIN'])) {
                            ?>
                                <a href="./elements_LQA/mhanghoa/hanghoaAct.php?reqact=deletehanghoa&idhanghoa=<?php echo $u->idhanghoa; ?>">
                                    <img src="./img_LQA/delete.png" class="iconimg">
                                </a>
                            <?php
                            } else {
                            ?>
                                <img src="./img_LQA/delete.png" class="iconimg">
                            <?php
                            }
                            ?>
                            <img src="./img_LQA/Update.png" class="w_update_btn_open_hh" value="<?php echo $u->idhanghoa; ?>">
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

<div id="w_update_hh">
    <div id="w_update_form_hh"></div>
    <input type="button" value="close" id="w_close_btn_hh">
</div>

<div id="replace-image-dialog" class="modal" style="display: none;">
    <div class="modal-content">
        <h3>Chọn hình ảnh thay thế</h3>
        <p>Hình ảnh này đang được sử dụng bởi một số sản phẩm. Vui lòng chọn hình ảnh thay thế:</p>
        <select id="replace-image-select">
            <option value="">-- Chọn hình ảnh thay thế --</option>
        </select>
        <div class="modal-buttons">
            <button id="confirm-replace">Xác nhận</button>
            <button id="cancel-replace">Hủy</button>
        </div>
    </div>
</div>

<script src="../../js_LQA/jscript.js"></script>