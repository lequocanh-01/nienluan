<?php
require_once '../mod/hanghoaCls.php';
$hanghoa = new hanghoa();
if (isset($_REQUEST['reqact'])) {
    $requestAction = $_REQUEST['reqact'];
    switch ($requestAction) {
        case 'addnew':
            $tenhanghoa = $_REQUEST['tenhanghoa'];
            $mota = $_REQUEST['mota'];
            $giathamkhao = $_REQUEST['giathamkhao'];
            $id_hinhanh = $_REQUEST['id_hinhanh'];
            $idloaihang = $_REQUEST['idloaihang'];
            $idThuongHieu = $_REQUEST['idThuongHieu'];
            $idDonViTinh = $_REQUEST['idDonViTinh'];
            $idNhanVien = $_REQUEST['idNhanVien'];

            $hanghoa->HanghoaAdd($tenhanghoa, $mota, $giathamkhao, $id_hinhanh, $idloaihang, $idThuongHieu, $idDonViTinh, $idNhanVien);
            if ($hanghoa) { 
                header('location: ../../index.php?req=hanghoaview&result=ok');
            } else {
                header('location: ../../index.php?req=hanghoaview&result=notok');
            }
            break;

        case 'deletehanghoa':
            $idhanghoa = $_REQUEST['idhanghoa'];
            $hanghoa->HanghoaDelete($idhanghoa);
            if ($hanghoa) { 
                header('location: ../../index.php?req=hanghoaview&result=ok');
            } else {
                header('location: ../../index.php?req=hanghoaview&result=notok');
            }
            break;

        case 'updatehanghoa':
            $idhanghoa = $_REQUEST['idhanghoa'];
            $tenhanghoa = $_REQUEST['tenhanghoa'];
            $mota = $_REQUEST['mota'];
            $giathamkhao = $_REQUEST['giathamkhao'];
            $id_hinhanh = $_REQUEST['id_hinhanh'];
            $idloaihang = $_REQUEST['idloaihang'];
            $idThuongHieu = $_REQUEST['idThuongHieu'];
            $idDonViTinh = $_REQUEST['idDonViTinh'];
            $idNhanVien = $_REQUEST['idNhanVien'];

            $hanghoa->HanghoaUpdate($tenhanghoa, $id_hinhanh, $mota, $giathamkhao, $idloaihang, $idThuongHieu, $idDonViTinh, $idNhanVien, $idhanghoa);
            if ($hanghoa) { 
                header('location: ../../index.php?req=hanghoaview&result=ok');
            } else {
                header('location: ../../index.php?req=hanghoaview&result=notok');
            }
            break;

        default:
            header('location:../../index.php?req=hanghoaview');
            break;
    }
}