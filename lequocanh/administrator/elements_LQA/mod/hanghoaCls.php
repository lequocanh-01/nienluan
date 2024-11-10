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
class hanghoa extends Database
{
    public function HanghoaGetAll()
    {
        // Remove 'soluong' from the query if it's not in the database
        $sql = 'SELECT idhanghoa, tenhanghoa, giathamkhao, mota, hinhanh, idloaihang FROM hanghoa'; 

        $getAll = $this->connect->prepare($sql);
        $getAll->setFetchMode(PDO::FETCH_OBJ);
        $getAll->execute();

        return $getAll->fetchAll();
    }
    public function HanghoaAdd($tenhanghoa, $mota, $giathamkhao, $hinhanh, $idloaihang)
    {   
        $sql = "INSERT INTO hanghoa (tenhanghoa, mota, giathamkhao, hinhanh, idloaihang) VALUES (?,?,?,?,?)";
        $data = array($tenhanghoa, $mota, $giathamkhao, $hinhanh, $idloaihang);
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
    public function HanghoaUpdate($tenhanghoa, $hinhanh, $mota,$giathamkhao, $idloaihang, $idhanghoa)
    {
        $sql = "UPDATE hanghoa set tenhanghoa=?, hinhanh=?, mota=?, giathamkhao=?, idloaihang=? WHERE idhanghoa =?";
        $data = array($tenhanghoa, $hinhanh, $mota, $giathamkhao, $idloaihang, $idhanghoa);

        $update = $this->connect->prepare($sql);
        $update->execute($data);
        return $update->rowCount();
    }
    public function HanghoaGetbyId($idhanghoa)
    {
        $sql = 'SELECT * FROM hanghoa WHERE idhanghoa = ?';
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

    public function searchHanghoa($query) {
        $query = "%" . $query . "%"; // Thêm ký tự đại diện cho tìm kiếm
        $sql = "SELECT * FROM hanghoa WHERE tenhanghoa LIKE ?";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute([$query]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}