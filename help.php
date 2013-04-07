<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php include_once("functionsPHP/generalFuncs.php"); ?>
<?php include_once("functionsPHP/shopFuncs.php"); ?>
<?php include_once("functionsPHP/dbConnection.php"); ?>
<?php include_once("functionsPHP/ChromePhp.php"); ?>
<?php 
	checkPage(); 
	
	ChromePhp::log("email from shop: " . $_SESSION['email']);
?>
<html>

<head>

	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/shop.css" TYPE="text/CSS">
	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/mainmenu.css" TYPE="text/CSS">
    <link href='http://fonts.googleapis.com/css?family=Noto+Sans|Tauri|Economica|Istok+Web|Monda|Merriweather+Sans|Share+Tech+Mono|Roboto+Condensed|Oxygen|Maven+Pro' rel='stylesheet' type='text/css'>
	<base href="//blackmarket5.hostei.com" />
	
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.15/jquery-ui.min.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/jquery.animate-colors.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/shop.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/generalFuncs.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/menuFuncs.js"></script>
	
	<link rel="icon" type="image/png" href="<?= $GLOBALS['baseURL']; ?>design/images/favicon.png">
	<title> Help </title>
</head>

<body>

	<?php printMenu(); ?>

	<div class='main'>
		<div style="border-bottom: 1px solid;border-color: #E4E4E4;width:100%;height:40px;"> </div>
		
		<div style="position:relative;">
			
			<div class='body'>		
			
				<h2>Contact Us</h2>
				Email: support@blackmarket.com<br>
				Phone: 1-800-555-5555
			
			</div>
		</div>
	</div>

</body>

</html>
