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
                        <h1 class="h4 mb-0">Cửa Hàng Điện Thoại</h1>
                    </div>
                    <div class="col text-end position-relative">
                        <div style="display: inline-block; position: relative; min-width: 350px;">
                            <form class="d-flex" action="./search.php" method="GET" id="searchForm">
                                <input class="form-control me-2" type="search" placeholder="Tìm sản phẩm"
                                    aria-label="Search" name="query" id="searchInput">
                                <button class="btn btn-outline-light" type="submit">Tìm</button>
                            </form>
                            <div id="searchResults"></div>
                        </div>
                        <a href="./administrator/userLogin.php" class="btn btn-primary ms-2">
                            <div style="display: flex; flex-direction: column; align-items: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                </svg>
                                Đăng nhập
                            </div>
                        </a>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    let searchTimeout;
    const searchInput = $('#searchInput');
    const searchResults = $('#searchResults');

    searchInput.on('input', function() {
        clearTimeout(searchTimeout);
        const query = $(this).val();
        
        if(query.length < 2) {
            searchResults.hide();
            return;
        }

        searchTimeout = setTimeout(function() {
            $.get('search_suggestions.php', { term: query }, function(data) {
                if(data.length > 0) {
                    let html = '';
                    data.forEach(item => {
                        html += `
                            <a href="./index.php?reqHanghoa=${item.id}" class="text-decoration-none text-dark">
                                <div class="search-suggestion">
                                    <img src="data:image/png;base64,${item.image}" alt="${item.name}">
                                    <div class="suggestion-details">
                                        <div class="suggestion-name">${item.name}</div>
                                        <div class="suggestion-price">${item.price}</div>
                                    </div>
                                </div>
                            </a>`;
                    });
                    searchResults.html(html).show();
                } else {
                    searchResults.html('<div class="p-3 text-center">Không tìm thấy sản phẩm</div>').show();
                }
            });
        }, 300);
    });

    // Ẩn kết quả khi click bên ngoài
    $(document).on('click', function(e) {
        if(!$(e.target).closest('#searchForm').length) {
            searchResults.hide();
        }
    });

    // Hiện lại kết quả khi focus vào input
    searchInput.on('focus', function() {
        if($(this).val().length >= 2) {
            searchResults.show();
        }
    });
});
</script>
</body>

</html>