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
    <title>Home</title>
    <script src="script.js"></script>
</head>

<body>

    <header class="header">
        <div class="container">
            <div class="inner__wrap">
                <a class="header__title" href="index.php">Gr6+</a>
                <ul class="header__bar">
                    <li>
                        <a href="about.php">Giới Thiệu</a>
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

                <div class="search-wrapper" style="position: relative;">
                    <form action="product.php" method="GET" class="header__form" autocomplete="off">
                        <input type="text" placeholder="Tìm kiếm sản phẩm..." id="searchInput" name="search">
                        <button><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                    <div id="suggestions" class="suggestion-box"></div>
                </div>

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

    <!-- Section-1 -->
    <div class="section-1">
        <div class="container">
            <div class="inner__wrap">
                <div class="content">
                    <h2 class="title">
                        CHUYÊN THỜI TRANG PHONG CÁCH, HIỆN ĐẠI
                    </h2>
                    <p class="sub-title">
                        Chúng tôi chuyên cung cấp nhiều loại quần áo được chế tác tỉ mỉ, được thiết kế để làm nổi bật cá
                        tính của bạn và đáp ứng phong cách của bạn.
                    </p>
                    <a href="product.php" class="button">Xem ngay</a>
                    <div class="desc">
                        <div class="descBox">
                            <div class="descBox-number">200+</div>
                            <div class="descBox-title">Thương Hiệu</div>
                        </div>

                        <div class="descBox">
                            <div class="descBox-number">2,000+</div>
                            <div class="descBox-title">Sản Phẩm Chất Lượng</div>
                        </div>

                        <div class="descBox">
                            <div class="descBox-number">200+</div>
                            <div class="descBox-title">Khách Hàng</div>
                        </div>
                    </div>
                </div>


                <div class="images">
                    <img src="img/Banner.jpg" alt="">
                    <img src="img/Vector.svg" alt="" class="star">
                    <img src="img/Vector.svg" alt="" class="star-2">
                </div>
            </div>
        </div>
    </div>
    <!-- end section-1 -->

    <!-- tradeMark -->
    <div class="tradeMark">
        <div class="container">
            <div class="inner__wrap">
                <img src="img/Logo-1.png" alt="">
                <img src="imgLogo-2.png" alt="">
                <img src="imgLogo-3.png" alt="">
                <img src="imgLogo-4.png" alt="">
                <img src="img/Logo-5.png" alt="">
            </div>
        </div>
    </div>
    <!-- end tradeMark -->

    <!-- Section-2 -->
    <div class="section-2">
        <div class="container">
            <div class="inner__wrap">
                <h2 class="title">
                    THỜI TRANG MỚI
                </h2>

                <div class="inner-box">
                    <?php 
                    $sql ="SELECT * FROM product ORDER BY price DESC LIMIT 4";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="box-title">
                        <div class="images">
                            <img src="<?php echo $row['img_path'] ?>" alt="">
                        </div>

                        <div class="content">
                            <a href="<?php echo "detail.php?Product_id=".  $row['Product_id'] ?>">
                                <?php echo $row['Product_Name'] ?> </a>
                        </div>

                        <div class="star">
                            <div class="inner-star">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="dg">5/5</div>
                        </div>

                        <div class="price">
                            <?php $index = (string) $row['Price'];
                                $array = [];
                                $a = 0;
                                $count = 0;
                                for ($i = strlen($index) - 1; $i >= 0; $i--) {
                                    $array[$a] = $index[$i];
                                    $a++;
                                    $count++;
                                    if ($count % 3 == 0 && $i != 0) {
                                        $array[$a] = ".";
                                        $a++;
                                    }
                                }
                                for ($i = $a - 1; $i >= 0; $i--) {
                                    echo $array[$i];
                                }
                                echo "đ"; ?>
                        </div>
                    </div>
                    <?php } ?>

                </div>

                <div class="button">
                    <a href="product.php">Xem Tất Cả</a>
                </div>

                <div class="rounded">

                </div>
            </div>
        </div>
    </div>

    <div class="section-2">
        <div class="container">
            <div class="inner__wrap">
                <h2 class="title">
                    GIẢM GIÁ NHIỀU
                </h2>
                <div class="inner-box">
                    <?php 
                    $sql ="SELECT * FROM product ORDER BY price ASC LIMIT 4";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="box-title">
                        <div class="images">
                            <img src="<?php echo $row['img_path'] ?>" alt="">
                        </div>

                        <div class="content">
                            <a href="<?php echo "detail.php?Product_id=".  $row['Product_id'] ?>">
                                <?php echo $row['Product_Name'] ?> </a>
                        </div>

                        <div class="star">
                            <div class="inner-star">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="dg">5/5</div>
                        </div>

                        <div class="price">
                            <?php $index = (string) $row['Price'];
                                $array = [];
                                $a = 0;
                                $count = 0;
                                for ($i = strlen($index) - 1; $i >= 0; $i--) {
                                    $array[$a] = $index[$i];
                                    $a++;
                                    $count++;
                                    if ($count % 3 == 0 && $i != 0) {
                                        $array[$a] = ".";
                                        $a++;
                                    }
                                }
                                for ($i = $a - 1; $i >= 0; $i--) {
                                    echo $array[$i];
                                }
                                echo "đ"; ?>
                        </div>
                    </div>
                    <?php } ?>

                </div>

                <div class="button">
                    <a href="product.php">Xem Tất Cả</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end section-2 -->

    <!-- Section-3 -->
    <div class="section-3">
        <div class="container">
            <div class="inner__wrap">
                <div class="title">
                    DANH MỤC NỔI BẬT
                </div>

                <div class="box-title">
                    <div class="box-top">
                        <div class="images-1">
                            <img src="img/ilutranstion-1.jpg" alt="">
                            <div class="desc-1">
                                Đơn Giản
                            </div>
                        </div>
                        <div class="images-2">
                            <img src="img/ilutranstion-2.jpg" alt="">
                            <div class="desc-2">
                                Lịch Lãm
                            </div>
                        </div>
                    </div>
                    <div class="box-bottom">
                        <div class="images-1">
                            <img src="img/ilutranstion-3.jpg" alt="">
                            <div class="desc-1">
                                Dạ Hội
                            </div>
                        </div>
                        <div class="images-2">
                            <img src="img/ilutranstion-4.jpg" alt="">
                            <div class="desc-2">
                                GYM
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End section-3 -->

    <!-- Section-4 -->
    <div class="section-4">
        <div class="container">
            <div class="inner__wrap">
                <h2 class="title">
                    CẢM NHẬN CỦA KHÁCH HÀNG
                </h2>
                <div class="box-title">
                    <div class="box-desc">
                        <div class="inner-star">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <div class="content">
                            <div class="name">
                                Le Van A <i class="fa-solid fa-circle-check"></i>
                            </div>
                            <div class="sub-title">
                                "Tôi rất ngạc nhiên trước chất lượng và kiểu dáng của những bộ quần áo từ Gr6+. Từ
                                trang phục thường ngày đến trang phục thanh lịch, mọi món đồ tôi mua đều vượt quá sự
                                mong đợi của tôi."
                            </div>
                        </div>
                    </div>

                    <div class="box-desc">
                        <div class="inner-star">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <div class="content">
                            <div class="name">
                                Le Van A <i class="fa-solid fa-circle-check"></i>
                            </div>
                            <div class="sub-title">
                                "Việc tìm kiếm quần áo phù hợp với phong cách cá nhân của tôi từng là một thử thách cho
                                đến khi tôi khám phá ra Gr6+. Hàng loạt lựa chọn mà họ cung cấp thực sự đáng chú ý."
                            </div>
                        </div>
                    </div>

                    <div class="box-desc">
                        <div class="inner-star">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <div class="content">
                            <div class="name">
                                Le Van A <i class="fa-solid fa-circle-check"></i>
                            </div>
                            <div class="sub-title">
                                "Là một người luôn tìm kiếm những món đồ thời trang độc đáo, tôi rất vui khi tình cờ
                                biết đến Gr6+. Việc lựa chọn quần áo không chỉ đa dạng mà còn bắt kịp xu hướng mới
                                nhất." </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
    <!-- End Section-4 -->


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

    <script type="module" src="assets/js/script.js">
    s
    </script>

</body>

</html>