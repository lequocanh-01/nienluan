<?php
require_once './elements_LQA/mod/hinhanhCls.php';
$hinhanh = new HinhAnh();
$list_hinhanh = $hinhanh->LayTatCaHinhAnh();
$l = count($list_hinhanh);
?>

<div class="content_hinhanh">
    <div class="admin-info">
        <h3>Quản lý hình ảnh</h3>
        <div class="upload-form">
            <form action="./elements_LQA/mhinhanh/hinhanhAct.php?reqact=addnew" method="post" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>Chọn hình ảnh:</td>
                        <td><input type="file" name="files[]" multiple required></td>
                    </tr>
                    <tr>
                        <td><input type="submit" id="btnsubmit" value="Tải lên" /></td>
                        <td><input type="reset" value="Làm lại" /><b id="noteForm"></b></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <hr />

    <div class="admin-info">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span>Tổng số hình ảnh: <b><?php echo $l; ?></b></span>
            <?php if (isset($_SESSION['ADMIN']) && $l > 0) { ?>
                <button onclick="deleteSelectedImages()" class="delete-selected-btn">Xóa đã chọn</button>
            <?php } ?>
        </div>
    </div>

    <table class="content-table">
        <thead>
            <tr>
                <?php if (isset($_SESSION['ADMIN'])) { ?>
                    <th><input type="checkbox" id="select-all" onclick="toggleAllCheckboxes()"></th>
                <?php } ?>
                <th>ID</th>
                <th>Tên file</th>
                <th>Hình ảnh</th>
                <th>Loại file</th>
                <th>Kích thước</th>
                <th>Ngày tạo</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($l > 0) {
                foreach ($list_hinhanh as $item) {
            ?>
                    <tr>
                        <?php if (isset($_SESSION['ADMIN'])) { ?>
                            <td><input type="checkbox" class="image-checkbox" value="<?php echo $item->id; ?>"></td>
                        <?php } ?>
                        <td><?php echo htmlspecialchars($item->id); ?></td>
                        <td><?php echo htmlspecialchars($item->ten_file); ?></td>
                        <td align="center">
                            <div class="product-img-wrapper">
                                <?php
                                $image_path = str_replace('../../', '', $item->duong_dan);
                                ?>
                                <img class="product-img" src="<?php echo $image_path; ?>"
                                    alt="<?php echo htmlspecialchars($item->ten_file); ?>"
                                    onerror="this.src='./img_LQA/no-image.png'">
                            </div>
                        </td>
                        <td><?php echo htmlspecialchars($item->loai_file); ?></td>
                        <td><?php echo number_format($item->kich_thuoc / 1024, 2) . ' KB'; ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($item->ngay_tao)); ?></td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

<style>
    .content_hinhanh {
        padding: 20px;
    }

    .upload-form {
        margin: 20px 0;
        padding: 20px;
        background: #f8f9fc;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .content-table {
        width: 100%;
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 0.9em;
        border-radius: 5px 5px 0 0;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    .content-table thead tr {
        background-color: #4e73df;
        color: #ffffff;
        text-align: left;
        font-weight: bold;
    }

    .content-table th,
    .content-table td {
        padding: 12px 15px;
    }

    .content-table tbody tr {
        border-bottom: 1px solid #dddddd;
    }

    .content-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    .content-table tbody tr:last-of-type {
        border-bottom: 2px solid #4e73df;
    }

    .product-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .product-img:hover {
        transform: scale(1.1);
        cursor: pointer;
    }

    .delete-selected-btn {
        background-color: #e74a3b;
        color: white;
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .delete-selected-btn:hover {
        background-color: #d52a1a;
    }

    #btnsubmit {
        background-color: #4e73df;
        color: white;
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    #btnsubmit:hover {
        background-color: #2e59d9;
    }

    input[type="reset"] {
        padding: 8px 16px;
        margin-left: 10px;
        border: 1px solid #d1d3e2;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    input[type="reset"]:hover {
        background-color: #f8f9fc;
    }

    .image-checkbox {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }

    #select-all {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }
</style>

<script>
    function toggleAllCheckboxes() {
        const selectAll = document.getElementById('select-all');
        const checkboxes = document.getElementsByClassName('image-checkbox');
        for (let checkbox of checkboxes) {
            checkbox.checked = selectAll.checked;
        }
    }

    function deleteSelectedImages() {
        const checkboxes = document.getElementsByClassName('image-checkbox');
        const selectedIds = [];

        for (let checkbox of checkboxes) {
            if (checkbox.checked) {
                selectedIds.push(parseInt(checkbox.value));
            }
        }

        if (selectedIds.length === 0) {
            alert('Vui lòng chọn ít nhất một hình ảnh để xóa!');
            return;
        }

        if (confirm('Bạn có chắc muốn xóa ' + selectedIds.length + ' hình ảnh đã chọn không?')) {
            fetch('./elements_LQA/mhinhanh/hinhanhAct.php?reqact=delete', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        ids: selectedIds
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        alert('Xóa hình ảnh thành công!');
                        location.reload();
                    } else {
                        alert(data.message || 'Có lỗi xảy ra khi xóa hình ảnh!');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra khi xóa hình ảnh: ' + error.message);
                });
        }
    }
</script>