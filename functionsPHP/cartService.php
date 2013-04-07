<?php
session_start();
include_once("ChromePhp.php");
include("dbConnection.php");

if ($_SERVER['REQUEST_METHOD'] == "POST"){	//hande POST
    $type = $_POST['type'];
	if ($type == 'update'){
		$id = $_POST['id'];
		$quantity = $_POST['quantity'];
	} else if ($type == 'add') {
		$itemJSON = json_decode(stripslashes($_POST['data']), true);
	} else if ($type == 'remove'){
		$id = $_POST['id'];
	} else if ($type == 'checkcart'){
		if (isset($_SESSION['cart'])){
			$cartJSON = json_decode($_SESSION['cart'], true);
			if ($cartJSON['total'] > 0){
				echo "1";
			} else {
				echo "0";
			}
		} else {
			echo "0";
		}
		
		die();
	}
	
		
    // if cart exists, update it and recalc total
    if (isset($_SESSION['cart'])){
		$cartJSON = json_decode($_SESSION['cart'], true);

		// add, remove, or update quantity
		switch($type){
			// add item to cart
			case 'add':
				$index = exists($itemJSON['id'], $cartJSON['products']);

				// if items exists, update its quantity
				if (isset($index)){
					$cartJSON['products'][$index]['quantity'] += $itemJSON['quantity'];
					if ($cartJSON['products'][$index]['quantity'] > 999) $cartJSON['products'][$index]['quantity'] = 999;
				} else {	 //else, add the item to the cart
					array_push($cartJSON['products'], $itemJSON);
				}
				
				$cartJSON['total'] = getTotal($cartJSON['products']);
				ChromePhp::log("added item $id to cart");
		
				break;
			// update item's quantity (used from shopping cart page if user wants to change quantity of item)
			case 'update':
				$index = exists($id, $cartJSON['products']);

				ChromePhp::log("index of item $id is $index");
				$tempname = $cartJSON['products'][$index]['name'];
				ChromePhp::log("item at $index is $tempname");
				
				// if items exists, update its quantity
				if (isset($index)){
					$cartJSON['products'][$index]['quantity'] = $quantity;						//set new quantity
					if ($cartJSON['products'][$index]['quantity'] > 999) $cartJSON['products'][$index]['quantity'] = 999;
					$cartJSON['total'] = getTotal($cartJSON['products']);						// recalculate total to avoid innacuracies
					
					if($quantity == 0){
						ChromePhp::log("quantity is 0, unsetting");
						unset($cartJSON['products'][$index]);
						$cartJSON['products'] = array_values($cartJSON['products']);
					}
				}	

				ChromePhp::log("updated item $id quantity to $quantity");
		
				break;
			// removes all quantities of that item (used from shopping cart page if users presses "x")
			case 'remove':
				$index = exists($id, $cartJSON['products']);
				
				ChromePhp::log("index of item $id is $index");
				$tempname = $cartJSON['products'][$index]['name'];
				ChromePhp::log("item at $index is $tempname");
				
				// if items exists, remove it 
				if (isset($index)){
					//$oldQ = $cartJSON['products'][$index]['quantity'];							//grab old quantity
					//$cartJSON['total'] -= $oldQ * $cartJSON['products'][$index]['price'];		//subtract price of old quantity
					unset($cartJSON['products'][$index]);
					$cartJSON['total'] = getTotal($cartJSON['products']);						// recalculate total to avoid innacuracies
					
					$cartStr = json_encode($cartJSON);
					ChromePhp::log("cartjson var : $cartStr");
					
					$cartJSON['products'] = array_values($cartJSON['products']);
				} else {
					ChromePhp::log("index is null");
				}

				ChromePhp::log("removed item $id from cart");
				
				break;
			
			default:
				break;
		}
		
		ChromePhp::log($_SESSION['cart']);
		
    // else create new cart object and set total
	} else {
		$cartJSON = array();
		$cartJSON['products'] = array();
		array_push($cartJSON['products'], $itemJSON);
		$cartJSON['total'] = $itemJSON['price'];
		
		
		ChromePhp::log("creating new cart session var");
		ChromePhp::log($_SESSION['cart']);
	}
    
	// save cart to session
	$_SESSION['cart'] = json_encode($cartJSON);
	
	//save cart to db if user is logged in
	if (isset($_SESSION['email'])){
		$con = connectToDB();
		
		$query = "UPDATE user SET cart = '" . $_SESSION['cart'] . "' WHERE email = '" . $_SESSION['email'] . "'";
		mysqli_query($con, $query);
		
		closeDBConnection($con);
	}
	echo $_SESSION['cart'];
}

function exists($id, $jsonArray){
	$i = 0;
	foreach ($jsonArray as $item){
		if ($item['id'] == $id){
			return $i;
		}
		$i++;
	} 

	return null;
}

function getTotal($jsonArray){
	$total = 0;
	
	foreach ($jsonArray as $item){
		$total += $item['price'] * $item['quantity'];
	} 
	
	return $total;
}
?>
