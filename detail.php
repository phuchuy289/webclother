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
    <title>Thông tin sản phẩm</title>
    <script src="script.js"></script>
</head>
<?php
    
   
    $Product_id = $loai = $_GET['Product_id'];
    if(isset($Product_id)){
        $sql = "SELECT * FROM product where Product_id = '$Product_id' ";
        $result = mysqli_query($conn, $sql); 
        $row = mysqli_fetch_assoc($result);
    }
?>

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
                        <a href="/">Liên Hệ</a>
                    </li>
                </ul>

                <form action="" class="header__form">
                    <input type="text" placeholder="Tìm kiếm sản phẩm...">
                    <button><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>

                <div class="header__cart">
                    <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
                    <a href="<?php if(isset($_SESSION['login']['id'])){
                        echo "user.php";
                    }else{
                        echo "login.php?web=detail.php?Product_id=".$row['Product_id'];
                    } ?>"><i class="fa-regular fa-user"></i></a>
                </div>

            </div>
        </div>
    </header>


    <div class="product-detail">
        <div class="container">
            <div class="inner__wrap">
                <div class="images">
                    <img src="<?php echo $row['img_path'] ?>">
                </div>
                <div class="content">
                    <div class="breadcrumb">
                        <a href="index.php">Trang chủ</a>
                        <i class="fa-solid fa-angle-right"></i>
                        <a href="product.php">Sản Phẩm</a>
                        <i class="fa-solid fa-angle-right"></i>
                        <?php
                        $category_id = $row['category_id'];
                        $sql = "SELECT * FROM category WHERE category_id = $category_id";
                        $result = mysqli_query($conn, $sql);
                        $row1 = mysqli_fetch_assoc($result); ?>
                        <a
                            href="product.php?category_id=<?php echo $row1['category_id']; ?>"><?php echo $row1['category_name']; ?></a>
                    </div>
                    <div class="box-title">
                        <div class="title"><?php echo $row['Product_Name'] ?></div>
                        <div class="price"><?php $index = (string) $row['Price'];
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
                                echo "đ"; ?></div>
                    </div>

                    <div class="inner-button">
                        <div class="bold">Liên hệ</div>
                        <form method="POST" action="add_cart.php" class="submit">
                            <input type="hidden" name="Product_id" value="<?php echo $row['Product_id']; ?>">
                            <input name="session_web123" id="session_web123" type="hidden"
                                value="detail.php?Product_id=<?php echo $row['Product_id']; ?>">

                            <i class="fa-regular fa-heart"></i>
                            <input type="submit" value="Thêm vào giỏ hàng">
                        </form>
                    </div>

                    <div class="discount-code">
                        <p>Mã giảm giá:</p>
                        <p class="discount color-bg">Giảm 5k</p>
                        <p class="discount">Giảm 10k</p>
                        <p class="discount">Giảm 20k</p>
                    </div>
                    <div class="shipping">
                        <p class="">Vận chuyển:</p>
                        <p class=""><i class="fa-solid fa-truck-moving"></i> Miễn phí vận chuyển.</p>
                    </div>
                    <div class="inner-size">
                        <p>Size:</p>
                        <p class="size color-size">S</p>
                        <p class="size">M</p>
                        <p class="size">L</p>
                    </div>
                    <div class="shared">
                        <p><i class="fa-solid fa-share-nodes"></i> Chia sẻ:</p>
                        <a href="#" class="icon"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#" class="icon"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="icon"><i class="fa-brands fa-twitch"></i></a>
                        <a href="#" class="icon"><i class="fa-brands fa-square-x-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="overlay" id="overlay">
        <div class="overlay-box">
            <div class="check">Thêm thành công <i class="fa-regular fa-circle-check"></i></div>
            <div class="inner-button">
                <button>Đóng</button>
            </div>
        </div>
    </div>

    <div class="section-2 section-2-detail">
        <div class="container">
            <div class="inner__wrap">
                <h2 class="title">
                    Các loại thời trang khác
                </h2>
                <div class="inner-box">
                    <div class="box-title">
                        <div class="images">
                            <img src="../images/clother-1.jpg" alt="">
                        </div>

                        <div class="content">
                            <a href="/">Áp Thun Nam Đơn Giản</a>
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
                            120.000đ
                        </div>
                    </div>

                    <div class="box-title">
                        <div class="images">
                            <img src="../images/clother-2.jpg" alt="">
                        </div>

                        <div class="content">
                            <a href="/">Quần Jean Nam Phong Cách</a>
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
                            480.000đ
                        </div>
                    </div>

                    <div class="box-title">
                        <div class="images">
                            <img src="../images/clother-3.jpg" alt="">
                        </div>

                        <div class="content">
                            <a href="/">Áo Sơ Mi Caro</a>
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
                            220.000đ
                        </div>
                    </div>

                    <div class="box-title">
                        <div class="images">
                            <img src="../images/clother-4.jpg" alt="">
                        </div>

                        <div class="content">
                            <a href="/">Áo Thun Nam Sọc Cam</a>
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
                            126.000đ
                        </div>
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
                            28.Shop
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

    <script src="script.js"></script>

</body>

</html>
<script>
document.addEventListener("DOMContentLoaded", () => {
    const urlParams = new URLSearchParams(window.location.search);
    const statusParam = urlParams.get('status');

    if (statusParam === "true") {
        const overlay = document.querySelector(".overlay");

        if (overlay) {

            urlParams.delete('status');
            const newUrl = window.location.origin + window.location.pathname +
                (urlParams.toString() ? '?' + urlParams.toString() : '');
            window.history.replaceState(null, '', newUrl);


            overlay.classList.add("show-overlay");
            overlay.addEventListener("click", () => {
                overlay.classList.remove("show-overlay");
            });
        }
    }
});
</script>