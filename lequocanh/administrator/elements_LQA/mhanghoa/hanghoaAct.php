<?php
session_start();
require '../../elements_LQA/mod/hanghoaCls.php';

if (isset($_GET['reqact'])) {
    $requestAction= $_GET['reqact'];
switch ($requestAction) {
    case 'addnew': 
        $tenhanghoa = $_REQUEST['tenhanghoa'];
        $giathamkhao = $_REQUEST['giathamkhao'];
        $mota = $_REQUEST['mota'];
        $idloaihang = $_REQUEST['idloaihang'];

        // Check if a file was uploaded
        if (isset($_FILES['hinhanh']) && $_FILES['hinhanh']['error'] == UPLOAD_ERR_OK) {
            $hinhanh_file = $_FILES['hinhanh']['tmp_name'];
            $hinhanh = base64_encode(file_get_contents($hinhanh_file));
        } else {
            // Handle the case where no file was uploaded
            // Set a default image or handle the error
            $hinhanh = ''; // Set to an empty string or a default image path
        }

        $lh = new hanghoa();
        $kq = $lh->HanghoaAdd($tenhanghoa, $mota, $giathamkhao, $hinhanh, $idloaihang);
        if ($kq) {
            header('location: ../../index.php?req=hanghoaview&result=ok');
        } else {
            header('location: ../../index.php?req=hanghoaview&result=notok');
        }
        break;
    case 'deletehanghoa':
        $idhanghoa = $_REQUEST['idhanghoa'];
        $hh = new hanghoa();
        $kq = $hh->HanghoaDelete($idhanghoa);
        if ($kq) {
            header('location: ../../index.php?req=hanghoaview&result=ok');
        } else {
            header('location: ../../index.php?req=hanghoaview&result=notok');
        }
        break;
    case 'updatehanghoa':
        $idhanghoa = $_REQUEST['idhanghoa'];
        $tenhanghoa = $_REQUEST['tenhanghoa'];
        $giathamkhao = $_REQUEST['giathamkhao'];
        $idloaihang = $_REQUEST['idloaihang'];
        $mota = $_REQUEST['mota'];
        
        if (file_exists($_FILES['fileimage']['tmp_name'])) {
            $hinhanh_file = $_FILES['fileimage']['tmp_name'];
            $hinhanh = base64_encode(file_get_contents(addslashes($hinhanh_file)));
        } else {
            $hinhanh = $_REQUEST['hinhanh'];
        }
        $lh = new hanghoa();
        $kq = $lh->HanghoaUpdate($tenhanghoa, $hinhanh, $mota, $giathamkhao, $idloaihang, $idhanghoa);
        if ($kq) {
            header('location: ../../index.php?req=hanghoaview&result=ok');
        } else {
            header('location: ../../index.php?req=hanghoaview&result=notok');
        }
        break;
    default:
        header('location: ../../index.php?req=hanghoaview');
        break;
}
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $tenhanghoa = $_POST['tenhanghoa'];
    $mota = $_POST['mota'];
    $giathamkhao = $_POST['giathamkhao'];
    $hinhanh = $_POST['hinhanh'];
    $idloaihang = $_POST['idloaihang'];
    $soluong = isset($_POST['soluong']) ? $_POST['soluong'] : 1; // Default to 1 if not set

    // Add the product to the database
    $hanghoa = new hanghoa();
    $hanghoa->HanghoaAdd($tenhanghoa, $mota, $giathamkhao, $hinhanh, $idloaihang, $soluong);
}