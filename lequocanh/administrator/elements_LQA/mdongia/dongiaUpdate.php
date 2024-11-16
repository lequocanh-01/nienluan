<div align="center">Cập nhật đơn giá</div>
<hr>
<?php
require '../../elements_LQA/mod/dongiaCls.php';

$idDonGia = $_REQUEST['idDonGia'];
$dongiaObj = new Dongia();
$getLhUpdate = $dongiaObj->DongiaGetbyId($idDonGia);
?>

<div>
    <form name="updatedongia" method="post" action='./elements_LQA/mdongia/dongiaAct.php?reqact=updatedongia' enctype="multipart/form-data">
        <input type="hidden" name="idDonGia" value="<?php echo  $getLhUpdate->idDonGia ?>">

        <table>
            <tr>
                <td>ID hàng hóa:</td>
                <td><input type="text" name="idHangHoa" value="<?php echo $getLhUpdate->idHangHoa; ?>" /></td>
            </tr>
            <tr>
                <td>Tên hàng hóa:</td>
                <td><input type="text" name="tenHangHoa" value="<?php echo $getLhUpdate->tenhanghoa; ?>" /></td>
            </tr>
            <tr>
                <td>Giá Bán:</td>
                <td><input type="text" name="giaBan" value="<?php echo $getLhUpdate->giaBan; ?>" /></td>
            </tr>
            <tr>
                <td>Ngày áp dụng:</td>
                <td><input type="date" name="ngayApDung" value="<?php echo $getLhUpdate->ngayApDung; ?>" /></td>
            </tr>
            <tr>
                <td>Ngày Kết Thúc:</td>
                <td><input type="date" name="ngayKetThuc" value="<?php echo $getLhUpdate->ngayKetThuc; ?>" /></td>
            </tr>
            <tr>
                <td>Điều kiện:</td>
                <td><input type="text" name="dieuKien" value="<?php echo $getLhUpdate->dieuKien; ?>" /></td>
            </tr>
            <tr>
                <td>Ghi Chú:</td>
                <td><input type="text" name="ghiChu" value="<?php echo $getLhUpdate->ghiChu; ?>" /></td>
            </tr>
            <tr>
                <td><input type="submit" value="Cập nhật" /></td>
                <td><b id="noteForm"></b></td>
            </tr>
        </table>
    </form>
</div>