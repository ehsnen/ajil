<?php
    // اتصال به پایگاه داده
    $conn = mysqli_connect("localhost", "root", "", "www_project");
    if(!$conn){
        echo "اتصال به پایگاه داده برقرار نشد: " . mysqli_connect_error();
        exit;
    }

    // دریافت تمام کاربران و رمز عبورهای ساده
    $query = "SELECT id, password FROM admin";
    $result = mysqli_query($conn, $query);

    if(!$result){
        echo "خطا در واکشی داده‌ها: " . mysqli_error($conn);
        exit;
    }

    // حلقه برای هش کردن رمز عبورها
    while($row = mysqli_fetch_assoc($result)){
        $id = $row['id'];
        $plainPassword = $row['password'];

        // بررسی اینکه رمز عبور هش نشده باشد
        if(!password_get_info($plainPassword)['algo']){
            // هش کردن رمز عبور
            $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

            // به‌روزرسانی در دیتابیس
            $updateQuery = "UPDATE admin SET password = ? WHERE id = ?";
            $stmt = mysqli_prepare($conn, $updateQuery);
            mysqli_stmt_bind_param($stmt, "si", $hashedPassword, $id);
            $updateResult = mysqli_stmt_execute($stmt);

            if($updateResult){
                echo "رمز عبور کاربر با شناسه $id به‌روزرسانی شد.<br>";
            } else {
                echo "خطا در به‌روزرسانی رمز عبور کاربر با شناسه $id: " . mysqli_error($conn) . "<br>";
            }
        } else {
            echo "رمز عبور کاربر با شناسه $id قبلاً هش شده است.<br>";
        }
    }

    // بستن اتصال به پایگاه داده
    mysqli_close($conn);

    echo "عملیات هش کردن رمز عبورها به پایان رسید.";
?>
