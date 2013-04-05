<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){	//hande POST
	$fname = '';
	$lname = '';
	$city = '';
	$postal = '';
	$address = '';
	$phone = '';
	if (isset($_POST['fname'])){
		$fname = $_POST['fname'];
	}
	if (isset($_POST['lname'])){
		$fname = $_POST['lname'];
	}
	if (isset($_POST['city'])){
		$fname = $_POST['city'];
	}
	if (isset($_POST['postal'])){
		$fname = $_POST['postal'];
	}
	if (isset($_POST['address'])){
		$fname = $_POST['address'];
	}
	if (isset($_POST['phone'])){
		$fname = $_POST['phone'];
	}
	
	$queryInsert = "UPDATE user SET firstname = '$fname', lastname = '$lname', city = '$city', postal = '$postal', address = '$address', phone = '$address' WHERE email = '$_SESSION['email']'";
    mysqli_query($con, $queryInsert);
}

?>
