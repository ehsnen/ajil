<?php
    $title = "تماس با ما";
    require_once "./template/header.php";
    require "./functions/database_functions.php";
    $conn = db_connect();
    $Cmessage = "";

    if(isset($_POST['add_contact'])){
        // دریافت و پاکسازی داده‌های ورودی
        $Cname = mysqli_real_escape_string($conn, trim($_POST['Cname']));
        $Cemail = mysqli_real_escape_string($conn, trim($_POST['Cemail']));
        $Ctext = mysqli_real_escape_string($conn, trim($_POST['Ctext']));

        // بررسی خالی نبودن فیلدها
        if(empty($Cname) || empty($Cemail) || empty($Ctext)){
            $Cmessage = 'لطفا تمام فیلدها را پر کنید';
        } else {
            // ثبت اطلاعات در دیتابیس
            $addCon = "INSERT INTO contact (C_name, C_Email, C_text) VALUES ('$Cname', '$Cemail', '$Ctext')";
            $insertResult = mysqli_query($conn, $addCon);

            if(!$insertResult){
                $Cmessage = "ارسال پیام با مشکل مواجه شد: " . mysqli_error($conn);
            } else {
                $Cmessage = 'پیام شما با موفقیت ارسال شد';
            }
        }
    }
?>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 text-center">
        <form method="post" action="contact.php" enctype="multipart/form-data" class="form-horizontal">
            <fieldset>
                <legend>تماس با ما</legend>
                <p class="lead">برای ارتباط با ما فرم زیر را تکمیل کرده و ارسال کنید</p>
                <div class="form-group">
                    <label for="inputName" class="control-label">نام</label>
                    <div class="col-lg-10">
                        <input type="text" name="Cname" class="form-control" id="inputName" placeholder="نام خود را وارد کنید" style="text-align:right;" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="control-label">ایمیل</label>
                    <div class="col-lg-10">
                        <input type="email" name="Cemail" class="form-control" id="inputEmail" placeholder="ایمیل خود را وارد کنید" style="text-align:right;" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="textArea" class="control-label">پیام</label>
                    <div class="col-lg-10">
                        <textarea name="Ctext" class="form-control" rows="5" id="textArea" style="text-align:right;" required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <input class="btn btn-default" type="button" onclick="window.location.replace('index.php')" value="انصراف" />
                        <button type="submit" name="add_contact" class="btn btn-primary">ارسال</button>
                    </div>
                </div>
                <div class="lead text-warning"><?php echo $Cmessage; ?></div>
            </fieldset>
        </form>
    </div>
    <div class="col-md-3"></div>
</div>
<?php
    require_once "./template/footer.php";
?>
