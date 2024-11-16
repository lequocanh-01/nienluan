<?php
session_start();
require '../../elements_LQA/mod/thuoctinhCls.php';

if (isset($_GET['reqact'])) {
    $requestAction = $_GET['reqact'];
    $lh = new ThuocTinh();
    
    switch ($requestAction) {
        case 'addnew': // Thêm mới
            $tenThuocTinh = isset($_POST['tenThuocTinh']) ? $_POST['tenThuocTinh'] : '';
            $giaTri = isset($_POST['giaTri']) ? $_POST['giaTri'] : '';
            $ghiChu = isset($_POST['ghiChu']) ? $_POST['ghiChu'] : '';

            $kq = $lh->thuoctinhAdd($tenThuocTinh, $giaTri, $ghiChu);
            header('location: ../../index.php?req=thuoctinhview&result=' . ($kq ? 'ok' : 'notok'));
            break;

        case 'deletethuoctinh': // Xóa
            $idThuocTinh = isset($_GET['idThuocTinh']) ? $_GET['idThuocTinh'] : null;
            if ($idThuocTinh) {
                $kq = $lh->thuoctinhDelete($idThuocTinh);
                header('location: ../../index.php?req=thuoctinhview&result=' . ($kq ? 'ok' : 'notok'));
            } else {
                header('location: ../../index.php?req=thuoctinhview&result=error');
            }
            break;

        case 'updatethuoctinh': // Cập nhật
            $idThuocTinh = isset($_POST['idThuocTinh']) ? $_POST['idThuocTinh'] : null;
            $tenThuocTinh = isset($_POST['tenThuocTinh']) ? $_POST['tenThuocTinh'] : '';
            $giaTri = isset($_POST['giaTri']) ? $_POST['giaTri'] : '';
            $ghiChu = isset($_POST['ghiChu']) ? $_POST['ghiChu'] : '';

            if ($idThuocTinh) {
                $kq = $lh->thuoctinhUpdate($tenThuocTinh, $giaTri, $ghiChu, $idThuocTinh);
                header('location: ../../index.php?req=thuoctinhview&result=' . ($kq ? 'ok' : 'notok'));
            } else {
                header('location: ../../index.php?req=thuoctinhview&result=error');
            }
            break;

        default:
            header('location: ../../index.php?req=thuoctinhview');
            break;
    }
} else {
    header('location: ../../index.php?req=thuoctinhview');
}
