<div>Quản lý đơn giá</div>
<hr>
<div>Thêm đơn giá</div>
<?php
require_once './elements_LQA/mod/dongiaCls.php'; // Sử dụng require_once
require_once './elements_LQA/mod/hanghoaCls.php'; // Thêm dòng này để sử dụng lớp hàng hóa

$lhobj = new Dongia(); // Đảm bảo tên lớp là Dongia với chữ cái đầu viết hoa
$list_lh = $lhobj->DongiaGetAll(); // Sử dụng phương thức với chữ cái đầu viết hoa
$l = count($list_lh);

// Lấy danh sách hàng hóa
$hhobj = new Hanghoa(); // Tạo đối tượng hàng hóa
$list_hh = $hhobj->HanghoaGetAll(); // Lấy tất cả hàng hóa

// Kiểm tra xem danh sách hàng hóa có tồn tại không
if (empty($list_hh)) {
    $list_hh = []; // Khởi tạo biến nếu không có dữ liệu
}
?>
<div>
    <form name="newdongia" id="formadddongia" method="post" action='./elements_LQA/mdongia/dongiaAct.php?reqact=addnew' enctype="multipart/form-data">
        <table>

            <tr>
                <td>Chọn hàng hóa:</td>
                <td>
                    <select name="idhanghoa" id="hanghoaSelect" onchange="updatePrice()">
                        <option value="">-- Chọn hàng hóa --</option>
                        <?php
                        if (!empty($list_hh)) { // Kiểm tra xem d   anh sách hàng hóa có tồn tại không
                            foreach ($list_hh as $h) {
                        ?>
                                <option value="<?php echo $h->idhanghoa; ?>" data-price="<?php echo $h->giathamkhao; ?>">
                                    <?php echo $h->tenhanghoa; ?>
                                </option>
                        <?php
                            }
                        } else {
                            echo "<option value=''>Không có hàng hóa nào để chọn.</option>"; // Thông báo nếu không có hàng hóa
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>

            <tr>
                <td>Giá bán</td>
                <td><input type="text" name="giaban" id="giaban" /></td>
            </tr>
            <tr>
                <td>Tên hàng hóa</td>
                <td><input type="text" name="tenHangHoa" id="giaban" /></td>
            </tr>
            <tr>
                <td>Ngày áp dụng</td>
                <td><input type="date" name="ngayapdung" /></td>
            </tr>
            <tr>
                <td>Ngày kết thúc</td>
                <td><input type="date" name="ngayketthuc" /></td>
            </tr>
            <tr>
                <td>Điều kiện</td>
                <td><input type="text" name="dieukien" /></td>
            </tr>
            <tr>
                <td>Ghi chú</td>
                <td><input type="text" name="ghichu" /></td>
            </tr>

            <tr>
                <td><input type="submit" id="btnsubmit" value="Tạo mới" /></td>
                <td><input type="reset" value="Làm lại" /><b id="noteForm"></b></td>
            </tr>
        </table>
    </form>
    <hr />
    <div class="title_dongia">Danh sách đơn giá</div>
    <div class="content_dongia">
        Trong bảng có: <b><?php echo $l; ?></b>

        <table border="solid">
            <thead>
                <th>ID</th>
                <th>ID hàng hóa</th>
                <th>Tên hàng hóa</th>
                <th>Giá bán</th>
                <th>Ngày áp dụng</th>
                <th>Ngày kết thúc</th>
                <th>Điều kiện</th>
                <th>Ghi chú</th>
                <th>Áp dụng</th>
                <!-- <th>thao tác</th> -->
            </thead>
            <tbody>
                <?php
                if ($l > 0) {
                    foreach ($list_lh as $u) {
                ?>
                        <tr>
                            <td><?php echo $u->idDonGia; ?></td>
                            <td><?php echo $u->idHangHoa; ?></td>
                            <td><?php echo $u->tenhanghoa; ?></td>
                            <td><?php echo $u->giaBan; ?></td>
                            <td><?php echo $u->ngayApDung; ?></td>
                            <td><?php echo $u->ngayKetThuc; ?></td>
                            <td><?php echo $u->dieuKien; ?></td>
                            <td><?php echo $u->ghiChu; ?></td>
                            <td>
                                <form method="post" action="./elements_LQA/mdongia/updateSetFalse.php">
                                    <input type="hidden" name="idDonGia" value="<?php echo $u->idDonGia; ?>">
                                    <input type="hidden" name="apDung" value="<?php echo $u->apDung ? 'false' : 'true'; ?>">
                                    <button type="submit" class="btn btn-sm <?php echo $u->apDung ? 'btn-success' : 'btn-danger'; ?>">
                                        <?php echo $u->apDung ? 'True' : 'False'; ?>
                                    </button>
                                </form>
                            </td>
                            <!-- <td align="center">
                                <?php
                                if (isset($_SESSION['ADMIN'])) {
                                ?>
                                    <a href="./elements_LQA/mdongia/dongiaAct.php?reqact=deletedongia&idDonGia=<?php echo $u->idDonGia; ?>">
                                        <img src="./img_LQA/Delete.png" class="iconimg">
                                    </a>
                                <?php
                                } else {
                                ?>
                                    <img src="./img_LQA/Delete.png" class="iconimg">
                                <?php
                                }
                                ?>
                                <img src="./img_LQA/Update.png" class="w_update_btn_open_dg" data-id="<?php echo $u->idDonGia; ?>">
                            </td> -->
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <div id="w_update_dg">
        <div id="w_update_form_dg"></div>
        <input type="button" value="close" id="w_close_btn_dg">
    </div>
</div>

<script>
    function updatePrice() {
        var select = document.getElementById("hanghoaSelect");
        var selectedOption = select.options[select.selectedIndex];
        var price = selectedOption.getAttribute("data-price");
        var name = selectedOption.text; // Lấy tên hàng hóa đã chọn
        document.getElementById("giaban").value = price; // Cập nhật giá bán
        document.getElementsByName("tenHangHoa")[0].value = name; // Cập nhật tên hàng hóa
    }
</script>