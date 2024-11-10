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
    }
} else {
    require './elements_LQA/default.php';
}
