<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php include_once("functionsPHP/generalFuncs.php"); ?>
<?php include_once("functionsPHP/cartFuncs.php"); ?>
<?php include_once("functionsPHP/dbConnection.php"); ?>
<?php include_once("functionsPHP/ChromePhp.php"); ?>
<?php 
	checkPage(); 
	$con = connectToDB();
?>
<html>

<head>
	<?php echo $GLOBALS['basehref']; // print the site's base href?>
	<!--<style type="text/css">
		body{font-family: Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;}
	</style>-->
	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/cart.css" TYPE="text/CSS">
	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/mainmenu.css" TYPE="text/CSS">
    <link href='http://fonts.googleapis.com/css?family=Noto+Sans|Tauri|Economica|Istok+Web|Monda|Merriweather+Sans|Share+Tech+Mono|Roboto+Condensed|Oxygen|Maven+Pro' rel='stylesheet' type='text/css'>
	
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.15/jquery-ui.min.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/jquery.animate-colors.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/generalFuncs.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/menuFuncs.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/order.js"></script>
	
	<link rel="icon" type="image/png" href="<?= $GLOBALS['baseURL']; ?>design/images/favicon.png">
	<title> Cart </title>
</head>

<body>

	<?php printMenu(); ?>
	<div id='page-alert'></div>
	<div class='main'>		
		<div style="position:relative;">
			
			<div class='body'>		
				<div id='cart-header'>
					<span style='display:inline-block;width:68%;'> </span>   
					<span style='display:inline-block;width:8%;text-align:center;'>Qty</span>   
					<span style='display:inline-block;width:14%;text-align:center;'>Price</span>   
					<span style='display:inline-block;width:8%;text-align:center;'>Remove</span>   
				</div>
				
				<?php printCartItems(); ?>
				
				<br><br><br><br><br><div style="float:right"><a href='<?php echo $_SERVER['HTTP_REFERER']; ?>'><button> Continue Shopping </button></a> <button onClick='checkUserLoggedIn();'> Checkout Cart </button></a></div><br><br><br>
				
			</div>
			
		</div>
	</div>

</body>

<?php closeDBConnection($con);?>

</html>
