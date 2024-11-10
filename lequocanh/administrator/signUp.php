<!doctype html>
<html lang="en">

<head>
    <title>Đăng ký</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="stylecss_LQA/mycss.css">
</head>

<body>
    <div class="container">
        <h2 class="text-center mb-4">Đăng ký</h2>
        <div class="form-container bg-white p-4 rounded">
            <form name="newuser" id="formreg" method="post" action='./elements_LQA/mUser/userAct.php?reqact=addnew' novalidate>
                <div class="mb-3">
                    <label for="username" class="form-label">Tên đăng nhập:</label>
                    <input type="text" class="form-control" id="username" name="username" 
                           pattern="^[a-zA-Z0-9]{5,20}$" required>
                    <div class="invalid-feedback">
                        Tên đăng nhập phải từ 5-20 ký tự và chỉ chứa chữ cái và số
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu:</label>
                    <input type="password" class="form-control" id="password" name="password" 
                           pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$" required>
                    <div class="invalid-feedback">
                        Mật khẩu phải có ít nhất 8 ký tự, bao gồm chữ hoa, chữ thường và số
                    </div>
                </div>

                <div class="mb-3">
                    <label for="hoten" class="form-label">Họ tên:</label>
                    <input type="text" class="form-control" id="hoten" name="hoten"
                           pattern="^[a-zA-ZÀ-ỹ\s]{2,50}$" required>
                    <div class="invalid-feedback">
                        Họ tên phải từ 2-50 ký tự và chỉ chứa chữ cái
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Giới tính:</label>
                    <div class="d-flex gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gioitinh" id="nam" value="1" checked required>
                            <label class="form-check-label" for="nam">Nam</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gioitinh" id="nu" value="0">
                            <label class="form-check-label" for="nu">Nữ</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="ngaysinh" class="form-label">Ngày sinh:</label>
                    <input type="date" class="form-control" id="ngaysinh" name="ngaysinh" required>
                    <div class="invalid-feedback">
                        Bạn phải đủ 18 tuổi để đăng ký
                    </div>
                </div>

                <div class="mb-3">
                    <label for="dienthoai" class="form-label">Điện thoại:</label>
                    <input type="tel" class="form-control" id="dienthoai" name="dienthoai"
                           pattern="^[0-9]{10}$" required>
                    <div class="invalid-feedback">
                        Số điện thoại phải có đúng 10 chữ số
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" id="btnsubmit" class="btn btn-primary px-4">Đăng ký</button>
                    <button type="button" id="btnreset" class="btn btn-outline-secondary px-4 ms-2">Làm lại</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Form validation
        const form = document.getElementById('formreg');
        const inputs = form.querySelectorAll('input');
        
        // Chỉ validate khi user blur khỏi field
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });

            // Remove invalid class when user starts typing
            input.addEventListener('input', function() {
                this.classList.remove('is-invalid');
            });
        });

        // Validate individual field
        function validateField(field) {
            switch(field.id) {
                case 'username':
                    if (!field.value.match(/^[a-zA-Z0-9]{5,20}$/)) {
                        field.classList.add('is-invalid');
                    }
                    break;
                case 'password':
                    if (!field.value.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/)) {
                        field.classList.add('is-invalid');
                    }
                    break;
                case 'hoten':
                    if (!field.value.match(/^[a-zA-ZÀ-ỹ\s]{2,50}$/)) {
                        field.classList.add('is-invalid');
                    }
                    break;
                case 'ngaysinh':
                    let birthDate = new Date(field.value);
                    let today = new Date();
                    let age = today.getFullYear() - birthDate.getFullYear();
                    if (age < 18 || !field.value) {
                        field.classList.add('is-invalid');
                    }
                    break;
                case 'dienthoai':
                    if (!field.value.match(/^[0-9]{10}$/)) {
                        field.classList.add('is-invalid');
                    }
                    break;
            }
        }

        // Reset form and clear validations
        document.getElementById('btnreset').addEventListener('click', function() {
            form.reset();
            inputs.forEach(input => {
                input.classList.remove('is-invalid');
            });
        });

        // Form submission
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            let isValid = true;

            // Validate all fields
            inputs.forEach(input => {
                if (input.type !== 'radio') {
                    validateField(input);
                    if (input.classList.contains('is-invalid')) {
                        isValid = false;
                    }
                }
            });

            if (isValid) {
                form.submit();
            }
        });
    </script>
</body>

</html>