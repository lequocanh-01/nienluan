<?php
session_start();
require '../../elements_LQA/mod/hanghoaCls.php';
//nếu có biến yêu cầu đlúng tên biến thì cbo vô nếu không đẩy về index.php ngăn truy cập mục đichs không rõ ràng
if (isset($_GET['reqact'])) {
    $requestAction = $_GET['reqact'];
    echo$requestAction;
    switch ($requestAction) {
        case 'addnew': //them moi
            //xu lys them moi 
            //nhabn du lieu
            $tenhanghoa = $_REQUEST['tenhanghoa'];
            $giathamkhao = $_REQUEST['giathamkhao'];
            $mota = $_REQUEST['mota'];
            $idloaihang = $_REQUEST['idloaihang'];
            $hinhanh_file = $_FILES['fileimage']['tmp_name'];
            $hinhanh = base64_encode(file_get_contents(addslashes($hinhanh_file)));
            //kiem thu lieu da nhan du khong
            // echo $tenhanghoa . '<br/>';
            // echo $mota . '<br/>';
            // echo $giathamkhao . '<br/>';
            // echo $idloaihang . '<br/>';
            // echo $hinhanh . '<br/>';
            

            $lh = new hanghoa();
            $kq = $lh->HanghoaAdd($tenhanghoa, $mota, $giathamkhao, $hinhanh, $idloaihang);
            if ($kq) {
                header('location: ../../index.php?req=hanghoaView&result=ok');
            } else {
                header('location: ../../index.php?req=hanghoaView&result=notok');
            }
            break;
        case 'deletehanghoa':
            $idhanghoa = $_REQUEST['idhanghoa'];
            // echo $idhanghoa;
            $hh = new hanghoa();
            $kq = $hh->HanghoaDelete($idhanghoa);
            if ($kq) {
                header('location: ../../index.php?req=hanghoaView&result=ok');
            } else {
                header('location: ../../index.php?req=hanghoaView&result=notok');
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
            // echo $idhanghoa . '<br/>';
            // echo $tenhanghoa . '<br/>';
            // echo $mota . '<br/>';
            // echo $hinhanh . '<br/>';
            $lh = new hanghoa();
            $kq = $lh->HanghoaUpdate($tenhanghoa, $hinhanh, $mota, $giathamkhao, $idloaihang, $idhanghoa);
            if ($kq) {
                header('location: ../../index.php?req=hanghoaview&result=ok');
            } else {
                header('location: ../../index.php?req=hanghoaview&result=notok');
            }
            break;
        default:
            //danh cho truong hop khong gan thi dai gia tri nao do trong cau truc xu ly 
            header('location: ../../index.php?req=hanghoaview');
            break;
    }
} else {
    //nhay lai dia chi index.php
    header('location: ../../index.php?req=hanghoaview');
}
