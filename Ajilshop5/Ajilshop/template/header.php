<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $title; ?></title>

    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="./bootstrap/css/jumbotron.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="./bootstrap/css/mystyle.css">

  <style>
  body {
    position: relative;
    margin: 0;
    min-height: 100vh;
    
  }

  body::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('./bootstrap/images/chini.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center;
    opacity: 0.5; /* Adjust the opacity value as needed (0.1 to 1) */
    z-index: -1; /* Ensure the background stays behind the content */
  }
</style>

  </head>

  <body>

  <nav class="navbar navbar-inverse navbar-fixed-top bg-info">
  <div class="container ">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php" dir="rtl">فروشگاه آجیل</a>
    </div>

    <!--/.navbar-collapse -->
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right" dir="rtl">
        <li><a href="admin.php"><span class="glyphicon glyphicon-user"></span>&nbsp; ورود ادمین</a></li>
        <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp; سبد خرید من</a></li>
        <li><a href="contact.php"><span class="glyphicon glyphicon-phone-alt"></span>&nbsp; تماس با ما</a></li>
        <li><a href="category_list.php"><span class="glyphicon glyphicon-paperclip"></span>&nbsp; لیست محصولات</a></li>
        <li><a href="products.php"><span class="glyphicon glyphicon-book"></span>&nbsp; محصولات</a></li>
      </ul>
    </div>
  </div>
</nav>

    <?php
      if(isset($title) && $title == "Index") {
    ?>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container" >
        <h1 dir="rtl">به فروشگاه آنلاین ایران ناتس  خوش آمدید</h1>
  
   
      </div>
    </div>
    <?php } ?>

    <div class="container" id="main">