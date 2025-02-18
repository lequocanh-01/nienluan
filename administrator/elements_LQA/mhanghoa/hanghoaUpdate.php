<?php
require '../../elements_LQA/mod/hanghoaCls.php';
require '../../elements_LQA/mod/loaihangCls.php';
$idhanghoa = $_REQUEST['idhanghoa'];

$hanghoaObj = new hanghoa();
$getLhUpdate = $hanghoaObj->HanghoaGetbyId($idhanghoa);
$obj = new loaihang();
$list_lh = $obj->LoaihangGetAll();

// Fetch lists for employees, units of measurement, brands and images
$list_nhanvien = $hanghoaObj->GetAllNhanVien();
$list_donvitinh = $hanghoaObj->GetAllDonViTinh();
$list_thuonghieu = $hanghoaObj->GetAllThuongHieu();
$list_hinhanh = $hanghoaObj->GetAllHinhAnh();

// Get current image
$current_image = $hanghoaObj->GetHinhAnhById($getLhUpdate->hinhanh);
?>

<div class="update-form">
    <h3>Cập nhật hàng hóa</h3>
    <form name="updatehanghoa" id="formupdatehh" method="post"
        action='./elements_LQA/mhanghoa/hanghoaAct.php?reqact=updatehanghoa'>
        <input type="hidden" name="idhanghoa" value="<?php echo $getLhUpdate->idhanghoa; ?>" />

        <div class="form-group">
            <label>Tên hàng hóa:</label>
            <input type="text" name="tenhanghoa" value="<?php echo htmlspecialchars($getLhUpdate->tenhanghoa); ?>"
                required />
        </div>

        <div class="form-group">
            <label>Giá tham khảo:</label>
            <input type="number" name="giathamkhao" value="<?php echo $getLhUpdate->giathamkhao; ?>" required />
        </div>

        <div class="form-group">
            <label>Mô tả:</label>
            <input type="text" name="mota" value="<?php echo htmlspecialchars($getLhUpdate->mota); ?>" />
        </div>

        <div class="form-group">
            <label>Hình ảnh:</label>
            <div class="image-selection">
                <!-- Hiển thị hình ảnh hiện tại -->
                <div class="current-image">
                    <h4>Hình ảnh hiện tại:</h4>
                    <?php if ($current_image): ?>
                        <div class="image-item selected">
                            <?php
                            // Xử lý đường dẫn hình ảnh hiện tại
                            $current_image_path = str_replace('uploads/', '', $current_image->duong_dan);
                            ?>
                            <img src="../../administrator/uploads/<?php echo $current_image_path; ?>" 
                                 class="preview-img" 
                                 alt="<?php echo htmlspecialchars($current_image->ten_file); ?>"
                                 onerror="this.src='../../img_LQA/no-image.png'">
                            <div class="image-info">
                                <span class="image-name"><?php echo htmlspecialchars($current_image->ten_file); ?></span>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Hiển thị các hình ảnh có thể chọn -->
                <div class="available-images">
                    <h4>Chọn hình ảnh mới:</h4>
                    <div class="image-grid">
                        <?php 
                        foreach ($list_hinhanh as $img):
                            // Đếm số sản phẩm đang sử dụng hình ảnh này
                            $products_using = $hanghoaObj->GetProductsByImageId($img->id);
                            // Hiển thị nếu là hình ảnh hiện tại hoặc chưa được sử dụng
                            if ($img->id == $getLhUpdate->hinhanh || empty($products_using)):
                                // Xử lý đường dẫn hình ảnh
                                $image_path = str_replace('uploads/', '', $img->duong_dan);
                        ?>
                            <div class="image-item <?php echo ($img->id == $getLhUpdate->hinhanh) ? 'selected' : ''; ?>"
                                 data-image-id="<?php echo $img->id; ?>">
                                <img src="../../administrator/uploads/<?php echo $image_path; ?>" 
                                     class="preview-img" 
                                     alt="<?php echo htmlspecialchars($img->ten_file); ?>"
                                     onerror="this.src='../../img_LQA/no-image.png'">
                                <div class="image-info">
                                    <span class="image-name"><?php echo htmlspecialchars($img->ten_file); ?></span>
                                </div>
                            </div>
                        <?php 
                            endif;
                        endforeach; 
                        ?>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id_hinhanh" value="<?php echo $getLhUpdate->hinhanh; ?>" id="selected-image-id">
        </div>

        <div class="form-group">
            <label>Loại hàng:</label>
            <div class="radio-group">
                <?php foreach ($list_lh as $l): ?>
                <label class="radio-item">
                    <input type="radio" name="idloaihang" value="<?php echo $l->idloaihang; ?>"
                        <?php echo ($l->idloaihang == $getLhUpdate->idloaihang) ? 'checked' : ''; ?> required>
                    <img class="iconbutton" src="data:image/png;base64,<?php echo $l->hinhanh; ?>">
                </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-group">
            <label>Thương hiệu:</label>
            <select name="idThuongHieu">
                <option value="">-- Chọn thương hiệu --</option>
                <?php foreach ($list_thuonghieu as $th): ?>
                <option value="<?php echo $th->idThuongHieu; ?>"
                    <?php echo ($th->idThuongHieu == $getLhUpdate->idThuongHieu) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($th->tenTH); ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Đơn vị tính:</label>
            <select name="idDonViTinh">
                <option value="">-- Chọn đơn vị tính --</option>
                <?php foreach ($list_donvitinh as $dvt): ?>
                <option value="<?php echo $dvt->idDonViTinh; ?>"
                    <?php echo ($dvt->idDonViTinh == $getLhUpdate->idDonViTinh) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($dvt->tenDonViTinh); ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Nhân viên:</label>
            <select name="idNhanVien">
                <option value="">-- Chọn nhân viên --</option>
                <?php foreach ($list_nhanvien as $nv): ?>
                <option value="<?php echo $nv->idNhanVien; ?>"
                    <?php echo ($nv->idNhanVien == $getLhUpdate->idNhanVien) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($nv->tenNV); ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-actions">
            <input type="submit" value="Cập nhật" class="btn-update" />
            <input type="reset" value="Làm lại" class="btn-reset" />
        </div>
    </form>
