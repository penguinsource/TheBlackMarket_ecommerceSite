<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<?php include("functionsPHP/generalFuncs.php"); ?>
<?php include("functionsPHP/dbConnection.php"); ?>
<?php checkPage(); ?>
<html>
  
<head>
  <?php echo $GLOBALS['basehref']; // print the site's base href?>
  
 
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
	<?php //phpinfo(); ?>
<?php //echo "PREVIOUS PAGE: ".$_SERVER['HTTP_REFERER'];?>

<div name="categoryName" id="categoryName" class="hidden"></div>
<p><a href="shop.php?category=dishwashers">Dishwashers</a></p>
<p><a href="http://localhost/TheBlackMarket_ecommerceSite/shop.php?category=dishwashers">Dishwashers local</a></p>
<p><a href="http://localhost/TheBlackMarket_ecommerceSite/api/items">Test the Rest</a></p>
<p><a href="http://localhost/TheBlackMarket_ecommerceSite/api/items/1">Test the Rest 2</a></p>
<p><a href="http://localhost/TheBlackMarket_ecommerceSite/api/hey.php">Test the Rest 2</a></p>
<p><a href="http://localhost/TheBlackMarket_ecommerceSite/shop.php">Shop</a></p>
<p><a href="http://localhost/TheBlackMarket_ecommerceSite/product.php/?category=Dishwashers&productID=c000001">Product page, category dishwashers and pid c000001</a></p>
<p><a href="product.php/?category=Dishwashers&productID=c000001">Product page, category dishwashers and pid c000001</a></p>

<p><a href="http://localhost/TheBlackMarket_ecommerceSite/user_profile.php/userid">user profile page</a></p>

<!-- <form action="http://cs410.cs.ualberta.ca:41981/products/c000003/order" method="POST"> 
<form action="http://localhost/bm/api/products.php?id=c000001&order=1" method="POST">  
<form action="http://localhost/TheBlackMarket_ecommerceSite/api/products.php?id=c000001&order=1" method="POST"> 
<form action="http://localhost/TheBlackMarket_ecommerceSite/api/orders.php?id=bmOrder_1" method="POST"> -->

<p>Sending order for product c000001 with url: "api/products/c000001/order"</p>
<form action="api/products/c000001/order" method="POST">
    <input name="amount" value='1'></input>
    <button>POST short path</button>
</form>

<p>Sending order for product c000001 with url: "api/products.php?id=c000001&order=1"</p>
<form action="api/products.php?id=c000001&order=1" method="POST">
    <input name="amount" value='1'></input>
    <!-- <input name="order" value='9'></input> -->
    <button>POST full path</button>
</form>

<button onClick="checkMarkets()" name="markets" class="visible">Markets !</button>
<?php
echo '<xmp>';
print_r($_SERVER);
echo '</xmp>';
?>
<p> aaaaalogin: buddy@yahoo.com / pass: buddy@yahoo.com
<hr>

<?php // check if any user is logged in
	if (isset($_SESSION["email"])){
		echo "<div id='userLoggedIn'>Logged in :".$_SESSION["email"]."</div>";
	} else {
		echo "<div id='userLoggedIn'>Logged in : Nobody is logged in.. </div>";
	}
?>



<a href="http://cs410.cs.ualberta.ca:42001/paybuddy/payment.cgi?grp=06&amt=12.00&tx=bmOrder01&ret=http://localhost/bm/blah.php"
   target="_blank">
    SEND TO PAYBUDDY !</a>


<?php
echo "server: " . "http://" . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"] . "configLocal.ini";
echo " HTTP_HOST: " . $_SERVER['HTTP_HOST'];
echo " REQUEST_URI: " . $_SERVER['REQUEST_URI'];


// echo "connect to db:";
// $con = connectToDB();



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
