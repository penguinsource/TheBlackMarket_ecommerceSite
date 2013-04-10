<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php include("functionsPHP/generalFuncs.php"); ?>
<?php include("functionsPHP/shopFuncs.php"); ?>
<?php include("functionsPHP/productFuncs.php"); ?>
<?php include("functionsPHP/dbConnection.php"); ?>
<?php 
	checkPage(); 
?>
<html>

<head>
	<?php echo $GLOBALS['basehref']; // print the site's base href?>
	<!--<style type="text/css">
		body{font-family: Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;}
	</style>-->

	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/shop.css" TYPE="text/CSS">
	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/product.css" TYPE="text/CSS">
	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/mainmenu.css" TYPE="text/CSS">
	<link href='http://fonts.googleapis.com/css?family=Noto+Sans|Tauri|Economica|Istok+Web|Monda|Merriweather+Sans|Share+Tech+Mono|Roboto+Condensed|Oxygen|Maven+Pro' rel='stylesheet' type='text/css'>
	
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script  src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.15/jquery-ui.min.js"></script>
	<script  src="<?= $GLOBALS['baseURL']; ?>functionsJS/jquery.animate-colors.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/generalFuncs.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/menuFuncs.js"></script>

    
    <?php
		echo "<script> var pid = '".$_GET['productID']."';</script>";
        $con = connectToDB();
        if (isset($_GET["productID"])){
            $productID = $_GET["productID"];
            $product = getProductInfo($con, $productID);
        }else {
            echo "No product id sent";
        }
    
        $userbought = userBought($productID, $con);
    
        if ($userbought){
            echo "<script src=\"" . $GLOBALS['baseURL'] . "functionsJS/product.js\"></script>";
        }    
       
    ?>
        
	
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
	if (isset($_GET["category"])){
		$category = $_GET["category"];
	}else {
		echo "No category sent";
	}
	
	printMenu();
?>

<div class='main'>
	<div style="border-bottom: 1px solid;border-color: #E4E4E4;width:100%;height:40px;"> </div>
	
	<div style="position:relative;">
		<div class='sidemenu' id='sidemenu'>
			<?php printCategories($con, $category); ?>
			
		</div>
		
		<div class="productWrapper">
			<!-- <div class="productName">LG 6.3 Cu. Ft. Self-Clean Smooth Top Range <br> <span class="categoryText">Dishwashers</span> -->
			<div class="productName"><?php echo $product['pname']; ?> <br> <span class="categoryText"><?php echo getCategoryName($con, $product['pcategory']); ?></span>
				<span class="productRatingPrice">
					<?php getRatingStars($userbought, $con, $pid); ?> 
					
					<span class="price">$<?php echo $product['price']; ?></span> 
				</span>
			</div>
			<div class="productContent">
				<div class="subtitleText">Product Description</div>
				<p class="productText">
					<?php echo $product['pdesc']; ?>
				</p>
				<div class="subtitleText">Product Details</div>
				<p class="productText">
					Dimensions: <?php echo $product['dim']; ?> feet<br>
					Weights: <?php echo $product['weight']; ?> lbs <br>
					
				</p>
			</div>
			
			<div class="imageWrapper">
				<img class='productImage' src='<?php echo $baseURL.'images/'.$product['imageurl']; ?>'>
				<div class="productImageInfo">
					<span class='floatRighty'><span class='quantity'>Qty:<input style='text-align:center;' id='input-quantity' size="1" type='text' value='1'></input></span>
					<a href='javascript:void(0)'>
						<span class='addCartButton' onClick='addToCart("<?= $product['pid'];?>" , "<?= $product['pname'];?>", <?= $product['price'];?>, "<?= $product['imageurl'];?>", getElementById("input-quantity").value);'>  Add to Cart  </span>
					</a>
					<span class='floatRighty' style='margin-right: 50px;'><span class='quantity' style='color: green;'>In-stock: 10 items</span></span>
				</div>
			</div>
		</div>
			
			<div class="clear"></div>
			<br><br><br><br>
			
		
		<div class="commentsContent">
			<div class="commentsContentHeader">x Comments Posted</div>
			<div class="commentLayout">
				<img class="commentUserLogo" src="BM_LOGO.png" height="50" width="50">
				<div class="commentText"><span class="commentTitle">Author Name</span> This is a comment. I am hello-worlding !</div>
			</div>
			<div class="commentLayout">
				<img class="commentUserLogo" src="BM_LOGO.png" height="50" width="50">
				<div class="commentText"><span class="commentTitle">Author Name</span> This is a comment. I am hello-wo asdf asdf sdf as dfasd f sad	
				awefaf23 a32 32f 323a 32 fa 23f		!</div>
			</div>
			<div class="commentLayout">
				<img class="commentUserLogo" src="BM_LOGO.png" height="50" width="50">
				<div class="commentText"><span class="commentTitle">Author Name</span> This is a comment. I am hello-wo asdf asdf sdf as dfasd f sad	
				awefaf23 a32 32f 323a 32 fa 23f		!</div>
			</div>
			<div class="commentLayout">
				<img class="commentUserLogo" src="BM_LOGO.png" height="50" width="50">
				<div class="commentText"><span class="commentTitle">Author Name</span> This is a comment. I am hello-wo asdf asdf sdf as dfasd f sad	
				awefaf23 a32 32f 323a 32 fa 23f		!</div>
			</div>
			<div class="commentLayout">
				<img class="commentUserLogo" src="BM_LOGO.png" height="50" width="50">
				<div class="commentText"><span class="commentTitle">Author Name</span> This is a comment. I am hello-wo asdf asdf sdf as dfasd f sad	
				awefaf23 a32 32f 323a 32 fa 23f		!</div>
			</div>
		</div>
			
			<br><br>
			
			<?php closeDBConnection($con); // close db connection ?>
			<p>hello</p>
			
	</div>
</div> 
	

</div>

</body>

</html>
