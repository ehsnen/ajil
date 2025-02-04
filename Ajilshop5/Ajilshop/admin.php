<?php
	$title = "ورود به پنل مدیریت";
	require_once "./template/header.php";
?>

	<form class="form-horizontal" method="post" action="admin_verify.php">
	<div class="container login-frm">
	<div id="login_form" class="well">
		<h2 style="text-align:center">ورود اعضا</h2>
		<hr>
		نام کاربری <input type="text" name="name" class="form-control" required>
		<div style="height: 10px;"></div>		
		رمز عبور <input type="password" name="pass" class="form-control" required> 
		<div style="height: 15px;"></div>
		<div style="text-align:center">
		<input type="submit" name="submit" class="btn btn-primary" value="ورود">
</div>
</div>
</div>
		</form>
<?php
	require_once "./template/footer.php";
?>