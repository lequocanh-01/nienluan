<div class="container mt-4">
    <h2 class="mb-4">Quản lý hàng hóa</h2>
    <hr>
    <h3 class="mb-3">Thêm hàng hóa mới</h3>
    <form name="newhanghoa" id="formhh" method="post" action='./elements_LQA/mhanghoa/hanghoaAct.php?reqact=addnew'
        enctype="multipart/form-data" class="mb-4">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="tenhanghoa" class="form-label">Tên hàng hóa:</label>
                <input type="text" class="form-control" id="tenhanghoa" name="tenhanghoa" required>
            </div>
            <div class="col-md-6">
                <label for="giathamkhao" class="form-label">Giá tham khảo:</label>
                <input type="number" class="form-control" id="giathamkhao" name="giathamkhao" required>
            </div>
            <div class="col-md-6">
                <label for="soluong" class="form-label">Số lượng:</label>
                <input type="number" class="form-control" id="soluong" name="soluong" value="1" min="1">
            </div>
            <div class="col-md-12">
                <label for="mota" class="form-label">Mô tả:</label>
                <textarea class="form-control" id="mota" name="mota" rows="3"></textarea>
            </div>
            <div class="col-md-6">
                <label for="idloaihang" class="form-label">Loại hàng:</label>
                <select class="form-select" id="idloaihang" name="idloaihang" required>
                    <?php
                    require_once './elements_LQA/mod/loaihangCls.php';
                    $loaihang = new loaihang();
                    $list_loaihang = $loaihang->LoaihangGetAll();
                    foreach ($list_loaihang as $loai) {
                        echo '<option value="' . $loai->idloaihang . '">' . $loai->tenloaihang . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6">
                <label for="hinhanh" class="form-label">Hình ảnh:</label>
                <input type="file" class="form-control" id="hinhanh" name="hinhanh">
            </div>
            <div class="col-12">
                <button type="submit" id="btnsubmit" class="btn btn-primary">Thêm mới</button>
                <button type="reset" class="btn btn-secondary">Làm lại</button>
            </div>
        </div>
    </form>

    <hr />
    <h3 class="mb-3">Danh sách hàng hóa</h3>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên hàng hóa</th>
                    <th>Giá tham khảo</th>
                    <th>Mô tả</th>
                    <th>Loại hàng</th>
                    <th>Số lượng</th>
                    <th>Hình ảnh</th>
                    <th>Chức năng</th>
                    <th>Mua</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once './elements_LQA/mod/hanghoaCls.php';
                $hanghoa = new hanghoa();
                $list_hanghoa = $hanghoa->HanghoaGetAll();
                foreach ($list_hanghoa as $hang) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($hang->idhanghoa) . '</td>';
                    echo '<td>' . htmlspecialchars($hang->tenhanghoa) . '</td>';
                
                    echo '<td>' . htmlspecialchars($hang->mota) . '</td>';
                    echo '<td>' . htmlspecialchars($hang->idloaihang) . '</td>';
                    echo '<td><img src="data:image/png;base64,' . htmlspecialchars($hang->hinhanh) . '" alt="' . htmlspecialchars($hang->tenhanghoa) . '" class="img-fluid" style="width: 50px; height: 50px;"></td>';
                    echo '<td><a href="./index.php?reqHanghoa=' . htmlspecialchars($hang->idhanghoa) . '" class="btn btn-primary">Xem chi tiết</a></td>';
                    echo '<td><a href="./purchase.php?productId=' . htmlspecialchars($hang->idhanghoa) . '" class="btn btn-success">Mua</a></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>