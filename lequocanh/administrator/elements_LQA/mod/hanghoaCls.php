<?php

// Xác định đường dẫn tới file database.php
$possible_paths = array(
    dirname(__FILE__) . '/database.php',                    // Cùng thư mục
    dirname(dirname(dirname(__FILE__))) . '/elements_LQA/mod/database.php',  // Từ thư mục administrator
    dirname(dirname(dirname(dirname(__FILE__)))) . '/administrator/elements_LQA/mod/database.php'  // Từ thư mục gốc
);

$database_file = null;
foreach ($possible_paths as $path) {
    if (file_exists($path)) {
        $database_file = $path;
        break;
    }
}

if ($database_file === null) {
    die("Không thể tìm thấy file database.php");
}

require_once $database_file;

class hanghoa extends Database
{
    public function HanghoaGetAll()
    {
        $sql = 'select * from hanghoa';

        $getAll = $this->connect->prepare($sql);
        $getAll->setFetchMode(PDO::FETCH_OBJ);
        $getAll->execute();

        return $getAll->fetchAll();
    }
    public function HanghoaAdd($tenhanghoa, $mota, $giathamkhao, $id_hinhanh, $idloaihang, $idThuongHieu, $idDonViTinh, $idNhanVien)
    {
        $sql = "INSERT INTO hanghoa (tenhanghoa, mota, giathamkhao, hinhanh, idloaihang, idThuongHieu, idDonViTinh, idNhanVien) VALUES (?,?,?,?,?,?,?,?)";
        $data = array($tenhanghoa, $mota, $giathamkhao, $id_hinhanh, $idloaihang, $idThuongHieu, $idDonViTinh, $idNhanVien);
        $add = $this->connect->prepare($sql);
        $add->execute($data);
        return $add->rowCount();
    }
    public function HanghoaDelete($idhanghoa)
    {
        $sql = "DELETE from hanghoa where idhanghoa = ?";
        $data = array($idhanghoa);

        $del = $this->connect->prepare($sql);
        $del->execute($data);
        return $del->rowCount();
    }
    public function HanghoaUpdate($tenhanghoa, $id_hinhanh, $mota, $giathamkhao, $idloaihang, $idThuongHieu, $idDonViTinh, $idNhanVien, $idhanghoa)
    {
        $sql = "UPDATE hanghoa SET tenhanghoa=?, hinhanh=?, mota=?, giathamkhao=?, idloaihang=?, idThuongHieu=?, idDonViTinh=?, idNhanVien=? WHERE idhanghoa =?";
        $data = array($tenhanghoa, $id_hinhanh, $mota, $giathamkhao, $idloaihang, $idThuongHieu, $idDonViTinh, $idNhanVien, $idhanghoa);

        $update = $this->connect->prepare($sql);
        $update->execute($data);
        return $update->rowCount();
    }
    public function HanghoaGetbyId($idhanghoa)
    {
        $sql = 'select * from hanghoa where idhanghoa=?';
        $data = array($idhanghoa);

        $getOne = $this->connect->prepare($sql);
        $getOne->setFetchMode(PDO::FETCH_OBJ);
        $getOne->execute($data);

        return $getOne->fetch();
    }

    public function HanghoaGetbyIdloaihang($idloaihang)
    {
        $sql = 'select * from hanghoa where idloaihang=?';
        $data = array($idloaihang);

        $getOne = $this->connect->prepare($sql);
        $getOne->setFetchMode(PDO::FETCH_OBJ);
        $getOne->execute($data);

        return $getOne->fetchAll();
    }
    public function HanghoaUpdatePrice($idhanghoa, $giaban)
    {
        $sql = "UPDATE hanghoa SET giathamkhao = ? WHERE idhanghoa = ?";
        $data = array($giaban, $idhanghoa);

        $update = $this->connect->prepare($sql);
        $update->execute($data);
        return $update->rowCount();
    }
    public function searchHanghoa($keyword)
    {
        try {
            $select = "SELECT * FROM hanghoa 
                       WHERE LOWER(tenhanghoa) LIKE LOWER(:keyword)
                       ORDER BY tenhanghoa ASC 
                       LIMIT 10";
            $stmt = $this->connect->prepare($select);
            $stmt->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            error_log("Search error: " . $e->getMessage());
            return [];
        }
    }
    public function CheckRelations($idhanghoa)
    {
        $tablesWithRelations = []; // Mảng để lưu tên các bảng có liên kết

        // Kiểm tra liên kết với bảng thuộc tính hàng hóa (ví dụ)
        $sql = "SELECT COUNT(*) FROM thuoctinhhh WHERE idhanghoa = ?";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute([$idhanghoa]);
        if ($stmt->fetchColumn() > 0) {
            $tablesWithRelations[] = 'thuoctinhhh';
        }

        // Kiểm tra liên kết với bảng đơn giá (ví dụ)
        $sql = "SELECT COUNT(*) FROM dongia WHERE idhanghoa = ?";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute([$idhanghoa]);
        if ($stmt->fetchColumn() > 0) {
            $tablesWithRelations[] = 'dongia';
        }

        // Thêm các bảng khác mà bạn muốn kiểm tra ở đây

        return $tablesWithRelations; // Trả về danh sách các bảng có liên kết
    }
    public function GetAllThuongHieu()
    {
        $sql = 'SELECT * FROM thuonghieu';
        $getAll = $this->connect->prepare($sql);
        $getAll->setFetchMode(PDO::FETCH_OBJ);
        $getAll->execute();
        return $getAll->fetchAll();
    }

