<?php
	function db_connect(){
		$conn = mysqli_connect("localhost", "root", "", "ajilfroshi");
		if(!$conn){
			echo "اتصال با پایگاه داده برقرار نشد " . mysqli_connect_error($conn);
			exit;
		}
		return $conn;
	}

	function select4LatestProduct($conn){
		$row = array();
		$query = "SELECT id, name, price, description FROM products ORDER BY id DESC LIMIT 4";
		$result = mysqli_query($conn, $query);
		if(!$result){
		    echo "مشکلی رخ داده است " . mysqli_error($conn);
		    exit;
		}
		while($product = mysqli_fetch_assoc($result)){
			$row[] = $product;
		}
		return $row;
	}

	function getProductById($conn, $id){
		$query = "SELECT name, category, price FROM products WHERE id = '$id'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "مشکلی رخ داده است " . mysqli_error($conn);
			exit;
		}
		return mysqli_fetch_assoc($result);
	}

	function getOrderId($conn, $customerid){
		$query = "SELECT id FROM orders WHERE customer_id = '$customerid'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "مشکلی رخ داده است" . mysqli_error($conn);
			exit;
		}
		$row = mysqli_fetch_assoc($result);
		return $row['id'];
	}

	function insertIntoOrder($conn, $customerid, $total_price, $date){
		$query = "INSERT INTO orders (customer_id, order_date, total_amount) VALUES 
		('$customerid', '$date', '$total_price')";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "مشکلی در اضافه کردن سفارش رخ داده است " . mysqli_error($conn);
			exit;
		}
		return mysqli_insert_id($conn);
	}

	function getCustomerId($name, $address, $city, $zip_code, $country, $email){
		$conn = db_connect();
		$query = "SELECT id from customers WHERE 
		 
		email = '$email'";
		$result = mysqli_query($conn, $query);
		if($result && mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_assoc($result);
			return $row['id'];
		} else {
			return null;
		}
	}

	function setCustomerId($name, $address, $city, $zip_code, $country, $email){
		$conn = db_connect();
	
		// بررسی اینکه ایمیل تکراری نباشد
		$checkEmailQuery = "SELECT id FROM customers WHERE email = '$email'";
		$checkEmailResult = mysqli_query($conn, $checkEmailQuery);
	
		if ($checkEmailResult && mysqli_num_rows($checkEmailResult) > 0) {
			echo "ایمیل وارد شده قبلاً ثبت شده است.";
			exit;
		}
	
		// درج کاربر جدید در پایگاه داده
		$query = "INSERT INTO customers (name, address, city, zip_code, country, email) VALUES 
			('$name', '$address', '$city', '$zip_code', '$country', '$email')";
	
		$result = mysqli_query($conn, $query);
		if (!$result) {
			echo "اضافه کردن ناموفق بود" . mysqli_error($conn);
			exit;
		}
	
		$customerid = mysqli_insert_id($conn);
		return $customerid;
	}
	

	function getAllProducts($conn){
		$query = "SELECT * FROM products ORDER BY id DESC";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "مشکلی رخ داده است " . mysqli_error($conn);
			exit;
		}
		return $result;
	}

	function getProductPrice($id){
		$conn = db_connect();
		$query = "SELECT price FROM products WHERE id = '$id'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "مشکلی رخ داده است " . mysqli_error($conn);
			exit;
		}
		$row = mysqli_fetch_assoc($result);
		return $row['price'];
	}
?>