</div>

<style>
.update-form {
    padding: 20px;
    background: white;
    border-radius: 8px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-group input[type="text"],
.form-group input[type="number"],
.form-group select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    margin-bottom: 10px;
}

.radio-group {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.radio-item {
    display: flex;
    align-items: center;
    gap: 5px;
    cursor: pointer;
}

.form-actions {
    margin-top: 20px;
    display: flex;
    gap: 10px;
}

.btn-update,
.btn-reset {
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.btn-update {
    background-color: #007bff;
    color: white;
}

.btn-reset {
    background-color: #6c757d;
    color: white;
}

.btn-update:hover {
    background-color: #0056b3;
}

.btn-reset:hover {
    background-color: #5a6268;
}

.image-selection {
    margin: 15px 0;
    display: grid;
    grid-template-columns: 200px 1fr; /* Cố định kích thước cột hình ảnh hiện tại */
    gap: 20px;
}

.current-image {
    position: sticky;
    top: 20px;
}

.image-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 15px;
    margin-top: 10px;
    min-height: 200px; /* Đặt chiều cao tối thiểu */
}

.image-item {
    border: 2px solid #ddd;
    border-radius: 8px;
    padding: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
    aspect-ratio: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
}

.image-item:hover {
    border-color: #007bff;
    transform: translateY(-2px);
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.image-item.selected {
    border-color: #28a745;
    background-color: #f8fff8;
}

.image-item:active {
    transform: scale(0.98);
}

.image-item.selected::after {
    content: '✓';
    position: absolute;
    top: 5px;
    right: 5px;
    background: #28a745;
    color: white;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
}

.preview-img {
    width: 100%;
    height: 120px;
    object-fit: contain;
    margin-bottom: 8px;
    background-color: #f8f9fa;
    pointer-events: none;
}

.image-info {
    text-align: center;
    pointer-events: none;
}

.image-name {
    font-size: 0.9em;
    color: #666;
    display: block;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

h4 {
    color: #333;
    margin-bottom: 10px;
    font-size: 1.1em;
}

/* Thêm loading placeholder */
.preview-img.loading {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: loading 1.5s infinite;
}

@keyframes loading {
    0% {
        background-position: 200% 0;
    }
    100% {
        background-position: -200% 0;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageItems = document.querySelectorAll('.image-item');
    const hiddenInput = document.getElementById('selected-image-id');

    // Thêm loading state cho hình ảnh
    document.querySelectorAll('.preview-img').forEach(img => {
        img.classList.add('loading');
        img.onload = function() {
            this.classList.remove('loading');
        }
        img.onerror = function() {
            this.classList.remove('loading');
            this.src = '../../img_LQA/no-image.png';
        }
    });

    imageItems.forEach(item => {
        item.addEventListener('click', function(e) {
            // Bỏ chọn tất cả các hình ảnh
            imageItems.forEach(i => i.classList.remove('selected'));
            
            // Chọn hình ảnh được click
            this.classList.add('selected');
            
            // Cập nhật giá trị cho input hidden
            const imageId = this.getAttribute('data-image-id');
            hiddenInput.value = imageId;

            // Thêm hiệu ứng visual feedback
            this.style.transform = 'scale(0.98)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 100);

            // Log để debug
            console.log('Selected image ID:', imageId);
        });
    });

    // Thêm hiệu ứng hover
    imageItems.forEach(item => {
        item.addEventListener('mouseover', function() {
            if (!this.classList.contains('selected')) {
                this.style.borderColor = '#007bff';
            }
        });

        item.addEventListener('mouseout', function() {
            if (!this.classList.contains('selected')) {
                this.style.borderColor = '#ddd';
            }
        });
    });
});
</script>