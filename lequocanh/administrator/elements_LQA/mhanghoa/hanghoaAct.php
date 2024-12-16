<?php
session_start();
require_once '../../elements_LQA/mod/hanghoaCls.php';
//nếu có biến yêu cầu đlúng tên biến thì cbo vô nếu không đẩy về index.php ngăn truy cập mục đichs không rõ ràng
if (isset($_GET['reqact'])) {
    $requestAction = $_GET['reqact'];
    echo $requestAction;
    switch ($requestAction) {
        case 'addnew': //them moi
            try {
                $tenhanghoa = $_REQUEST['tenhanghoa'];
                $giathamkhao = $_REQUEST['giathamkhao'];
                $mota = $_REQUEST['mota'];
                $idloaihang = $_REQUEST['idloaihang'];
                $idThuongHieu = $_REQUEST['idThuongHieu'] ?? null;
                $idDonViTinh = $_REQUEST['idDonViTinh'] ?? null;
                $idNhanVien = $_REQUEST['idNhanVien'] ?? null;

                // Đường dẫn đến file ảnh mặc định nếu không có ảnh upload
                $default_image = "../../assets/images/default-product.png";
                
                $lh = new hanghoa();
                
                if (!empty($_FILES['fileimage']['tmp_name'])) {
                    // Sử dụng ảnh được upload
                    $image_path = $_FILES['fileimage']['tmp_name'];
                } else {
                    // Sử dụng ảnh mặc định
                    $image_path = $default_image;
                }

                $kq = $lh->HanghoaAddWithImage(
                    $tenhanghoa, 
                    $mota, 
                    $giathamkhao, 
                    $image_path,
                    $idloaihang, 
                    $idThuongHieu, 
                    $idDonViTinh, 
                    $idNhanVien
                );

                if ($kq) {
                    header('location: ../../index.php?req=hanghoaview&result=ok');
                }else {
                    header('location: ../../index.php?req=hanghoaview&result=notok');
                }
            } catch (Exception $e) {
                header('location: ../../index.php?req=hanghoaview&result=error&message=' . urlencode($e->getMessage()));
            }
            break;

        case 'deletehanghoa':
            $idhanghoa = $_REQUEST['idhanghoa'];
            // Kiểm tra xem hàng hóa có liên kết với bảng khác không
            $hh = new hanghoa();
            $relations = $hh->CheckRelations($idhanghoa); // Phương thức kiểm tra liên kết

            if ($relations) {
                // Nếu có liên kết, hiển thị thông báo
                $relatedTables = implode(", ", $relations); // Chuyển danh sách bảng thành chuỗi
                echo "<script>
                        alert('Hàng hóa này có thuộc tính liên quan trong các bảng: $relatedTables. Vui lòng xóa thuộc tính trong các bảng này trước khi xóa hàng hóa.');
                        window.history.back();
                      </script>";
            } else {
                // Nếu không có liên kết, thực hiện xóa ngay
                $kq = $hh->HanghoaDelete($idhanghoa);
                if ($kq) {
                    header('location: ../../index.php?req=hanghoaview&result=ok');
                } else {
                    header('location: ../../index.php?req=hanghoaView&result=notok');
                }
            }
            break;

        case 'updatehanghoa':
            $idhanghoa = $_REQUEST['idhanghoa'] ?? '';
            $tenhanghoa = $_REQUEST['tenhanghoa'] ?? '';
            $giathamkhao = $_REQUEST['giathamkhao'] ?? 0;
            $idloaihang = $_REQUEST['idloaihang'] ?? '';
            $mota = $_REQUEST['mota'] ?? '';
            
            // Xử lý các trường có thể NULL
            $idThuongHieu = !empty($_REQUEST['idThuongHieu']) ? $_REQUEST['idThuongHieu'] : null;
            $idDonViTinh = !empty($_REQUEST['idDonViTinh']) ? $_REQUEST['idDonViTinh'] : null;
            $idNhanVien = !empty($_REQUEST['idNhanVien']) ? $_REQUEST['idNhanVien'] : null;

            // Kiểm tra các trường bắt buộc
            if (empty($idhanghoa) || empty($tenhanghoa) || empty($idloaihang)) {
                echo "<script>
                    alert('Vui lòng điền đầy đủ thông tin bắt buộc!');
                    window.history.back();
                </script>";
                exit;
            }
            
            // Xử lý hình ảnh
            if (!empty($_FILES['fileimage']['tmp_name'])) {
                $hinhanh_file = $_FILES['fileimage']['tmp_name'];
                $hinhanh = base64_encode(file_get_contents(addslashes($hinhanh_file)));
            } else {
                $hinhanh = $_REQUEST['hinhanh'] ?? '';
            }

            try {
                $lh = new hanghoa();
                $kq = $lh->HanghoaUpdate(
                    $tenhanghoa, 
                    $hinhanh, 
                    $mota, 
                    $giathamkhao, 
                    $idloaihang, 
                    $idThuongHieu, 
                    $idDonViTinh, 
                    $idNhanVien, 
                    $idhanghoa
                );
                
                if ($kq) {
                    header('location: ../../index.php?req=hanghoaview&result=ok');
                } else {
                    header('location: ../../index.php?req=hanghoaview&result=notok');
                }
            } catch (PDOException $e) {
                header('location: ../../index.php?req=hanghoaview&result=error&message=' . urlencode($e->getMessage()));
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
