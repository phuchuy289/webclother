<?php
include "../connect.php";
session_start();
if ($_SESSION['login']['role'] == "User" ){
    header("Location: ../index.php");
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
                    <h1 class="title">Product List</h1>
                    <button style="background-color: black; padding: 10px; border-radius: 5px;">
                        <a href="index.php" style="color: white">Add product</a>
                    </button>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <td>Product Id</td>
                            <td>Category name</td>
                            <td>Product name</td>
                            <td>Stock</td>
                            <td>Price</td>
                            <td>Images</td>
                            <td>Update</td>
                            <td>Delete</td>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                            $sql = "SELECT * FROM product
                                    INNER JOIN Category ON product.category_id = category.category_id;";
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($result)){?>
                            <tr>
                                <td>
                                    <?php echo $row['Product_id']; ?>
                                </td>
                                <td>
                                    <select name="category_id" id="category_id_<?php echo $row['Product_id']; ?>" onchange="handleCategoryChange(<?php echo $row['Product_id']; ?>, this.value)">
                                        <?php 
                                        $sql = "SELECT * FROM category";
                                        $result1 = mysqli_query($conn, $sql);
                                            while ($row1 = mysqli_fetch_assoc($result1)) {
                                                if ($row['category_id'] == $row1['category_id']) {
                                                    echo '<option value="' . $row1['category_id'] . '" selected>' . $row1['category_name'] . '</option>';
                                                }
                                                else {
                                                    echo '<option value="' . $row1['category_id'] . '">' . $row1['category_name'] . '</option>';
                                                }
                                            }
                                            ?>
                                    </select>
                                </td>
                                <td>
                                    <input id="product_name_<?php echo $row['Product_id']; ?>" type="text" value="<?php echo $row['Product_Name']; ?>" class="Name" style="width: 100%" oninput="update_product_name(<?php echo $row['Product_id']; ?>)">
                                </td>
                                <td>
                                    <input id="stock_<?php echo $row['Product_id']; ?>" type="text" value="<?php echo $row['stock']; ?>" oninput="update_stock(<?php echo $row['Product_id']; ?>)"> 
                                </td>
                                <td>
                                    <input id="price_<?php echo $row['Product_id']; ?>" type="text" value="<?php echo $row['Price']; ?>" oninput="update_price(<?php echo $row['Product_id']; ?>)">
                                </td>
                                <td>
                                    <img src="<?php echo "../".$row['img_path']; ?>" alt="" style="width: 84px; height: 84px; aspect-ratio: 1 / 1; object-fit: cover;">
                                </td>
                                <td >
                                    <form action="update.php" method="POST">
                                        <input type="hidden" name="Product_id" value="<?php echo $row['Product_id']; ?>">
                                        <input name="category_id" id="category_name_update_<?php echo $row['Product_id']; ?>" type="hidden" value="<?php echo $row['category_id']; ?>">
                                        <input name="Product_Name" id="product_name_update_<?php echo $row['Product_id']; ?>" type="hidden" value="<?php echo $row['Product_Name']; ?>">
                                        <input name="stock" id="stock_update_<?php echo $row['Product_id']; ?>" type="hidden" value="<?php echo $row['stock']; ?>">
                                        <input name="Price" id="price_update_<?php echo $row['Product_id']; ?>" type="hidden" value="<?php echo $row['Price']; ?>">
                                        <input id="update" class="update" type="submit" value="Update">
                                    </form>
                                </td>
                                <td>
                                    <form action="delete.php" method="POST">
                                        <input type="hidden" name="product_id" value="<?php echo $row['Product_id']; ?>">
                                        <input type="hidden" name="img_path" value="<?php echo $row['img_path']; ?>">
                                        <input id="delete" class="delete" type="submit" value="Delete">
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    function handleCategoryChange(productId, value){
        console.log(value);
        console.log(productId);
        const input = document.getElementById(`category_name_update_${productId}`);
        input.value = value;
    }
    function update_product_name(productId) {
        const input = document.getElementById(`product_name_${productId}`);
        const hiddenInput = document.getElementById(`product_name_update_${productId}`);
        hiddenInput.value = input.value;
 
}
function update_stock(productId) {
        const input = document.getElementById(`stock_${productId}`);
        const hiddenInput = document.getElementById(`stock_update_${productId}`);
        hiddenInput.value = input.value;
 
}
function update_price(productId) {
        const input = document.getElementById(`price_${productId}`);
        const hiddenInput = document.getElementById(`price_update_${productId}`);
        hiddenInput.value = input.value;
 
}

</script>
