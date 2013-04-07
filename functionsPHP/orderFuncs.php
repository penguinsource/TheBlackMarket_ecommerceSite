<?php

function checkAccess(){
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
}

function createOrder($user, $productArray){
    $con = connectToDB();
    /*$query = "INSERT INTO * FROM product WHERE pid = '$pid'";
    $result = mysqli_query($con,$query);	        // query db*/
    
}

?>