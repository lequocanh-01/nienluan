// Carousel initialization
document.addEventListener('DOMContentLoaded', function() {
    var carousel = new bootstrap.Carousel(document.getElementById('productCarousel'), {
        interval: 3000,  // Thời gian chuyển slide (3 giây)
        wrap: true,      // Cho phép quay vòng
        keyboard: true,  // Cho phép điều khiển bằng bàn phím
        pause: 'hover'   // Tạm dừng khi di chuột qua
    });
}); 