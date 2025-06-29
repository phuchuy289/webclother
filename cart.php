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
    <title>Giỏ hàng</title>
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
                        <a href="/">Liên Hệ</a>
                    </li>
                </ul>

                <form action="" class="header__form">
                    <input type="text" placeholder="Tìm kiếm sản phẩm...">
                    <button><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>

                <div class="header__cart">
                    <a href="cart1.php"><i class="fa-solid fa-cart-shopping"></i></a>
                    <a href="user.php"><i class="fa-regular fa-user"></i></a>
                </div>

            </div>
        </div>
    </header>



    <div class="cart">
        <div class="container">
            <div class="inner__wrap">
                <div class="name">Giỏ hàng của bạn</div>
                <?php
                    $user_id = mysqli_real_escape_string($conn, $_SESSION['login']['id']);
                    $sql = "SELECT cart.cart_id, cart.user_id, product.Product_id ,product.Product_Name, product.Price, product.img_path, cart.quantity, cart.added_at
                                FROM cart
                                INNER JOIN product ON cart.Product_id = product.Product_id
                                WHERE cart.user_id = '$user_id';";
                    $result = mysqli_query($conn, $sql);    
                    while($row = mysqli_fetch_assoc($result)) {?>
                <div class="cart-box">
                    <div class="images">
                        <img width="100" src="<?php echo $row['img_path'] ?>">
                    </div>
                    <div class="content">
                        <div class="title bold"><?php echo $row['Product_Name'] ?>.</div>
                        <div class="sub-title"><span>Size:</span> M</div>
                    </div>

                    <input style="width: 40px;" type="number" value="<?php echo $row['quantity']; ?>"
                        onchange="updateQuantity(<?php echo $row['cart_id']; ?>,<?php echo $row['Product_id']; ?>, this.value)">


                    <div class="price bold">
                        <?php $index = (string) ($row['Price'] * $row['quantity']) ;
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
                                echo "đ";?>
                    </div>

                    <div class="buy bold">
                        Mua ngay
                    </div>

                    <div class="remove">
                        <a
                            href="delete_cart.php?cart_id=<?php echo $row["cart_id"]; ?>&Product_id=<?php echo $row["Product_id"]; ?>"><i
                                class="fa-regular fa-trash-can"></i></a>
                    </div>

                </div><?php } ?>
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

    <script type="module" src="script.js">
    s
    </script>
</body>

</html>
<script>
function updateQuantity(cart_id, productId, quantity) {

    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "quantity.php", true); // Path to the PHP file for handling

    // Set the content type for the request
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Handle the server response
    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log("Quantity updated successfully:", xhr.responseText);
        } else {
            console.error("Error updating quantity:", xhr.statusText);
        }
    };

    // Send the request with the necessary data, including cart_id
    xhr.send("Product_id=" + encodeURIComponent(productId) + "&quantity=" + encodeURIComponent(quantity) + "&cart_id=" +
        encodeURIComponent(cart_id));
    setTimeout(function() {
        location.reload();
    }, 100);

}
</script>