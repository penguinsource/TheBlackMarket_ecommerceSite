<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php include("functionsPHP/generalFuncs.php"); ?>
<?php include("functionsPHP/shopFuncs.php"); ?>
<?php include("functionsPHP/dbConnection.php"); ?>
<?php 
	checkPage(); 
	$baseURL = "http://" . $_SERVER['HTTP_HOST'] . "/";
?>
<html>

<head>
	<!--<style type="text/css">
		body{font-family: Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;}
	</style>-->
	<LINK REL=STYLESHEET HREF="<?= $baseURL; ?>design/shop.css" TYPE="text/CSS">
	<base href="//blackmarket5.hostei.com" />
	
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.15/jquery-ui.min.js"></script>
	<script src="<?= $baseURL; ?>functionsJS/jquery.animate-colors.js"></script>
	<script src="<?= $baseURL; ?>functionsJS/shop.js"></script>
	
	<link rel="icon" type="image/png" href="<?= $baseURL; ?>design/images/favicon.png">
</head>

<body>

<?php
    $con = connectToDB();
	if (isset($_GET["category"])){	
		$category = $_GET["category"];
	} else {
		$category = null;
	}
?>
</body>

<div class='mainmenu'>
	<div style='border-right:1px;border-color:#E4E4E4;display:inline-block;'>
		<a href='/index'><img valign='center' class='menulogo' src='/design/images/logo2.png'></a>
	</div>
	
	<div class='menulinks'>
		<div class='menulink'> <a href='/index'>HOME</a> </div>
		<div class='menulink'> <a href='/shop'>SHOP</a> </div>
		<div class='menulink'> <a href='/about'>ABOUT</a> </div>
		<div class='menulink'> <a href='/help'>HELP</a> </div>
		<div class='menulink'> <a href='/faq'>FAQ</a> </div>
	</div>
	
	<div class='blueline'> </div>
</div>

<div class='main'>
	<div style="border-bottom: 1px solid;border-color: #E4E4E4;width:100%;height:40px;"> </div>
	
	<div style="position:relative;">
		<div class='sidemenu' id='sidemenu'>
			<?php printCategories($con, $category); ?>
		</div>
		
		<div class='body'>		
		
			<?php printProducts($con, $category); ?>
		
			<!--<div class='product product-rightborder'>
				<a href='products/c000002'> <img class='imgthumb' src='images/c000002.jpg'>
				<p class='product-name'><b>LG 6.3 Cu. Ft. Self-Clean Smooth Top Range</b></p> </a>
				<p class='product-desc'>The LG LDF7551 is a quiet dishwasher, packed with cutting-edge features that make it convenient and easy to clean ... <a href='products/c000002'>[+]</a></p>
				<div class='product-rating'>
					<img src='design/star.png'><img src='design/starempty.png'><img src='design/starempty.png'><img src='design/starempty.png'><img src='design/starempty.png'>
				</div>
				<div class='product-price'>$5499.99 </div>
				<div class='product-stock'>In Stock: 10 <a href='somecartlinkiunno'><div class='testbutton'> Add to Cart</div></div></a>
				
			</div>-->
			
		</div>
	</div>
</div>

<?php closeDBConnection($con);?>

</html>
