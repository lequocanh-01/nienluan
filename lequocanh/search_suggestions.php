<?php
require_once './administrator/elements_LQA/mod/hanghoaCls.php';

// Lấy từ khóa tìm kiếm
$term = isset($_GET['term']) ? $_GET['term'] : '';

// Kiểm tra độ dài từ khóa
if (strlen($term) >= 2) {
    $hanghoa = new hanghoa();
    $results = $hanghoa->searchHanghoa($term);
    
    // Chuyển đổi kết quả sang định dạng phù hợp cho JSON
    $suggestions = array_map(function($item) {
        return [
            'id' => $item->idhanghoa,
            'name' => $item->tenhanghoa,
            'price' => number_format($item->giathamkhao, 0, ',', '.') . ' VNĐ',
            'image' => $item->hinhanh
        ];
    }, $results);
    
    // Trả về kết quả dưới dạng JSON
    header('Content-Type: application/json');
    echo json_encode($suggestions);
} else {
    // Trả về mảng rỗng nếu từ khóa quá ngắn
    header('Content-Type: application/json');
    echo json_encode([]);
}
?>