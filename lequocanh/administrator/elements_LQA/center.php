<?php
if (isset($_GET['req'])) {
    $request = $_GET['req'];
    switch ($request) {
        case 'userview':
            require './elements_LQA/mUser/userView.php';
            break;
        case 'updateuser':
            require './elements_LQA/mUser/userUpdate.php';
            break;
        case 'loaihangview':
            require './elements_LQA/mLoaihang/loaihangView.php';
            break;
        case 'hanghoaview':
            require './elements_LQA/mhanghoa/hanghoaView.php';
            break;
        case 'dongiaview': // Đảm bảo rằng trường hợp này được xử lý
            require './elements_LQA/mdongia/dongiaView.php';
            break;
        case 'thuonghieuview':
            require './elements_LQA/mthuonghieu/thuonghieuView.php';
            break;
        case 'donvitinhview':
            require './elements_LQA/mdonvitinh/donvitinhView.php';
            break;
        case 'nhanvienview':
            require './elements_LQA/mnhanvien/nhanvienView.php';
            break;
        case 'thuoctinhview':
            require './elements_LQA/mthuoctinh/thuoctinhView.php';
            break;
        case 'giohangview':
            require './elements_LQA/mgiohang/giohangView.php';
            break;
    }
} else {
    require './elements_LQA/default.php';
}
