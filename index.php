<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<?php include("functionsPHP/generalFuncs.php"); ?>
<?php include("functionsPHP/dbConnection.php"); ?>
<?php checkPage(); ?>
<html>
  
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <link href="design.css" rel="Stylesheet" type="text/css">
  <script type="text/javascript" src="functionsJS/index.js"></script>
</head>

<body>

<p>Register</p>
    <input type="text" name="registerEmail" id="registerEmail">
    <input type="text" name="registerPass" id="registerPass">
    <button onClick="authenticate('register')" name='registerBtn'>Register</button>
<p>Login</p>
    <input type="text" name="loginEmail" id="loginEmail">
    <input type="password" name="loginPass" id="loginPass">
    <button onClick="authenticate('login')" name='loginBtn'>Login</button>
    <br>
	<button onClick="authenticate('logout')" name='logoutBtn' id='logoutBtn' class='visible'>Logout</button>

<div name="categoryName" id="categoryName" class="hidden"></div>
<p><a href="shop.php?category=dishwashers">Dishwashers</a></p>
<p><a href="http://localhost/TheBlackMarket_ecommerceSite/shop.php?category=dishwashers">Dishwashers local</a></p>
<p><a href="http://localhost/TheBlackMarket_ecommerceSite/api/items">Test the Rest</a></p>
<p><a href="http://localhost/TheBlackMarket_ecommerceSite/api/items/1">Test the Rest 2</a></p>
<p><a href="http://localhost/TheBlackMarket_ecommerceSite/api/hey.php">Test the Rest 2</a></p>

<button onClick="checkMarkets()" name="markets" class="visible">Markets !</button>

<p> login: buddy@yahoo.com / pass: buddy@yahoo.com
<hr>

<?php // check if any user is logged in
	if (isset($_SESSION["email"])){
		echo "<div id='userLoggedIn'>Logged in :".$_SESSION["email"]."</div>";
	} else {
		echo "<div id='userLoggedIn'>Logged in : Nobody is logged in.. </div>";
	}
?>

<?php

//curl -X POST -d '{"name":"Name for your market","url":"http://cs410-XX.cs.ualberta.ca/yourapipath"}'
//http://cs410.cs.ualberta.ca:42001/registration/markets --header "Content-Type:application/json";

/*$url = "http://localhost/TheBlackMarket_ecommerceSite/productPage/3322";
$response = file_get_contents($url);
echo $response;

//-------------------------------------------------------

    require_once "libraries/tonic-master/src/Tonic/Autoloader.php";

    $app = new Tonic\Application();
    $request = new Tonic\Request();

    require_once 'example.php';

    $resource = $app->getResource($request);
    $response = $resource->exec();
    $response->output();*/
?>


<br>


</body>

</html>
