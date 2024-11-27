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
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        }

        .cart-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        .cart-table th {
            background-color: #f8f9fa;
            padding: 15px;
            text-align: center;
            border-bottom: 2px solid #e9ecef;
            color: #495057;
            font-weight: 600;
        }

        .cart-table td {
            padding: 15px;
            text-align: center;
            vertical-align: middle;
            border-bottom: 1px solid #e9ecef;
        }

        .product-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .product-name {
            text-align: left;
            color: #2c3e50;
            font-weight: 500;
        }

        .price {
            color: #e74c3c;
            font-weight: 600;
            font-size: 1.1em;
        }

        .quantity-control {
            display: inline-flex;
            align-items: center;
            border: 1px solid #dde2e6;
            border-radius: 8px;
            overflow: hidden;
            background: #fff;
        }

        .quantity-btn {
            border: none;
            background: #f8f9fa;
            padding: 8px 15px;
            cursor: pointer;
            color: #495057;
            transition: all 0.3s ease;
        }

        .quantity-btn:hover {
            background: #e9ecef;
            color: #212529;
        }

        .quantity-input {
            width: 60px;
            text-align: center;
            border: none;
            border-left: 1px solid #dde2e6;
            border-right: 1px solid #dde2e6;
            padding: 8px;
            font-weight: 500;
        }

        .remove-btn {
            color: #dc3545;
            text-decoration: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px 15px;
            font-size: 0.9em;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .remove-btn:hover {
            background-color: #dc3545;
            color: #fff;
        }

        .cart-footer {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            border-top: 2px solid #e9ecef;
        }

        .checkout-btn {
            background-color: #2ecc71;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .checkout-btn:hover {
            background-color: #27ae60;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(46, 204, 113, 0.2);
        }

        .form-check-input {
            cursor: pointer;
            width: 18px;
            height: 18px;
        }

        .form-check-input:checked {
            background-color: #2ecc71;
            border-color: #2ecc71;
        }

        .empty-cart {
            text-align: center;
            padding: 40px 20px;
        }

        .empty-cart img {
            width: 150px;
            margin-bottom: 25px;
            opacity: 0.7;
        }

        .empty-cart h5 {
            color: #6c757d;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(52, 152, 219, 0.2);
        }

        .btn-secondary {
            background-color: #95a5a6;
            border-color: #95a5a6;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #7f8c8d;
            border-color: #7f8c8d;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(149, 165, 166, 0.2);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .cart-container {
                padding: 15px;
            }

            .product-image {
                width: 80px;
                height: 80px;
            }

            .cart-footer {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }
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
            <div class="cart-container">
                <div class="empty-cart">
                    <img src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/cart/9bdd8040b334d31946f49e36beaf32db.png" 
                         alt="Empty Cart">
                    <h5>Giỏ hàng của bạn còn trống</h5>
                    <a href="../../../index.php" class="btn btn-primary">Mua sắm ngay</a>
                    <button onclick="goBack()" class="btn btn-secondary ms-2">Quay lại</button>
                </div>
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
                                <div class="cart-container">
                                    <div class="empty-cart">
                                        <img src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/cart/9bdd8040b334d31946f49e36beaf32db.png" 
                                             alt="Empty Cart">
                                        <h5>Giỏ hàng của bạn còn trống</h5>
                                        <a href="../../../index.php" class="btn btn-primary">Mua sắm ngay</a>
                                        <button onclick="goBack()" class="btn btn-secondary ms-2">Quay lại</button>
                                    </div>
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