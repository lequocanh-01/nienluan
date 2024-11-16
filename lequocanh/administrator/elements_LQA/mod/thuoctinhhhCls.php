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
        $getAll->execute();

        return $getAll->fetchAll();
    }

    // Thêm thuộc tính mới
    public function thuoctinhhhAdd($idhanghoa, $idThuocTinh, $tenThuocTinhHH, $giaTri, $ghiChu)
    {
        $sql = "INSERT INTO thuoctinhhh (idhanghoa, idThuocTinh, tenThuocTinhHH, giaTri, ghiChu) VALUES (?, ?, ?, ?, ?)";
        $data = array($idhanghoa, $idThuocTinh, $tenThuocTinhHH, $giaTri, $ghiChu);

        $add = $this->connect->prepare($sql);
        $add->execute($data);

        return $add->rowCount();
    }

    // Xóa thuộc tính theo ID
    public function thuoctinhhhDelete($idthuoctinhhh)
    {
        $sql = "DELETE FROM thuoctinhhh WHERE idthuoctinhhh = ?";
        $data = array($idthuoctinhhh);

        $del = $this->connect->prepare($sql);
        $del->execute($data);

        return $del->rowCount();
    }

    // Cập nhật thông tin thuộc tính
    public function thuoctinhhhUpdate($tenThuocTinhHH, $giaTri, $ghiChu, $idthuoctinhhh)
    {
        $sql = "UPDATE thuoctinhhh SET tenThuocTinhHH = ?, giaTri = ?, ghiChu = ? WHERE idthuoctinhhh = ?";
        $data = array($tenThuocTinhHH, $giaTri, $ghiChu, $idthuoctinhhh);

        $update = $this->connect->prepare($sql);
        $update->execute($data);

        return $update->rowCount();
    }

    // Lấy thông tin thuộc tính theo ID
    public function thuoctinhhhGetbyId($idthuoctinhhh)
    {
        $sql = 'SELECT * FROM thuoctinhhh WHERE idthuoctinhhh = ?';
        $data = array($idthuoctinhhh);

        $getOne = $this->connect->prepare($sql);
        $getOne->setFetchMode(PDO::FETCH_OBJ);
        $getOne->execute($data);

        return $getOne->fetch();
    }

    // Lấy các thuộc tính theo ID loại hàng (nếu cần)
    public function thuoctinhhhGetbyIdloaihang($idloaihang)
    {
        $sql = 'SELECT * FROM thuoctinhhh WHERE idloaihang = ?';
        $data = array($idloaihang);

        $getOne = $this->connect->prepare($sql);
        $getOne->setFetchMode(PDO::FETCH_OBJ);
        $getOne->execute($data);

        return $getOne->fetchAll();
    }
}
