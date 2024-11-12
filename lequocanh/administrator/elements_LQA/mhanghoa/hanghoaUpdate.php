<div align="center">Cập nhật hàng hóa</div>
<hr>
<?php
require '../../elements_LQA/mod/hanghoaCls.php';
require '../../elements_LQA/mod/loaihangCls.php';
$idhanghoa = $_REQUEST['idhanghoa'];
echo $idhanghoa;

$lhobj = new hanghoa();
$getLhUpdate = $lhobj->HanghoaGetbyId($idhanghoa);
// echo $getUserUpdate->hoten;
$obj = new loaihang();
$list_lh = $obj->LoaihangGetAll();

?>

<div>
    <form name="updatehanghoa" id="formupdatehh" method="post" action='./elements_LQA/mhanghoa/hanghoaAct.php?reqact=updatehanghoa' enctype="multipart/form-data">
        <input type="hidden" name="idhanghoa" value="<?php echo $getLhUpdate->idhanghoa;  ?>" />
        <input type="hidden" name="hinhanh" value="<?php echo $getLhUpdate->hinhanh;  ?>" />
        <table>
            <tr>
                <td>Tên loại hàng</td>
                <td><input type="text" name="tenhanghoa" value="<?php echo $getLhUpdate->tenhanghoa;
                                                                    ?>" /></td>
            </tr>
            <tr>
                <td>Gía tham khảo</td>
                <td><input type="text" name="giathamkhao" value="<?php echo $getLhUpdate->giathamkhao;
                                                                    ?>" /></td>
            </tr>
            <tr>
                <td>Mô tả</td>
                <td><input type="text" size="50" name="mota" value="<?php echo $getLhUpdate->mota;
                                                                    ?>" /></td>
            </tr>
            <tr>
                <td>Chọn loại hàng:</td>
                <td>
                    <?php
                    foreach ($list_lh as $l) {
                    ?>
                        <input type="radio" name="idloaihang" value="<?php echo $l->idloaihang; ?>"<?php if($l->idloaihang == $getLhUpdate->idloaihang){echo 'checked';}?>>
                        <img class="iconbutton" src="data:image/png;base64,<?php echo $l->hinhanh; ?>">
                        <br>
                    <?php
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Hình ảnh</td>
                <td>
                    
                    <img width="150px" src="data:image/png;base64,<?php echo $getLhUpdate->hinhanh; ?>"><br>
                    <input type="file" name="fileimage">
                </td>
            </tr>

            <tr>
                <td><input type="submit" id="btnsubmit" value="Update" size="50" /></td>
                <td><b id="noteForm"></b></td>
            </tr>
        </table>
    </form>
</div>