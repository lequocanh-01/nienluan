<div>Quản lý thuộc tính hàng hóa</div>
<hr>
<div>Thêm thuộc tính hàng hóa</div>
<?php
require_once './elements_LQA/mod/hanghoaCls.php';
require_once './elements_LQA/mod/thuoctinhCls.php';
require_once './elements_LQA/mod/thuoctinhhhCls.php';

$hangHoaObj = new HangHoa();
$list_hh = $hangHoaObj->HanghoaGetAll();

$thuocTinhObj = new ThuocTinh();
$list_lh_thuoctinh = $thuocTinhObj->thuoctinhGetAll();

$thuocTinhHHObj = new ThuocTinhHH();
$list_lh_thuoctinhhh = $thuocTinhHHObj->thuoctinhhhGetAll();
?>

<div>
    <form name="newthuoctinhhh" id="formaddthuoctinhhh" method="post" action='./elements_LQA/mthuoctinhhh/thuoctinhhhAct.php?reqact=addnew'>
        <table>
            <tr>
                <td>Chọn hàng hóa:</td>
                <td>
                    <select name="idhanghoa" id="hanghoaSelect">
                        <option value="">-- Chọn hàng hóa --</option>
                        <?php foreach ($list_hh as $h) { ?>
                            <option value="<?php echo $h->idhanghoa; ?>"><?php echo $h->tenhanghoa; ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Chọn thuộc tính:</td>
                <td>
                    <select name="idThuocTinh" id="idThuocTinh">
                        <?php foreach ($list_lh_thuoctinh as $l) { ?>
                            <option value="<?php echo $l->idThuocTinh; ?>"><?php echo $l->tenThuocTinh; ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Tên Thuộc Tính HH</td>
                <td><input type="text" name="tenThuocTinhHH" /></td>
            </tr>
            <tr>
                <td>Ghi Chú</td>
                <td><input type="text" name="ghiChu" /></td>
            </tr>
            <tr>
                <td><input type="submit" value="Tạo mới" /></td>
            </tr>
        </table>
    </form>
</div>

<hr />
<div>Danh sách thuộc tính hàng hóa</div>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>ID Hàng Hóa</th>
            <th>ID Thuộc Tính</th>
            <th>Tên Thuộc Tính HH</th>
            <th>Ghi Chú</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($list_lh_thuoctinhhh as $u) { ?>
            <tr>
                <td><?php echo $u->idThuocTinhHH; ?></td>
                <td><?php echo $u->idhanghoa; ?></td>
                <td><?php echo $u->idThuocTinh; ?></td>
                <td><?php echo htmlspecialchars($u->tenThuocTinhHH); ?></td>
                <td><?php echo htmlspecialchars($u->ghiChu); ?></td>
                <td>
                    <a href="./elements_LQA/mthuoctinhhh/thuoctinhhhAct.php?reqact=deletethuoctinhhh&idThuocTinhHH=<?php echo $u->idThuocTinhHH; ?>" onclick="return confirm('Bạn có chắc muốn xóa không?');">
                        <img src="./img_LQA/delete.png" class="iconimg">
                    </a>
                    <img src="./img_LQA/Update.png" class="w_update_btn_open_tthh" data-id="<?php echo $u->idThuocTinhHH; ?>">
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<div id="w_update_tthh" style="display:none;">
    <div id="w_update_form_tthh"></div>
    <button class="close-btn" id="w_close_btn_tthh">Đóng</button>
</div>

<script>
$(document).ready(function() {
    $(".w_update_btn_open_tthh").click(function(e) {
        e.preventDefault();
        const idThuocTinhHH = $(this).data("id");
        $("#w_update_form_tthh").load("./elements_LQA/mthuoctinhhh/thuoctinhhhUpdate.php", { idThuocTinhHH: idThuocTinhHH });
        $("#w_update_tthh").show();
    });

    $("#w_close_btn_tthh").click(function() {
        $("#w_update_tthh").hide();
    });
});
</script>
