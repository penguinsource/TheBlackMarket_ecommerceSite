<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php include("functionsPHP/generalFuncs.php"); ?>
<?php include("functionsPHP/dbConnection.php"); ?>
<?php include ("functionsPHP/userprofileFuncs.php"); ?>
<?php 
	checkPage(); 
	
	if (isset($_SESSION['email'])) {
	  $user = getUserInfo($_SESSION['email']);
	} else {
	  header("Location: shop");
		exit;
	}
	
	$tab = (isset($_GET['profileOrders']) ? $_GET['profileOrders'] : null;
?>

<hmtl>

<head>
	<?php echo $GLOBALS['basehref']; ?>
	<title>Profile</title>

	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/mainmenu.css" TYPE="text/CSS">
	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/shop.css" TYPE="text/CSS">
	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/user_profile.css" TYPE="text/CSS">
	
	<script src="<?php echo $GLOBALS['baseURL']; ?>functionsJS/generalFuncs.js"></script>
	<script src='http://code.jquery.com/jquery-latest.min.js' type="text/javascript"></script>
	<script  src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.15/jquery-ui.min.js"></script>
	<script  src="<?= $GLOBALS['baseURL']; ?>functionsJS/jquery.animate-colors.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/userProfileFuncs.js"></script>
	
</head>

<body>
  <?php printMenu(); ?>

  <div class='main'>
    <div style="border-bottom: 1px solid;border-color: #E4E4E4;width:100%;height:40px;"> </div>
    <div class="leftMenu">
      <?php showLeftMenu(); ?>
    </div>    
    
    <?php showProfile($tab, $user); ?>
  </div>  

</body>

</html>
