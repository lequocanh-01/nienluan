<head>
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn {
            cursor: pointer !important;
            padding: 8px 16px;
            margin: 5px;
        }
        input, select {
            margin: 5px 0;
            padding: 5px;
        }
        table {
            width: 100%;
            max-width: 600px;
        }
        td {
            padding: 8px;
        }
    </style>
</head>

<?php
require './elements_LQA/mod/userCls.php';

$iduser = isset($_REQUEST['iduser']) ? $_REQUEST['iduser'] : null;

if (!$iduser) {
    echo "ID người dùng không hợp lệ";
    exit;
}

$userObj = new user();
$getUserUpdate = $userObj->UserGetbyId($iduser);

if (!$getUserUpdate) {
    echo "Không tìm thấy người dùng";
    exit;
}
?>

<div align="center">Cập nhật thông tin người dùng</div>
<hr>
<div>
    <form name="updateuser" id="formupdateuser" method="post" action="./elements_LQA/mUser/userAct.php?reqact=updateuser">
        <input type="hidden" name="iduser" value="<?php echo $getUserUpdate->iduser; ?>" />
        <table>
            <tr>
                <td>Tên đăng nhập:</td>
                <td>
                    <input type="text" name="username" value="<?php echo htmlspecialchars($getUserUpdate->username); ?>" 
                           <?php echo ($getUserUpdate->username === 'admin') ? 'readonly' : ''; ?> />
                </td>
            </tr>
            <tr>
                <td>Mật khẩu:</td>
                <td><input type="password" name="password" value="<?php echo htmlspecialchars($getUserUpdate->password); ?>" /></td>
            </tr>
            <tr>
                <td>Họ tên:</td>
                <td><input type="text" name="hoten" value="<?php echo htmlspecialchars($getUserUpdate->hoten); ?>" /></td>
            </tr>
            <tr>
                <td>Giới tính:</td>
                <td>
                    Nam<input type="radio" name="gioitinh" value="1" <?php echo $getUserUpdate->gioitinh == 1 ? 'checked' : ''; ?> />
                    Nữ<input type="radio" name="gioitinh" value="0" <?php echo $getUserUpdate->gioitinh == 0 ? 'checked' : ''; ?> />
                </td>
            </tr>
            <tr>
                <td>Ngày sinh:</td>
                <td><input type="date" name="ngaysinh" value="<?php echo $getUserUpdate->ngaysinh; ?>" /></td>
            </tr>
            <tr>
                <td>Địa chỉ:</td>
                <td><input type="text" name="diachi" value="<?php echo htmlspecialchars($getUserUpdate->diachi); ?>" /></td>
            </tr>
            <tr>
                <td>Điện thoại:</td>
                <td><input type="tel" name="dienthoai" value="<?php echo htmlspecialchars($getUserUpdate->dienthoai); ?>" /></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" id="btnsubmit" value="Cập nhật" />
                    <b id="noteForm"></b>
                </td>
            </tr>
        </table>
    </form>
</div>

<script>
$(document).ready(function() {
    $("#formupdateuser").submit(function(e) {
        e.preventDefault();
        
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.includes('ok')) {
                    $("#noteForm").html("Cập nhật thành công!")
                        .removeClass('text-danger')
                        .addClass('text-success');
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                } else {
                    $("#noteForm").html("Có lỗi xảy ra!")
                        .removeClass('text-success')
                        .addClass('text-danger');
                }
            },
            error: function(xhr, status, error) {
                $("#noteForm").html("Lỗi kết nối: " + error)
                    .removeClass('text-success')
                    .addClass('text-danger');
            }
        });
    });
});
</script>