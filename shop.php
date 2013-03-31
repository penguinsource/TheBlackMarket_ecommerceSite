<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php include("functionsPHP/generalFuncs.php"); ?>
<?php include("functionsPHP/shopFuncs.php"); ?>
<?php include("functionsPHP/dbConnection.php"); ?>
<?php 
	checkPage(); 
	$baseURL = "http://" . $_SERVER[HTTP_HOST] . "/";
?>
<html>

<head>
	<!--<style type="text/css">
		body{font-family: Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;}
	</style>-->
	<LINK REL=STYLESHEET HREF="<?= $baseURL; ?>design/shop.css" TYPE="text/CSS">
	<base href="//blackmarket5.hostei.com" />
	
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script  src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.15/jquery-ui.min.js"></script>
	<script  src="<?= $baseURL; ?>functionsJS/jquery.animate-colors.js"></script>
	<script >
		$(document).ready(function(){
			$('.menuitem').hover(function () {
				$(this).stop(true, true).addClass('menuhover', 100);
				$(this).addClass('menuhover', 250);
			},
			function () {
				$(this).stop(true, true).removeClass('menuhover', 100);
				$(this).removeClass('menuhover', 100);
			});
		});
	</script>
</head>

<body>

<?php
    $con = connectToDB();
    $category = $_GET["category"];
?>
</body>

<div class='main'>
	<div style="border-bottom: 1px solid;border-color: #E4E4E4;width:100%;height:40px;"> </div>
	
	<div style="position:relative;">
		<div class='sidemenu' id='sidemenu'>
			<?php printCategories($con, $category); ?>
		</div>
		
		<div class='body'>		
			<div class='product'>
				<img class='imgthumb' src='images/c000002.jpg'>
				<p class='product-name'><b>LG 6.3 Cu. Ft. Self-Clean Smooth Top Range</b></p>
				<p class='product-desc'>The LG LDF7551 is a quiet dishwasher, packed with cutting-edge features that make it convenient and easy to clean ... <a href='products/c000002'>[+]</a></p>
				<p class='product-price'>$5499.99 </p>
				
			</div>
			
			<div class='product'>
				<img class='imgthumb' src='images/c000001.jpg'>
				<p class='product-name'><b>LG Tall Tub Built-In Dishwasher</b></p>
				<p class='product-desc'>The LG LDF7551 is a quiet dishwasher, packed with cutting-edge features that make it convenient and easy to clean ... <a href='products/c000001'>[+]</a></p>
				<p class='product-price'>$10499.99 </p>
			</div>	
			
			
			<div class='product'>
				<img class='imgthumb' src='images/c000003.jpg'>
				<p class='product-name'><b>GE Profile 20.2 Cu. Ft. Bottom Mount Refrigerator</b></p>
				<p class='product-desc'>The LG LDF7551 is a quiet dishwasher, packed with cutting-edge features that make it convenient and easy to clean ... <a href='products/c000003'>[+]</a></p>
				<p class='product-price'>$4499.99 </p>
			</div>
			
			<div class='product'>
				<img class='imgthumb' src='images/c000004.jpg'>
				<p class='product-name'><b>LG WaveForce 5.4 Cu. Ft. Top Load HE Washer with H...</b></p>
				<p class='product-desc'>The LG LDF7551 is a quiet dishwasher, packed with cutting-edge features that make it convenient and easy to clean ... <a href='products/c000004'>[+]</a></p>
				<p class='product-price'>$3499.99 </p>
			</div>
		</div>
	</div>
</div>

</html>
