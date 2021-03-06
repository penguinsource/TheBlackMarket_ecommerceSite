<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php include("functionsPHP/generalFuncs.php"); ?>
<?php include("functionsPHP/dbConnection.php"); ?>
<?php include ("functionsPHP/userprofileFuncs.php"); ?>
<?php include ("functionsPHP/adminFuncs.php"); ?>


<?php 
  // start session
  checkPage(); 
?>	

<html>

<head>
	<?php echo $GLOBALS['basehref']; ?>
	<title>Profile</title>

	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/mainmenu.css" TYPE="text/CSS">
	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/shop.css" TYPE="text/CSS">
	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/user_profile.css" TYPE="text/CSS">
	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>tablesorter/themes/blue/style.css" TYPE="text/CSS">
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Noto+Sans|Tauri|Economica|Istok+Web|Monda|Merriweather+Sans|Share+Tech+Mono|Roboto+Condensed|Oxygen|Maven+Pro' rel='stylesheet' type='text/css'>

	
	<script src="http://code.jquery.com/jquery-latest.js" type="text/javascript"></script>
	<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/jquery.animate-colors.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/generalFuncs.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/userProfileFuncs.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>tablesorter/jquery.tablesorter.js"></script> 
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/menuFuncs.js"></script>
	
</head>

<body>
  <?php printMenu(); ?>

  <div class='main' id='mainPage'>
    <div style="border-bottom: 1px solid;border-color: #E4E4E4;width:100%;height:40px;"> </div>
    <div class="leftMenu">
      <?php showLeftMenu(); ?>
    </div>    
    
    <span id='window'>
    <?php showProfile(); ?>
    </span>
  </div>  

</body>

</html>
