<?php
include "connect.php";

if (isset($_GET['query'])) {
    $keyword = mysqli_real_escape_string($conn, $_GET['query']);

    $sql = "SELECT Product_Name FROM product WHERE Product_Name LIKE '%$keyword%' LIMIT 5";
    $result = mysqli_query($conn, $sql);

    $suggestions = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $suggestions[] = $row['Product_Name'];
    }

    echo json_encode($suggestions);
}
?>
