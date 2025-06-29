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
    <title>Contact</title>
    <script src="script.js"></script>
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
                        <a href="product.php" target="_blank">Sản Phẩm</a>
                    </li>

                    <li>
                        <a href="/">Bài Viết</a>
                    </li>

                    <li>
                        <a href="contact.php">Liên Hệ</a>
                    </li>
                </ul>

                <form action="" class="header__form">
                    <input type="text" placeholder="Tìm kiếm sản phẩm...">
                    <button><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>

                <div class="header__cart">
                    <a href="<?php if(isset($_SESSION['login']['id'])){
                        echo "cart.php";
                    }else{
                        echo "login.php?web=cart.php";
                    } ?>"><i class="fa-solid fa-cart-shopping"></i></a>
                    <a href="<?php if(isset($_SESSION['login']['id'])){
                        echo "user.php";
                    }else{
                        echo "login.php";
                    } ?>"><i class="fa-regular fa-user"></i></a>
                </div>

            </div>
        </div>
    </header>

    <div class="contact">
        <div class="container">
            <div class="inner-wrap" style="display: flex;">
                <div class="infor" style="width: 50%">
                    <h2 style="font-size: 35px">Thông tin liên hệ của chúng tôi</h2>
                    <div class="infor-item" style="margin-bottom: 20px;">
                        <i class="fa-regular fa-envelope" style="margin-right: 5px;"></i>
                        <span style="font-size: 24px;"> <strong>Email:</strong> gr6shop@gmail.com</span>
                    </div>

                    <div class="infor-item" style="margin-bottom: 20px;">
                        <i class="fa-solid fa-phone" style="margin-right: 5px;"></i>
                        <span style="font-size: 24px;"> <strong>SDT:</strong> 012345678</span>
                    </div>

                    <div class="infor-item" style="margin-bottom: 20px;">
                        <i class="fa-solid fa-location-dot" style="margin-right: 5px;"></i>
                        <span style="font-size: 24px;"> <strong>Địa chỉ:</strong> 123, Tân Hưng Thuận, Q12</span>
                    </div>
                </div>


                <div class="image" style="width: 50%; height: 50%; border-radius: 10px; overflow: hidden;">
                    <img src="img/contact2.jpg" alt="" style="width: 100%; height: 400px; object-fit: contain;">
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

</html>