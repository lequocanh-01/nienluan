<div align="center">Quản lý thuộc tính</div>
<hr>
<div>Thêm thuộc tính</div>
<?php
require './elements_LQA/mod/thuoctinhCls.php';

$lhobj = new ThuocTinh();
$list_lh = $lhobj->thuoctinhGetAll();
$l = count($list_lh);
?>

<div>
    <form name="newthuoctinh" id="formaddthuoctinh" method="post" action='./elements_LQA/mthuoctinh/thuoctinhAct.php?reqact=addnew' enctype="multipart/form-data">
        <table>
            <tr>
                <td>Tên thuộc tính</td>
                <td><input type="text" name="tenThuocTinh" id="tenThuocTinh" /></td>
            </tr>
            <tr>
                <td>Giá trị</td>
                <td><input type="text" name="giaTri" id="giaTri" /></td>
            </tr>
            <tr>
                <td>Ghi Chú</td>
                <td><input type="text" name="ghiChu" /></td>
            </tr>
            <tr>
                <td><input type="submit" id="btnsubmit" value="Tạo mới" /></td>
                <td><input type="reset" value="Làm lại" /><b id="noteForm"></b></td>
            </tr>
        </table>
    </form>
    <hr />
    <div class="title_thuoctinh">Danh sách thuộc tính</div>
    <div class="content_thuoctinh">
        Trong bảng có: <b><?php echo $l; ?></b>

        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên thuộc tính</th>
                    <th>Giá trị</th>
                    <th>Ghi Chú</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($l > 0) {
                    foreach ($list_lh as $u) {
                ?>
                        <tr>
                            <td><?php echo $u->idThuocTinh; ?></td>
                            <td><?php echo htmlspecialchars($u->tenThuocTinh); ?></td>
                            <td><?php echo htmlspecialchars($u->giaTri); ?></td>
                            <td><?php echo htmlspecialchars($u->ghiChu); ?></td>
                            <td style="text-align: center;">
                                <?php if (isset($_SESSION['ADMIN'])) { ?>
                                    <a href="./elements_LQA/mthuoctinh/thuoctinhAct.php?reqact=deletethuoctinh&idThuocTinh=<?php echo $u->idThuocTinh; ?>">
                                        <img src="./img_LQA/delete.png" class="iconimg">
                                    </a>
                                <?php } ?>
                                <img src="./img_LQA/Update.png" class="w_update_btn_open_tt" value="<?php echo $u->idThuocTinh; ?>">
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <div id="w_update_tt" style="display:none;">
        <div id="w_update_form_tt"></div>
        <input type="button" value="Đóng" class="close-btn" id="w_close_btn_tt">
    </div>
</div>
