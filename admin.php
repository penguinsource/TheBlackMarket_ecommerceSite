<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php include_once("functionsPHP/generalFuncs.php"); ?>
<?php include_once("functionsPHP/adminFuncs.php"); ?>
<?php include_once("functionsPHP/dbConnection.php"); ?>
<?php include_once("functionsPHP/ChromePhp.php"); ?>
<?php 
	checkPage(); 
	$con = connectToDB();

	$opt = isset($_GET["opt"]) ? $_GET["opt"] : null;	
	$from = isset($_POST["from"]) ? $_POST["from"] : null;
	$to = isset($_POST["to"]) ? $_POST["to"] : null;

	ChromePhp::log("email from shop: " . $_SESSION['email']);
?>
<html>

<head>
	<?php echo $GLOBALS['basehref']; // print the site's base href?>
	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/shop.css" TYPE="text/CSS">
	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/mainmenu.css" TYPE="text/CSS">
	<link rel="stylesheet" href="<?= $GLOBALS['baseURL']; ?>design/admin.css" type="text/css">
	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>tablesorter/themes/blue/style.css" TYPE="text/CSS">
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" type="text/css">
  <link href='http://fonts.googleapis.com/css?family=Noto+Sans|Tauri|Economica|Istok+Web|Monda|Merriweather+Sans|Share+Tech+Mono|Roboto+Condensed|Oxygen|Maven+Pro' rel='stylesheet' type='text/css'>
	
	<script src="http://code.jquery.com/jquery-latest.js" type="text/javascript"></script>
	<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/jquery.animate-colors.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/shop.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/generalFuncs.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/menuFuncs.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>tablesorter/jquery.tablesorter.js"></script> 
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/adminFuncs.js"></script>	
	
	<link rel="icon" type="image/png" href="<?= $GLOBALS['baseURL']; ?>design/images/favicon.png">
	<title> Admin </title>
</head>

<body>	

	<?php printMenu(); ?>

	<div class='main'>
		<div style="border-bottom: 1px solid;border-color: #E4E4E4;width:100%;height:40px;"> </div>			
		<div style="position:relative;">
			
			<div class='sidemenu' id='sidemenu'>
				<?php printAdminList($con, $opt); ?>
			</div>
			
			<div class='body'>
				<input type="hidden" id="o" value="<?= $opt; ?>" />
				<input type="hidden" id="hf" />
				<input type="hidden" id="ht" />

				<div id='tableView'>
					<?php printStats($con, $opt, $from, $to); ?>
				</div>

				<div id='dateWrapper'>
					<?php displayDateRange($opt); ?>
				</div>
			</div>
		</div>
	</div>

</body>

<?php closeDBConnection($con);?>

</html>