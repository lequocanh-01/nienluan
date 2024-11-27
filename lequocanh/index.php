<?php
session_start();
require_once './administrator/elements_LQA/mod/giohangCls.php';

// Khởi tạo đối tượng GioHang và lấy số lượng sản phẩm
$giohang = new GioHang();
$cartItemCount = $giohang->getCartItemCount();
?>

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
            background: linear-gradient(135deg, #1a237e 0%, #311b92 100%);
            color: #fff;
            padding: 4rem 0 2rem;
            position: relative;
            overflow: hidden;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #00c6ff, #0072ff);
        }

        .footer h5 {
            color: #fff;
            font-weight: 600;
            position: relative;
            padding-bottom: 15px;
        }

        .footer h5::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 2px;
            background: #00c6ff;
        }

        .footer .text-muted {
            color: rgba(255, 255, 255, 0.7) !important;
        }

        .footer a.text-muted {
            transition: all 0.3s ease;
        }

        .footer a.text-muted:hover {
            color: #fff !important;
            text-decoration: none;
            padding-left: 5px;
        }

        .footer .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            margin-right: 10px;
            transition: all 0.3s ease;
        }

        .footer .social-icons a:hover {
            background: #00c6ff;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 198, 255, 0.3);
        }

        .footer .input-group .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: #fff;
        }

        .footer .input-group .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .footer .input-group .btn-primary {
            background: #00c6ff;
            border: none;
        }

        .footer .input-group .btn-primary:hover {
            background: #0072ff;
        }

        .footer hr.text-muted {
            opacity: 0.1;
        }

        .footer .payment-methods img {
            filter: brightness(0) invert(1);
            opacity: 0.7;
            transition: opacity 0.3s ease;
        }

        .footer .payment-methods img:hover {
            opacity: 1;
        }

        /* Thêm hiệu ứng hover cho các nút */
        .btn {
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Cải thiện thanh tìm kiếm */
        .search-container .form-control {
            border-radius: 20px;
            padding-left: 1rem;
            transition: all 0.3s ease;
        }

        .search-container .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
            border-color: #0d6efd;
        }

        .search-container .btn {
            border-radius: 20px;
            margin-left: -1px;
        }

        /* Cải thiện card sản phẩm */
        .card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .card-img-top {
            transition: all 0.3s ease;
        }

        .card:hover .card-img-top {
            transform: scale(1.05);
        }

        /* Cải thiện navbar */
        .navbar {
            background: linear-gradient(135deg, #0a2540 0%, #1a365d 100%) !important;
            padding: 1rem 0;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(45deg, #00c6ff, #0072ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .nav-item {
            margin: 0 5px;
            position: relative;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: #fff !important;
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        .nav-link.active {
            background: rgba(0, 198, 255, 0.2);
            color: #fff !important;
        }

        /* Hiệu ứng hover mới cho nav-link */
        .nav-link:hover::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #00c6ff, #0072ff);
            transition: all 0.3s ease;
            transform: translateX(-50%);
            animation: navHover 0.3s forwards;
        }

        @keyframes navHover {
            to {
                width: 80%;
            }
        }

        /* Cải thiện cart badge */
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #ff4757;
            color: white;
            border-radius: 50%;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            font-weight: bold;
            border: 2px solid #fff;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 71, 87, 0.4);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(255, 71, 87, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(255, 71, 87, 0);
            }
        }

        /* Cải thiện search box */
        .search-container .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            padding-left: 2.5rem;
            height: 45px;
        }

        .search-container .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .search-container .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.7);
        }

        /* Responsive adjustments */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: linear-gradient(135deg, #0a2540 0%, #1a365d 100%);
                padding: 1rem;
                border-radius: 10px;
                margin-top: 1rem;
            }

            .nav-link {
                padding: 0.75rem 1rem;
                border-radius: 5px;
            }

            .nav-link:hover::after {
                display: none;
            }
        }

        .footer {
            background: linear-gradient(135deg, #212529 0%, #343a40 100%);
        }

        .social-icons a {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            text-align: center;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            margin-right: 0.5rem;
        }

        .social-icons a:hover {
            background: #0d6efd;
            transform: translateY(-3px);
        }

        /* Cải thiện kết quả tìm kiếm */
        #searchResults {
            border-radius: 15px;
            margin-top: 5px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .search-suggestion {
            border-radius: 10px;
            margin: 5px;
        }

        .search-suggestion img {
            border-radius: 10px;
        }

        /* Badge số lượng giỏ hàng */
        .badge {
            transition: all 0.3s ease;
        }

        .badge:hover {
            transform: scale(1.1);
        }

        /* Thêm hiệu ứng loading */
        .loading {
            position: relative;
            overflow: hidden;
        }

        .loading::after {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.2),
                transparent
            );
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            100% {
                left: 100%;
            }
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
                            <?php echo $cartItemCount; ?>
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
    <footer class="footer mt-auto py-5">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-3">Về chúng tôi</h5>
                    <p class="small text-muted">
                        Cửa hàng điện thoại uy tín hàng đầu Việt Nam. Chuyên cung cấp các sản phẩm chính hãng với chất lượng tốt nhất và dịch vụ chăm sóc khách hàng 24/7.
                    </p>
                    <div class="social-icons mt-4">
                        <a href="#" title="Facebook"><i class="fab fa-facebook"></i></a>
                        <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" title="Youtube"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-3">Thông tin hữu ích</h5>
                    <ul class="list-unstyled text-muted">
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Hướng dẫn mua hàng</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Chính sách bảo hành</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Chính sách đổi trả</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Chính sách vận chuyển</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Điều khoản dịch vụ</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-3">Liên hệ</h5>
                    <ul class="list-unstyled text-muted">
                        <li class="mb-3">
                            <i class="fas fa-map-marker-alt me-2"></i> 
                            123 Đường ABC, Phường XYZ, Quận 1, TP.HCM
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-phone me-2"></i>
                            Hotline: 1900 xxxx
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-envelope me-2"></i>
                            Email: support@example.com
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-clock me-2"></i>
                            Giờ làm việc: 8:00 - 22:00
                        </li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-3">Đăng ký nhận tin</h5>
                    <p class="small text-muted">Đăng ký để nhận thông tin về sản phẩm mới và khuyến mãi</p>
                    <form class="mb-3">
                        <div class="input-group">
                            <input class="form-control" type="email" placeholder="Email của bạn" 
                                   style="border-radius: 20px 0 0 20px;">
                            <button class="btn btn-primary" type="submit" 
                                    style="border-radius: 0 20px 20px 0;">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                    <div class="mt-4">
                        <img src="path/to/payment-methods.png" alt="Phương thức thanh toán" 
                             class="img-fluid" style="max-height: 30px;">
                    </div>
                </div>
            </div>

            <hr class="text-muted my-4">
            
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="small text-muted mb-0">
                        &copy; <?php echo date('Y'); ?> Cửa Hàng Điện Thoại. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <img src="path/to/verified-badge.png" alt="Chứng nhận" class="img-fluid" 
                         style="max-height: 40px;">
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const searchInput = $('#searchInput');
            const searchResults = $('#searchResults');
            let searchTimeout;

            // Xử lý sự kiện nhập vào ô tìm kiếm
            searchInput.on('input', function() {
                clearTimeout(searchTimeout);
                const query = $(this).val().trim();
                
                if (query.length >= 2) {
                    searchTimeout = setTimeout(() => {
                        $.ajax({
                            url: 'search_suggestions.php',
                            method: 'GET',
                            data: { term: query },
                            success: function(data) {
                                if (data.length > 0) {
                                    let html = '';
                                    data.forEach(item => {
                                        html += `
                                            <a href="index.php?reqHanghoa=${item.id}" class="text-decoration-none text-dark">
                                                <div class="search-suggestion">
                                                    <img src="data:image/png;base64,${item.image}" alt="${item.name}">
                                                    <div>
                                                        <div class="fw-bold">${item.name}</div>
                                                        <div class="text-muted">${item.price}</div>
                                                    </div>
                                                </div>
                                            </a>`;
                                    });
                                    searchResults.html(html).show();
                                } else {
                                    searchResults.hide();
                                }
                            }
                        });
                    }, 300);
                } else {
                    searchResults.hide();
                }
            });

            // Ẩn kết quả khi click ra ngoài
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.search-container').length) {
                    searchResults.hide();
                }
            });

            // Xử lý form submit
            $('#searchForm').on('submit', function(e) {
                const query = searchInput.val().trim();
                if (query.length < 2) {
                    e.preventDefault();
                    alert('Vui lòng nhập ít nhất 2 ký tự để tìm kiếm');
                }
            });
        });
    </script>
</body>

</html>