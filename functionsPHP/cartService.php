<?php
if ($_SERVER['REQUEST_METHOD'] == "POST"){	//hande POST
	$itemJSON = json_decode(stripslashes($_POST['json']), true);
    
    // if cart exists, update it and recalc total
    if (isset($_SESSION['cart'])){
		$cartJSON = json_decode($_SESSION['cart']);
		array_push($cartJSON['products'], $itemJSON);
		$cartJSON['total'] += $itemJSON['price'];
		
    // else create new cart object and set total
	} else {
		$cartJSON = array();
		$cartJSON['products'] = array();
		array_push($cartJSON['products'], $itemJSON);
		$cartJSON['total'] = $itemJSON['price'];
	}
    
	echo $cartJSON['total'];
}
?>