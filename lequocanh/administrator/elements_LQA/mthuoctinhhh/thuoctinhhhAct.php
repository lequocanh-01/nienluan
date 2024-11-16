<?php
session_start();
require '../../elements_LQA/mod/thuoctinhhhCls.php';

if (isset($_GET['reqact'])) {
    $requestAction = $_GET['reqact'];
    $thuocTinhHHObj = new ThuocTinhHH();

    switch ($requestAction) {
        case 'addnew':
            $idhanghoa = $_POST['idhanghoa'] ?? null;
            $idThuocTinh = $_POST['idThuocTinh'] ?? null;
            $tenThuocTinhHH = $_POST['tenThuocTinhHH'] ?? null;
            $ghiChu = $_POST['ghiChu'] ?? null;

            $result = $thuocTinhHHObj->thuoctinhhhAdd($idhanghoa, $idThuocTinh, $tenThuocTinhHH, null, $ghiChu);
            header("Location: ../../index.php?req=thuoctinhhhview&result=" . ($result ? 'ok' : 'notok'));
            break;

        case 'deletethuoctinhhh':
            $idThuocTinhHH = $_GET['idThuocTinhHH'] ?? null;
            $result = $thuocTinhHHObj->thuoctinhhhDelete($idThuocTinhHH);
            header("Location: ../../index.php?req=thuoctinhhhview&result=" . ($result ? 'ok' : 'notok'));
            break;

        case 'updatethuoctinhhh':
            $idThuocTinhHH = $_POST['idThuocTinhHH'] ?? null;
            $tenThuocTinhHH = $_POST['tenThuocTinhHH'] ?? null;
            $ghiChu = $_POST['ghiChu'] ?? null;

            $result = $thuocTinhHHObj->thuoctinhhhUpdate($tenThuocTinhHH, null, $ghiChu, $idThuocTinhHH);
            header("Location: ../../index.php?req=thuoctinhhhview&result=" . ($result ? 'ok' : 'notok'));
            break;

        default:
            header('Location: ../../index.php?req=thuoctinhhhview');
            break;
    }
} else {
    header('Location: ../../index.php?req=thuoctinhhhview');
}
