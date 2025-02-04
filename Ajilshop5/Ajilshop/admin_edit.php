<?php
    session_start();
    require_once "./functions/admin.php";
    $title = "ویرایش محصول";
    require_once "./template/header.php";
    require_once "./functions/database_functions.php";
    $conn = db_connect();

    if(isset($_GET['id'])){
        $product_id = $_GET['id'];
    } else {
        echo "لطفاً تمامی فیلدها را پر کنید";
        exit;
    }

    if(!isset($product_id)){
        echo "لطفاً تمامی فیلدها را پر کنید";
        exit;
    }

    // دریافت اطلاعات محصول
    $query = "SELECT * FROM products WHERE id = '$product_id'";
    $result = mysqli_query($conn, $query);
    if(!$result){
        echo "مشکلی رخ داده است " . mysqli_error($conn);
        exit;
    }
    $row = mysqli_fetch_assoc($result);
?>
    <form method="post" action="edit_product.php" enctype="multipart/form-data">
        <table class="table" dir="rtl">
            <tr>
                <th>کد</th>
                <td><input type="text" name="id" value="<?php echo $row['id'];?>" readOnly></td>
            </tr>
            <tr>
                <th>نام محصول</th>
                <td><input type="text" name="name" value="<?php echo $row['name'];?>" required></td>
            </tr>
            <tr>
                <th>دسته‌بندی</th>
                <td><input type="text" name="category" value="<?php echo $row['category'];?>" required></td>
            </tr>
            <tr>
                <th>تصویر</th>
                <td><input type="file" name="image"></td>
            </tr>
            <tr>
                <th>توضیحات</th>
                <td><textarea name="description" cols="40" rows="5" style="width: 800px; height: 200px;"><?php echo $row['description'];?></textarea>
            </tr>
            <tr>
                <th>قیمت</th>
                <td><input type="text" name="price" value="<?php echo $row['price'];?>" required></td>
            </tr>
        </table>
        <input class="btn btn-default" type="button" onclick="window.location.replace('admin_product.php')" value="انصراف" />
        <input type="submit" name="save_change" value="ذخیره تغییرات" class="btn btn-primary">
    </form>
    <br/>
<?php
    if(isset($conn)) {mysqli_close($conn);}
    require "./template/footer.php";
?>
