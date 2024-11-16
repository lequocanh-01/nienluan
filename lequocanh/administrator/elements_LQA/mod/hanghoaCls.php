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
        $sql = 'select * from hanghoa';

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
    public function searchHanghoa($query) {
        // Logic to search for products based on the query
        // This is just a placeholder; implement your actual search logic here
        $results = []; // Assume this will hold the search results

        // Example: Query the database to find matching products
        // $results = $this->database->query("SELECT * FROM products WHERE name LIKE '%$query%'");

        return $results;
    }
    public function CheckRelations($idhanghoa) {
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
}
