<div align="center">
    <h2>Cập nhật hàng hóa</h2>
    <hr>
</div>

<?php
require_once '../../elements_LQA/mod/hanghoaCls.php';
require_once '../../elements_LQA/mod/loaihangCls.php';

$idhanghoa = $_REQUEST['idhanghoa'];
//echo $idhanghoa;

$lhobj = new hanghoa();
$getLhUpdate = $lhobj->HanghoaGetbyId($idhanghoa);

$obj = new loaihang();
$list_lh = $obj->LoaihangGetAll();

?>

<div
    style="background: linear-gradient(to right, #1a2980, #26d0ce); padding: 20px; border-radius: 10px; margin: 20px auto; max-width: 600px;">
    <form name="updatehanghoa" id="formupdatehh" method="post"
        action='./elements_LQA/mhanghoa/hanghoaAct.php?reqact=updatehanghoa' enctype="multipart/form-data">
        <input type="hidden" name="idhanghoa" value="<?php echo $getLhUpdate->idhanghoa;  ?>" />
        <input type="hidden" name="hinhanh" value="<?php echo $getLhUpdate->hinhanh;  ?>" />
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="text-align: right; padding-right: 10px; font-weight: bold; color: #fff;">Tên loại hàng:</td>
                <td><input type="text" name="tenhanghoa" value="<?php echo $getLhUpdate->tenhanghoa;
                                                                ?>"
                        style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 3px;" /></td>
            </tr>
            <tr>
                <td style="text-align: right; padding-right: 10px; font-weight: bold; color: #fff;">Gía tham khảo:</td>
                <td><input type="text" name="giathamkhao" value="<?php echo $getLhUpdate->giathamkhao;
                                                                    ?>"
                        style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 3px;" /></td>
            </tr>
            <tr>
                <td style="text-align: right; padding-right: 10px; font-weight: bold; color: #fff;">Mô tả:</td>
                <td><textarea name="mota"
                        style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 3px;"><?php echo $getLhUpdate->mota; ?></textarea>
                </td>
            </tr>
            <tr>
                <td style="text-align: right; padding-right: 10px; font-weight: bold; color: #fff;">Chọn loại hàng:</td>
                <td>
                    <?php
                    foreach ($list_lh as $l) {
                    ?>
                    <label style="display: block;">
                        <input type="radio" name="idloaihang" value="<?php echo $l->idloaihang; ?>" <?php if ($l->idloaihang == $getLhUpdate->idloaihang) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                        <img class="iconbutton" src="data:image/png;base64,<?php echo $l->hinhanh; ?>">
                        <?php echo $l->tenloaihang; ?>
                    </label>
                    <?php
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td style="text-align: right; padding-right: 10px; font-weight: bold; color: #fff;">Hình ảnh:</td>
                <td>
                    <img width="150px" src="data:image/png;base64,<?php echo $getLhUpdate->hinhanh; ?>"><br>
                    <input type="file" name="fileimage"
                        style="padding: 8px; border: 1px solid #ccc; border-radius: 3px;">
                </td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <input type="submit" id="btnsubmit" value="Update" size="50"
                        style="background-color: #1a2980; color: white; padding: 10px 20px; border: none; border-radius: 3px; cursor: pointer; font-weight: bold;">
                    <b id="noteForm"></b>
                </td>
            </tr>
        </table>
    </form>
</div>