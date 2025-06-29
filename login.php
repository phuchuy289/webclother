<?php
include "connect.php";
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <title>Login</title>
</head>

<body>
    <header class="header">
        <div class="container">
            <div class="inner__wrap">
                <a class="header__title" href="index.php">Gr6+</a>
                <ul class="header__bar">
                    <li>
                        <a href="/">Giới Thiệu</a>
                    </li>
                    <li>
                        <a href="/">Sản Phẩm</a>
                    </li>
                    <li>
                        <a href="/">Bài Viết</a>
                    </li>
                    <li>
                        <a href="/">Liên Hệ</a>
                    </li>
                </ul>
                <form action="" class="header__form">
                    <input type="text" placeholder="Tìm kiếm sản phẩm...">
                    <button><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>

                <div class="header__cart">
                    <a href=""><i class="fa-solid fa-cart-shopping"></i></a>
                    <a href=""><i class="fa-regular fa-user"></i></a>
                </div>

            </div>
        </div>
    </header>
    <div class="login">
        <div class="container">
            <div class="inner__wrap">
                <div class="form">
                    <h1 class="title">Đăng nhập</h1>
                    <form method="POST" action="login1.php">
                        <input type="hidden" name="web" id="web"
                            value="<?php if(isset($_GET['web'])){echo $_GET['web'];} ?>">
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username" required>
                        <label for="password">Password:</label>
                        <div style="position: relative;">
                            <input type="password" name="password" id="password" required>
                            <i class="fa-solid fa-eye" id="togglePassword"
                                style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                        </div>
                        <h3 style="color: red;">
                            <?php if( isset($_GET['status']) and $_GET['status'] == "false"){echo "tên đăng nhập hoặc mật khẩu sai";} ?>
                        </h3>
                        <button>Đăng nhập</button>
                    </form>
                    <div class="notAccount">
                        <a href="register.php">Bạn chưa có tài khoản ?</a>
                        <a href="">Quên mật khẩu?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="inner__wrap">

                <div class="footer__top">
                    <div class="footer__main">
                        <div class="footer__title">
                            Gr6+
                        </div>
                        <div class="footer__desc">
                            Chúng tôi có những bộ quần áo phù hợp với phong cách của bạn và bạn có thể tự hào khi mặc.
                        </div>
                        <div class="footer__social">
                            <a href=""><i class="fa-brands fa-facebook"></i></a>
                            <a href=""><i class="fa-brands fa-square-x-twitter"></i></a>
                            <a href=""><i class="fa-brands fa-instagram"></i></a>
                        </div>
                    </div>

                    <div class="footer__bar">
                        <div class="footer__title">
                            CÔNG TY
                        </div>
                        <ul class="footer__desc">
                            <li><a href="">Giới Thiệu</a></li>
                            <li><a href="">Sản Phẩm</a></li>
                            <li><a href="">Công Việc</a></li>
                            <li><a href="">Việc Làm</a></li>
                        </ul>
                    </div>

                    <div class="footer__bar">
                        <div class="footer__title">
                            Trợ giúp
                        </div>
                        <ul class="footer__desc">
                            <li><a href="">Hỗ Trợ Khách Hàng</a></li>
                            <li><a href="">Thông Tin Đơn Hàng</a></li>
                            <li><a href="">Điều Khoản & Điều Kiện</a></li>
                            <li><a href="">Chính Sách</a></li>
                        </ul>
                    </div>

                    <div class="footer__bar">
                        <div class="footer__title">
                            Tài nguyên
                        </div>
                        <ul class="footer__desc">
                            <li><a href="">Sách Miễn Phí</a></li>
                            <li><a href="">Bài Viết</a></li>
                            <li><a href="">Kiến Thức</a></li>
                            <li><a href="">Youtube</a></li>
                        </ul>
                    </div>

                    <div class="footer__bar">
                        <div class="footer__title">
                            FAQ
                        </div>
                        <ul class="footer__desc">
                            <li><a href="">Tài Khoản</a></li>
                            <li><a href="">Quản Lý Đơn Hàng</a></li>
                            <li><a href="">Đơn Hàng</a></li>
                            <li><a href="">Thanh Toán</a></li>
                        </ul>
                    </div>
                </div>


                <div class="footer__bottom">
                    Gr6+ © 2025, All Rights Reserved
                </div>

            </div>
        </div>
    </footer>
</body>

<script>
const togglePassword = document.getElementById('togglePassword');
const passwordInput = document.getElementById('password');

togglePassword.addEventListener('click', function() {
    const isPassword = passwordInput.type === 'password';
    passwordInput.type = isPassword ? 'text' : 'password';

    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
});
</script>

</html>