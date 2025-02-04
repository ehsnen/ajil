<?php
    session_start();
    require_once "./functions/admin.php";
    $title = "اضافه کردن محصول جدید";
    require "./template/header.php";
    require "./functions/database_functions.php";
    $conn = db_connect();

    if(isset($_POST['add'])){
        $id = trim($_POST['id']);
        $id = mysqli_real_escape_string($conn, $id);
        
        $name = trim($_POST['name']);
        $name = mysqli_real_escape_string($conn, $name);

        $category = trim($_POST['category']);
        $category = mysqli_real_escape_string($conn, $category);
        
        $description = trim($_POST['description']);
        $description = mysqli_real_escape_string($conn, $description);
        
        $price = floatval(trim($_POST['price']));
        $price = mysqli_real_escape_string($conn, $price);

        // افزودن تصویر
        if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
            $image = $_FILES['image']['name'];
            $directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
            $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "bootstrapimages/";
            $uploadDirectory .= $image;

            // بررسی نوع و اندازه فایل
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if(in_array($_FILES['image']['type'], $allowedTypes) && $_FILES['image']['size'] <= 5000000){
                move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory);
            } else {
                echo "فرمت یا اندازه فایل نامعتبر است.";
                exit;
            }
        }

        // افزودن محصول به جدول `products`
        $query = "INSERT INTO products (id, name, category, image, description, price) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "issssd", $id, $name, $category, $image, $description, $price);

        $result = mysqli_stmt_execute($stmt);
        if(!$result){
            echo "مشکلی رخ داده است! لطفاً مجدداً تلاش کنید: " . mysqli_error($conn);
            exit;
        } else {
            header("Location: admin_product.php");
            exit;
        }
    }
?>
    <form method="post" action="admin_add.php" enctype="multipart/form-data">
        <table class="table" dir="rtl">
            <tr>
                <th>کد محصول</th>
                <td><input type="text" name="id" required></td>
            </tr>
            <tr>
                <th>نام محصول</th>
                <td><input type="text" name="name" required></td>
            </tr>
            <tr>
                <th>دسته‌بندی</th>
                <td>
                    <select name="category" required>
                        <option value="آجیل ایرانی">آجیل ایرانی</option>
                        <option value="آجیل چینی">آجیل چینی</option>
                        <option value="پسته">پسته</option>
                        <option value="بادام">بادام</option>
                        <option value="گردو">گردو</option>
                        <option value="پشمک">پشمک</option>
                        <option value="شکلات">شکلات</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>تصویر</th>
                <td><input type="file" name="image" required></td>
            </tr>
            <tr>
                <th>توضیحات</th>
                <td><textarea name="description" cols="40" rows="5" style="width: 800px; height: 200px;" required></textarea></td>
            </tr>
            <tr>
                <th>قیمت</th>
                <td><input type="text" name="price" required></td>
            </tr>
        </table>
        <input class="btn btn-default" type="button" onclick="window.location.replace('admin_product.php')" value="انصراف" />
        <input type="submit" name="add" value="اضافه کردن محصول جدید" class="btn btn-primary">
    </form>
    <br/>
<?php
    if(isset($conn)) { mysqli_close($conn); }
    require_once "./template/footer.php";
?>
