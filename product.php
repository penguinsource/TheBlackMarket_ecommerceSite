<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php include("functionsPHP/generalFuncs.php"); ?>
<?php include("functionsPHP/shopFuncs.php"); ?>
<?php include("functionsPHP/productFuncs.php"); ?>
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
	<!--<LINK REL=STYLESHEET HREF="<?= $baseURL; ?>design/shop.css" TYPE="text/CSS">
	<LINK REL=STYLESHEET HREF="<?= $baseURL; ?>design/product.css" TYPE="text/CSS"> -->
	 <LINK REL=STYLESHEET HREF="http://localhost/TheBlackMarket_ecommerceSite/design/shop.css" TYPE="text/CSS">
	<LINK REL=STYLESHEET HREF="http://localhost/TheBlackMarket_ecommerceSite/design/product.css" TYPE="text/CSS">
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
	if (isset($_GET["productID"])){
		$productID = $_GET["productID"];
	}else {
		echo "No product id sent";
	}
	if (isset($_GET["category"])){
		$category = $_GET["category"];
	}else {
		echo "No category sent";
	}
?>

</body>

<div class='main'>
	<div style="border-bottom: 1px solid;border-color: #E4E4E4;width:100%;height:40px;"> </div>
	
	<div style="position:relative;">
		<div class='sidemenu' id='sidemenu'>
			<?php printCategories($con, $category); ?>
			<?php //printProduct($con, $productID); ?>
		</div>

		<div class="productWrapper">
			<div class="productName">LG 6.3 Cu. Ft. Self-Clean Smooth Top Range <br> <span class="categoryText">Dishwashers</span></div>
			<div class="productContent">
				<div class="subtitleText">Product Description</div>
				<p class="productText">
					some product descrip tion some product descrip tion some product descrip tion some product descrip tion some product descrip tion 
					some product descrip tion some product descrip tion some product descrip tion
				</p>
				<div class="subtitleText">Product Details</div>
				<p class="productText">
					Width: <br>
					Height: <br>
					Weights: <br>
					
				</p>
			</div>
			
			<img class='productImage' src='images/c000002.jpg'>
			<div class="productImageInfo">
				<span class="floatLefty">In-stock: 10</span> 
				<span class="floatRighty"><a href='somecartlinkiunno'><div class='testbutton'> Add to Cart</div></a></span>
			</div>
			
			<div class="reviewsContent">Reviawe fawe a..</div>
			<div class="reviewsContent">Reviews..		</div>
			
			<div class="commentsContent">
				<div class="commentLayout">
					<img class="commentUserLogo" src="BM_LOGO">
				</div>
			</div>
			
			<br><br>
			<p>hello</p>
			
		</div>
	</div> 
	

</div>



</html>
