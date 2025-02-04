<?php
    session_start();
    $count = 0;

    $title = "صفحه اصلی";
    require_once "./template/header.php";
    require_once "./functions/database_functions.php";

    $conn = db_connect();

    // دریافت اطلاعات 4 محصول آخر
    $query = "SELECT id, image FROM products ORDER BY id DESC LIMIT 4";
    $result = mysqli_query($conn, $query);
    if(!$result){
        echo "مشکلی رخ داده است " . mysqli_error($conn);
        exit;
    }
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<style>
  /* تنظیم اندازه ثابت برای تصاویر */
  .img-thumbnail {
    width: 300px; /* عرض دلخواه */
    height: 200px; /* ارتفاع دلخواه */
    object-fit: cover; /* تطبیق تصویر با اندازه */
    transition: transform 0.3s, box-shadow 0.3s; /* انیمیشن برای افکت هاور */
  }

  /* افکت هاور */
  .img-thumbnail:hover {
    transform: scale(1.1); /* افکت زوم */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3); /* سایه */
  }
</style>
      <!-- نمایش آخرین محصولات -->
      <p class="lead text-center text-dark">آخرین محصولات موجود شده</p>
      <div class="row">
        <?php foreach($row as $product) { 
          ?>
        <div class="col-md-3">
          
            <a href="product.php?id=<?php echo $product['id']; ?>">
            <img class="img-responsive img-thumbnail" src="<?php echo $product['image']; ?>" alt="Product Image">
            </a>
        </div>
        <?php } ?>
      </div>
<?php
    if(isset($conn)) { mysqli_close($conn); }
    require_once "./template/footer.php";
?>
