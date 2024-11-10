<div>Cập nhật người dùng</div>
<?php
    require './elements_LQA/mod/userCls.php';
    $iduser = $_REQUEST['iduser'];
    //echo $iduser;
    $userObj = new user();
    $getUserUpdate = $userObj->UserGetByid($iduser);
?>
<div>
    <form name="updateuser" id="formupdate" method="post" action="./elements_LQA/mUser/userAct.php?reqact=updateuser">
        <input type="hiden" name="iduser" value="<?php echo $getUserUpdate->iduser;?>">
        <table>
            <tr>
                <td>Tên đăng nhập:</td>
                <td><input type="text" name="username" value="<?php echo $getUserUpdate->username;?>" /></td>
            </tr>
            <tr>
                <td>Mật khẩu:</td>
                <td><input type="password" name="password" value="<?php echo $getUserUpdate->password;?>" /></td>
            </tr>
            <tr>
                <td>Họ tên:</td>
                <td><input type="text" name="hoten" value="<?php echo $getUserUpdate->hoten;?>" /></td>
            </tr>
            <tr>
                <td>Giới tính:</td>
                <td>Nam<input type="radio" name="gioitinh" value="1"
                        <?php if($getUserUpdate->gioitinh==1) echo 'checked' ?> />
                    Nữ<input type="radio" name="gioitinh" value="0"
                        <?php if($getUserUpdate->gioitinh==0) echo 'checked' ?> />
                </td>
            </tr>
            <tr>
                <td>Ngày sinh:</td>
                <td><input type="date" name="ngaysinh" value="<?php echo $getUserUpdate->ngaysinh;?>" /></td>
            </tr>
            <tr>
                <td>Địa chỉ:</td>
                <td><input type="text" name="diachi" value="<?php echo $getUserUpdate->diachi;?>" /></td>
            </tr>
            <tr>
                <td>Điện thoại:</td>
                <td><input type="tel" name="dienthoai" value="<?php echo $getUserUpdate->dienthoai;?>" /></td>
            </tr>
            <tr>
                <td><input type="submit" id="btnsubmit" value="Cập Nhật" /></td>
            </tr>
        </table>
    </form>
</div>