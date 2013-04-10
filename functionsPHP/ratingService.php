<?php

session_start();
include("dbConnection.php");
include("ChromePhp.php");

if (isset($_POST['rating'])){
	$rating = $_POST['rating'];
	$pid = $_POST['pid'];
	$con = connectToDB();
	$email = $_SESSION['email'];
	$userid = getUserId($email, $con);
	
	//check if rating exists for user
	$query =   "SELECT * FROM ratings WHERE userid='$userid';";								
	$result = mysqli_query($con, $query) or die($query);
	
	$ratingSum = 0;
	$ratingTotal = 1;
	
	//if rating exists, update it and the product total rating
	if($row = mysqli_fetch_array($result)) {
		$oldRating = $row['rating'];
		
		$query =   "UPDATE ratings SET rating='$rating' WHERE userid='$userid' AND pid='$pid';";								
		$result = mysqli_query($con, $query) or die($query);
		
		$query = "SELECT ratingSum, ratingCount FROM product WHERE pid='$pid';";								
		$result = mysqli_query($con, $query) or die($query);
		$row = mysqli_fetch_array($result);
		
		$ratingSum = $row['ratingSum'];
		$ratingTotal = $row['ratingCount'];
		
		$ratingSum = $ratingSum - $oldRating + $rating;
		
		$query =   "UPDATE product SET ratingSum='$ratingSum' WHERE pid='$pid';";								
		$result = mysqli_query($con, $query) or die($query);
	//else add new rating and update product rating
	} else {
		$query =   "INSERT INTO ratings VALUES ('$userid', '$pid' ,'$rating')";					
		$result = mysqli_query($con, $query) or die($query);
		
		$query = "SELECT ratingSum, ratingCount FROM product WHERE pid='$pid';";								
		$result = mysqli_query($con, $query) or die($query);
		$row = mysqli_fetch_array($result);
		
		$ratingSum = $row['ratingSum'];
		$ratingTotal = $row['ratingCount'];
		
		$ratingSum += $rating;
		$ratingTotal++;
		
		$query =   "UPDATE product SET ratingSum='$ratingSum', ratingCount='$ratingTotal' WHERE pid='$pid';";								
		$result = mysqli_query($con, $query) or die($query);
	}
	
	echo round($ratingSum/$ratingTotal);
}

function getUserId($email, $con){
	$query= "SELECT * from user WHERE email='$email'";
	//echo $query;
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_assoc($result)  or die($query);

	return $row['userid'];
}

?>