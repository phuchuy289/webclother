<?php 
include "connect.php";
session_start();
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';

if ($searchTerm !== '') {
    $sql = "SELECT * FROM product WHERE Product_Name LIKE '%$searchTerm%'";
} else {
    $sql = "SELECT * FROM product";
}
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <title>Sản phẩm</title>
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
                    <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
                    <a href="<?php if(isset($_SESSION['login']['id'])){
                        echo "user.php";
                    }else{
                        echo "login.php?web=product.php";
                    } ?>"><i class="fa-regular fa-user"></i></a>
                </div>

            </div>
        </div>
    </header>

    <div class="product-Layout">
        <div class="container">
            <div class="inner__wrap">
                <div class="fillter">
                    <div class="fillter-title">
                        <img src="../images/Filter.svg" alt="" srcset="">
                        <div class="title">Bộ lọc</div>
                    </div>

                    <div class="fillter-top">
                        <div class="title">Thể loại</div>
                        <div class="inner-check">
                            <form action="" method="post">
                                <?php
                                $sql = "SELECT * FROM category ;";
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($result)){?>
                                <label>
                                    <input type="checkbox" name="items[]" value="<?php echo $row['category_id']; ?> ">
                                    <?php echo $row['category_name'] ?>
                                </label><br>
                                <?php } ?>
                                <input type="submit" value="chọn" style="background-color: black; color:white ">
                            </form>
                        </div>
                    </div>
                </div>

                <div class="product-list">
                    <div class="title">Sản phẩm</div>
                    <div class="list">
                        <?php if ($_SERVER["REQUEST_METHOD"] === "POST") {
                        if (!empty($_POST['items'])) {
                            $selectedItems = $_POST['items'];
                            $selectedItemsList = implode(',', $selectedItems);
                            $sql = "SELECT * FROM product WHERE category_id IN ($selectedItemsList)";
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="box-title">
                            <div class="images"><img src="<?php echo $row['img_path']; ?>" alt=""></div>
                            <div class="content"><a
                                    href="<?php echo "detail.php?Product_id=".  $row['Product_id'] ?>"><?php echo $row['Product_Name']; ?></a>
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
                                <p id="price">
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
                                        echo "đ"; ?></p>
                            </div>
                        </div>

                        <?php } ?>
                        <?php } 
                        else{
                            $sql = "SELECT * FROM product WHERE category_id ";
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="box-title">
                            <div class="images"><img src="<?php echo $row['img_path']; ?>" alt=""></div>
                            <div class="content"><a
                                    href="<?php echo "detail.php?Product_id=".  $row['Product_id'] ?>"><?php echo $row['Product_Name']; ?></a>
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
                                <p id="price">
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
                                        echo "đ"; ?></p>
                            </div>
                        </div>

                        <?php } ?>
                        <?php } ?>
                        <?php }
                    else{
                        if(isset($_GET['category_id'])){
                            $category_id = $_GET['category_id'];
                            $sql = "SELECT * FROM product WHERE category_id = '$category_id'";
                        }
                        else{
                            $sql = "SELECT * FROM product";
                        }
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="box-title">
                            <div class="images"><img src="<?php echo $row['img_path']; ?>" alt=""></div>
                            <div class="content"><a
                                    href="<?php echo "detail.php?Product_id=".  $row['Product_id'] ?>"><?php echo $row['Product_Name']; ?></a>
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
                                <p id="price">
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
                                        echo "đ"; ?></p>
                            </div>
                        </div>

                        <?php } ?>
                        <?php } ?>
                    </div>

                    <div class="pagination" id="pagination">
                        <div class="pagination-arrow pagination-all" id="pagination-item"><i
                                class="fa-solid fa-arrow-left"></i></div>
                        <div class="pagination-number pagination-all pagination-bg" id="1">1</div>
                        <div class="pagination-number pagination-all" id="2">2</div>
                        <div class="pagination-number pagination-all" id="3">3</div>
                        <div class="pagination-number pagination-all" id="4">...</div>
                        <div class="pagination-number pagination-all" id="5">20</div>
                        <div class="pagination-arrow pagination-all" id="arrow-right"><i
                                class="fa-solid fa-arrow-right"></i></div>
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
                            <li><a href="<?php if(isset($_SESSION['login']['id'])){
                        echo "user.php";
                    }else{
                        echo "login.php?web=product.php";
                    } ?>">Tài Khoản</a></li>
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

    <script src="assets/js/script.js"></script>
</body>

</html>