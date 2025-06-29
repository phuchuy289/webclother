<?php
include "connect.php";
session_start();
if(!isset($_SESSION['login']['id'])){
    header("Location: login.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password1 = mysqli_real_escape_string($conn, $_POST['password1']);
    if($password != $password1){
        header("Location: user.php?status=false");
    }
    else if ($password == $password1){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $Address = mysqli_real_escape_string($conn, $_POST['Address']);
        $user_id = $_SESSION['login']['id'];
        $sql = "SELECT * FROM account where user_id = '$user_id' ";
        $result = mysqli_query($conn, $sql); 
        $row = mysqli_fetch_assoc($result);
        
        if($name == ''){
            $name =  $row['UserName'];
        }
        if($phone == ''){
            $phone =  $row['Phone'];
        }
        if($Address == ''){
            $Address =  $row['Address'];
        }
        if($password == ''){
            $password =  $row['Password'];
        }
      
        $sql = "UPDATE account 
            SET UserName='$name', Phone='$phone', Address='$Address', Password='$password' 
            WHERE user_id = '$user_id'";
        $result = mysqli_query($conn, $sql);
        if($result){

            header("Location: user.php?status=true");
        }
    }
    
   
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <title>Người dùng</title>
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
                        <a href="/">Liên Hệ</a>
                    </li>
                </ul>

                <form action="" class="header__form" autocomplete="off">
                    <input type="text" placeholder="Tìm kiếm sản phẩm..." id="searchInput">
                    <div id="suggestions" class="suggestion-box"></div>
                    <button><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
                <div class="header__cart">
                    <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
                    <a href="user.php"><i class="fa-regular fa-user"></i></a>
                </div>

            </div>
        </div>
    </header>
    <?php
        $user_id = $_SESSION['login']['id'];
        if(isset($user_id)){
            $sql = "SELECT * FROM account where user_id = '$user_id' ";
            $result = mysqli_query($conn, $sql); 
            $row = mysqli_fetch_assoc($result);
        }
    ?>
    <div class="user">
        <div class="container">
            <div class="inner__wrap">
                <div class="box-right" width="400">
                    <div class="user-infor">
                        <div class="images">
                            <img src="../images/user.png" alt="">
                        </div>
                        <div class="content">
                            <div class="title font">
                                <h2 style="display:inline;"> <?php echo $row['UserName']; ?> </h2>
                            </div>
                            <div class="edit font"><i class="fa-solid fa-pencil"></i>Sửa hồ sơ</div>
                        </div>
                    </div>

                    <div class="inner-infor">
                        <div class="title" id="account"><i class="fa-regular fa-user"></i>
                            <h2 style="display:inline;"> Tài khoản của tôi</h2>
                        </div>
                        <div class="infor-item">
                            <a href="logout.php" class="" id="item">Đăng xuất</a>
                            <a href="cart.php">Giỏ hàng</a>
                            <a href="">Ngân hàng</a>
                        </div>

                        <?php if($_SESSION['login']['role'] == "Admin"){
                            echo "<div class=".'"title"'. "id=".'"account"'." ><i class=".'"fa-regular fa-user"'." style=".'"display:inline;"'."></i><h2 style=".'"display:inline;"'."> admin</h2></div>";
                            echo "<div class=".'"infor-item"'.">";
                            echo "<a href=".'"admin/"'.">Quản lý trang web</a>";
                            echo "</div>";
                        }?>

                    </div>
                </div>

                <div class="box-left">
                    <div class="title">
                        <h2>Hồ sơ của tôi</h2>
                        <span>Quản lý thông tin hồ sơ để bảo mật tài khoản</span>
                    </div>

                    <div class="content profile">
                        <div class="box-left-edit">
                            <div class="title">Tên đăng nhập:
                                <span><?php echo $row['UserName'] ?></span>
                                <span class="title-edit" id="nameUser">Thay đổi <i
                                        class="fa-solid fa-pen-to-square"></i></span>
                            </div>
                            <div class="name name-login">
                                <label>Nhập tên đăng nhập mới: </label>
                                <input type="text" id="new_name" placeholder="Nhập tên mới..." oninput="update_name()">
                            </div>

                            <div class="title">
                                Số điện thoại:
                                <span><?php echo $row['Phone'] ?></span>
                                <span class="title-edit" id="phoneUser">Thay đổi <i
                                        class="fa-solid fa-pen-to-square"></i></span>
                            </div>
                            <div class="name phone-login">
                                <label>Nhập số điện thoại mới: </label>

                                <input type="tel" id="new_phone" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"
                                    placeholder="Nhập số điện thoại mới..." oninput="update_phone()">
                            </div>

                            <div class="title">
                                Password:
                                <span>**********</span>
                                <span class="title-edit" id="passwordUser">Thay đổi <i
                                        class="fa-solid fa-pen-to-square"></i></span>
                            </div>
                            <div class="name password-login">
                                <label>Nhập password mới: </label>
                                <input id="new_password" type="password" placeholder="Nhập password mới..."
                                    oninput="update_password()">
                            </div>

                            <div class="name password-again">
                                <label>Nhập lại password: </label>
                                <input id="new_password1" type="password" placeholder="Nhập lại password mới..."
                                    oninput="update_password1()">
                            </div>

                            <div class="title">
                                Địa chỉ:
                                <!-- Địa chỉ ban đầu sẽ chưa có -->
                                <span><?php if ($row['Address'] == " "){
                                    echo "chưa có";
                                    }
                                    else{
                                        echo $row['Address']; }
                                    ?></span>
                                <span class="title-edit" id="addressUser">Thay đổi <i
                                        class="fa-solid fa-pen-to-square"></i></span>
                            </div>
                            <div class="name address-login">
                                <label>Thay đổi địa chỉ: </label>
                                <input id="new_address" type="text" placeholder="Nhập lại địa chỉ mới..."
                                    oninput="update_address()">
                            </div>


                            <div class="inner-button">
                                <form action="" method="post">
                                    <input type="hidden" id="name" name="name">
                                    <input type="hidden" id="phone" name="phone">
                                    <input type="hidden" id="password" name="password">
                                    <input type="hidden" id="password1" name="password1">
                                    <input type="hidden" id="Address" name="Address">
                                    <input type="submit" value="Lưu thông tin">
                                </form>

                            </div>
                        </div>

                        <div class="box-right-edit">
                            <div class="images">
                                <img src="../images/user.png" alt="">
                            </div>

                            <div class="inner-button">
                                <label for="inputTag">
                                    <input type="file" id="inputTag">
                                    <input type="submit" value="Chọn một ảnh" class="button-item">
                                </label>
                            </div>
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

    <script type="module" src="script.js"></script>
</body>

</html>
<script>
function update_phone() {
    const phone = document.getElementById('new_phone');
    const hiddenphone = document.getElementById('phone');
    hiddenphone.value = phone.value;

}

function update_name() {
    const name = document.getElementById('new_name');
    const hiddenname = document.getElementById('name');
    hiddenname.value = name.value;

}

function update_password() {
    const password = document.getElementById('new_password');
    const hiddenpassword = document.getElementById('password');
    hiddenpassword.value = password.value;
}

function update_password1() {
    const password1 = document.getElementById('new_password1');
    const hiddenpassword1 = document.getElementById('password1');
    hiddenpassword1.value = password1.value;
}

function update_address() {
    const Address = document.getElementById('new_address');
    const hiddenAddress = document.getElementById('Address');
    hiddenAddress.value = Address.value;
}
</script>