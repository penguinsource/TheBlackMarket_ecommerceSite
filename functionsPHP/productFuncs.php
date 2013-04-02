<?php

function printProduct($con, $prodID){
	$query = "SELECT * FROM product WHERE pid = '$prodID';";
	$result = mysqli_query($con, $query) or die("Query failed getting product details.");
	$row = mysqli_fetch_array($result);
	echo "Category: " . $row[1] . "<br>";
	echo "Description: " . $row[3] . "<br>";
	echo "Image url: " . $row[4] . "<br>";
	echo "Price: " . $row[5] . "<br>";
	echo "Quantity Available: " . $row[6] . "<br>";
}

?>