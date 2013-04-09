<?php
	session_start();
	
	include("dbConnection.php");
	include("ChromePhp.php");
	require_once('lib/fb.php');

	ob_start();
	
	function my_error_handler ($e_number, $e_message, $e_file, $e_line, $e_vars){
		$debug = true;
		$message = "An error occurred in script '$e_file' on line $e_line: \n<BR />$e_message\n<br />";
		$message .= "Date/Time: " . date('n-j-Y H:i:s') . "\n<br />";
		$message .= "<pre>" . print_r ($e_vars, 1) . "</pre>\n<BR />";
		if ($debug){
			echo '<p class="error">'.$message.'</p>';
		}

	}
	set_error_handler('my_error_handler');
		
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$con = connectToDB();
		$cartJSON = json_decode($_SESSION['cart'], true);
		
		// JSON to hold data on where to get each product
		$whereToOrder = array();
		
		// true when an items quantity cant be satisfied
		$orderFailed = false;
		$index = 0;
		
		// figure out where to buy each product, return if quantity doesn't exist for one of them
		foreach ($cartJSON['products'] as $item){
			$id = $item['id'];
			$name = $item['name'];
			$price = $item['price'];
			$qNeed = $item['quantity'];
			$qHave = getQuantityFromDB($id, $con);
			
			$wtoItem = array('pid' => $id,'sources' => array());
			
			
			$msg = "have : " . $qHave ." | need: " . $qNeed;
			Fb::log($msg, "msg");
			
			// if we have the needed quantity, dont order from other stores
			if ($qHave >= $qNeed){
				array_push($wtoItem['sources'], array('url'=>'home', 'quantity' => $qNeed, 'price' => $price));
				array_push($whereToOrder, $wtoItem);
			//else compile a list of stores and how much quantity to buy from them
			} else {
				//add our store as the first if we have any quantity
				$myStore = null;
				if ($qHave != 0){
					$myStore = array('url'=>'home', 'quantity' => $qHave, 'price' => $price);
				}
				
				//get list of all stores that have the item with quantity greater than 0
				$stores = getPossibleStores($id);
				$totalQuantity = getTotalQuantity($stores) + $qHave;
				
				$msg = "total q: " . $totalQuantity ." | need: " . $qNeed;
				
				Fb::log($msg, "msg");
				
				// if there is enough collective quantity, sort list by price and try buy most from the cheapest stores
				if ($totalQuantity >= $qNeed) {
					$remainingQneed = $qNeed;
					
					// sort in descending price
					usort($stores,'sortStoreByPrice');
					
					//add my store as first if it has any quantity
					if (isset($myStore)) array_unshift($stores, $myStore);
					
					//go through stores and keep addign them until quantity is satisfied
					foreach ($stores as $store){
						//if we need more than or same as what the store has, add its entire quantity to the sources of the product
						if ($remainingQneed >= $store['quantity']){
							array_push($wtoItem['sources'], $store);
							
							//if it was equal, don't check other stores
							if ($remainingQneed == $store['quantity']){
								break;
							} else {
								$remainingQneed -= $store['quantity'];
							}
						// else only add howevr much you need left
						} else {
							array_push($wtoItem['sources'], array('url' => $store['url'], 'quantity' => $remainingQneed, 'price' => $store['price']));
							break;
						}
					}
					
				// set fail to true, update available quantity in the cart
				} else {
					$orderFailed = true;
					
					//remove item from cart if we don't have it at all
					if ($totalQuantity == 0){
						unset($cartJSON['products'][$index]);
						$cartJSON['products'] = array_values($cartJSON['products']);
					} else {
						$cartJSON['products'][$index]['quantity'] = $totalQuantity;
					}
					
					$cartJSON['total'] = getCartTotal($cartJSON['products']);			//update total		
					$_SESSION['cart'] = json_encode($cartJSON);
					
					//update user's cart in the db
					$query = "UPDATE user SET cart = '" . $_SESSION['cart'] . "' WHERE email = '" . $_SESSION['email'] . "'";
					mysqli_query($con, $query);
				}			
				
				array_push($whereToOrder, $wtoItem);
				Fb::log($stores, "stores");
			}
			
			Fb::log($wtoItem, "wto " . $index);
			$index++;
		}
		
		//if order failed, redirect back to card
		if ($orderFailed){
			echo "/cart?orderFailed";
			die();
		}
		
		//save pending order to db
		$orderId = getOrderId($con);	
		$userId = getUserId($_SESSION['email'], $con);
		$price = calculatePrice($whereToOrder);
		
		$data = array('total' => $price, 'products' => $whereToOrder);
		$data = json_encode($data);
		
		$query = "INSERT INTO pendingOrders VALUES ('$orderId', '$userId', '$data')";	
		Fb::log($query, "inserting to db");
		$result = mysqli_query($con, $query);
		
		Fb::log($result, "result");
		
		
		
		echo "http://cs410.cs.ualberta.ca:42001/paybuddy/payment.cgi?grp=6&amt=$price&tx=$orderId&ret=http://cs410.cs.ualberta.ca:41061/receipt.php";
		
		closeDBConnection($con);
	}
	
	// returns the quantity of the item currently in stock
	function getQuantityFromDB($id, $con){
		$query =   "SELECT * FROM product WHERE pid='$id';";								
		$result = mysqli_query($con, $query) or die(" Query failed ");
		
		if($row = mysqli_fetch_array($result)) {
			$quantity = $row['quantity'];
			return $quantity;
		}
	}
	
	//returns a list of all stores that have the item and how much quantity they have of the item
	function getPossibleStores($id){
		$markets = getCurl("http://cs410-ta.cs.ualberta.ca/registration/markets");
		
		$stores = array();
		
		//add each market that contains the product
		foreach($markets['markets'] as $market){
			$mname = $market['name'];
			$murl = $market['url'];

			if ($mname == 'The Black Market' || $mname == 'TA Market') continue;		//dont buy from yourself

			$mproduct = getCurl($murl . '/products/' . $id);
			
			if (!isset($mproduct) || !isset($mproduct['quantity']) || $mproduct == "") continue;
			
			if ($mproduct['quantity'] > 0) {
				array_push($stores, array('url' => $murl, 'quantity' => $mproduct['quantity'], 'price' => $mproduct['price']));
			}
		}
		
		return $stores;
	}
	
	function getTotalQuantity($stores){
		$totalQ = 0;
		
		if (!isset($stores)) return 0;
		
		foreach($stores as $store){
			$totalQ += $store['quantity'];
		}
		
		return $totalQ;
	}
	
	function getCurl($url){
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$data = curl_exec($ch);
		curl_close($ch);
		
		return json_decode($data, true);
	}
	
	function sortStoreByPrice($item1,$item2){
		if ($item1['price'] == $item2['price']) return 0;
		return ($item1['price'] > $item2['price']) ? 1 : -1;
	}
	
	function getCartTotal($jsonArray){
		$total = 0;
		
		foreach ($jsonArray as $item){
			$total += $item['price'] * $item['quantity'];
		} 
	
		return $total;
	}
	
	function getOrderId($con){
		$query = "SELECT  (	SELECT COUNT(*)	FROM  pendingOrders) AS count1,	(SELECT COUNT(*) FROM userOrders) AS count2	FROM dual";
		    
        $result = mysqli_query($con, $query); Fb::log("grabbing row", "");
        $row = mysqli_fetch_assoc($result);
		$count = $row['count1'] + $row['count2'] + 1;

		return 'bmOrder_' . $count;
	}
	
	function getUserId($email, $con){
		$query= "SELECT * from user WHERE email='$email'";
		    
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
		
		return $row['userid'];
	}
	
	function calculatePrice($data){
		$totalPrice = 0;
		foreach($data as $product){
			foreach($product['sources'] as $source){
				$totalPrice += $source['quantity'] * $source['price'];
			}
		}
		
		return $totalPrice;
	}
	
?>