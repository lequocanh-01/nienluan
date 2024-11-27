<?php
session_start();
require_once '../../elements_LQA/mod/giohangCls.php';

$giohang = new GioHang();

// Kiểm tra hành động từ GET
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    
    if ($action === 'clear') {
        $giohang->clearCart();
        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
        exit();
    }

    if ($action === 'removeSelected') {
        // Nhận dữ liệu JSON từ request
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (isset($data['productIds']) && is_array($data['productIds'])) {
            foreach ($data['productIds'] as $productId) {
                $giohang->removeFromCart((int)$productId);
            }
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
            exit();
        }
    }

    $productId = isset($_GET['productId']) ? (int)$_GET['productId'] : null;
    $quantity = isset($_GET['quantity']) ? (int)$_GET['quantity'] : 1;  // Ép kiểu cho số lượng

    // Kiểm tra các tham số cần thiết
    if (!$productId) {
        // Nếu productId không hợp lệ, chuyển hướng và thông báo lỗi
        $_SESSION['error'] = 'ID sản phẩm không hợp lệ.';
        header('Location: giohangView.php');
        exit();
    }

    switch ($action) {
        case 'add':
            $giohang->addToCart($productId, $quantity);
            break;
        
        case 'remove':
            $giohang->removeFromCart($productId);
            break;

        case 'update':
            if ($quantity > 0) {
                $giohang->updateCart($productId, $quantity);
            } else {
                $_SESSION['error'] = 'Số lượng phải lớn hơn 0.';
            }
            break;

        case 'clear':
            $giohang->clearCart();
            break;
        
        default:
            $_SESSION['error'] = 'Hành động không hợp lệ.';
            break;
    }
}

// Chuyển hướng lại trang giỏ hàng sau khi thực hiện hành động
header('Location: giohangView.php');
exit();
?>
