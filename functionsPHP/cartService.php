<?php
session_start();
include_once("ChromePhp.php");

if ($_SERVER['REQUEST_METHOD'] == "POST"){	//hande POST
    $type = $_POST['type'];
	if ($type == 'update'){
		$id = $_POST['id'];
		$quantity = $_POST['quantity'];
	} else if ($type == 'add') {
		$itemJSON = json_decode(stripslashes($_POST['data']), true);
	} else {
		$id = $_POST['id'];
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
				if ($index != null){
					$cartJSON['products'][$index]['quantity']++;
				} else {	 //else, add the item to the cart
					array_push($cartJSON['products'], $itemJSON);
				}

				// increase total price, and add cart to session var
				$cartJSON['total'] += $itemJSON['price'];
				$_SESSION['cart'] = json_encode($cartJSON);
				
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
					$oldQ = $cartJSON['products'][$index]['quantity'];							//grab old quantity
					$cartJSON['total'] -= $oldQ * $cartJSON['products'][$index]['price'];		//subtract price of old quantity
					$cartJSON['products'][$index]['quantity'] = $quantity;						//set new quantity
					$cartJSON['total'] += $quantity * $cartJSON['products'][$index]['price'];	//add price of new quantity
					
					if($quantity == 0){
						ChromePhp::log("quantity is 0, unsetting");
						unset($cartJSON['products'][$index]);
						$cartJSON['products'] = array_values($cartJSON['products']);
					}
				}	

				$_SESSION['cart'] = json_encode($cartJSON);
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
					$oldQ = $cartJSON['products'][$index]['quantity'];							//grab old quantity
					$cartJSON['total'] -= $oldQ * $cartJSON['products'][$index]['price'];		//subtract price of old quantity
					unset($cartJSON['products'][$index]);
					
					$cartStr = json_encode($cartJSON);
					ChromePhp::log("cartjson var : $cartStr");
					
					$cartJSON['products'] = array_values($cartJSON['products']);
				} else {
					ChromePhp::log("index is null");
				}

				// increase total price, and add cart to session var
				$cartJSON['total'] += $itemJSON['price'];
				$_SESSION['cart'] = json_encode($cartJSON);

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
		$_SESSION['cart'] = json_encode($cartJSON);
		
		ChromePhp::log("creating new cart session var");
		ChromePhp::log($_SESSION['cart']);
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
?>
