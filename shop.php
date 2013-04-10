<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php include_once("functionsPHP/generalFuncs.php"); ?>
<?php include_once("functionsPHP/shopFuncs.php"); ?>
<?php include_once("functionsPHP/dbConnection.php"); ?>
<?php include_once("functionsPHP/ChromePhp.php"); ?>
<?php 
	checkPage(); 

	$con = connectToDB();
	if (isset($_GET["category"])){	
		$category = $_GET["category"];
		//echo "CATEGORY IS: " . $category;
	} else {
		//echo "NO CATEGORY GETTING HERE";
		$category = null;
	}
	if (isset($_SESSION['email'])){
		ChromePhp::log("email from shop: " . $_SESSION['email']);
	}
?>
<html>

<head>
	<?php echo $GLOBALS['basehref']; // print the site's base href?>
	<!--<style type="text/css">
		body{font-family: Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;}
	</style>-->
	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/shop.css" TYPE="text/CSS">
	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/mainmenu.css" TYPE="text/CSS">
    <link href='http://fonts.googleapis.com/css?family=Noto+Sans|Tauri|Economica|Istok+Web|Monda|Merriweather+Sans|Share+Tech+Mono|Roboto+Condensed|Oxygen|Maven+Pro' rel='stylesheet' type='text/css'>
	
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.15/jquery-ui.min.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/jquery.animate-colors.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/shop.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/generalFuncs.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/menuFuncs.js"></script>
	
	<link rel="icon" type="image/png" href="<?= $GLOBALS['baseURL']; ?>design/images/favicon.png">
	<title> Shop </title>
</head>

<body>

	<?php printMenu(); ?>
	<?php //echo 'base url:' . $baseURL;?>
	<div class='main'>
		<div style="border-bottom: 1px solid;border-color: #E4E4E4;width:100%;height:40px;"> </div>
		
		<div style="position:relative;">
			<div class='sidemenu' id='sidemenu'>
				<?php printCategories($con, $category); ?>
			</div>
			
			<div class='body'>		
			
				<?php //printProducts($con, $category, 'noSorting'); ?>
				<?php 
				if (isset($_GET['sortBy'])){
					printProducts($con, $category, $_GET['sortBy']);
				} else {
					printProducts($con, $category, 'noSorting');
				}
				
				?>
				
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
			


			<?php 
			if (isset($_GET['category'])){
				// saving category in javascript
				//$val = $_GET['category'];
				//echo "<script> currCategory = ".$val."; </script>";
			
				echo "<div class='sortDiv'>";
					echo "<span>Sort By: </span>";
					echo "<select onchange=\"goToSortedPage('".$_GET['category'] ."')\" id='sortBy'>";
						echo "<option id='noSorting' name='noSort' value='noSorting'></option>";
						echo "<option id='lowestPrice' name='lowestPrice' value='lowestPrice'>Lowest Price</option>";
						echo "<option id='highestPrice' name='highestPrice' value='highestPrice'>Highest Price</option>";
					echo "</select>";
				echo "</div>";
				echo "<script>document.getElementById('".$_GET['sortBy']."').selected = true;</script>";
				//echo "<script> setTimeout(function(){document.getElementById('".$_GET['sortBy']."').selected = true;},500);</script>"; // after 500 milliseconds, call the filter search function
			}
			?>
			<!-- <div class='sortDiv'>
				<span>Sort By:</span>
				<?php  ?>
				<select onchange='shop/' id='sortBy'>
					<option id='noSort' name='noSort' value='noSorting'></option>
					<option id='sortLowestPrice' name='sortLowestPrice' value='lowestPrice'>Lowest Price</option>
					<option id='sortHighestPrice' name='sortHighestPrice' value='highestPrice'>Highest Price</option>
				</select>
			</div> -->
			
		</div>
	</div>

</body>

<?php closeDBConnection($con);?>

</html>
