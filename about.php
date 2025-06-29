<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Giới thiệu</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="about.css" />
    <script src="script.js"></script>
</head>

<body style="background-color: #F2F0F1;">
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
    <div class="about-us">
        <h1>Về Chúng Tôi</h1>
        <p>
            Chào mừng bạn đến với Thời Trang Mới - nơi chúng tôi mang đến những
            thiết kế tinh tế và thời thượng nhất. Sự hài lòng của bạn là động lực để
            chúng tôi không ngừng sáng tạo.
        </p>
        <div class="cards">
            <div class="card">
                <h2>Đội ngũ sáng tạo</h2>
                <p>
                    Chúng tôi tự hào với đội ngũ thiết kế chuyên nghiệp và đam mê, mang
                    lại những bộ sưu tập độc đáo, hợp xu hướng.
                </p>
            </div>
            <div class="card">
                <h2>Sản phẩm và dịch vụ</h2>
                <p>
                    Chúng tôi cung cấp các sản phẩm thời trang cao cấp, từ quần áo đến
                    phụ kiện. Đặc biệt, dịch vụ tư vấn phong cách giúp bạn tỏa sáng.
                </p>
            </div>
            <div class="card">
                <h2>Thành tựu</h2>
                <p>
                    Được công nhận là thương hiệu thời trang được yêu thích, với hàng
                    ngàn khách hàng hài lòng trên cả nước.
                </p>
            </div>
        </div>
    </div>
</body>

</html>