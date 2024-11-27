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

class GioHang {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getProductById($productId) {
        try {
            $query = "SELECT * FROM hanghoa WHERE idhanghoa = :id";
            $stmt = $this->db->connect->prepare($query);
            $stmt->execute(['id' => $productId]);
            
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return null;
        }
    }

    public function addToCart($productId, $quantity = 1) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity'] += $quantity;
        } else {
            $product = $this->getProductById($productId);
            if ($product) {
                $_SESSION['cart'][$productId] = [
                    'name' => $product->tenhanghoa,
                    'price' => $product->giathamkhao,
                    'quantity' => $quantity,
                    'image' => $product->hinhanh // Thêm hình ảnh vào giỏ hàng
                ];
            }
        }
    }

    public function removeFromCart($productId) {
        if (isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }
    }

    public function updateCart($productId, $quantity) {
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity'] = $quantity;
        }
    }

    public function getCart() {
        return $_SESSION['cart'] ?? [];
    }

    public function clearCart() {
        unset($_SESSION['cart']);
    }
}
?>
