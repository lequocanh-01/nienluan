<?php
session_start();
require_once '../../elements_LQA/mod/giohangCls.php';

$giohang = new GioHang();
$cart = $giohang->getCart();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Giỏ hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public_files/mycss.css">
    <style>
        .cart-container {
            max-width: 1200px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, .13);
        }

        .cart-table {
            width: 100%;
            border-collapse: collapse;
        }

        .cart-table th {
            background-color: #f8f9fa;
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #dee2e6;
        }

        .cart-table td {
            padding: 12px;
            text-align: center;
            vertical-align: middle;
            border-bottom: 1px solid #dee2e6;
        }

        .product-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
        }

        .product-name {
            text-align: left;
            color: #212529;
        }

        .price {
            color: #ee4d2d;
            font-weight: 500;
        }

        .quantity-control {
            display: inline-flex;
            align-items: center;
            border: 1px solid #dee2e6;
            border-radius: 3px;
        }

        .quantity-btn {
            border: none;
            background: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .quantity-input {
            width: 50px;
            text-align: center;
            border: none;
            border-left: 1px solid #dee2e6;
            border-right: 1px solid #dee2e6;
        }

        .remove-btn {
            color: #ff424f;
            text-decoration: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px 10px;
            font-size: 14px;
        }

        .remove-btn:hover {
            color: #ff0015;
            text-decoration: underline;
        }

        .cart-footer {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            border-top: 1px solid #dee2e6;
        }

        .checkout-btn {
            background-color: #ee4d2d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="cart-container">
        <h4 class="mb-4">Giỏ hàng của bạn</h4>
        <?php if (!empty($cart)): ?>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th style="width: 5%">
                            <input type="checkbox" id="select-all" class="form-check-input">
                        </th>
                        <th style="width: 40%">Sản phẩm</th>
                        <th style="width: 15%">Đơn giá</th>
                        <th style="width: 15%">Số lượng</th>
                        <th style="width: 15%">Số tiền</th>
                        <th style="width: 10%">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $id => $item): ?>
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input product-select">
                            </td>
                            <td class="product-name">
                                <div class="d-flex align-items-center">
                                    <?php if (isset($item['image']) && !empty($item['image'])): ?>
                                        <img class="product-image me-3" src="data:image/png;base64,<?php echo $item['image']; ?>"
                                            alt="<?php echo htmlspecialchars($item['name']); ?>">
                                    <?php endif; ?>
                                    <span><?php echo htmlspecialchars($item['name']); ?></span>
                                </div>
                            </td>
                            <td class="price">₫<?php echo number_format($item['price'], 0, ',', '.'); ?></td>
                            <td>
                                <form action="giohangUpdate.php" method="post" class="quantity-control">
                                    <input type="hidden" name="productId" value="<?php echo $id; ?>">
                                    <button type="button" class="quantity-btn" onclick="updateQuantity(this, -1)">-</button>
                                    <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>"
                                        min="1" data-product-id="<?php echo $id; ?>" class="quantity-input">
                                    <button type="button" class="quantity-btn" onclick="updateQuantity(this, 1)">+</button>
                                </form>
                            </td>
                            <td class="price">₫<?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?></td>
                            <td>
                                <a href="giohangAct.php?action=remove&productId=<?php echo $id; ?>"
                                    class="remove-btn"
                                    onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="cart-footer">
                <div class="d-flex align-items-center">
                    <input type="checkbox" id="select-all-bottom" class="form-check-input me-2">
                    <label for="select-all-bottom">Chọn tất cả</label>
                    <button onclick="deleteSelectedItems()" class="remove-btn ms-4">Xóa sản phẩm đã chọn</button>
                </div>
                <div class="d-flex align-items-center">
                    <div class="me-4">
                        <span>Tổng thanh toán (<span id="selected-count">0</span> sản phẩm):</span>
                        <span class="price fs-5 ms-2">₫<span id="total-price">0</span></span>
                    </div>
                    <button class="checkout-btn">Mua hàng</button>
                </div>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <img src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/cart/9bdd8040b334d31946f49e36beaf32db.png"
                    alt="Empty Cart" style="width: 100px; margin-bottom: 20px;">
                <h5>Giỏ hàng của bạn còn trống</h5>
                <a href="../../../index.php" class="btn btn-primary mt-3">Mua sắm ngay</a>
                <button onclick="goBack()" class="btn btn-secondary mt-3 ms-2">Quay lại</button>
            </div>
        <?php endif; ?>
    </div>

    <script>
        // Cập nhật hàm updateQuantity để sử dụng AJAX
        async function updateQuantity(button, change) {
            const input = button.parentElement.querySelector('input[type="number"]');
            const productId = input.dataset.productId;
            let value = parseInt(input.value) + change;
            if (value < 1) value = 1;
            input.value = value;

            try {
                const response = await fetch('giohangUpdate.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        productId: productId,
                        quantity: value
                    })
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const data = await response.json();
                if (data.success) {
                    // Cập nhật tổng tiền
                    updateTotalPrice();
                    // Cập nhật giá tiền của sản phẩm
                    const row = input.closest('tr');
                    const pricePerUnit = parseFloat(row.querySelector('td.price').dataset.price);
                    const totalPriceCell = row.querySelector('td.total-price');
                    const newTotal = pricePerUnit * value;
                    totalPriceCell.textContent = new Intl.NumberFormat('vi-VN').format(newTotal) + ' ₫';
                } else {
                    // alert('Có lỗi xảy ra khi cập nhật số lượng!');
                }
            } catch (error) {
                console.error('Error:', error);
                // alert('Có lỗi xảy ra khi cập nhật số lượng!');
            }
        }

        // Đồng bộ checkbox chọn tất cả
        document.querySelectorAll('#select-all, #select-all-bottom').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const isChecked = this.checked;
                document.querySelectorAll('.product-select').forEach(productCheckbox => {
                    productCheckbox.checked = isChecked;
                });
                // Đồng bộ giữa hai checkbox "Chọn tất cả"
                document.querySelectorAll('#select-all, #select-all-bottom').forEach(otherCheckbox => {
                    otherCheckbox.checked = isChecked;
                });
                updateTotalPrice();
            });
        });

        // Thêm hàm goBack()
        function goBack() {
            window.history.back();
        }

        // Hàm tính tổng tiền và số lượng sản phẩm được chọn
        function updateTotalPrice() {
            const checkboxes = document.querySelectorAll('.product-select');
            let totalPrice = 0;
            let selectedCount = 0;

            checkboxes.forEach((checkbox, index) => {
                if (checkbox.checked) {
                    const row = checkbox.closest('tr');
                    const priceText = row.querySelector('td.price').textContent;
                    const price = parseInt(priceText.replace(/[^\d]/g, '')); // Lấy số từ chuỗi giá
                    const quantity = parseInt(row.querySelector('input[type="number"]').value);
                    totalPrice += price * quantity;
                    selectedCount++;
                }
            });

            // Cập nhật hiển thị
            document.getElementById('total-price').textContent = new Intl.NumberFormat('vi-VN').format(totalPrice);
            document.getElementById('selected-count').textContent = selectedCount;
        }

        // Thêm sự kiện cho các checkbox sản phẩm
        document.querySelectorAll('.product-select').forEach(checkbox => {
            checkbox.addEventListener('change', updateTotalPrice);
        });

        // Khởi tạo giá trị ban đầu
        updateTotalPrice();

        // Thêm hàm xóa các sản phẩm đã chọn
        async function deleteSelectedItems() {
            const selectedCheckboxes = document.querySelectorAll('.product-select:checked');
            if (selectedCheckboxes.length === 0) {
                alert('Vui lòng chọn sản phẩm cần xóa!');
                return;
            }

            if (confirm('Bạn có chắc muốn xóa các sản phẩm đã chọn?')) {
                const selectedIds = Array.from(selectedCheckboxes).map(checkbox => {
                    return checkbox.closest('tr').querySelector('.quantity-input').dataset.productId;
                });

                try {
                    const response = await fetch('giohangAct.php?action=removeSelected', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            productIds: selectedIds
                        })
                    });

                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const data = await response.json();
                    if (data.success) {
                        // Xóa các hàng đã chọn khỏi giao diện
                        selectedCheckboxes.forEach(checkbox => {
                            checkbox.closest('tr').remove();
                        });

                        // Cập nhật tổng tiền
                        updateTotalPrice();

                        // Kiểm tra nếu giỏ hàng trống
                        if (document.querySelectorAll('.cart-table tbody tr').length === 0) {
                            document.querySelector('.cart-container').innerHTML = `
                                <div class="text-center py-5">
                                    <img src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/cart/9bdd8040b334d31946f49e36beaf32db.png" 
                                         alt="Empty Cart" style="width: 100px; margin-bottom: 20px;">
                                    <h5>Giỏ hàng của bạn còn trống</h5>
                                    <a href="../../../index.php" class="btn btn-primary mt-3">Mua sắm ngay</a>
                                    <button onclick="goBack()" class="btn btn-secondary mt-3 ms-2">Quay lại</button>
                                </div>
                            `;
                        }
                    } else {
                        alert('Có lỗi xảy ra khi xóa sản phẩm!');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra khi xóa sản phẩm!');
                }
            }
        }
    </script>
</body>

</html>