<?php
    session_start();
    require_once "./functions/database_functions.php";
    require_once "./functions/cart_functions.php";

    // دریافت شناسه محصول از فرم
    if(isset($_POST['id'])){
        $product_id = $_POST['id'];
    }

    if(isset($product_id)){
        // محصول جدید انتخاب شده است
        if(!isset($_SESSION['cart'])){
            // $_SESSION['cart'] آرایه‌ای است که id محصول => تعداد را ذخیره می‌کند
            $_SESSION['cart'] = array();

            $_SESSION['total_items'] = 0;
            $_SESSION['total_price'] = '0';
        }

        if(!isset($_SESSION['cart'][$product_id])){
            $_SESSION['cart'][$product_id] = 1;
        } elseif(isset($_POST['cart'])){
            $_SESSION['cart'][$product_id]++;
            unset($_POST);
        }
    }

    // حذف یک محصول خاص
    if(isset($_POST['remove_product'])){
        $product_id = $_POST['remove_product'];
        unset($_SESSION['cart'][$product_id]);
    }

    // خالی کردن سبد خرید
    if(isset($_POST['clear_cart'])){
        unset($_SESSION['cart']);
        $_SESSION['total_items'] = 0;
        $_SESSION['total_price'] = '0';
    }

    // اگر دکمه ذخیره تغییرات کلیک شود، تعداد هر محصول در سبد به‌روزرسانی می‌شود
    if(isset($_POST['save_change'])){
        foreach($_SESSION['cart'] as $id => $qty){
            if($_POST[$id] == '0'){
                unset($_SESSION['cart'][(string)$id]);
            } else {
                $_SESSION['cart'][(string)$id] = (int)$_POST[$id];
            }
        }
    }

    // نمایش هدر
    $title = "سبد خرید";
    require "./template/header.php";

    if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){
        $_SESSION['total_price'] = total_price($_SESSION['cart']);
        $_SESSION['total_items'] = total_items($_SESSION['cart']);
?>
    <form action="cart.php" method="post">
        <table class="table" dir="rtl">
            <tr>
                <th style="text-align:right;">نام محصول</th>
                <th style="text-align:right;">قیمت</th>
                <th style="text-align:right;">تعداد</th>
                <th style="text-align:right;">جمع</th>
                <th style="text-align:right;">حذف</th>
            </tr>
            <?php
                foreach($_SESSION['cart'] as $id => $qty){
                    $conn = db_connect();
                    $product = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM products WHERE id = '$id'"));
            ?>
            <tr>
                <td><?php echo $product['name'] . " - " . $product['category']; ?></td>
                <td><?php echo $product['price']. " تومان"; ?></td>
                <td><input type="text" value="<?php echo $qty; ?>" size="2" name="<?php echo $id; ?>"></td>
                <td><?php echo $qty * $product['price']. " تومان"; ?></td>
                <td>
                    <button type="submit" class="btn btn-danger" name="remove_product" value="<?php echo $id; ?>">حذف</button>
                </td>
            </tr>
            <?php } ?>
        </table>
        <input type="submit" class="btn btn-primary" name="save_change" value="ذخیره تغییرات">
        <button type="submit" class="btn btn-warning" name="clear_cart">خالی کردن سبد خرید</button>
    </form>
    <br/><br/>
    <a href="checkout.php" class="btn btn-primary">تسویه حساب</a> 
    <a href="products.php" class="btn btn-primary">ادامه خرید</a>
<?php
    } else {
        echo "<p class=\"lead text-dark\">سبد خرید شما خالی است! لطفا برخی از محصولات را به آن اضافه کنید</p>";
    }
    if(isset($conn)){ mysqli_close($conn); }
    require_once "./template/footer.php";
?>
