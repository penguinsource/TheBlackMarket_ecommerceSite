<?php
	session_start();

	include('dbConnection.php');
	include('adminFuncs.php');

	$con = connectToDB();

	$opt = isset($_POST["opt"]) ? $_POST["opt"] : null;	
	$from = isset($_POST["from"]) ? $_POST["from"] : null;
	$to = isset($_POST["to"]) ? $_POST["to"] : null;

	printStats($con, $opt, $from, $to);

	closeDBConnection($con);
?>