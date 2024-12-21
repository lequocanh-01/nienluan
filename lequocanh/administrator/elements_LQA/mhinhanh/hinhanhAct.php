<?php
require_once '../mod/hinhanhCls.php';

function convertToWebP($source, $quality = 80)
{
    $extension = pathinfo($source, PATHINFO_EXTENSION);
    $webp_path = str_replace('.' . $extension, '.webp', $source);

    $info = getimagesize($source);
    $isValid = true;

    if ($info['mime'] == 'image/jpeg' || $info['mime'] == 'image/jpg')
        $image = imagecreatefromjpeg($source);
    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source);
    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source);
    else
        $isValid = false;

    if ($isValid) {
        // Lưu ảnh dưới định dạng WebP
        imagewebp($image, $webp_path, $quality);
        imagedestroy($image);

        return $webp_path;
    }

    return $source;
}

if (isset($_REQUEST['reqact'])) {
    $requestAction = $_REQUEST['reqact'];

    switch ($requestAction) {
        case 'addnew':
            $upload_dir = '../../uploads/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            $files = $_FILES['files'];
            $hinhAnh = new HinhAnh();
            $success = true;

            for ($i = 0; $i < count($files['name']); $i++) {
                $file_name = $files['name'][$i];
                $file_tmp = $files['tmp_name'][$i];
                $file_type = $files['type'][$i];
                $file_size = $files['size'][$i];

                $file_path = $upload_dir . time() . '_' . $file_name;

                if (move_uploaded_file($file_tmp, $file_path)) {
                    // Chuyển đổi sang WebP nếu là ảnh PNG
                    if ($file_type == 'image/png') {
                        $webp_path = convertToWebP($file_path);
                        // Xóa file gốc nếu chuyển đổi thành công
                        if ($webp_path != $file_path) {
                            unlink($file_path);
                            $file_path = $webp_path;
                            $file_type = 'image/webp';
                            $file_name = pathinfo($webp_path, PATHINFO_BASENAME);
                            $file_size = filesize($webp_path);
                        }
                    }

                    if (!$hinhAnh->ThemHinhAnh(
                        $file_name,
                        $file_path,
                        $file_type,
                        $file_size,
                        0, // id_tham_chieu
                        'general', // loai_tham_chieu
                        0 // thu_tu
                    )) {
                        $success = false;
                    }
                } else {
                    $success = false;
                }
            }

            if ($success) {
                header('location: ../../index.php?req=hinhanhview&result=ok');
            } else {
                header('location: ../../index.php?req=hinhanhview&result=notok');
            }
            break;

        case 'delete':
            $json = file_get_contents('php://input');
            $data = json_decode($json);

            if ($data && isset($data->ids) && is_array($data->ids)) {
                $hinhAnh = new HinhAnh();
                if ($hinhAnh->XoaNhieuHinhAnh($data->ids)) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Không thể xóa hình ảnh']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ']);
            }
            break;
    }
}
