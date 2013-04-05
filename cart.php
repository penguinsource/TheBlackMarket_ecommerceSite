<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php include_once("functionsPHP/generalFuncs.php"); ?>
<?php include_once("functionsPHP/cartFuncs.php"); ?>
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
	<LINK REL=STYLESHEET HREF="<?= $baseURL; ?>design/mainmenu.css" TYPE="text/CSS">
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
		<div style="position:relative;">
			
			<div class='body'>		
				<div id='cart-header'>
					<span style='display:inline-block;width:68%;'> </span>   
					<span style='display:inline-block;width:8%;text-align:center;'>Qty</span>   
					<span style='display:inline-block;width:14%;text-align:center;'>Price</span>   
					<span style='display:inline-block;width:8%;text-align:center;'>Remove</span>   
				</div>
				
				<?php printCartItems(); ?>
				
				<!--<div id='cart-item-c0000001' class='cart-item'>
					<div class='cart-item-product'>
						<a href='/product/dishwashers/c000001'> <img src='images/c000001.jpg'></img> <div style='margin-left:20px;display:inline-block;'>Breville Cafe Roma Espresso Machine</div> </a>
					</div> </a>
					
					<div align='center' class='cart-item-quantity'>
						<input type='text' id='quantity-c000001'></input>
					</div>
					
					<div align='center' class='cart-item-price'> $599.99 </div>
					
					<div align='center' class='cart-item-remove' > <input type='image' src='/design/images/redx.png' onClick='removeFromCart("c000001");' width='20px'>	</div>
				</div>
				
				<div id='cart-total'> Total: <span id='cart-total-price'>$1099.99</span> </div>-->
				
				<br><br><br><br><br><div style="float:right"><a href='/shop'><button> Continue Shopping </button></a> <a href='/order'><button> Checkout Cart </button></a></div><br><br><br>
				
			</div>
			
		</div>
	</div>

</body>

<?php closeDBConnection($con);?>

</html>
