<?php
session_start();
require '../../elements_LQA/mod/userCls.php';
require '../../elements_LQA/mod/giohangCls.php';

if (isset($_GET['reqact'])) {
    $requestAction = $_GET['reqact'];
    switch ($requestAction) {
        case 'addnew':
            // xử lý thêm
            $username = $_REQUEST['username'];
            $password = $_REQUEST['password'];
            $hoten = $_REQUEST['hoten'];
            $gioitinh = $_REQUEST['gioitinh'];
            $ngaysinh = $_REQUEST['ngaysinh'];
            $dienthoai = $_REQUEST['dienthoai'];
            $diachi = $_REQUEST['diachi'];
            $userObj = new user();;
            $kq = $userObj->UserAdd($username, $password, $hoten, $gioitinh, $ngaysinh, $diachi, $dienthoai);
            if ($kq) {
                header('Location: ../../index.php?req=userview&result=ok');
            } else {
                header('Location: ../../index.php?req=userview&result=notok');
            }
            break;
            
        case 'deleteuser':
            $iduser = $_REQUEST['iduser'];
            $userObj = new user();
            $user = $userObj->UserGetByid($iduser);
            
            // Kiểm tra nếu là tài khoản admin
            if ($user->username === 'admin') {
                $admin_password = isset($_REQUEST['admin_password']) ? $_REQUEST['admin_password'] : '';
                if ($admin_password !== 'lequocanh') {
                    header('location: ../../index.php?req=userview&result=invalid_admin_pass');
                    exit();
                }
            }
            
            $kq = $userObj->UserDelete($iduser);
            if($kq){
                header('location: ../../index.php?req=userview&result=ok');
            } else {
                header('location: ../../index.php?req=userview&result=notok');
            }
            break;

        case 'setlock':
            $iduser = $_REQUEST['iduser'];
            $setlock = $_REQUEST['setlock'];
            $userObj = new user();
            $user = $userObj->UserGetbyId($iduser);
            
            // Kiểm tra nếu là tài khoản admin
            if ($user->username === 'admin') {
                $admin_password = isset($_REQUEST['admin_password']) ? $_REQUEST['admin_password'] : '';
                if ($admin_password !== 'lequocanh') {
                    header('location: ../../index.php?req=userview&result=invalid_admin_pass');
                    exit();
                }
            }
            
            $newStatus = $setlock == 1 ? 0 : 1;
            $kq = $userObj->UserSetACtive($iduser, $newStatus);
            if($kq){
                header('location: ../../index.php?req=userview&result=ok');
            } else {
                header('location: ../../index.php?req=userview&result=notok');
            }
            break;
        case 'updateuser':
            $username = $_REQUEST['username'];
            $password = $_REQUEST['password'];
            $hoten = $_REQUEST['hoten'];
            $gioitinh = $_REQUEST['gioitinh'];
            $ngaysinh = $_REQUEST['ngaysinh'];
            $diachi = $_REQUEST['diachi'];
            $dienthoai = $_REQUEST['dienthoai'];
            $iduser = $_REQUEST['iduser'];
            
            // Kiểm tra nếu là admin và yêu cầu mật khẩu admin
            if ($username === 'admin') {
                $admin_password = isset($_REQUEST['admin_password']) ? $_REQUEST['admin_password'] : '';
                if ($admin_password !== 'lequocanh') {
                    header('location: ../../index.php?req=userview&result=invalid_admin_pass');
                    exit();
                }
            }
            
            $userObj = new user();
            // Kiểm tra xem có thay đổi mật khẩu không
            if (empty($password)) {
                // Nếu không có mật khẩu mới, lấy mật khẩu cũ
                $oldUserData = $userObj->UserGetbyId($iduser);
                $password = $oldUserData->password;
            }
            
            $kq = $userObj->UserUpdate($username, $password, $hoten, $gioitinh, $ngaysinh, $diachi, $dienthoai, $iduser);
            if($kq) {
                header('location: ../../index.php?req=userview&result=ok');
            } else {
                header('location: ../../index.php?req=userview&result=notok');
            }
            break;
            
        case 'checklogin':
            $username = $_REQUEST['username'];
            $password = $_REQUEST['password'];
            $userObj = new user();
            $kq = $userObj->UserCheckLogin($username, $password);
            if ($kq) {
                if ($username == 'admin') {
                    $_SESSION['ADMIN'] = $username;
                    // Chuyển giỏ hàng từ session sang database
                    $giohang = new GioHang();
                    $giohang->migrateSessionCartToDatabase($username);
                    header('location: ../../index.php?req=userview&result=ok');
                } else {
                    $_SESSION['USER'] = $username;
                    // Chuyển giỏ hàng từ session sang database
                    $giohang = new GioHang();
                    $giohang->migrateSessionCartToDatabase($username);
                    // Đặt cookie sau khi đăng nhập thành công
                    $time_login = date('h:i - d/m/Y');
                    setcookie($username, $time_login, time() + (86400 * 30), '/');
                    header('location: ../../../index.php');
                }
            } else {
                header('location: ../../userLogin.php?error=1');
            }
            break;

        case 'userlogout':
            $time_login = date('h:i - d/m/Y');
            if(isset($_SESSION['USER'])){
                $namelogin = $_SESSION['USER'];
            }
            if(isset($_SESSION['ADMIN'])){
                $namelogin = $_SESSION['ADMIN'];
            }
            // Chỉnh sửa tên cookie
            $namelogin = str_replace(' ', '-', $namelogin);
            $namelogin = str_replace('"', '', $namelogin);
            setcookie($namelogin, $time_login, time() + (86400 * 30), '/'); // 1 tháng
            session_destroy();
            
            // Chuyển hướng về trang chủ sau khi đăng xuất
            if(isset($_SESSION['ADMIN'])) {
                header('location: ../../index.php');
            } else {
                header('location: ../../../index.php');
            }
            break;
        default:
            header('Location: ../../index.php?req=userview');
            break;
    }
} else {
    header('Location: ../../index.php?req=userview');
}
?>