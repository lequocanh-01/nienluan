<h2 align="center">Cập nhật loại hàng</h2>
<hr>
<?php
require '../../elements_LQA/mod/loaihangCls.php';
$idloaihang = $_REQUEST['idloaihang'];
$loaihang = new loaihang();
$getloaihang = $loaihang->loaihangGetbyId($idloaihang);
?>
<div class="title_mod">
    <img class="iconimg" src="./img_LQA/Update2.png" />Cập nhật loại hàng
</div>
<div class="content_mod">
    <form name="updateloaihang" id="formupdate" method="post" enctype="multipart/form-data" action="./elements_LQA/mLoaihang/loaihangAct.php?reqact=updateloaihang">
        <input type="hidden" name="idloaihang" value="<?php echo htmlspecialchars($idloaihang); ?>" />
        <input type="hidden" name="hinhanh" value="<?php echo htmlspecialchars($getloaihang->hinhanh); ?>" />
        <table>
            <tr>
                <td>Tên Loại hàng:</td>
                <td><input type="text" name="tenloaihang" value="<?php echo htmlspecialchars($getloaihang->tenloaihang); ?>" /></td>
            </tr>
            <tr>
                <td>Mô tả:</td>
                <td><input type="text" name="mota" value="<?php echo htmlspecialchars($getloaihang->mota); ?>" /></td>
            </tr>
            <tr>
                <td>Hình ảnh:</td>
                <td>
                    <?php if (!empty($getloaihang->hinhanh)): ?>
                        <img width="100px" class="imgtable" src="data:image/png;base64,<?php echo htmlspecialchars($getloaihang->hinhanh); ?>" />
                    <?php endif; ?>
                    <br>
                    <input type="file" name="fileimage" />

                </td>
            </tr>
            <tr>
                <td><input type="submit" id="btnsubmit" value="Update" /></td>
                <td><input type="reset" value="Làm lại" /><b id="noteForm"></b></td>
            </tr>
        </table>
    </form>
</div>