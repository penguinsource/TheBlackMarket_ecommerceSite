<?php
	session_start();
	include("dbConnection.php");

	/*if (isset($_POST['type'])){
		if ($_POST['type'] == 'login'){
			$carttotal = loginUser();
			if (isset($_SESSION["email"])){
				// send back the email of the user logged in
				echo json_encode(array('type'=>'success', 'value'=>$_SESSION["email"], 'cartTotal'=>$carttotal));
			}
		} else if ($_POST['type'] == 'register'){
			registerUser();
			if (isset($_SESSION["email"])){
				// send back the email of the user logged in
				echo json_encode(array('type'=>'success', 'value'=>$_SESSION["email"]));
			}
		} else if ($_POST['type'] == 'logout'){
			logoutUser();
		}
	} else {
		echo json_encode(array('type'=>'success', 'value'=>'Error ! No type sent.. see file authenticationFuncs.php'));
		die();
	}
	*/
	echo "hello";
	/*
	if (isset($_POST['priceFilterLow'])){
		
	}
	if (isset($_POST['priceFilterHigh'])){
		
	}
	if (isset($_POST['priceFilterLow'])){
		
	}
	if (isset($_POST['dishwashers'])){
		echo "it is set.. to smthing:";
	}*/
	/*
	search queries
	
	SELECT * FROM product WHERE price > '1000'
	SELECT * FROM product WHERE price > '1000' AND price < '1100'
	SELECT * FROM product WHERE price > '1000' AND price < '1100' AND pcategory = 'stoves_ranges'
	
	
	*/
?>
