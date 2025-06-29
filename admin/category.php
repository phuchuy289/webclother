<?php
include "../connect.php";
session_start();
if ($_SESSION['login']['role'] == "User" ){
    header("Location: ../index.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $submit = mysqli_real_escape_string($conn, $_POST['submit']);
    echo $submit;
    if ($submit == "Add category"){
        $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);
      
        if($category_name != ''){
            $sql = "INSERT INTO category(category_name) VALUES ('$category_name')";
            if(mysqli_query($conn, $sql)){
                header('location'.'category.php');
            }
            else{
                header('location'.'category.php?$e=null');
            }
        }
    }
    if ($submit == "Delete"){
        $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);
        $sql = "DELETE FROM category WHERE category_id = '$category_id'";
            if(mysqli_query($conn, $sql)){
                header('location'.'category1.php');
            }
            else{
                echo "false";
                
            }
    }
    if ($submit == "Update"){
        $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);
        $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);
        $sql = "UPDATE category
            SET category_name='$category_name'
            WHERE category_id = '$category_id'";
            if(mysqli_query($conn, $sql)){
                header('location'.'category.php');
            }
            else{
                header('location'.'category.php?$e=null');
            }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_admin.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <title>Admin home</title>
</head>
<body>
    <div class="admin">
        <div class="inner-wrap">
            <div class="admin-left">
                <h1 class="title">AdminDek</h1>

                <div class="infor">
                    <i class="fa-solid fa-house-lock"></i> Dashboards
                </div>

                <div class="category">
                    <i class="fa-solid fa-angle-right"></i>
                    <a href="category.php">
                        Category
                    </a>
                </div>

                <div class="category">
                    <i class="fa-solid fa-angle-right"></i>
                    <a href="productList.php">
                        Product list
                    </a>
                </div>

                <div class="category">
                    <i class="fa-solid fa-angle-right"></i>
                    <a href="index.php">
                        Add product
                    </a>
                </div>

                
                <div class="category last">
                    <i class="fa-solid fa-angle-right"></i>
                    <a href="../logout.php">
                        Logout
                    </a>
                </div>

            </div>
            <div class="admin-right">
                <div class="main-title">
                    <h1 class="title">Category</h1>
                    <form class="addForm" action="" method="POST">
                        <label for="categoryName">Category Name:</label>
                        <input type="text" name="category_name" id="categoryName" placeholder="enter category name..." class="text">
                        <input type="submit" name="submit" value="Add category" class="button">
                    </form>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <td>Id</td>
                            <td>Category</td>
                            <td>Update</td>
                            <td>Delete</td>
                        </tr>
                    </thead>
                    <tbody>
            <?php 
            $sql = "SELECT * FROM category;";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td>
                    <p><?php echo $row['category_id']; ?></p>
                </td>
                <td>
                    <input id="category_name_<?php echo $row['category_id']; ?>" type="text" value="<?php echo $row['category_name']; ?>" oninput="updateHiddenInput(<?php echo $row['category_id']; ?>)"> 
                </td>
                <td>
                    <form method="POST" action="">
                        <input name="category_id" type="hidden" value="<?php echo $row['category_id']; ?>">
                        <input name="category_name" id="category_name_update_<?php echo $row['category_id']; ?>" type="hidden" value="<?php echo $row['category_name']; ?>">    
                        <input id="update" class="update"  name="submit" type="submit" value="Update">
                    </form>
                </td>
                <td>
                    <form method="POST" action="">
                        <input name="category_id" type="hidden" value="<?php echo $row['category_id']; ?>">
                        <input id="delete" class="delete" name="submit" type="submit" value="Delete">
                    </form>
                </td>
            </tr>
        <?php } ?>
</tbody>
<script>
function updateHiddenInput(categoryId) {
    const input = document.getElementById(`category_name_${categoryId}`);  // Dùng backticks để chèn biến
    const hiddenInput = document.getElementById(`category_name_update_${categoryId}`);
    hiddenInput.value = input.value;
    // setInterval(updateHiddenInput(categoryId), 100);
}
</script>
