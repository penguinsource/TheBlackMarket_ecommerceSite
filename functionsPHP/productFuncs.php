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

function getRatingStars($userBought, $con, $pid){
    $rating = getRatingP($con, $pid);
    $ratingString = "";

    $aopen = ($userBought) ? "<a href='javascript:void(0)'>" : "";
    $aclose = ($userBought) ? "<a>" : "";
    
    $j = 0;
    // print full stars
    for ($j = 0; $j < $rating; $j++){
        $ratingString = $ratingString . $aopen . "<img class='star' id='star" . $j . "' src='design/images/star.png'>" . $aclose;
    }
    
    //print empty stars
    for ($k = $j; $k < 5; $k++){
        $ratingString = $ratingString . $aopen . "<img class='star' id='star" . $k . "' src='design/images/starempty.png'>" . $aclose;
    }

    if ($userBought){
        echo "<span style='font-size:10'>Rate this product</span> ";
    } else {
        echo "<span style='font-size:10'>Buy to rate</span> ";
    }
    echo "<div class='product-rating'>";
		echo $ratingString;
	echo "</div>";
}

function getRatingP($con, $pid){
	$query = "SELECT ratingSum, ratingCount FROM product WHERE pid='$pid';";	
	$result = mysqli_query($con, $query) or die(" Query failed ");
	$row = mysqli_fetch_array($result);
	
	$ratingSum = $row['ratingSum'];
	$ratingTotal = $row['ratingCount'];
	
	if ($ratingTotal == 0) return 0;
	
	return round($ratingSum/$ratingTotal);
}

function userBought($pid, $con){
    if (!isset($_SESSION['email'])) return false;
    $uid = getUserId($_SESSION['email'], $con);
    
    $query = "SELECT * FROM userOrders, productOrders WHERE userid='$uid' AND pid='$pid'";
    //echo $query;
	$result = mysqli_query($con, $query) or die("Query failed getting product details.");
    //echo mysqli_num_rows($result);
	return (mysqli_num_rows($result) > 0) ? true : false;
}

function getUserId($email, $con){
	$query= "SELECT * from user WHERE email='$email'";
    //echo $query;
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_assoc($result)  or die("Query failed getting product details.");
	
	return $row['userid'];
}
?>
