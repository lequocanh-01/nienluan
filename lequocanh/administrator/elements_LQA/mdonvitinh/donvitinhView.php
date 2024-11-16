<div>Quản lý đơn vị tính</div>
<hr>
<div>Thêm đơn vị tính</div>
<?php
require_once './elements_LQA/mod/donvitinhCls.php'; // Sử dụng require_once
// require_once './elements_LQA/mod/hanghoaCls.php'; // Thêm dòng này để sử dụng lớp hàng hóa

$lhobj = new donvitinh(); // Đảm bảo tên lớp là donvitinh với chữ cái đầu viết hoa
$list_lh = $lhobj->donvitinhGetAll(); // Sử dụng phương thức với chữ cái đầu viết hoa
$l = count($list_lh);

// Lấy danh sách hàng hóa
// $hhobj = new Hanghoa(); // Tạo đối tượng hàng hóa
// $list_hh = $hhobj->HanghoaGetAll(); // Lấy tất cả hàng hóa

// Kiểm tra xem danh sách hàng hóa có tồn tại không
// if (empty($list_hh)) {
//     $list_hh = []; // Khởi tạo biến nếu không có dữ liệu
// }
?>
<div>
    <form name="newdonvitinh" id="formadddonvitinh" method="post" action='./elements_LQA/mdonvitinh/donvitinhAct.php?reqact=addnew' enctype="multipart/form-data">
        <table>
            <tr>
                <td>Tên đơn vị tính</td>
                <td><input type="text" name="tenDonViTinh" id="tenDonViTinh" /></td>
            </tr>
            <tr>
                <td>Mô tả</td>
                <td><input type="text" name="moTa" id="moTa" /></td>
            </tr>
            <tr>
                <td>Ghi chú</td>
                <td><input type="text" name="ghiChu" id="ghiChu" /></td>
            </tr>

            <tr>
                <td><input type="submit" id="btnsubmit" value="Tạo mới" /></td>
                <td><input type="reset" value="Làm lại" /><b id="noteForm"></b></td>
            </tr>
        </table>
    </form>
    <hr />
    <div class="title_donvitinh">Danh sách đơn vị tính</div>
    <div class="content_donvitinh">
        Trong bảng có: <b><?php echo $l; ?></b>

        <table border="solid">
            <thead>
                <th>ID</th>
                <th>Tên Đơn Vị Tính</th>
                <th>Mô Tả</th>
                <th>Ghi Chú</th>
                <th>Chức Năng</th>
            </thead>
            <tbody>
                <?php
                if ($l > 0) {
                    foreach ($list_lh as $u) {
                ?>
                        <tr>
                            <td><?php echo $u->idDonViTinh; ?></td>
                            <td><?php echo $u->tenDonViTinh; ?></td>
                            <td><?php echo $u->moTa; ?></td>
                            <td><?php echo $u->ghiChu; ?></td>


                            <td align="center">
                                <?php
                                if (isset($_SESSION['ADMIN'])) {
                                ?>
                                    <a href="./elements_LQA/mdonvitinh/donvitinhAct.php?reqact=deletedonvitinh&iddonvitinh=<?php echo $u->idDonViTinh; ?>">
                                        <img src="./img_LQA/delete.png" class="iconimg">
                                    </a>
                                <?php
                                } else {
                                ?>
                                    <img src="./img_LQA/delete.png" class="iconimg">
                                <?php
                                }
                                ?>
                                <img src="./img_LQA/Update.png" class="w_update_btn_open_dvt" value="<?php echo $u->idDonViTinh; ?>">
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <div id="w_update_dvt">
        <div id="w_update_form_dvt"></div>
        <input type="button" value="close" id="w_close_btn_dvt">
    </div>
</div>