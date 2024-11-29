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
?>

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
                <td><input type="file" name="fileimage" required></td>
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
                        <img class="iconbutton" src="data:image/png;base64,<?php echo $u->hinhanh; ?>">
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
