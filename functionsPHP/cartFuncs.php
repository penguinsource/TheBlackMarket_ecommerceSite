<?php
session_start();

function printCartItems(){
	$cartJSON = json_decode($_SESSION['cart'], true);
	$total = '0.00';
	
	// if cart doesn't exist or is empty, print message
	if (!isset($_SESSION['cart']) or empty($cartJSON['products'])){
		echo "<div class='cart-no-items'> Your cart is currently empty</div>\n";
	} else {	//else print all items in cart
		foreach($cartJSON['products'] as $item){
			$id = $item['id'];
			$name = $item['name'];
			$price = $item['price'];
			$quantity = $item['quantity'];
			$img = $item['img'];
			
			$priceToShow = $price * $quantity;
			
			echo "<div id='cart-item-$id' class='cart-item'>\n";
				echo "<div class='cart-item-product'>\n";
					echo "<a href='/product/dishwashers/$id'> <img src='images/$img'></img> <div style='margin-left:20px;display:inline-block;'>$name</div> </a>\n";
				echo "</div> </a>";
				
				echo "<div align='center' class='cart-item-quantity'>\n";
					echo "<input type='text' id='quantity-$id' value='$quantity' onChange='updateCart(\"$id\", document.getElementById(\"quantity-$id\").value, \"$name\");'></input>\n";
				echo "</div>\n";
				
				echo "<div align='center' id='price-$id' class='cart-item-price'> $$priceToShow </div>\n";					
				echo "<div align='center' class='cart-item-remove' > <input type='image' src='/design/images/redx.png' onClick='removeFromCart(\"$id\", \"$name\");' width='20px'>	</div>\n";
			echo "</div>";
		}
		
		$total = $cartJSON['total'];
	}
	
	
	echo "<div id='cart-total'> Total: <span id='cart-total-price'>$$total</span> </div>";
}

?>