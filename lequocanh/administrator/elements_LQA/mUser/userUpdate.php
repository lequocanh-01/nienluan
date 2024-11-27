<div>Cập nhật người dùng</div>
<?php
    require './elements_LQA/mod/userCls.php';
    $iduser = $_REQUEST['iduser'];
    $userObj = new user();
    $getUserUpdate = $userObj->UserGetbyId($iduser);
    
    // Kiểm tra xem có phải admin không
    $isAdmin = ($getUserUpdate->username === 'admin');
?>
<div>
    <form name="updateuser" id="formupdate" method="post" action="./elements_LQA/mUser/userAct.php?reqact=updateuser">
        <input type="hidden" name="iduser" value="<?php echo $getUserUpdate->iduser;?>">
        <input type="hidden" name="username" value="<?php echo $getUserUpdate->username;?>">
        <?php if($isAdmin): ?>
            <input type="hidden" name="admin_password" id="admin_password">
        <?php endif; ?>
        <table>
            <tr>
                <td>Tên đăng nhập:</td>
                <td><?php echo $getUserUpdate->username;?></td>
            </tr>
            <tr>
                <td>Mật khẩu mới:</td>
                <td><input type="password" name="password" placeholder="Để trống nếu không đổi mật khẩu"/></td>
            </tr>
            <tr>
                <td>Họ tên:</td>
                <td><input type="text" name="hoten" value="<?php echo $getUserUpdate->hoten;?>" required/></td>
            </tr>
            <tr>
                <td>Giới tính:</td>
                <td>Nam<input type="radio" name="gioitinh" value="1"
                        <?php if($getUserUpdate->gioitinh==1) echo 'checked' ?> required/>
                    Nữ<input type="radio" name="gioitinh" value="0"
                        <?php if($getUserUpdate->gioitinh==0) echo 'checked' ?> required/>
                </td>
            </tr>
            <tr>
                <td>Ngày sinh:</td>
                <td><input type="date" name="ngaysinh" value="<?php echo $getUserUpdate->ngaysinh;?>" required/></td>
            </tr>
            <tr>
                <td>Địa chỉ:</td>
                <td><input type="text" name="diachi" value="<?php echo $getUserUpdate->diachi;?>" required/></td>
            </tr>
            <tr>
                <td>Điện thoại:</td>
                <td><input type="tel" name="dienthoai" value="<?php echo $getUserUpdate->dienthoai;?>" required/></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" class="btn btn-primary" <?php echo $isAdmin ? 'onclick="return checkAdminPassword()"' : ''; ?>>Cập nhật</button>
                    <a href="index.php?req=userview" class="btn btn-secondary">Quay lại</a>
                </td>
            </tr>
        </table>
    </form>
</div>

<?php if($isAdmin): ?>
<script>
function checkAdminPassword() {
    var adminPass = prompt('Vui lòng nhập mật khẩu admin để thực hiện thao tác này:');
    if (!adminPass) {
        return false;
    }
    document.getElementById('admin_password').value = adminPass;
    return true;
}
</script>
<?php endif; ?>