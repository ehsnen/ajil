<?php
    session_start();
    require_once "./functions/database_functions.php";

    // دریافت دسته‌بندی
    if(isset($_GET['category'])){
        $category = $_GET['category'];
    } else {
        echo "مشکلی رخ داده است";
        exit;
    }

    // اتصال به پایگاه داده
    $conn = db_connect();

    // دریافت محصولات مرتبط با دسته‌بندی
    $query = "SELECT id, name, image FROM products WHERE category = '$category'";
    $result = mysqli_query($conn, $query);
    if(!$result){
        echo "مشکلی پیش آمده است " . mysqli_error($conn);
        exit;
    }
    if(mysqli_num_rows($result) == 0){
        echo "در حال حاضر هیچ محصولی برای این دسته‌بندی ثبت نشده است";
        exit;
    }

    $title = "محصولات بر اساس دسته‌بندی";
    require "./template/header.php";
?>
    <p class="lead"><a href="category_list.php">دسته‌بندی‌ها</a> > <?php echo htmlspecialchars($category); ?></p>
    <?php while($row = mysqli_fetch_assoc($result)){ ?>
    <div class="row">
        <div class="col-md-3">
            <img class="img-responsive img-thumbnail" src="<?php echo $row['image'];?>">
        </div>
        <div class="col-md-7">
            <h4><?php echo $row['name'];?></h4>
            <a href="product.php?id=<?php echo $row['id'];?>" class="btn btn-primary">مشاهده جزئیات</a>
        </div>
    </div>
    <br>
<?php
    }
    if(isset($conn)) { mysqli_close($conn); }
    require "./template/footer.php";
?>
