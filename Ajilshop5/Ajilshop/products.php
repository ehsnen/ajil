<?php
    session_start();
    $count = 0;
    
    // اتصال به دیتابیس
    require_once "./functions/database_functions.php";
    $conn = db_connect();

    // دریافت اطلاعات محصولات
    $query = "SELECT id, image, name FROM products";
    $result = mysqli_query($conn, $query);
    if(!$result){
        echo "مشکلی رخ داده است " . mysqli_error($conn);
        exit;
    }

    $title = "لیست محصولات";
    require_once "./template/header.php";
?>

<style>
  /* تنظیم اندازه ثابت برای تصاویر */
  .img-thumbnail {
    width: 300px; /* عرض دلخواه */
    height: 200px; /* ارتفاع دلخواه */
    object-fit: cover; /* تناسب تصویر با اندازه */
    transition: transform 0.3s, box-shadow 0.3s; /* انیمیشن برای افکت هاور */
  }

  /* افکت هاور */
  .img-thumbnail:hover {
    transform: scale(1.1); /* افکت زوم */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3); /* سایه */
  }
</style>

<p class="lead text-center text-dark alert">فهرست تمام محصولات</p>

<?php 
// نمایش محصولات در قالب گالری
for($i = 0; $i < mysqli_num_rows($result); $i++){ ?>
  <div class="row">
    <?php while($query_row = mysqli_fetch_assoc($result)){ ?>
      <div class="col-md-3 text-center">
        <a href="product.php?id=<?php echo $query_row['id']; ?>">
          <img class="img-responsive img-thumbnail" src="<?php echo $query_row['image']; ?>" alt="Product Image">
        </a>
        <!-- نمایش نام محصول -->
        <p class="mt-2 font-weight-bold">
          <?php echo $query_row['name']; ?>
        </p>
      </div>
    <?php
      $count++;
      if($count >= 4){
          $count = 0;
          break;
        }
      } ?> 
  </div>
<?php
  }
  if(isset($conn)) { mysqli_close($conn); }
  require_once "./template/footer.php";
?>
