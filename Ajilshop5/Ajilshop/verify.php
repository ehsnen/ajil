<?php
    // دریافت داده‌های ورودی
    $email = trim($_POST['inputEmail']);
    $pswd = trim($_POST['inputPasswd']);

    // اتصال به پایگاه داده
    $conn = mysqli_connect("localhost", "root", "", "www_project");
    if(!$conn){
        echo "اتصال به پایگاه داده برقرار نشد: " . mysqli_connect_error();
        exit;
    }

    // استفاده از پرس و جوهای آماده برای امنیت بیشتر
    $query = "SELECT username, password FROM admin WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // بررسی نتیجه
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);

        // تأیید رمز عبور
        if(password_verify($pswd, $row['password'])){
            echo "خوش آمدید!";
        } else {
            echo "رمز عبور اشتباه است!";
        }
    } else {
        echo "کاربری با این ایمیل یافت نشد!";
    }

    // بستن اتصال به پایگاه داده
    mysqli_close($conn);
?>
