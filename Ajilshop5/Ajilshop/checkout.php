<?php
    session_start();
    require_once "./functions/database_functions.php";
    // نمایش هدر
    $title = "پرداخت";
    require "./template/header.php";

    if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){
?>

    <table class="table" dir="rtl">
        <tr>
            <th style="text-align:right;">نام محصول</th>
            <th style="text-align:right;">قیمت</th>
            <th style="text-align:right;">تعداد</th>
            <th style="text-align:right;">جمع</th>
        </tr>
        <?php
            foreach($_SESSION['cart'] as $id => $qty){
                $conn = db_connect();
                $product = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM products WHERE id = '$id'"));
        ?>
        <tr>
            <td><?php echo $product['name'] . " - " . $product['category']; ?></td>
            <td><?php echo $product['price'] . " تومان"; ?></td>
            <td><?php echo $qty; ?></td>
            <td><?php echo $qty * $product['price'] . " تومان"; ?></td>
        </tr>
        <?php } ?>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <td><?php echo $_SESSION['total_items']; ?></td>
            <td><?php echo $_SESSION['total_price'] . " تومان"; ?></td>
        </tr>
    </table>
    <form method="post" action="purchase.php" class="form-horizontal" dir="rtl" style="float:right;">
        <?php if(isset($_SESSION['err']) && $_SESSION['err'] == 1){ ?>
            <p class="text-danger">تمامی فیلد ها بایستی پر شوند</p>
        <?php } ?>
        <div class="form-group">
           <label for="name" class="control-label">نام</label>
            <div class="col-md-4">
                <input type="text" name="name" class="col-md" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="address" class="control-label">آدرس</label>
            <div class="col-md-4">
                <input type="text" name="address" class="col-md" class="form-control" required>
            </div>
        </div>
        <div class="form-group" >
            <label for="city" class="control-label">شهر</label>
            <div class="col-md-4">
                <input type="text" name="city" class="col-md" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="zip_code" class="control-label">کد پستی</label>
            <div class="col-md-4">
                <input type="text" name="zip_code" class="col-md" class="form-control" required>
            </div>
            </div>
            <div class="form-group">
            <label for="email" class="control-label">ایمیل</label>
            <div class="col-md-4">
                <input type="email" name="email" class="col-md" class="form-control" placeholder="ایمیل خود را وارد کنید" required>
        </div>
        </div>
        <div class="form-group">
        <label for="country" class="control-label">کشور</label>
            <div class="col-md-4">
                <input type="text" name="country" class="col-md" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="ادامه دادن" class="btn btn-primary">
        </div>
    </form>
    <div style="clear:both;"></div>
<?php
    } else {
        echo "<p class=\"lead text-warning\">سبد خرید شما خالی است! لطفا برخی از محصولات را به آن اضافه کنید</p>";
    }
    if(isset($conn)){ mysqli_close($conn); }
    require_once "./template/footer.php";
?>
