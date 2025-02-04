<?php
    session_start();
    require_once "./functions/admin.php";
    $title = "لیست محصولات";
    require_once "./template/header.php";
    require_once "./functions/database_functions.php";
    $conn = db_connect();
    $result = getAllProducts($conn);
?>
    <p style="text-align:right;" class="lead"><a href="admin_add.php">(+) اضافه کردن محصول جدید</a></p>
    <a href="admin_signout.php" class="btn btn-primary">خروج</a>
    <table class="table" style="margin-top: 20px" dir="rtl">
        <tr>
            <th style="text-align:right;">کد</th>
            <th style="text-align:right;">نام محصول</th>
            <th style="text-align:right;">دسته‌بندی</th>
            <th style="text-align:right;">توضیحات</th>
            <th style="text-align:right;">قیمت</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)){ ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['category']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><a href="admin_edit.php?id=<?php echo $row['id']; ?>">ویرایش</a></td>
            <td><a href="admin_delete.php?id=<?php echo $row['id']; ?>">حذف</a></td>
        </tr>
        <?php } ?>
    </table>

<?php
    if(isset($conn)) { mysqli_close($conn); }
    require_once "./template/footer.php";
?>
