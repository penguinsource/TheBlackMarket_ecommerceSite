<?php
session_start();
include_once("ChromePhp.php");

if ($_SERVER['REQUEST_METHOD'] == "POST"){	//hande POST
	$itemJSON = json_decode(stripslashes($_POST['json']), true);
    
	ChromePhp::log("email from cart service: " . $_SESSION['email']);	
	
	
    // if cart exists, update it and recalc total
    if (isset($_SESSION['cart'])){
		$cartJSON = json_decode($_SESSION['cart'], true);
		array_push($cartJSON['products'], $itemJSON);
		$cartJSON['total'] += $itemJSON['price'];
		$_SESSION['cart'] = json_encode($cartJSON);
		
		ChromePhp::log("updating cart session var");
		ChromePhp::log($_SESSION['cart']);
		
    // else create new cart object and set total
	} else {
		$cartJSON = array();
		$cartJSON['products'] = array();
		array_push($cartJSON['products'], $itemJSON);
		$cartJSON['total'] = $itemJSON['price'];
		$_SESSION['cart'] = json_encode($cartJSON);
		
		ChromePhp::log("creating new cart session var");
		ChromePhp::log($_SESSION['cart']);
	}
    
	echo $cartJSON['total'];
}
?>