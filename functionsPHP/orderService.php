<?php
	session_start();
	
	include("dbConnection.php");
	include("ChromePhp.php");
	
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
			$qHave = getQuantityFromDB($id);
			
			$wtoItem = array('pid' => $id, 'sources' => array());
			
			// if we have the needed quantity, dont order from other stores
			if ($qHave >= $qNeed){
				
			}
		}
	}
	
	// returns the quantity of the item currently in stock
	function getQuantityFromDB($id){
		$query =   "SELECT * FROM product WHERE pid='$id';";								
		$result = mysqli_query($con, $query) or die(" Query failed ");
		
		if($row = mysqli_fetch_array($result)) {
			return $row['quantity'];
		}
	}
?>