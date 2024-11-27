<?php
session_start();
require_once '../../elements_LQA/mod/giohangCls.php';

$giohang = new GioHang();

// Nhận dữ liệu JSON từ request
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['productId']) && isset($data['quantity'])) {
    $productId = (int)$data['productId'];
    $quantity = (int)$data['quantity'];

    // Kiểm tra số lượng có hợp lệ
    if ($productId > 0 && $quantity > 0) {
        $giohang->updateCart($productId, $quantity);
        $response = ['success' => true];
    } else {
        $response = [
            'success' => false,
            'message' => 'Số lượng không hợp lệ!'
        ];
    }
} else {
    $response = [
        'success' => false,
        'message' => 'Dữ liệu không hợp lệ!'
    ];
}

// Trả về response dạng JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
