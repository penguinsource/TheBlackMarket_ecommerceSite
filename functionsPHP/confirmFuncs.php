<?php

function printPage($con){
	// redirect if not logged in or no get params
	if (!isset($_SESSION['email'])){
		//header('Location: shop');
		echo "<div id='header'> Prohibited Access</div><br>\n";
		echo "<p>You must be logged in to view this page.<p>";
		die();
	}
	
	if (!isset($_GET['auth']) || !isset($_GET['tx'])){
		echo "<div id='header'> Unauthorized Access</div><br>\n";
		echo "<p>Invalid authorization token or order id.<p>";
		die();
	}
	
	$auth = $_GET['auth'];
	$orderid = $_GET['tx'];
	$email = $_SESSION['email'];
	
	$query = "SELECT * FROM pendingOrders WHERE orderid='$orderid'";
		
	$result = mysqli_query($con, $query);
	
	//redirect if orderif doesnt exist in pending orders, or logged in user doesnt match user of the order
	if($row = mysqli_fetch_array($result)) {	
		$sqluserid = $row['userid'];
		$sqlorderid = $row['orderid'];
		$data = json_decode($row['data'], true);
		
		$sqlemail = getUserEmail($sqluserid, $con);
		
		if ($sqlemail != $email){
			//header('Location: shop');
			echo "<div id='header'> Restricted Access</div>\n";
			echo "<p style='margin-left: 30px;'>This order was placed with a different account.<p>";
			die();
		}		
	} else {
		//header('Location: shop');
		echo "<div id='header'> Invalid Order</div><br>\n";
		echo "<p>This order either does not exist or has already been processed.<p>";
		die();
	}
	
	//ORDER PROCESSING
	///////////////////////
	$totalPrice = $data['total'];
    $deliveryArray = array(date('Y-m-d', strtotime(date("Y-m-d") . ' + 1 day')));	
	
	//print table header
	echo "<div id='header'> Transaction Successful!</div><br>\n";
	echo "<p>Here is your order summary.<p>";
	echo "<div style='margin-left:30px; margin-right:30px;overflow:auto;'>\n";
	echo "<div id='cart'>\n";
	echo "<div id='sub-header'> 
			<span style='display:inline-block;padding-left:10px;width:50%'> Product Name </span>
			<span style='display:inline-block;width:23%'> Store Purchased </span>
			<span style='display:inline-block;width:12%'> Quantity </span>
			<span style='display:inline-block;width:12%'> Price </span>
		</div>\n";
	
	foreach($data['products'] as $product){
		$pid = $product['pid'];
		$pquantity = 0;
		
		$counter = 0;
		//process each source of the product
		foreach($product['sources'] as $source){
			echo "<div style='width:100%;'>";
			
			$url = $source['url'];
			$quantity = $source['quantity'];
			$price = $source['price'];
			$name = $source['name'];
			
			$pquantity += $quantity;
			if ($counter == 0){
				echo "<span style='display:inline-block;padding-left:10px;width:50%'> Product Name </span>";
			}
			
			//if store is black market, subtract quantity
			if ($name == "The Black Market"){
				$query = "SELECT * FROM product WHERE pid='$pid'";		    
				$result = mysqli_query($con, $query);
				$row = mysqli_fetch_assoc($result);
				$currentQuantity = $row['quantity'];
				$newQuantity = $currentQuantity - $quantity;
				
				$query = "UPDATE product SET quantity = '$newQuantity' WHERE id = '$sqluserid'";
				mysqli_query($con, $query);
			//else must order from other store(s)
			} else {
				$response = curlPost($url . "/products/" . $pid . "/order");
				$storeDate = $response['delivey_date'];
				$storeId = $response['order_id'];
				
				//add date to arrauy
				array_push($deliveryArray, $storeDate);
				
				//log product source
				$query = "INSERT INTO orderSources VALUES ('$sqlorderid', '$storeId, '$url', '$pid', '$quantity', '$name')";	
				$result = mysqli_query($con, $query);
			}

			echo "</div>\n";
			$counter++;
		}
		
		//log quantity in productOrders
		$query = "INSERT INTO productOrders VALUES ('$sqlorderid', '$pid, '$quantity')";	
		$result = mysqli_query($con, $query);
		
	}
	
	echo "</div></div>\n";
	//log data in userOrders table
	$deliveryDate = getMaxDate($deliveryArray);
	$query = "INSERT INTO userOrders VALUES ('$sqlorderid', '$sqluserid', '$deliveryDate')";	
	$result = mysqli_query($con, $query);
	
	//delete from pending orders
	$query = "DELETE FROM pendingOrders WHERE orderid='$sqlorderid'";	
	$result = mysqli_query($con, $query);
	
	
}

function getUserEmail($id, $con){
	$query= "SELECT * from user WHERE userid='$id'";
		
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_assoc($result);
	
	return $row['email'];
}


// MAKE THIS FUNCTION ?????????????????????????????????????/////////
function getProductName($if, $con){

}

function getMaxDate($array){
	$oldest = $array[0];
	
	foreach($array as $date){
		if ($date > $oldest) $oldest = $date;
	}
	
	return $date;
}

function curlPost($url, $quantity){
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, true);

	$data = array(
		'amount' => $quantity
	);

	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	$output = curl_exec($ch);
	curl_close($ch);
	
	return $output;
}

?>