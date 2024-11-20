<div align="center">Cập nhật hàng hóa</div>
<hr>
<?php
require '../../elements_LQA/mod/hanghoaCls.php';
require '../../elements_LQA/mod/loaihangCls.php';
$idhanghoa = $_REQUEST['idhanghoa'];
echo $idhanghoa;

$lhobj = new hanghoa();
$getLhUpdate = $lhobj->HanghoaGetbyId($idhanghoa);
$obj = new loaihang();
$list_lh = $obj->LoaihangGetAll();

// Fetch lists for employees, units of measurement, and brands
$list_nhanvien = $lhobj->GetAllNhanVien();
$list_donvitinh = $lhobj->GetAllDonViTinh();
$list_thuonghieu = $lhobj->GetAllThuongHieu();
?>

<div>
    <form name="updatehanghoa" id="formupdatehh" method="post" action='./elements_LQA/mhanghoa/hanghoaAct.php?reqact=updatehanghoa' enctype="multipart/form-data">
        <input type="hidden" name="idhanghoa" value="<?php echo $getLhUpdate->idhanghoa;  ?>" />
        <input type="hidden" name="hinhanh" value="<?php echo $getLhUpdate->hinhanh;  ?>" />
        <table>
            <tr>
                <td>Tên loại hàng</td>
                <td><input type="text" name="tenhanghoa" value="<?php echo $getLhUpdate->tenhanghoa; ?>" /></td>
            </tr>
            <tr>
                <td>Giá tham khảo</td>
                <td><input type="text" name="giathamkhao" value="<?php echo $getLhUpdate->giathamkhao; ?>" /></td>
            </tr>
            <tr>
                <td>Mô tả</td>
                <td><input type="text" size="50" name="mota" value="<?php echo $getLhUpdate->mota; ?>" /></td>
            </tr>
            <tr>
                <td>Chọn loại hàng:</td>
                <td>
                    <?php
                    foreach ($list_lh as $l) {
                    ?>
                        <input type="radio" name="idloaihang" value="<?php echo $l->idloaihang; ?>"<?php if($l->idloaihang == $getLhUpdate->idloaihang){echo ' checked';} ?>>
                        <img class="iconbutton" src="data:image/png;base64,<?php echo $l->hinhanh; ?>">
                        <br>
                    <?php
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Chọn thương hiệu:</td>
                <td>
                    <select name="idThuongHieu">
                        <option value="">-- Chọn thương hiệu --</option>
                        <?php
                        foreach ($list_thuonghieu as $th) {
                        ?>
                            <option value="<?php echo $th->idThuongHieu; ?>" <?php if($th->idThuongHieu == $getLhUpdate->idThuongHieu){echo 'selected';} ?>><?php echo $th->tenTH; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Chọn đơn vị tính:</td>
                <td>
                    <select name="idDonViTinh">
                        <option value="">-- Chọn đơn vị tính --</option>
                        <?php
                        foreach ($list_donvitinh as $dvt) {
                        ?>
                            <option value="<?php echo $dvt->idDonViTinh; ?>" <?php if($dvt->idDonViTinh == $getLhUpdate->idDonViTinh){echo 'selected';} ?>><?php echo $dvt->tenDonViTinh; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Chọn nhân viên:</td>
                <td>
                    <select name="idNhanVien">
                        <option value="">-- Chọn nhân viên --</option>
                        <?php
                        foreach ($list_nhanvien as $nv) {
                        ?>
                            <option value="<?php echo $nv->idNhanVien; ?>" <?php if($nv->idNhanVien == $getLhUpdate->idNhanVien){echo 'selected';} ?>><?php echo $nv->tenNV; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><input type="submit" id="btnsubmit" value="Cập nhật" /></td>
                <td><input type="reset" value="Làm lại" /><b id="noteForm"></b></td>
            </tr>
        </table>
    </form>
</div>