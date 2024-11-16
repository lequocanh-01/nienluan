<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public_files/mycss.css">
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <title>Trang sản phẩm hàng hóa tiêu dùng giải trí</title>
</head>

<body class="bg-light">
    <div class="container-fluid p-0">
        <header class="bg-primary text-white py-3 mb-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <h1 class="h4 mb-0">Trang sản phẩm</h1>
                    </div>
                    <div class="col text-end">
                        <form class="d-flex" action="./search.php" method="GET">
                            <input class="form-control me-2" type="search" placeholder="Tìm sản phẩm"
                                aria-label="Search" name="query">
                            <button class="btn btn-outline-light" type="submit">Tìm</button>
                        </form>
                        <a href="./administrator/userLogin.php" class="btn btn-primary">Đăng nhập</a>
                    </div>
                </div>
            </div>
        </header>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top mb-4" id="lvTwo">
            <div class="container">
                <?php require './apart/menuLoaihang.php'; ?>
            </div>
        </nav>

        <main class="container" id="lvThree">
            <div class="row">
                <div class="col-12">
                    <?php
                    if (!isset($_GET['reqHanghoa'])) {
                        require './apart/viewListLoaihang.php';
                    } else {
                        require './apart/viewHangHoa.php';
                    }
                    ?>
                </div>
            </div>
        </main>

        <footer class="bg-secondary text-white py-4 mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Về chúng tôi</h5>
                        <p>Thông tin về công ty của bạn</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Liên hệ</h5>
                        <p>Email: example@example.com</p>
                        <p>Điện thoại: 123-456-7890</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="./"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navItems = document.querySelectorAll('.nav-item');
            navItems.forEach(item => {
                item.addEventListener('click', function() {
                    navItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>
</body>

</html>