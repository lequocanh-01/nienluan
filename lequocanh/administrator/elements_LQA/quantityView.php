<?php
require_once '../elements_LQA/mod/hanghoaCls.php';

$hanghoa = new hanghoa();
$list_hanghoa = $hanghoa->HanghoaGetAll();
$quantity = count($list_hanghoa);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Số lượng hàng hóa</title>
    <link rel="stylesheet" href="public_files/mycss.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h2 class="text-center">Số lượng hàng hóa</h2>
        <p class="text-center">Tổng số lượng hàng hóa hiện có: <strong><?php echo $quantity; ?></strong></p>

        <h3 class="mt-4">Danh sách hàng hóa</h3>
        <?php if ($quantity > 0): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên hàng hóa</th>
                    <th>Giá tham khảo</th>
                    <th>Số lượng</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list_hanghoa as $hang): ?>
                <tr>
                    <td><?php echo htmlspecialchars($hang->idhanghoa); ?></td>
                    <td><?php echo htmlspecialchars($hang->tenhanghoa); ?></td>
                    <td><?php echo number_format($hang->giathamkhao, 0, ',', '.'); ?> VNĐ</td>
                    <td><?php echo isset($hang->soluong) ? htmlspecialchars($hang->soluong) : 'N/A'; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <div class="alert alert-warning text-center" role="alert">
            Không có hàng hóa nào để hiển thị.
        </div>
        <?php endif; ?>
    </div>
</body>

</html>