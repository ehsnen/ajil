<?php
    // بررسی اینکه آیا تغییرات ذخیره شده‌اند
    if(!isset($_POST['save_change'])){
        echo "مشکلی رخ داده است";
        exit;
    }

    $id = trim($_POST['id']);
    $name = trim($_POST['name']);
    $category = trim($_POST['category']);
    $description = trim($_POST['description']);
    $price = floatval(trim($_POST['price']));

    // مدیریت آپلود تصویر
    if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
        $image = $_FILES['image']['name'];
        $directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
        $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "bootstrap/images/";
        $uploadDirectory .= $image;
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory);
    }

    require_once("./functions/database_functions.php");
    $conn = db_connect();

    // به‌روزرسانی اطلاعات محصول
    $query = "UPDATE products SET  
    name = '$name', 
    category = '$category', 
    description = '$description', 
    price = '$price'";
    if(isset($image)){
        $query .= ", image='$image' WHERE id = '$id'";
    } else {
        $query .= " WHERE id = '$id'";
    }
    $result = mysqli_query($conn, $query);
    if(!$result){
        echo "مشکلی در بروزرسانی رخ داده است " . mysqli_error($conn);
        exit;
    } else {
        header("Location: admin_product.php");
    }
?>
