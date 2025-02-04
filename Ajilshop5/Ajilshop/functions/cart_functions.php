<?php
	function total_price($cart){
		$price = 0;
		if(is_array($cart)){
		  	foreach($cart as $id => $qty){
				$productPrice = getProductPrice($id);
				if($productPrice){
					$price += (float) $productPrice * (int) $qty;
		  		}
		  	}
		}
		return $price;
	}

	function total_items($cart){
		$items = 0;
		if(is_array($cart)){
			foreach($cart as $id => $qty){
				$items += (int)$qty;
			}
		}
		return $items;
	}
?>