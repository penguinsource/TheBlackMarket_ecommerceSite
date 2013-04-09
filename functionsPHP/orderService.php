<?php
	session_start();
	
	include("dbConnection.php");
	include("ChromePhp.php");
	require_once('lib/fb.php');
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$con = connectToDB();
		$cartJSON = json_decode($_SESSION['cart'], true);
		
		// JSON to hold data on where to get each product
		$whereToOrder = array();
		
		// figure out where to buy each product, return if quantity doesn't exist for one of them
		foreach ($cartJSON['products'] as $item){
			$id = $item['id'];
			$name = $item['name'];
			$qNeed = $item['quantity'];
			$qHave = 0;// getQuantityFromDB($id, $con);
			
			$wtoItem = array('pid' => $id,'sources' => array());
			
			// if we have the needed quantity, dont order from other stores
			if ($qHave >= $qNeed){
				array_push($wtoItem['sources'], array('url'=>'home', 'quantity' => $qNeed));
				array_push($whereToOrder, $wtoItem);
			//else compile a list of stores and how much quantity to buy from them
			} else {
				//add our store as the first if we have any quantity
				$myStore = null;
				if ($qHave != 0){
					$myStore = array('url'=>'home', 'quantity' => $qNeed);
				}
				
				//get list of all stores that have the item with quantity greater than 0
				$stores = getPossibleStores($id);
			}
		}
		
		$temp = json_encode($whereToOrder);
		ChromePhp::log($temp);
		
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
		FB::log($market, "markets");
	}
	
	function getCurl($url){
		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);

		//execute post
		$result = curl_exec($ch);

		//close connection
		curl_close($ch);
		
		return json_decode($result, true);
	}
	
?>