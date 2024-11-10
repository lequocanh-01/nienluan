<!doctype html>
<html lang="en">

<head>
    <title>Webleb</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="stylecss_LQA/mycss.css">
</head>

<body>
    <div class="container text-center">
        <div class="row my-4">
            <div class="col">
            </div>
        </div>
        <div class="row my-5">
            <div class="col">
                <h1 class="title">Welcome back</h1>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-12">
                <form method="post" name="frmLogin" action="./elements_LQA/mUser/userAct.php?reqact=checklogin">
                    <input type="text" name="username" id="id_username" placeholder="User Name"
                        class="form-control mx-auto mb-3">
                    <input type="password" name="password" id="id_password" placeholder="Password"
                        class="form-control mx-auto mb-3">
                    <button type="submit" class="btn btn-primary w-100">Continue</button>
                </form>
                <?php
                if (isset($_GET['error'])) {
                    echo '<p class="text-danger mt-2">' . htmlspecialchars($_GET['error']) . '</p>';
                }
                ?>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-12">
                <p>Don't have an account? <a href="../administrator/signUp.php"
                        style="color: #fff; text-decoration: underline;">Sign up</a></p>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-12">
                <hr style="width: 160px; display: inline-block; margin: 0 10px;">OR
                <hr style="width: 160px; display: inline-block; margin: 0 10px;">
            </div>
        </div>
        <div class="row my-3">
            <div class="col-12">
                <button class="btn btn-light w-100 mb-2"><i class="fab fa-google me-2"></i>Continue with Google</button>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-12">
                <button class="btn btn-light w-100"><i class="fab fa-microsoft me-2"></i>Continue with
                    Microsoft</button>
            </div>
        </div>
    </div>
    <footer class="text-center mt-5 footer">
        <p>Terms of use | Privacy policy</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>