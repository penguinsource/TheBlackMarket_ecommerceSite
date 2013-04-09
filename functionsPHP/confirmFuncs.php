<?php

function printPage($con){
	if (!isset($_SESSION['email']) || !isset($_GET['auth']) || !isset($_GET['tx'])){
		header('Location: shop');
		die();
	}
	
	$auth = $_GET['auth'];
	$orderid = $_GET['tx'];
	
	
	$query = "SELECT * FROM pendingOrders WHERE orderid='$orderid'";
		
	$result = mysqli_query($con, $query); Fb::log("grabbing row", "");
	if($row = mysqli_fetch_array($result)) {	
		$sqluserid = $row['id'];
		$sqlorderid = $row['orderid'];
	} else {
		header('Location: shop');
		die();
	}
}

?>