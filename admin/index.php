<?php
include "../connect.php";
session_start();
if ($_SESSION['login']['role'] == "User" ){
    header("Location: ../index.php");
}
$target_dir = "C:/xampp/htdocs/web_clother/img/";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            if ($imageFileType == "jpg" || $imageFileType == "jpeg" || $imageFileType == "png" || $imageFileType == "gif") {
                file_exists($target_file) ;
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        $category_id = $_POST['category_id'];
                        $Product_name = mysqli_real_escape_string($conn, $_POST['Product_name']);
                        $stock = mysqli_real_escape_string($conn, $_POST['stock']);
                        $Price = mysqli_real_escape_string($conn, $_POST['Price']);
                        $target_file = 'img/' . htmlspecialchars(basename($_FILES["image"]["name"]));
                        
                        $sql = "INSERT INTO product (category_id, Product_name, stock, Price, img_path) 
                                VALUES ('$category_id', '$Product_name','$stock', '$Price', '$target_file')";
                        if (mysqli_query($conn, $sql)) {
                            echo "Dữ liệu đã được thêm thành công!";
                        }
                        else{
                            echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
                        }
                    }
                    else{
                        echo "Lỗi khi tải lên hình ảnh.";
                    }
            }
            else {
                echo "Lỗi: Chỉ chấp nhận các tệp JPG, JPEG, PNG, GIF.";
            }
        }
        else{
            echo "Lỗi: Tệp không phải là hình ảnh.";
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
                    <h1 class="title">Add Product</h1>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Category</td>
                            <td>Product name</td>
                            <td>Stock</td>
                            <td>Price</td>
                            <td>Images</td>
                            <td>Action</td>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>
                                <select name="category_id" >
                                <?php 
                                    $sql = "SELECT * FROM category";
                                    $result = mysqli_query($conn, $sql);
                                    while($row = mysqli_fetch_assoc($result)){?>
                                        <option value="<?php echo $row['category_id']; ?>" ><?php echo $row['category_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="Name" name="Product_name" style="width: 100%"> 
                            </td>
                            <td>
                                <input type="text" name="stock"> 
                            </td>
                            <td>
                                <input type="text" name="Price">
                            </td>
                
                            <td>
                                <label for="images" style="cursor: pointer; font-style: italic; text-decoration: underline;">Add picture</label>
                                <input id="images" type="file" name="image" accept="image/*" style="display: none;">
                            </td>
                            
                            <td> <input id="update" class="update" type="submit" value="Add"></td>
                        </tr>
                    </tbody>

                </table>
                </form>
            </div>
        </div>
    </div>
</body>
</html>