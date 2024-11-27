<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public_files/mycss.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>Cửa Hàng Điện Thoại</title>
    <style>
        /* Custom styles */
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .search-container {
            position: relative;
            max-width: 500px;
            width: 100%;
        }

        #searchResults {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border-radius: 0.375rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: none;
        }

        .search-suggestion {
            display: flex;
            padding: 0.75rem;
            border-bottom: 1px solid #eee;
            transition: background-color 0.2s;
        }

        .search-suggestion:hover {
            background-color: #f8f9fa;
        }

        .search-suggestion img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            margin-right: 1rem;
        }

        .hero-section {
            background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
            padding: 4rem 0;
            margin-bottom: 2rem;
        }

        .nav-link {
            position: relative;
            transition: color 0.3s ease;
        }

        .nav-link:hover::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #0d6efd;
        }

        .footer {
            background: #212529;
            color: #fff;
            padding: 3rem 0;
        }

        .social-icons a {
            color: #fff;
            margin-right: 1rem;
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: #0d6efd;
        }
    </style>
</head>

<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-mobile-alt me-2"></i>
                Cửa Hàng Điện Thoại
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="search-container mx-auto">
                    <form class="d-flex" action="./search.php" method="GET" id="searchForm">
                        <input class="form-control me-2" type="search" placeholder="Tìm kiếm sản phẩm..."
                            aria-label="Search" name="query" id="searchInput">
                        <button class="btn btn-light" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                    <div id="searchResults"></div>
                </div>

                <div class="ms-auto d-flex align-items-center">
                    <a href="./administrator/userLogin.php" class="btn btn-light me-2">
                        <i class="fas fa-user me-2"></i>
                        Đăng nhập
                    </a>
                    <a href="./administrator/elements_LQA/mgiohang/giohangView.php" class="btn btn-light position-relative">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            0
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Category Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <?php require './apart/menuLoaihang.php'; ?>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container py-4">
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

    <!-- Footer -->
    <footer class="footer mt-auto">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4">
                    <h5 class="text-white mb-3">Về chúng tôi</h5>
                    <p class="small text-muted">Chúng tôi cung cấp các sản phẩm điện thoại chính hãng với giá cả cạnh tranh và dịch vụ khách hàng tốt nhất.</p>
                </div>
                <div class="col-lg-4">
                    <h5 class="text-white mb-3">Liên hệ</h5>
                    <ul class="list-unstyled text-muted">
                        <li><i class="fas fa-map-marker-alt me-2"></i> 123 Đường ABC, Thành phố XYZ</li>
                        <li><i class="fas fa-phone me-2"></i> (123) 456-7890</li>
                        <li><i class="fas fa-envelope me-2"></i> contact@example.com</li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5 class="text-white mb-3">Theo dõi chúng tôi</h5>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <hr class="text-muted mt-4">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="small text-muted mb-0">&copy; <?php echo date('Y'); ?> Cửa Hàng Điện Thoại. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Existing scripts remain unchanged -->
</body>

</html>