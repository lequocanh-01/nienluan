<div>Quản lý hàng hóa</div>
<hr>
<div>Thêm hàng hóa</div>
<?php
require './elements_LQA/mod/loaihangCls.php';
$lhobj = new loaihang();
$list_lh = $lhobj->LoaihangGetAll();
$l = count($list_lh);
?>
<div>
    <form name="newhanghoa" id="formaddhanghoa" method="post" action='./elements_LQA/mhanghoa/hanghoaAct.php?reqact=addnew' enctype="multipart/form-data">
        <table>
            <tr>
                <td>Tên hàng hóa</td>
                <td><input type="text" name="tenhanghoa" /></td>
            </tr>
            <tr>
                <td>Giá tham khảo</td>
                <td><input type="number" name="giathamkhao" /></td>
            </tr>
            <tr>
                <td>Mô tả</td>
                <td><input type="text" name="mota" /></td>
            </tr>
            <tr>
                <td>Hình ảnh</td>
                <td><input type="file" name="fileimage"></td>
            </tr>
            <tr>
                <td>Chọn loại hàng:</td>
                <td>
                    <?php
                    foreach ($list_lh as $l) {
                    ?>
                        <input type="radio" name="idloaihang" value="<?php echo $l->idloaihang; ?>">
                        <img class="iconbutton" src="data:image/png;base64,<?php echo $l->hinhanh; ?>">
                        <br>
                    <?php
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td><input type="submit" id="btnsubmit" value="Tạo mới" /></td>
                <td><input type="reset" value="Làm lại" /><b id="noteForm"></b></td>
            </tr>
        </table>
    </form>
    <hr />
    <?php
    require './elements_LQA/mod/hanghoaCls.php';
    $lhobj = new hanghoa();
    $list_lh = $lhobj->HanghoaGetAll();
    $l = count($list_lh);
    ?>
    <div class="title_hanghoa">Danh sách hàng hóa</div>
    <div class="content_hanghoa">
        Trong bảng có: <b><?php echo $l; ?></b>

        <table border="solid">
            <thead>
                <th>ID</th>
                <th>Tên loại hàng</th>
                <th>Gia tham khảo</th>
                <th>Mô tả</th>
                <th>Hình ảnh</th>
                <th>Chức năng</th>
            </thead>
            <?php
            if ($l > 0) {
                foreach ($list_lh as $u) {
            ?>
                    <tr>
                        <td><?php echo $u->idhanghoa; ?></td>
                        <td><?php echo $u->tenhanghoa; ?></td>
                        <td><?php echo $u->giathamkhao; ?></td>
                        <td><?php echo $u->mota; ?></td>
                        <td align="center">

                            <img class="iconbutton" src="data:image/png;base64,<?php echo $u->hinhanh; ?>">
                        </td>
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
        </table>
    </div>

    <div id="w_update_hh">
        <div id="w_update_form_hh"></div>
        <input type="button" value="close" id="w_close_btn_hh">
    </div>
</div>
