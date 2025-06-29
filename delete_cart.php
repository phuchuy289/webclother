<?php
include "connect.php";
    $Product_id = $_GET['Product_id'];
    $cart_id= $_GET['cart_id'];
    $sql = "DELETE FROM cart WHERE Product_id = '$Product_id' AND cart_id='$cart_id'";
        if (mysqli_query($conn, $sql)) {
            header('Location: cart.php');
        
        }
        else {
            echo "Lỗi khi xóa bản ghi từ cơ sở dữ liệu: " . mysqli_error($conn);
        }
?>
