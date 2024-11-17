<?php
$s = '../../elements_LQA/mod/database.php';
if (file_exists($s)) {
    $f = $s;
} else {
    $f = './elements_LQA/mod/database.php';
    if (!file_exists($f)) {
        $f = './administrator/elements_LQA/mod/database.php';
    }
}
require_once $f;

class ThuocTinhHH extends Database
{
    // Lấy tất cả các thuộc tính
    public function thuoctinhhhGetAll()
    {
        $sql = 'SELECT * FROM thuoctinhhh';
        $getAll = $this->connect->prepare($sql);
        $getAll->setFetchMode(PDO::FETCH_OBJ);

        if (!$getAll->execute()) {
            error_log(print_r($getAll->errorInfo(), true));
            return false;
        }

        return $getAll->fetchAll();
    }

    // Thêm thuộc tính mới
    public function thuoctinhhhAdd($idhanghoa, $idThuocTinh, $tenThuocTinhHH, $giaTri, $ghiChu)
    {
        $sql = "INSERT INTO thuoctinhhh (idhanghoa, idThuocTinh, tenThuocTinhHH, giaTri, ghiChu) VALUES (?, ?, ?, ?, ?)";
        $data = array($idhanghoa, $idThuocTinh, $tenThuocTinhHH, $giaTri, $ghiChu);

        $add = $this->connect->prepare($sql);

        if (!$add->execute($data)) {
            error_log(print_r($add->errorInfo(), true));
            return false;
        }

        return $add->rowCount();
    }

    // Xóa thuộc tính theo ID
    public function thuoctinhhhDelete($idThuocTinhHH)
    {
        $sql = "DELETE FROM thuoctinhhh WHERE idThuocTinhHH = ?";
        $data = array($idThuocTinhHH);

        $del = $this->connect->prepare($sql);

        if (!$del->execute($data)) {
            error_log(print_r($del->errorInfo(), true));
            return false;
        }

        return $del->rowCount();
    }

    // Cập nhật thông tin thuộc tính
    public function thuoctinhhhUpdate( $tenThuocTinhHH, $giaTri, $ghiChu, $idThuocTinhHH)
    {
        $sql = "UPDATE thuoctinhhh 
                SET  tenThuocTinhHH = ?, giaTri = ?, ghiChu = ? 
                WHERE idThuocTinhHH = ?";
        $data = array( $tenThuocTinhHH, $giaTri, $ghiChu, $idThuocTinhHH);

        $update = $this->connect->prepare($sql);

        if (!$update->execute($data)) {
            error_log(print_r($update->errorInfo(), true));
            return false;
        }

        return $update->rowCount();
    }

    // Lấy thông tin thuộc tính theo ID
    public function thuoctinhhhGetbyId($idThuocTinhHH)
    {
        $sql = 'SELECT * FROM thuoctinhhh WHERE idThuocTinhHH = ?';
        $data = array($idThuocTinhHH);

        $getOne = $this->connect->prepare($sql);
        $getOne->setFetchMode(PDO::FETCH_OBJ);

        if (!$getOne->execute($data)) {
            error_log(print_r($getOne->errorInfo(), true));
            return false;
        }

        return $getOne->fetch();
    }

    // Lấy các thuộc tính theo ID loại hàng (nếu cần)
    // Xác minh xem bảng có cột idloaihang không trước khi sử dụng phương thức này
    public function thuoctinhhhGetbyIdloaihang($idloaihang)
    {
        $sql = 'SELECT * FROM thuoctinhhh WHERE idloaihang = ?';
        $data = array($idloaihang);

        $getOne = $this->connect->prepare($sql);
        $getOne->setFetchMode(PDO::FETCH_OBJ);

        if (!$getOne->execute($data)) {
            error_log(print_r($getOne->errorInfo(), true));
            return false;
        }

        return $getOne->fetchAll();
    }
}
