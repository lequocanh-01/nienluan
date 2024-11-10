<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div>Quản lý người dùng</div>
    <hr>
    <div>Người dùng mới</div>
    <div>
        <form name="newuser" id="formreg" method="post" action='./elements_LQA/mUser/userAct.php?reqact=addnew'>
            <table>
                <tr>
                    <td>Tên đăng nhập:</td>
                    <td><input type="text" name="username" /></td>
                </tr>
                <tr>
                    <td>Mật khẩu:</td>
                    <td><input type="password" name="password" /></td>
                </tr>
                <tr>
                    <td>Họ tên:</td>
                    <td><input type="text" name="hoten" /></td>
                </tr>
                <tr>
                    <td>Giới tính:</td>
                    <td>Nam<input type="radio" name="gioitinh" value="1" checked="true" />
                        Nữ<input type="radio" name="gioitinh" value="0" />
                    </td>
                </tr>
                <tr>
                    <td>Ngày sinh:</td>
                    <td><input type="date" name="ngaysinh" /></td>
                </tr>
                <tr>
                    <td>Địa chỉ:</td>
                    <td><input type="text" name="diachi" /></td>
                </tr>
                <tr>
                    <td>Điện thoại:</td>
                    <td><input type="tel" name="dienthoai" /></td>
                </tr>
                <tr>
                    <td>
                        <button type="submit" id="btnsubmit" class="btn btn-success">Tạo mới</button>
                    </td>
                    <td>
                        <button type="reset" class="btn btn-outline-success">Làm lại</button>
                        <b id="noteForm"></b>
                    </td>
                </tr>
            </table>
        </form>

        <hr />
        <?php
        require './elements_LQA/mod/userCls.php';
        $userObj = new user();
        $list_user = $userObj->UserGetAll();
        $l = count($list_user);
        ?>
        <div class="titile_user">Danh Sách người dùng</div>
        <div class="content_user">
            Trong bảng có: <b> <?php echo $l; ?></b>
            <table class="table table-hover table-primary" border="solder">
                <thead class="table-danger">
                    <th>ID</th>
                    <th>username</th>
                    <th>Password</th>
                    <th>Họ Tên</th>
                    <th>Giới tính</th>
                    <th>Ngày Sinh</th>
                    <th>Địa chỉ</th>
                    <th>Điện thoại</th>
                    <th>Ngày Đăng ký</th>
                    <th>Hoạt Động</th>
                    <th>Chức Năng</th>
                </thead>
                <?php
                if ($l > 0) {
                    foreach ($list_user as $u) {
                        // Kiểm tra xem user đang đăng nhập có phải admin hay không
                        $isAdmin = isset($_SESSION['ADMIN']) && $_SESSION['ADMIN'] == 'admin';
                ?>
                <tr>
                    <td><?php echo $u->iduser; ?></td>
                    <td><?php echo $u->username; ?></td>
                    <td><?php echo $u->password; ?></td>
                    <td><?php echo $u->hoten; ?></td>
                    <td align="center">
                        <?php if ($u->gioitinh == 1) { ?>
                        <img src="./img_LQA/Boy.png" class="iconimg">
                        <?php } else { ?>
                        <img src="./img_LQA/Girl.png" class="iconimg">
                        <?php } ?>
                    </td>
                    <td><?php echo $u->ngaysinh; ?></td>
                    <td><?php echo $u->diachi; ?></td>
                    <td><?php echo $u->dienthoai; ?></td>
                    <td><?php echo isset($u->ngaydangki) ? $u->ngaydangki : 'N/A'; ?></td>
                    <td align="center">
                        <?php if (isset($_SESSION['ADMIN'])) { ?>
                        <a
                            href='./elements_LQA/mUser/userAct.php?reqact=setlock&iduser=<?php echo $u->iduser; ?>&setlock=<?php echo $u->setlock; ?>'>
                            <img src="<?php echo $u->setlock == 1 ? './img_LQA/Unlock.png' : './img_LQA/Lock.png'; ?>"
                                class="iconimg">
                        </a>
                        <?php } else { ?>
                        <img src="<?php echo $u->setlock == 1 ? './img_LQA/Unlock.png' : './img_LQA/Lock.png'; ?>"
                            class="iconimg">
                        <?php } ?>
                    </td>
                    <td align="center">
                        <?php if ($isAdmin) { ?>
                        <a href='./elements_LQA/mUser/userAct.php?reqact=deleteuser&iduser=<?php echo $u->iduser; ?>'>
                            <img src="./img_LQA/Delete.png" class="iconimg" alt="">
                        </a>
                        <?php } else { ?>
                        <img src="./img_LQA/Delete.png" class="iconimg" alt="">
                        <?php } ?>
                        <?php if ($isAdmin || (isset($_SESSION['USER']) && $_SESSION['USER'] == $u->username)) { ?>
                        <a href='index.php?req=updateuser&iduser=<?php echo $u->iduser; ?>'>
                            <img src="./img_LQA/Update.png" class="iconimg" alt="">
                        </a>
                        <?php } else { ?>
                        <img src="./img_LQA/Update.png" class="iconimg" alt="">
                        <?php } ?>
                    </td>
                </tr>
                <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz4fnFO9gyb6g5c5c5c5c5c5c5c5c5c5c5c5c5c5c5c5c5c5c5c5c5" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-1n1n1n1n1n1n1n1n1n1n1n1n1n1n1n1n1n1n1n1n1n1n1n1n1n1n1n1n1n1" crossorigin="anonymous"></script>
</body>