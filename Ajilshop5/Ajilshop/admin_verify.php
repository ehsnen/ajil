<?php
    session_start();

    if(!isset($_POST['submit'])){
        echo "مشکلی پیش آمده است! لطفا مجدد تلاش کنید";
        exit;
    }

    require_once "./functions/database_functions.php";
    $conn = db_connect();

    // دریافت داده‌ها و حذف فاصله‌ها
    $name = trim($_POST['name']);
    $pass = trim($_POST['pass']);

    if($name == "" || $pass == ""){
        echo "نام کاربری یا رمز عبور خالی است! در پر کردن اطلاعات، دقت کنید";
        exit;
    }

    
    $name = mysqli_real_escape_string($conn, $name);

    // دریافت اطلاعات ادمین از دیتابیس
    $query = "SELECT name, pass FROM admin WHERE name = '$name' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if(!$result){
        echo "خطایی در بازیابی داده‌ها رخ داده است: " . mysqli_error($conn);
        exit;
    }

    if(mysqli_num_rows($result) == 0){
        echo "نام کاربری یا رمز عبور اشتباه است! لطفا مجدد تلاش کنید";
        exit;
    }

    $row = mysqli_fetch_assoc($result);

    // Hash the entered password using SHA-1
    $hashedPassword = sha1($pass);

    // Debugging: Print the entered password and the hashed password from the database
    // echo "Entered Password: " . $pass . "<br>";
    // echo "Hashed Password from DB: " . $row['pass'] . "<br>";
    // echo "Hashed Entered Password: " . $hashedPassword . "<br>";


    // بررسی رمز عبور با استفاده از password_verify
    if($hashedPassword === $row['pass']){
        $_SESSION['admin'] = true;
        header("Location: admin_product.php");
        exit;
    } else {
        echo "نام کاربری یا رمز عبور اشتباه است! لطفا مجدد تلاش کنید";
        $_SESSION['admin'] = false;
        exit;
    }
?>
