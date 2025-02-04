<?php
    session_start();
    // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //     echo "<pre>";
    //     print_r($_POST);
    //     echo "</pre>";
    //     exit;
    // }
    // بررسی خالی نبودن فیلدها
    $_SESSION['err'] = 1;
    foreach($_POST as $key => $value){
        if(trim($value) == ''){
            $_SESSION['err'] = 0;
            break;
        }
    }

    if($_SESSION['err'] == 0){
        header("Location: checkout.php");
        exit;
    } else {
        unset($_SESSION['err']);
    }

    // ذخیره اطلاعات پرداخت در سشن
    $_SESSION['ship'] = array();
    foreach($_POST as $key => $value){
        if($key != "submit"){
            $_SESSION['ship'][$key] = $value;
        }
    }

    require_once "./functions/database_functions.php";
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
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><?php echo $_SESSION['total_items']; ?></td>
            <td><?php echo $_SESSION['total_price'] . " تومان"; ?></td>
        </tr>
        <tr>
            <td><b>هزینه حمل و نقل</b></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><b>15000 تومان</b></td>
        </tr>
        <tr>
            <td style="text-align:right;"><b>جمع کل همراه با حمل و نقل</b></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><b><?php echo ($_SESSION['total_price'] + 15000) . " تومان"; ?></b></td>
        </tr>
    </table>
    <form method="post" action="process.php" class="form-horizontal" dir="rtl" style="float:right;">
        <?php if(isset($_SESSION['err']) && $_SESSION['err'] == 1){ ?>
        <p class="text-danger">همه فیلدها بایستی پر شوند</p>
        <?php } ?>
        <div class="form-group">
            <label for="card_type" class="control-label">نوع پرداخت</label>
            <div class="col-lg-10">
                <select class="form-control" name="card_type">
                    <option value="SPEH">بانک سپه</option>
                    <option value="MELI">بانک ملی</option>
                    <option value="PASARGAD">بانک پاسارگاد</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="card_number" class="control-label">شماره کارت</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" name="card_number" required>
            </div>
        </div>
        <div class="form-group">
            <label for="card_PID" class="control-label">cvv2</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" name="card_PID" required>
            </div>
        </div>
        <div class="form-group">
            <label for="card_expire" class="control-label">تاریخ سفارش</label>
            <div class="col-lg-10">
                <input type="date" name="card_expire" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="card_owner" class="control-label">نام</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" name="card_owner" required>
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="control-label">ایمیل</label>
            <div class="col-lg-10">
                <input type="email" class="form-control" name="email" value="<?php echo $_SESSION['ship']['email']; ?>" disabled>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2" dir="ltr" style="width:600px;">
                <button type="reset" class="btn btn-default">پاک کردن</button>
                <button type="submit" class="btn btn-primary">خرید</button>
            </div>
        </div>
    </form>
    <div style="clear:both;"></div>
<?php
    } else {
        echo "<p class='lead text-warning'>سبد خرید شما خالی است! لطفا محصولاتی را اضافه کنید.</p>";
    }
    if(isset($conn)){ mysqli_close($conn); }
    require "./template/footer.php";
?>
