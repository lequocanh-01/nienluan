<?php
session_start();
require '../../elements_LQA/mod/loaihangCls.php';

if (isset($_GET['reqact'])) {
    $requestAction = $_GET['reqact'];
    switch ($requestAction) {
        case 'addnew':
            $tenloaihang = $_REQUEST['tenloaihang'];
            $mota = $_REQUEST['mota'];
            $hinhanh_file = $_FILES['fileimage']['tmp_name'];
            $hinhanh = base64_encode(file_get_contents(addslashes($hinhanh_file)));
            $lh = new loaihang();
            $kq = $lh->LoaihangAdd($tenloaihang, $hinhanh, $mota);
            if ($kq) {
                header('location: ../../index.php?req=loaihangview&result=ok');
            } else {
                header('location: ../../index.php?req=loaihangview&result=notok');
            }
            break;
        case 'deleteloaihang':
            $idloaihang = $_REQUEST['idloaihang'];
            $lh = new loaihang();
            $kq = $lh->LoaihangDelete($idloaihang);
            if ($kq) {
                header('location: ../../index.php?req=loaihangview&result=ok');
            } else {
                header('location: ../../index.php?req=loaihangview&result=notok');
            }
            break;
        case 'updateloaihang':

            $idloaihang = $_REQUEST['idloaihang'];
            $tenloaihang = $_REQUEST['tenloaihang'];
            $mota = $_REQUEST['mota'];

            if (file_exists($_FILES['fileimage']['tmp_name'])) {
                $hinhanh_file = $_FILES['fileimage']['tmp_name'];
                $hinhanh = base64_encode(file_get_contents(addslashes($hinhanh_file)));
            } else {
                $hinhanh = $_REQUEST['hinhanh'];
            }
            $lh = new loaihang();
            $kq = $lh->LoaihangUpdate($tenloaihang, $hinhanh, $mota, $idloaihang);
            if ($kq) {
                header('location: ../../index.php?req=loaihangview&result=ok');
            } else {
                header('location: ../../index.php?req=loaihangview&result=notok');
            }
            break;
        default:
            header('location: ../../index.php?req=loaihangview');
            break;
    }
} else {
    header('location: ../../index.php?req=loaihangview');
}
