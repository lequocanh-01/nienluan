<div>Quản lý thương hiệu</div>
<hr>
<div>Thêm thương hiệu</div>

<div>
    <form name="newthuonghieu" id="formaddthuonghieu" method="post" action='./elements_LQA/mthuonghieu/thuonghieuAct.php?reqact=addnew' enctype="multipart/form-data">
        <table>
            <tr>
                <td>Tên thương hiệu</td>
                <td><input type="text" name="tenTH" id="tenTH" /></td>
            </tr>
            <tr>
                <td>SĐT</td>
                <td><input type="phone" name="SDT" id="SDT" /></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="email" name="email" id="email" /></td>
            </tr>
            <tr>
                <td>Địa chỉ</td>
                <td><input type="text" name="diaChi" id="diaChi" /></td>
            </tr>
            <tr>
                <td><input type="submit" id="btnsubmit" value="Tạo mới" /></td>
                <td><input type="reset" value="Làm lại" /><b id="noteForm"></b></td>
            </tr>
        </table>
    </form>
    <hr />
    <?php
    require_once './elements_LQA/mod/thuonghieuCls.php';
    $lhobj = new ThuongHieu();
    $list_lh = $lhobj->thuonghieuGetAll();
    $l = count($list_lh);
    ?>
    <div class="title_thuonghieu">Danh sách thương hiệu</div>
    <div class="content_thuonghieu">
        Trong bảng có: <b><?php echo $l; ?></b>

        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên thương hiệu</th>
                    <th>SĐT</th>
                    <th>Email</th>
                    <th>Địa Chỉ</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($l > 0) {
                    foreach ($list_lh as $u) {
                ?>
                        <tr>
                            <td><?php echo $u->idThuongHieu; ?></td>
                            <td><?php echo $u->tenTH; ?></td>
                            <td><?php echo $u->SDT; ?></td>
                            <td><?php echo $u->email; ?></td>
                            <td><?php echo $u->diaChi; ?></td>
                            <td style="text-align: center;">
                                <?php
                                if (isset($_SESSION['ADMIN'])) {
                                ?>
                                    <a href="./elements_LQA/mthuonghieu/thuonghieuAct.php?reqact=deletethuonghieu&idThuongHieu=<?php echo $u->idThuongHieu; ?>">
                                        <img src="./img_LQA/Delete.png" class="iconimg">
                                    </a>
                                <?php
                                } else {
                                ?>
                                    <img src="./img_LQA/Delete.png" class="iconimg">
                                <?php
                                }
                                ?>
                                <img src="./img_LQA/Update.png" class="w_update_btn_open_th" value="<?php echo $u->idThuongHieu; ?>">
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <div id="w_update_th" style="display:none;">
        <div id="w_update_form_th"></div>
        <input type="button" value="Đóng" id="w_close_btn_th">
    </div>
</div>
