<?php
    session_start();

    // بررسی صحت ورودی‌ها
    $_SESSION['err'] = 1;
    foreach($_POST as $key => $value){
        if(trim($value) == ''){
            $_SESSION['err'] = 0;
            break;
        }
    }

    if($_SESSION['err'] == 0){
        header("Location: purchase.php");
        exit;
    } else {
        unset($_SESSION['err']);
    }

    require_once "./functions/database_functions.php";

    // نمایش هدر
    $title = "پرداخت موفق";
    require "./template/header.php";

    // اتصال به دیتابیس
    $conn = db_connect();

    // دریافت اطلاعات مشتری از سشن
    extract($_SESSION['ship']);

    // دریافت ایمیل از سشن
    $email = isset($_SESSION['ship']['email']) ? trim($_SESSION['ship']['email']) : null;
    if(empty($email)){
        die("ایمیل نمی‌تواند خالی باشد.");
    }

    // اعتبارسنجی فرمت ایمیل
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        die("فرمت ایمیل وارد شده معتبر نیست.");
    }

    // اعتبارسنجی ورودی‌های پرداخت (اختیاری)
    $card_number = isset($_POST['card_number']) ? $_POST['card_number'] : null;
    $card_PID = isset($_POST['card_PID']) ? $_POST['card_PID'] : null;
    $card_expire = isset($_POST['card_expire']) ? strtotime($_POST['card_expire']) : null;
    $card_owner = isset($_POST['card_owner']) ? $_POST['card_owner'] : null;

    if(empty($card_number) || empty($card_PID) || empty($card_expire) || empty($card_owner)){
        die("اطلاعات پرداخت نمی‌تواند خالی باشد.");
    }

    // یافتن مشتری یا ایجاد مشتری جدید
    $customerid = getCustomerId($name, $address, $city, $zip_code, $country,$email);
    if($customerid == null) {
        $customerid = setCustomerId($name, $address, $city, $zip_code, $country, $email); 
    }

    // ثبت سفارش
    $date = date("Y-m-d H:i:s");
    insertIntoOrder($conn, $customerid, $_SESSION['total_price'], $date, $name, $address, $city, $zip_code, $country);
    
    // دریافت شناسه سفارش برای افزودن محصولات
    $orderid = getOrderId($conn, $customerid);

    foreach($_SESSION['cart'] as $id => $qty){
        $productPrice = getProductPrice($id);
        $query = "INSERT INTO order_items (order_id, product_id, price, quantity) VALUES 
        ('$orderid', '$id', '$productPrice', '$qty')";
        $result = mysqli_query($conn, $query);
        if(!$result){
            echo "مشکلی رخ داده است: " . mysqli_error($conn);
            exit;
        }
    }

    // خالی کردن سبد خرید
    session_unset();
?>
    <p class="lead text-success">سفارش شما با موفقیت ثبت شد. سبد خرید شما خالی شد.</p>

<?php
    if(isset($conn)){
        mysqli_close($conn);
    }
    require_once "./template/footer.php";
?>
