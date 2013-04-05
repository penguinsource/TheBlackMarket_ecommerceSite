<?php

function getUserInfo($userEmail){
	$con = connectToDB();		// open db connection
	$query = "SELECT * FROM user WHERE email = '$userEmail';";
	$result = mysqli_query($con, $query) or die("Query failed getting product details.");
	$row = mysqli_fetch_assoc($result);
	return $row;					// return array with all of user's info
	closeDBConnection($con);    // close the database connection
}

?>