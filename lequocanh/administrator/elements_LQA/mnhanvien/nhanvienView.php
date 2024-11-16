<div>Quản lý nhân viên</div>
<hr>
<div>Thêm nhân viên</div>

<?php
require_once './elements_LQA/mod/nhanvienCls.php';

$lhobj = new NhanVien();
$list_lh = $lhobj->nhanvienGetAll();
$l = count($list_lh);
?>

<div>
    <form name="newnhanvien" id="formaddnhanvien" method="post" action='./elements_LQA/mnhanvien/nhanvienAct.php?reqact=addnew' enctype="multipart/form-data">
        <table>
            <tr>
                <td>Tên Nhân viên</td>
                <td><input type="text" name="tenNV" id="tenNV" /></td>
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
                <td>Lương cơ bản</td>
                <td><input type="number" name="luongCB" id="luongCB" /></td>
            </tr>
            <tr>
                <td>Phụ Cấp</td>
                <td><input type="number" name="phuCap" /></td>
            </tr>
            <tr>
                <td>Chức vụ</td>
                <td><input type="text" name="chucVu" /></td>
            </tr>
            <tr>
                <td><input type="submit" id="btnsubmit" value="Tạo mới" /></td>
                <td><input type="reset" value="Làm lại" /><b id="noteForm"></b></td>
            </tr>
        </table>
    </form>
    <hr />
    <div class="title_nhanvien">Danh sách nhân viên</div>
    <div class="content_nhanvien">
        Trong bảng có: <b><?php echo $l; ?></b>

        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Nhân viên</th>
                    <th>SĐT</th>
                    <th>Email</th>
                    <th>Lương cơ bản</th>
                    <th>Phụ Cấp</th>
                    <th>Chức vụ</th>
                    <th>Chức Năng</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($l > 0) {
                    foreach ($list_lh as $u) {
                ?>
                        <tr>
                            <td><?php echo $u->idNhanVien; ?></td>
                            <td><?php echo $u->tenNV; ?></td>
                            <td><?php echo $u->SDT; ?></td>
                            <td><?php echo $u->email; ?></td>
                            <td><?php echo $u->luongCB; ?></td>
                            <td><?php echo $u->phuCap; ?></td>
                            <td><?php echo $u->chucVu; ?></td>
                            <td style="text-align: center;">
                                <?php
                                if (isset($_SESSION['ADMIN'])) {
                                ?>
                                    <a href="./elements_LQA/mnhanvien/nhanvienAct.php?reqact=deletenhanvien&idNhanVien=<?php echo $u->idNhanVien; ?>">
                                        <img src="./img_LQA/delete.png" class="iconimg">
                                    </a>
                                <?php
                                } else {
                                ?>
                                    <img src="./img_LQA/delete.png" class="iconimg">
                                <?php
                                }
                                ?>
                                <img src="./img_LQA/Update.png" class="w_update_btn_open_nv" value="<?php echo $u->idNhanVien; ?>">
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <div id="w_update_nv" style="display:none;">
        <div id="w_update_form_nv"></div>
        <input type="button" value="Đóng" id="w_close_btn_nv">
    </div>
</div>
