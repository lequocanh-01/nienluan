<?php
require_once("./elements_LQA/mod/hanghoaCls.php");
$hanghoa = new hanghoa();
$list_hinhanh = $hanghoa->GetAllHinhAnh();
$total = count($list_hinhanh);
?>

<div class="admin-title">
    <h1>Quản lý hình ảnh</h1>
</div>

<div class="admin-content">
    <!-- Form upload hình ảnh -->
    <div class="upload-form">
        <h3>Thêm hình ảnh mới</h3>
        <form action="./elements_LQA/mhinhanh/hinhanhAct.php?reqact=addnew" method="post" enctype="multipart/form-data">
            <input type="file" name="files[]" multiple accept="image/*" required>
            <input type="submit" value="Upload" class="btn btn-primary">
        </form>
    </div>

    <!-- Hiển thị danh sách hình ảnh -->
    <div class="image-list">
        <div class="list-header">
            <h3>Danh sách hình ảnh (<?php echo $total; ?> hình ảnh)</h3>
            <button id="delete-selected" class="btn btn-danger" style="display: none;">Xóa đã chọn</button>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>ID</th>
                    <th>Hình ảnh</th>
                    <th>Tên file</th>
                    <th>Kích thước</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list_hinhanh as $img): ?>
                    <tr>
                        <td><input type="checkbox" class="select-item" value="<?php echo $img->id; ?>"></td>
                        <td><?php echo $img->id; ?></td>
                        <td>
                            <?php
                            $image_src = $img->duong_dan;
                            if (strlen($image_src) > 100 && strpos($image_src, ',') !== false) {
                                $image_src = $image_src;
                            } else if (file_exists($image_src)) {
                                $image_src = $image_src;
                            } else if (file_exists("./" . $image_src)) {
                                $image_src = "./" . $image_src;
                            } else {
                                $image_src = "./img_LQA/no-image.png";
                            }
                            ?>
                            <img src="<?php echo $image_src; ?>"
                                alt="<?php echo htmlspecialchars($img->ten_file); ?>"
                                class="thumbnail">
                        </td>
                        <td><?php echo htmlspecialchars($img->ten_file); ?></td>
                        <td><?php echo $img->kich_thuoc; ?></td>
                        <td>
                            <button class="btn btn-danger delete-btn" data-id="<?php echo $img->id; ?>">Xóa</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    .admin-content {
        padding: 20px;
    }

    .upload-form {
        margin-bottom: 30px;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 5px;
    }

    .list-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 1rem;
        background-color: #fff;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .table th,
    .table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #dee2e6;
        vertical-align: middle;
    }

    .table th {
        background-color: #f8f9fa;
        font-weight: bold;
    }

    .thumbnail {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 4px;
    }

    .btn {
        padding: 6px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAll = document.getElementById('select-all');
        const selectItems = document.querySelectorAll('.select-item');
        const deleteSelectedBtn = document.getElementById('delete-selected');
        const deleteButtons = document.querySelectorAll('.delete-btn');

        // Xử lý chọn tất cả
        selectAll.addEventListener('change', function() {
            selectItems.forEach(item => {
                item.checked = this.checked;
            });
            updateDeleteSelectedButton();
        });

        // Xử lý chọn từng item
        selectItems.forEach(item => {
            item.addEventListener('change', function() {
                updateDeleteSelectedButton();
                // Kiểm tra nếu tất cả các item đều được chọn thì check selectAll
                const allChecked = Array.from(selectItems).every(item => item.checked);
                selectAll.checked = allChecked;
            });
        });

        // Cập nhật trạng thái nút xóa đã chọn
        function updateDeleteSelectedButton() {
            const checkedItems = document.querySelectorAll('.select-item:checked');
            deleteSelectedBtn.style.display = checkedItems.length > 0 ? 'inline-block' : 'none';
        }

        // Xử lý xóa nhiều ảnh
        deleteSelectedBtn.addEventListener('click', function() {
            const selectedIds = Array.from(document.querySelectorAll('.select-item:checked'))
                .map(checkbox => checkbox.value);

            if (selectedIds.length === 0) {
                alert('Vui lòng ch��n ít nhất một hình ảnh để xóa');
                return;
            }

            if (confirm(`Bạn có chắc chắn muốn xóa ${selectedIds.length} hình ảnh đã chọn?`)) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', './elements_LQA/mhinhanh/hinhanhAct.php?reqact=deletemultiple', true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.setRequestHeader('Accept', 'application/json');

                xhr.onload = function() {
                    try {
                        if (xhr.status === 200) {
                            const response = JSON.parse(xhr.responseText);
                            alert(response.message);

                            if (response.success) {
                                // Xóa các hàng đã chọn khỏi bảng
                                selectedIds.forEach(id => {
                                    const row = document.querySelector(`.select-item[value="${id}"]`).closest('tr');
                                    if (row) {
                                        row.remove();
                                    }
                                });

                                // Reset checkbox chọn tất cả
                                selectAll.checked = false;
                                // Cập nhật nút xóa đã chọn
                                updateDeleteSelectedButton();

                                // Cập nhật số lượng hình ảnh
                                const totalImages = document.querySelectorAll('.select-item').length;
                                const headerTitle = document.querySelector('.list-header h3');
                                if (headerTitle) {
                                    headerTitle.textContent = `Danh sách hình ảnh (${totalImages} hình ảnh)`;
                                }
                            }
                        } else {
                            throw new Error('Network response was not ok');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Có lỗi xảy ra khi xử lý yêu cầu: ' + error.message);
                    }
                };

                xhr.onerror = function() {
                    alert('Có lỗi xảy ra khi kết nối đến server');
                };

                try {
                    xhr.send(JSON.stringify({
                        ids: selectedIds
                    }));
                } catch (error) {
                    console.error('Error sending request:', error);
                    alert('Có lỗi xảy ra khi gửi yêu cầu: ' + error.message);
                }
            }
        });

        // Xử lý xóa một ảnh
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const imageId = this.getAttribute('data-id');
                if (confirm('Bạn có chắc chắn muốn xóa hình ảnh này?')) {
                    const xhr = new XMLHttpRequest();
                    xhr.open('GET', `./elements_LQA/mhinhanh/hinhanhAct.php?reqact=deletehinhanh&id=${imageId}`, true);
                    xhr.setRequestHeader('Accept', 'application/json');

                    xhr.onload = function() {
                        try {
                            if (xhr.status === 200) {
                                const response = JSON.parse(xhr.responseText);
                                alert(response.message);

                                if (response.success) {
                                    // Xóa hàng khỏi bảng
                                    const row = button.closest('tr');
                                    if (row) {
                                        row.remove();
                                    }

                                    // Cập nhật s��� lượng hình ảnh
                                    const totalImages = document.querySelectorAll('.select-item').length;
                                    const headerTitle = document.querySelector('.list-header h3');
                                    if (headerTitle) {
                                        headerTitle.textContent = `Danh sách hình ảnh (${totalImages} hình ảnh)`;
                                    }
                                }
                            } else {
                                throw new Error('Network response was not ok');
                            }
                        } catch (error) {
                            console.error('Error:', error);
                            alert('Có lỗi xảy ra khi xử lý yêu cầu: ' + error.message);
                        }
                    };

                    xhr.onerror = function() {
                        alert('Có lỗi xảy ra khi kết nối đến server');
                    };

                    xhr.send();
                }
            });
        });
    });
</script>