<?php

function getProductInfo($con, $prodID){
	$query = "SELECT * FROM product WHERE pid = '$prodID';";
	$result = mysqli_query($con, $query) or die("Query failed getting product details.");
	return mysqli_fetch_assoc($result);
}

function getCategoryName($con, $categoryid){
	$query = "SELECT name FROM category WHERE id = '$categoryid';";
	$result = mysqli_query($con, $query) or die("Query failed getting product details.");
	$row = mysqli_fetch_array($result);
	echo $row[0];
}

?>