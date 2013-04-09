<?php
session_start();

function printCartItems(){
	$cartJSON = json_decode($_SESSION['cart'], true);
	$total = '0.00';
	
	// if cart doesn't exist or is empty, print message
	if (!isset($_SESSION['cart']) or empty($cartJSON['products'])){
		echo "<div id='cart-no-items' class='cart-no-items' style='height: 85px;'> Your cart is currently empty</div>\n";
	} else {	//else print all items in cart
		echo "<div id='cart-no-items' class='cart-no-items' style='height: 0px;'> Your cart is currently empty</div>\n";
		
		foreach($cartJSON['products'] as $item){
			$id = $item['id'];
			$name = $item['name'];
			$name = shorten($name, 70);
			$price = $item['price'];
			$quantity = $item['quantity'];
			$img = $item['img'];
			
			$priceToShow = $price * $quantity;		
			
			echo "<div id='cart-item-$id' class='cart-item'>\n";				
				echo "<div class='cart-item-product'>\n";
					echo "<a href='/product/dishwashers/$id'> <img src='images/$img'></img> <div style='margin-left:20px;display:inline-block;width:80%;height:85px;overflow:hidden;'>$name</div> </a>\n";
				echo "</div> </a>";
				
				echo "<div align='center' class='cart-item-quantity'>\n";
					echo "<input type='text' id='quantity-$id' value='$quantity' oninput='updateCart(\"$id\", document.getElementById(\"quantity-$id\").value, \"$name\", $price);'></input>\n";
				echo "</div>\n";
				
				echo "<div align='center' id='price-$id' class='cart-item-price'> $$priceToShow </div>\n";					
				echo "<div align='center' class='cart-item-remove' > <input type='image' src='/design/images/redx.png' onClick='removeFromCart(\"$id\", \"$name\");' width='20px'>	</div>\n";
			echo "</div>";
		}
		
		$total = $cartJSON['total'];
	}
	
	
	echo "<div id='cart-total'> Total: <div id='cart-total-price'>$$total</div> </div>";
}

function shorten($string, $chars = 100){
    preg_match('/^.{0,' . $chars. '}(?:.*?)\b/iu', $string, $matches);
    $new_string = $matches[0];
    return ($new_string === $string) ? $string : $new_string . '&hellip;';
}

?>