    public function GetAllDonViTinh()
    {
        $sql = 'SELECT * FROM donvitinh';
        $getAll = $this->connect->prepare($sql);
        $getAll->setFetchMode(PDO::FETCH_OBJ);
        $getAll->execute();
        return $getAll->fetchAll();
    }

    public function GetAllNhanVien()
    {
        $sql = 'SELECT * FROM nhanvien';
        $getAll = $this->connect->prepare($sql);
        $getAll->setFetchMode(PDO::FETCH_OBJ);
        $getAll->execute();
        return $getAll->fetchAll();
    }

    // Lấy thông tin thương hiệu theo ID
    public function GetThuongHieuById($idThuongHieu)
    {
        $sql = 'SELECT * FROM thuonghieu WHERE idThuongHieu = ?';
        $stmt = $this->connect->prepare($sql);
        $stmt->execute([$idThuongHieu]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function GetAllHinhAnh()
    {
        try {
            $sql = 'SELECT * FROM hinhanh ORDER BY ngay_tao DESC';
            $getAll = $this->connect->prepare($sql);
            $getAll->setFetchMode(PDO::FETCH_OBJ);
            $getAll->execute();
            $list = $getAll->fetchAll();

            // Xử lý đường dẫn hình ảnh
            foreach ($list as $item) {
                // Nếu đường dẫn bắt đầu bằng http hoặc https, giữ nguyên
                if (strpos($item->duong_dan, 'http') === 0) {
                    continue;
                }

                // Nếu là đường dẫn tương đối, thêm đường dẫn base
                if ($item->duong_dan && $item->duong_dan[0] === '/') {
                    $item->duong_dan = substr($item->duong_dan, 1);
                }
            }

            return $list;
        } catch (Exception $e) {
            error_log("Error in GetAllHinhAnh: " . $e->getMessage());
            return array();
        }
    }

    public function GetHinhAnhById($id)
    {
        if (!$id) return null;

        try {
            // Nếu là ID số, truy vấn từ bảng hinhanh
            $sql = 'SELECT * FROM hinhanh WHERE id = ?';
            $stmt = $this->connect->prepare($sql);
            $stmt->execute([$id]);
            $hinhanh = $stmt->fetch(PDO::FETCH_OBJ);

            if ($hinhanh) {
                // Nếu đường dẫn bắt đầu bằng http hoặc https, giữ nguyên
                if (strpos($hinhanh->duong_dan, 'http') === 0) {
                    return $hinhanh;
                }

                // Nếu là base64 string
                if (strlen($hinhanh->duong_dan) > 100 && strpos($hinhanh->duong_dan, ',') !== false) {
                    return $hinhanh;
                }

                // Nếu là đường dẫn tương đối, thêm đường dẫn base
                if ($hinhanh->duong_dan && $hinhanh->duong_dan[0] !== '/') {
                    $hinhanh->duong_dan = './' . $hinhanh->duong_dan;
                }

                return $hinhanh;
            }

            return null;
        } catch (Exception $e) {
            error_log("Error in GetHinhAnhById: " . $e->getMessage());
            return null;
        }
    }

    public function ThemHinhAnh($ten_file, $loai_file, $kich_thuoc, $duong_dan)
    {
        $sql = "INSERT INTO hinhanh (ten_file, loai_file, kich_thuoc, duong_dan) VALUES (?, ?, ?, ?)";
        $stmt = $this->connect->prepare($sql);
        return $stmt->execute([$ten_file, $loai_file, $kich_thuoc, $duong_dan]);
    }

    public function XoaHinhAnh($id)
    {
        try {
            // Kiểm tra xem hình ảnh có đang được sử dụng không
            $products = $this->GetProductsByImageId($id);
            if (!empty($products)) {
                return false;
            }

            // Xóa record trong database
            $sql = "DELETE FROM hinhanh WHERE id = ?";
            $stmt = $this->connect->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Error in XoaHinhAnh: " . $e->getMessage());
            return false;
        }
    }

    // Thêm phương thức để cập nhật hình ảnh của sản phẩm
    public function CapNhatHinhAnhSanPham($idhanghoa, $id_hinhanh_moi)
    {
        try {
            $sql = "UPDATE hanghoa SET hinhanh = ? WHERE idhanghoa = ?";
            $stmt = $this->connect->prepare($sql);
            return $stmt->execute([$id_hinhanh_moi, $idhanghoa]);
        } catch (Exception $e) {
            return false;
        }
    }

    public function GetProductsByImageId($imageId)
    {
        $sql = "SELECT idhanghoa, tenhanghoa FROM hanghoa WHERE hinhanh = ?";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute([$imageId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function UpdateProductImages($oldImageId, $newImageId)
    {
        try {
            $sql = "UPDATE hanghoa SET hinhanh = ? WHERE hinhanh = ?";
            $stmt = $this->connect->prepare($sql);
            return $stmt->execute([$newImageId, $oldImageId]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function GetImagePath($id)
    {
        $sql = "SELECT duong_dan FROM hinhanh WHERE id = ?";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['duong_dan'] : null;
    }
}
