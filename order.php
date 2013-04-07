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
						<div id='sub-header'> Order <a href='/cart'> (edit) </a></div>
						
						<div class='item'>
							<span style='display:inline-block;width:68%;'>Bosch 4.6 Cu. Ft. Self-Clean Smooth Top Convection Range</span>
							<span style='display:inline-block;width:15%;'>x3</span>
							<span style='display:inline-block;width:15%;'>$799.99</span>
						</div>
						
						<div class='item'>
							<span style='display:inline-block;width:68%;'>LG 6.3 Cu. Ft. Self-Clean Smooth Top Range</span>
							<span style='display:inline-block;width:15%;'>x1</span>
							<span style='display:inline-block;width:15%;'>$899.99</span>
						</div>
						
						<div class='item'>
							<span style='display:inline-block;width:68%;'>Bosch 5.0 Cu. Ft. Self-Clean Gas Range</span>
							<span style='display:inline-block;width:15%;'>x1</span>
							<span style='display:inline-block;width:15%;'>$599.99</span>
						</div>
					</div>
					
					<div id='address'>
						<div id='sub-header'> Shipping Address <a href='/user_profile'> (edit) </a></div>
					</div>
				</div>
			</div>
			
		</div>
	</div>

</body>

<?php closeDBConnection($con);?>

</html>
