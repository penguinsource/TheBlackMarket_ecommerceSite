<?php

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

function printPage($con){
    ChromePhp::log("start");
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
	
    $sqluserid = null;
    $sqlorderid = null;
    $data = null;    
    $sqlemail = null;
    
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
		echo "<p style='margin-left:30px;'>This order either does not exist or has already been processed.<p>";
		die();
	}
	
	//ORDER PROCESSING
	///////////////////////
	$totalPrice = $data['total'];
    $deliveryArray = array(date('Y-m-d', strtotime(date("Y-m-d") . ' + 1 day')));	
	
	//print table header
	echo "<div id='header'> Transaction Successful!</div>\n";
	echo "<p style='margin-left:30px;'>Here is your order summary:</p>";
	echo "<div style='margin-left:30px; margin-right:30px;overflow:hidden;'>\n";
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
        $pname = getProductName($pid, $con);
        
		$ptotalprice = 0;
        
		$counter = 0;
        echo "<div style='border-bottom: 1px solid #ECECEC;'>";
        
		//process each source of the product
		foreach($product['sources'] as $source){
			echo "<div class='item' style='width:100%;'>";
			
			$url = $source['url'];
			$quantity = $source['quantity'];
			$price = $source['price'];
			$name = $source['name'];
			$pquantity += $quantity;
            
            $ptotalprice += $quantity * $price;
			if ($counter == 0){
				echo "<span style='display:inline-block;padding-left:10px;width:50%'> $pname </span>";
			} else {
                echo "<span style='display:inline-block;padding-left:10px;width:50%'>  </span>";
            }
            
            $totalprice = $price * $quantity;
            
            echo "<span style='display:inline-block;width:23%'> $name </span>\n";
			echo "<span style='display:inline-block;width:10%'> x$quantity </span>\n";
			echo "<span style='display:inline-block;width:14%'> $$totalprice ($$price ea.) </span>\n";
			
			//if store is black market, subtract quantity
			if ($name == "The Black Market"){
				$query = "SELECT * FROM product WHERE pid='$pid'";		    
				$result = mysqli_query($con, $query);
				$row = mysqli_fetch_assoc($result);
				$currentQuantity = $row['quantity'];
				$newQuantity = $currentQuantity - $quantity;
				
				$query = "UPDATE product SET quantity='$newQuantity' WHERE pid='$pid'";
				$result = mysqli_query($con, $query);

			//else must order from other store(s)
			} else {
				$response = curlPost($url . "/products/" . $pid . "/order", $quantity);
                $response = json_decode($response, true);
				$storeDate = $response['delivery_date'];
                echo $storeDate . "\n";
                $storeId = $response['order_id'];
				
				//add date to arrauy
				array_push($deliveryArray, $storeDate);
				
				//log product source
				$query = "INSERT INTO orderSources VALUES ('$sqlorderid', '$storeId', '$url', '$pid', '$quantity', '$name')";	
				$result = mysqli_query($con, $query);
			}

			echo "</div>\n";
			$counter++;
		}
		
        echo "</div>\n";
        
		//log quantity in productOrders
		$query = "INSERT INTO productOrders VALUES ('$sqlorderid', '$pid', '$quantity', '$ptotalprice')";	
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
function getProductName($id, $con){
    $query= "SELECT * from product WHERE pid='$id'";
		
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_assoc($result);
	
	return $row['pname'];
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