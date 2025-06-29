<?php
include "connect.php";
session_start();
if (!isset($_SESSION['login']['id'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sesession_web = mysqli_real_escape_string($conn, $_POST['session_web123']);
    echo $sesession_web;
    header('Location: login.php?web=' . $sesession_web); 
    exit;
}}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_id = $_SESSION['login']['id'];
        $Product_id = mysqli_real_escape_string($conn, $_POST['Product_id']);
        $session_web123 = mysqli_real_escape_string($conn, $_POST['session_web123']);
        $sql = "SELECT quantity FROM cart WHERE user_id = '$user_id' AND Product_id = '$Product_id';";
        $result = mysqli_query($conn, $sql);
        

        if($result && mysqli_num_rows($result) > 0){
            $result =  mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result); 
            
            $quantity = $row['quantity'] +1;
           
            $sql = "UPDATE cart SET quantity = $quantity,added_at = NOW()
                    WHERE user_id = $user_id AND Product_id = $Product_id ";
            if(mysqli_query($conn, $sql)){
                header('location: ' . $session_web123. "&status=true");
            }else{
                echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
        else{
            $sql = "INSERT INTO cart (user_id, Product_id,quantity,added_at)
                VALUES ('$user_id', '$Product_id',1,NOW())";
            if(mysqli_query($conn, $sql)){
                header('location: ' . $session_web123);
            }else{
                echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
            }
            
        }
    }
// }
?>