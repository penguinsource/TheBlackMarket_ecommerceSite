<?php

/*
A method that gets the status of an order, given the 'orderid'.  It should return the old date or a new "delayed" date.

POST /orders/:id
return = {
  "delivery_date": "2013-01-01"
}
*/

include("../functionsPHP/dbConnection.php");

if (isset($_GET["id"])){
    //echo "id=".$_GET["id"];
	returnDeliveryDate($_GET["id"]);
} else{
    // wrong call / 404 page..
}

function returnDeliveryDate($orderID){
	$con = connectToDB();	// open db connection
	// query to get the delivery date given the order id
	$query = "SELECT delivery_date FROM userOrders WHERE orderid = '$orderID'";
    $result = mysqli_query($con,$query);	        // query db
    $row = mysqli_fetch_row($result);
    $deliveryDate = $row[0];
	
	// build an array, json encode it, send it as response
	$retObject = array();
	$retObject['delivery_date'] = $deliveryDate;
	$json = json_encode($retObject); // encode the json and send it back.
    echo $json;
	
	closeDBConnection($con);	// close db connection
}

?>
