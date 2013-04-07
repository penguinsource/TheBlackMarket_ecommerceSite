<?php

function printPage(){
	//redirect and die if user not signed in
	if(!isset($_SESSION['email'])){
		echo "Please log in.";
		header('Location: cart');
		die();
	}
	
	//check for empty cart
	if (isset($_SESSION['cart'])){
		$cartJSON = json_decode($_SESSION['cart'], true);
		if ($cartJSON['total'] < 0){
			echo "Please add items to cart.";
			header('Location: cart');
			die();
		}
	} else {
		echo "Please add items to cart.";
		header('Location: cart');
		die();
	}
	
	$con = connectToDB();
			
	$query = "SELECT * FROM user WHERE email = '" . $_SESSION["email"] . "'";        
	$result = mysqli_query($con, $query);
	
	$redirect = false;
	
	if($row = mysqli_fetch_array($result)) {
		$firstname = $row['firstname'];
		$city = $row['city'];
		$postal = $row['postal'];
		$address = $row['address'];
		
		if (!isset($firstname) || ($firstname == ""))	$redirect = true;
		if (!isset($city) || ($city == ""))				$redirect = true;
		if (!isset($postal) || ($postal == ""))			$redirect = true;
		if (!isset($address) || ($address == ""))		$redirect = true;		
	}			
	
	if ($redirect) {	
		closeDBConnection($con);
		echo "Please fill in your name and address on your profile.";
		header('Location: cart');
		die();
	}
	
	
	// PRINT ACTUAL PAGE IF ACCESS NOT RESTRICTED
	
	echo "<div id='header'> Confirm Order Details</div>\n";
				
	echo "<div style='margin-left:30px; margin-right:30px;overflow:auto;'>\n";
		echo "<div id='cart'>\n";
			echo "<div id='sub-header'> <span style='padding-left:10px'> Order <a href='/cart'> (edit) </a></span></div>\n";
			
			$cartJSON = json_decode($_SESSION['cart'], true);
			
			foreach($cartJSON['products'] as $item){
				echo "<div class='item'>\n";
					echo "<span style='display:inline-block;width:65%;'>" . $item['name'] . "</span>\n";
					echo "<span style='display:inline-block;width:7%;text-align: right;'>x" . $item['quantity'] . "</span>\n";
					echo "<span style='display:inline-block;width:26%;text-align: center;'>$" . ($item['price'] * $item['quantity']) . "</span>\n";
				echo "</div>\n";
			}
						
			echo "<div id='total-price'> $" . $cartJSON['total'] . " </div><div id='total-text'> Total: </div> \n";
		echo "</div>\n";
		
		echo "<div id='address'>\n";
			echo "<div id='sub-header'> <span style='padding-left:10px'> Shipping Address <a href='/user_profile'> (edit) </a></span></div>\n";
			
			$query = "SELECT * FROM user WHERE email = '" . $_SESSION["email"] . "'";        
			$result = mysqli_query($con, $query);
			
			if($row = mysqli_fetch_array($result)) {
				$firstname = $row['firstname'];
				$lastname = $row['lastname'];
				if (isset($lastname) && $lastname != "") $firstname = $firstname . " " . $lastname;
				
				$city = $row['city'];
				$postal = $row['postal'];
				$address = $row['address'];
				$phone = $row['phone'];
			}
			
			echo "<div style='padding-top:10px;'>\n";
				echo "<div class='address-line'>$firstname</div>\n";
				
				if (isset($phone) && $phone != "") echo "<div class='address-line'>$phone</div>\n";
				
				echo "<div class='address-line'>$address</div>\n";
				echo "<div class='address-line'>$city</div>\n";
				echo "<div class='address-line'>$postal</div>\n";
			echo "</div>\n";
		
		echo "</div>\n";		
		
	echo "</div>\n";
	
	echo "<a href='javascript:void(0);'><div class='button'> Place Order </div></a>\n";
}

function createOrder($user, $productArray){
    $con = connectToDB();
    /*$query = "INSERT INTO * FROM product WHERE pid = '$pid'";
    $result = mysqli_query($con,$query);	        // query db*/
    
}

?>