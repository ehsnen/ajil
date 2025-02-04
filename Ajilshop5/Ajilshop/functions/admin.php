<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // بررسی دسترسی ادمین
    if (empty($_SESSION['admin']) || $_SESSION['admin'] !== true) {
        header("Location: index.php");
        exit; // توقف اجرای کد پس از هدایت
    }
?>
