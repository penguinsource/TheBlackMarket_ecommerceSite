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
				<?php printPage($con); ?>
				
			</div>
			
		</div>
	</div>

</body>

<?php closeDBConnection($con);?>

</html>
