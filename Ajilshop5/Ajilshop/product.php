<?php
  session_start();
  $product_id = $_GET['id'];

  // اتصال به پایگاه داده
  require_once "./functions/database_functions.php";
  $conn = db_connect();

  // دریافت اطلاعات محصول
  $query = "SELECT * FROM products WHERE id = '$product_id'";
  $result = mysqli_query($conn, $query);
  if(!$result){
    echo "مشکلی پیش آمده است " . mysqli_error($conn);
    exit;
  }

  $row = mysqli_fetch_assoc($result);
  if(!$row){
    echo "محصولی ثبت نشده است";
    exit;
  }

  $title = $row['name'];
  require "./template/header.php";
?>
<link rel="stylesheet" type="text/css" href="bootstrap/css/mystyle.css">
      <p class="lead" style="margin: 25px 0"><a href="products.php">آجیل</a> > <?php echo $row['name']; ?></p>
      <div class="row">
        <div class="col-md-3 text-center">
          <img class="img-responsive img-thumbnail" src="<?php echo $row['image']; ?>">
        </div>
        <div class="col-md-6" style="text-align:right;font-size:x-large;">
          <h4>توضیحات محصول</h4>
          <p style="text-align:justify" dir="rtl"><?php echo $row['description']; ?></p>
          <h4>جزئیات محصول</h4>
          <table class="table" dir="rtl">
          	<?php foreach($row as $key => $value){
              if($key == "description" || $key == "image" || $key == "id" || $key == "name"){
                continue;
              }
              switch($key){
                case "id":
                  $key = "کد";
                  break;
                case "name":
                  $key = "نام محصول";
                  break;
                case "category":
                  $key = "دسته‌بندی";
                  break;
                case "price":
                  $key = "قیمت هر کیلو";
                  break;
                case "weight":
                    $key = "وزن";
                    break;
                  case "stock":
                      $key = "موجودی";
                      break;
              }
            ?>
            <tr>
              <td><?php echo $key; ?></td>
              <td><?php echo $value; ?></td>
            </tr>
            <?php 
              } 
              if(isset($conn)) {mysqli_close($conn); }
            ?>
          </table>
          <form method="post" action="cart.php">
            <input type="hidden" name="id" value="<?php echo $product_id;?>">
            <input type="submit" value="خرید / اضافه به سبد خرید" name="cart" class="btn btn-primary">
          </form>
       	</div>
      </div>
<?php
  require "./template/footer.php";
?>
