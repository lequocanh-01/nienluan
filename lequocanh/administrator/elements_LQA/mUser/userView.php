<head>
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="admin-title">Quản lý người dùng</div>
    <hr>

    <?php
    require './elements_LQA/mod/userCls.php';
    $userObj = new user();
    $list_user = $userObj->UserGetAll();
    $l = count($list_user);

    // Thống kê
    $totalUsers = count($list_user);
    $activeUsers = 0;
    $last30DaysLogins = 0;
    $newUsersThisMonth = 0;

    foreach ($list_user as $u) {
        if ($u->setlock == 1) $activeUsers++;
        
        // Đếm người dùng đăng nhập trong 30 ngày
        if (isset($_COOKIE[$u->username])) {
            $lastLogin = strtotime($_COOKIE[$u->username]);
            if ((time() - $lastLogin) <= (30 * 24 * 60 * 60)) {
                $last30DaysLogins++;
            }
        }
        
        // Đếm người dùng mới trong tháng này
        if (isset($u->ngaydangki)) {
            $registerDate = strtotime($u->ngaydangki);
            if (date('Y-m', $registerDate) === date('Y-m')) {
                $newUsersThisMonth++;
            }
        }
    }
    ?>

    <!-- Dashboard Cards -->
    <div class="admin-dashboard">
        <div class="dashboard-cards">
            <div class="dashboard-card primary">
                <div class="card-content">
                    <div class="card-info">
                        <h4>Tổng số người dùng</h4>
                        <h2><?php echo $totalUsers; ?></h2>
                    </div>
                    <div class="card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>

            <div class="dashboard-card success">
                <div class="card-content">
                    <div class="card-info">
                        <h4>Người dùng hoạt động</h4>
                        <h2><?php echo $activeUsers; ?></h2>
                    </div>
                    <div class="card-icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                </div>
            </div>

            <div class="dashboard-card info">
                <div class="card-content">
                    <div class="card-info">
                        <h4>Đăng nhập 30 ngày qua</h4>
                        <h2><?php echo $last30DaysLogins; ?></h2>
                    </div>
                    <div class="card-icon">
                        <i class="fas fa-sign-in-alt"></i>
                    </div>
                </div>
            </div>

            <div class="dashboard-card warning">
                <div class="card-content">
                    <div class="card-info">
                        <h4>Người dùng mới tháng này</h4>
                        <h2><?php echo $newUsersThisMonth; ?></h2>
                    </div>
                    <div class="card-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr />
    <div class="admin-form">
        <h3>Thêm người dùng mới</h3>
        <form name="newuser" id="formreg" method="post" action='./elements_LQA/mUser/userAct.php?reqact=addnew'>
            <table class="form-table">
                <tr>
                    <td>Tên đăng nhập:</td>
                    <td><input type="text" name="username" required /></td>
                </tr>
                <tr>
                    <td>Mật khẩu:</td>
                    <td><input type="password" name="password" required /></td>
                </tr>
                <tr>
                    <td>Họ tên:</td>
                    <td><input type="text" name="hoten" required /></td>
                </tr>
                <tr>
                    <td>Giới tính:</td>
                    <td>
                        Nam<input type="radio" name="gioitinh" value="1" checked="true" />
                        Nữ<input type="radio" name="gioitinh" value="0" />
                    </td>
                </tr>
                <tr>
                    <td>Ngày sinh:</td>
                    <td><input type="date" name="ngaysinh" required /></td>
                </tr>
                <tr>
                    <td>Địa chỉ:</td>
                    <td><input type="text" name="diachi" required /></td>
                </tr>
                <tr>
                    <td>Điện thoại:</td>
                    <td><input type="tel" name="dienthoai" pattern="[0-9]{10}" required /></td>
                </tr>
                <tr>
                    <td colspan="2" class="form-actions">
                        <button type="submit" class="btn btn-primary">Tạo mới</button>
                        <button type="reset" class="btn btn-secondary">Làm lại</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <hr />
    <div class="content_user">
        <div class="admin-info">
            Tổng số người dùng: <b><?php echo $l; ?></b>
        </div>

        <div class="table-responsive">
            <table class="content-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Mật khẩu</th>
                        <th>Họ tên</th>
                        <th>Giới tính</th>
                        <th>Ngày sinh</th>
                        <th>Địa chỉ</th>
                        <th>Điện thoại</th>
                        <th>Trạng thái</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($l > 0) {
                        foreach ($list_user as $u) {
                            $isAdmin = ($u->username === 'admin');
                    ?>
                            <tr>
                                <td><?php echo $u->iduser; ?></td>
                                <td><?php echo $u->username; ?></td>
                                <td>
                                    <span class="password-field">
                                        <span class="password-dots">••••••••</span>
                                        <span class="password-text" style="display: none;">
                                            <?php echo $u->password; ?>
                                        </span>
                                        <i class="fas fa-eye toggle-password" style="cursor: pointer; margin-left: 5px;"></i>
                                    </span>
                                </td>
                                <td><?php echo $u->hoten; ?></td>
                                <td><?php echo $u->gioitinh; ?></td>
                                <td><?php echo $u->ngaysinh; ?></td>
                                <td><?php echo $u->diachi; ?></td>
                                <td><?php echo $u->dienthoai; ?></td>
                                <td align="center">
                                    <?php if (isset($_SESSION['ADMIN'])) { ?>
                                        <a href='./elements_LQA/mUser/userAct.php?reqact=setlock&iduser=<?php echo $u->iduser; ?>&setlock=<?php echo $u->setlock; ?>' 
                                           class="status-icon">
                                            <img src="<?php echo $u->setlock == 1 ? './img_LQA/Unlock.png' : './img_LQA/Lock.png'; ?>" 
                                                 class="iconimg" alt="Trạng thái">
                                        </a>
                                    <?php } else { ?>
                                        <img src="<?php echo $u->setlock == 1 ? './img_LQA/Unlock.png' : './img_LQA/Lock.png'; ?>" 
                                             class="iconimg" alt="Trạng thái">
                                    <?php } ?>
                                </td>
                                <td class="action-buttons">
                                    <?php if ($isAdmin) { ?>
                                        <a href='./elements_LQA/mUser/userAct.php?reqact=deleteuser&iduser=<?php echo $u->iduser; ?>' 
                                           class="admin-action"
                                           data-username="<?php echo $u->username; ?>"
                                           data-action="delete">
                                            <img src="./img_LQA/Delete.png" class="iconimg" alt="">
                                        </a>
                                    <?php } else { ?>
                                        <img src="./img_LQA/Delete.png" class="iconimg" alt="">
                                    <?php } ?>
                                    
                                    <?php if ($isAdmin || (isset($_SESSION['USER']) && $_SESSION['USER'] == $u->username)) { ?>
                                        <a href='index.php?req=updateuser&iduser=<?php echo $u->iduser; ?>'
                                           class="admin-action"
                                           data-username="<?php echo $u->username; ?>"
                                           data-action="update">
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
                </tbody>
            </table>
        </div>
    </div>

    <style>
    /* Style cho form */
    .form-table {
        width: 100%;
        max-width: 600px;
        margin: 20px 0;
    }

    .form-table td {
        padding: 10px;
    }

    .form-table input[type="text"],
    .form-table input[type="password"],
    .form-table input[type="date"],
    .form-table input[type="tel"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        transition: border-color 0.3s;
    }

    .form-table input:focus {
        border-color: #4e73df;
        outline: none;
        box-shadow: 0 0 0 2px rgba(78, 115, 223, 0.25);
    }

    .form-actions {
        text-align: center;
        padding-top: 20px;
    }

    .btn {
        padding: 8px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.3s;
    }

    .btn-primary {
        background: #4e73df;
        color: white;
    }

    .btn-secondary {
        background: #858796;
        color: white;
        margin-left: 10px;
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .btn-primary:hover {
        background: #2e59d9;
    }

    .btn-secondary:hover {
        background: #717384;
    }

    /* Style cho radio buttons */
    input[type="radio"] {
        margin: 0 5px 0 15px;
    }

    /* Style cho bảng */
    .content-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin: 20px 0;
    }

    .content-table th,
    .content-table td {
        padding: 12px 15px;
        border-bottom: 1px solid #dee2e6;
    }

    .content-table thead th {
        background-color: #4e73df;
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.9rem;
        letter-spacing: 0.5px;
        vertical-align: middle;
        border-bottom: 2px solid #4668ce;
        text-align: left;
    }

    .content-table tbody tr {
        transition: all 0.3s ease;
    }

    .content-table tbody tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    .content-table tbody tr:hover {
        background-color: #eef2ff;
    }

    .content-table tbody td {
        color: #2c3e50;
        font-weight: 500;
        vertical-align: middle;
    }

    /* Style cho icons */
    .iconimg {
        width: 24px;
        height: 24px;
        transition: transform 0.2s;
    }

    .iconimg:hover {
        transform: scale(1.2);
    }

    .action-buttons {
        display: flex;
        gap: 10px;
        justify-content: center;
    }

    /* Responsive */
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    @media (max-width: 768px) {
        .content-table {
            font-size: 14px;
        }
        
        .content-table th,
        .content-table td {
            padding: 10px 12px;
        }
        
        .content-table thead th {
            font-size: 0.8rem;
        }
    }

    .password-field {
        position: relative;
        display: inline-flex;
        align-items: center;
    }

    .toggle-password {
        color: #666;
        transition: color 0.3s;
    }

    .toggle-password:hover {
        color: #333;
    }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz4fnFO9gyb6g5c5c5c5c5c5c5c5c5c5c5c5c5c5c5c5c5c5c5c5c5" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-1n1n1n1n1n1n1n1n1n1n1n1n1n1n1n1n1n1n1n1n1n1n1n1n1n1n1n1n1n1" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function() {
        // Xử lý khi click vào nút xóa hoặc cập nhật cho tài khoản admin
        $('.admin-action').click(function(e) {
            e.preventDefault();
            const username = $(this).data('username');
            const action = $(this).data('action');
            const href = $(this).attr('href');
            
            if (username === 'admin') {
                const adminPass = prompt('Vui lòng nhập mật khẩu admin để thực hiện thao tác này:');
                if (adminPass) {
                    // Thêm mật khẩu vào URL
                    window.location.href = href + '&admin_password=' + encodeURIComponent(adminPass);
                }
            } else {
                window.location.href = href;
            }
        });

        // Xử lý toggle password
        $('.toggle-password').click(function() {
            const passwordField = $(this).closest('.password-field');
            const dots = passwordField.find('.password-dots');
            const text = passwordField.find('.password-text');
            
            if (dots.is(':visible')) {
                dots.hide();
                text.show();
                $(this).removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                dots.show();
                text.hide();
                $(this).removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });
    </script>
</body>