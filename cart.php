<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php include_once("functionsPHP/generalFuncs.php"); ?>
<?php include_once("functionsPHP/shopFuncs.php"); ?>
<?php include_once("functionsPHP/dbConnection.php"); ?>
<?php include_once("functionsPHP/ChromePhp.php"); ?>
<?php 
	checkPage(); 
	$baseURL = "http://" . $_SERVER['HTTP_HOST'] . "/";

	$con = connectToDB();
?>
<html>

<head>
	<!--<style type="text/css">
		body{font-family: Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;}
	</style>-->
	<LINK REL=STYLESHEET HREF="<?= $baseURL; ?>design/cart.css" TYPE="text/CSS">
    <link href='http://fonts.googleapis.com/css?family=Noto+Sans|Tauri|Economica|Istok+Web|Monda|Merriweather+Sans|Share+Tech+Mono|Roboto+Condensed|Oxygen|Maven+Pro' rel='stylesheet' type='text/css'>
	<base href="//blackmarket5.hostei.com" />
	
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.15/jquery-ui.min.js"></script>
	<script src="<?= $baseURL; ?>functionsJS/jquery.animate-colors.js"></script>
	<script src="<?= $baseURL; ?>functionsJS/shop.js"></script>
	<script src="<?= $baseURL; ?>functionsJS/generalFuncs.js"></script>
	
	<link rel="icon" type="image/png" href="<?= $baseURL; ?>design/images/favicon.png">
	<title> Cart </title>
</head>

<body>


</body>

<div class='mainmenu'>
	<div id='menulogo'>
		<a href='/index'>
			<img valign='center' class='activelogo' src='/design/images/logo1-small.png'>
			<img valign='center' src='/design/images/logo2-small.png'>
		</a>
	</div>
	
	<div class='menulinks'>
		<div class='menulink'> <a href='/index'>HOME</a> </div>
		<div class='menulink'> <a href='/shop'>SHOP</a> </div>
		<div class='menulink'> <a href='/about'>ABOUT</a> </div>
		<div class='menulink'> <a href='/help'>HELP</a> </div>
		<div class='menulink'> <a href='/faq'>FAQ</a> </div>
	</div>
	
	<div id='userStuff'>
		<div id='shoppingCart'>
			<a href='/cart'>Shopping Cart (<?= checkCart(); ?>)</a>
		</div>
	</div>
	
	<div class='blueline'> </div>
</div>

<div class='main'>
	<div style="border-bottom: 1px solid;border-color: #E4E4E4;width:100%;height:40px;"> </div>
	
	<div style="position:relative;">
		
		<div class='body'>		
			<div id='cart-header'>
				   
			</div>
		</div>
		
	</div>
</div>

<?php closeDBConnection($con);?>

</html>
