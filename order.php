<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php include_once("functionsPHP/generalFuncs.php"); ?>
<?php include_once("functionsPHP/orderFuncs.php"); ?>
<?php include_once("functionsPHP/dbConnection.php"); ?>
<?php include_once("functionsPHP/ChromePhp.php"); ?>
<?php 
	checkPage(); 
	$con = connectToDB();
?>
<html>

<head>
	<!--<style type="text/css">
		body{font-family: Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;}
	</style>-->
	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/order.css" TYPE="text/CSS">
	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/mainmenu.css" TYPE="text/CSS">
    <link href='http://fonts.googleapis.com/css?family=Noto+Sans|Tauri|Economica|Istok+Web|Monda|Merriweather+Sans|Share+Tech+Mono|Roboto+Condensed|Oxygen|Maven+Pro' rel='stylesheet' type='text/css'>
	<base href="//blackmarket5.hostei.com" />
	
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.15/jquery-ui.min.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/jquery.animate-colors.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/generalFuncs.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/menuFuncs.js"></script>
	
	<link rel="icon" type="image/png" href="<?= $GLOBALS['baseURL']; ?>design/images/favicon.png">
	<title> Order </title>
</head>

<body>

	<?php printMenu(); ?>
	<div id='page-alert'></div>
	<div class='main'>		
		<div style="position:relative;">
			
			<div class='body'>		
				<?php checkAccess($con); ?>
				
				<div id='header'> Confirm Order Details</div>
				
				<div style='margin-left:30px; margin-right:30px;'>
					<div id='cart'>
						<div id='sub-header'> <span style='padding-left:10px'> Order <a href='/cart'> (edit) </a></span></div>
						
						<div class='item'>
							<span style='display:inline-block;width:65%;'>Bosch 4.6 Cu. Ft. Self-Clean Smooth Top Convection Range</span>
							<span style='display:inline-block;width:7%;text-align: right;'>x3</span>
							<span style='display:inline-block;width:26%;text-align: center;'>$799.99</span>
						</div>
						
						<div class='item'>
							<span style='display:inline-block;width:65%;'>LG 6.3 Cu. Ft. Self-Clean Smooth Top Range</span>
							<span style='display:inline-block;width:7%;text-align: right;'>x1</span>
							<span style='display:inline-block;width:26%;text-align: center;'>$899.99</span>
						</div>
						
						<div class='item bottom'>
							<span style='display:inline-block;width:65%;'>Bosch 5.0 Cu. Ft. Self-Clean Gas Range</span>
							<span style='display:inline-block;width:7%;text-align: right;'>x1</span>
							<span style='display:inline-block;width:26%;text-align: center;'>$599.99</span>
						</div>
						
						<div id='total-price'> $2455.99 </div><div id='total-text'> Total: </div> 
					</div>
					
					<div id='address'>
						<div id='sub-header'> <span style='padding-left:10px'> Shipping Address <a href='/user_profile'> (edit) </a></span></div>
						
						<div style='padding-top:10px;'>
							<div class='address-line'>Guyname Namerson</div>
							<div class='address-line'>7801234567</div>
							<div class='address-line'>507 Whattafuck Street</div>
							<div class='address-line'>Washington DC</div>
							<div class='address-line'>A4A 4A4</div>
						</div>
					
					</div>
					
					<a href='javascript:void(0);'><div class='button'> Place Order </div>
				</div>
				
				
			</div>
			
		</div>
	</div>

</body>

<?php closeDBConnection($con);?>

</html>
