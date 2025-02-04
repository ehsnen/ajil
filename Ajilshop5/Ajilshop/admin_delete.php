<?php
    // دریافت شناسه محصول از پارامتر GET
    $product_id = $_GET['id'];

    // اتصال به پایگاه داده
    require_once "./functions/database_functions.php";
    $conn = db_connect();

    // حذف محصول از جدول products
    $query = "DELETE FROM products WHERE id = '$product_id'";
    $result = mysqli_query($conn, $query);
    if(!$result){
        echo "مشکلی در حذف محصول رخ داده است: " . mysqli_error($conn);
        exit;
    }

    // هدایت به صفحه مدیریت محصولات
    header("Location: admin_product.php");
    exit;
?>
