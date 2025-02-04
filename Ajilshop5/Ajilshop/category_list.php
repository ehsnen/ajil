<?php
    session_start();
    require_once "./functions/database_functions.php";
    $conn = db_connect();

    // دریافت لیست دسته‌بندی‌ها و تعداد محصولات در هر دسته
    $query = "SELECT category, COUNT(*) as count FROM products GROUP BY category";
    $result = mysqli_query($conn, $query);
    if(!$result){
        echo "مشکلی پیش آمده است: " . mysqli_error($conn);
        exit;
    }
    if(mysqli_num_rows($result) == 0){
        echo "دسته‌بندی‌ای یافت نشد! لطفاً مجدداً تلاش نمایید.";
        exit;
    }

    $title = "دسته‌بندی محصولات";
    require "./template/header.php";
?>
    <p class="lead">لیست دسته‌بندی‌های محصولات</p>
    <ul style="text-align:right;direction:rtl;font-size:x-large;">
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <li>
                <a href="productsByCategory.php?category=<?php echo urlencode($row['category']); ?>">
                    <?php echo $row['category']; ?>
                </a>
                <span class="badge"><?php echo $row['count']; ?></span>
            </li>
        <?php } ?>
        <li>
            <a href="products.php">مشاهده تمامی محصولات</a>
        </li>
    </ul>
<?php
    mysqli_close($conn);
    require "./template/footer.php";
?>
