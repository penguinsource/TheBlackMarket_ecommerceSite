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

	<!-- <LINK REL=STYLESHEET HREF="<?= $baseURL; ?>design/shop.css" TYPE="text/CSS">
	<LINK REL=STYLESHEET HREF="<?= $baseURL; ?>design/product.css" TYPE="text/CSS">-->
	<LINK REL=STYLESHEET HREF="http://localhost/TheBlackMarket_ecommerceSite/design/shop.css" TYPE="text/CSS">
	<LINK REL=STYLESHEET HREF="http://localhost/TheBlackMarket_ecommerceSite/design/user_profile.css" TYPE="text/CSS">
	<!--<LINK REL=STYLESHEET HREF="http://localhost/bm/design/shop.css" TYPE="text/CSS">
	<LINK REL=STYLESHEET HREF="http://localhost/bm/design/product.css" TYPE="text/CSS">-->
	
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
	if (isset($_GET["userid"])){
		//$productID = $_GET["productID"];
		//$product = getProductInfo($con, $productID);
	}else {
		echo "No user id sent";
	}
?>

</body>

<div class='main'>

	<div style="border-bottom: 1px solid;border-color: #E4E4E4;width:100%;height:40px;"> </div>
	
	<div class="leftMenu">
		<div class="profileTitle"> Your Profile </div>
		<div class="profileMenu">
			<?php if (isset($_GET['profileOrders'])){
				/*echo "<div class='profileMenuTab'><span class='profileTab'> <a href='user_profile.php'> Settings </a> </span></div> ";
				echo "<div class='profileMenuTabSel'><span class='profileTab'> <a href='user_profile.php?profileOrders'> Orders </a> </span></div> "; */
				echo "<div class='profileMenuTab'><span class='profileTab'> <a href='http://localhost/TheBlackMarket_ecommerceSite/user_profile.php'> Settings </a> </span></div> ";
				echo "<div class='profileMenuTabSel'><span class='profileTab'> <a href='http://localhost/TheBlackMarket_ecommerceSite/user_profile.php?profileOrders'> Orders </a> </span></div> ";
			} else {
				/*echo "<div class='profileMenuTabSel'><span class='profileTab'> <a href='user_profile.php'> Settings </a> </span></div> ";		// FOR REMOTE HOST!
				echo "<div class='profileMenuTab'><span class='profileTab'> <a href='user_profile.php?profileOrders'> Orders </a> </span></div> "; */
				echo "<div class='profileMenuTabSel'><span class='profileTab'> <a href='http://localhost/TheBlackMarket_ecommerceSite/user_profile.php'> Settings </a> </span></div> ";
				echo "<div class='profileMenuTab'><span class='profileTab'> <a href='http://localhost/TheBlackMarket_ecommerceSite/user_profile.php?profileOrders'> Orders </a> </span></div> ";
			}
			?>
		</div>
	</div>
	
	<div class="profileSettings">
		<form name='userProfile'>
			<p> First Name </p>
			<input type='text' name='fname' id='fname'></input>
			<p> Last Name </p>
			<input type='text' name='lname' id='lname'></input>
			<p> City </p>
			<input type='text' name='city' id='city'></input>
			<p> Postal Code </p>
			<input type='text' name='postalcode' id='postalcode'></input>
			<p> Address </p>
			<input type='text' name='address' id='address'></input>
			<p> Phone Number </p>
			<input type='text' name='phonenumber' id='phonenumber'></input>
			<br><br>
			<button>Save Profile</button>
		</form>
	</div>
	
	<div class="profileSettings">
		<p>Email </p>
		<input type='text' name='email' id='email' value='test @yahoo.com' disabled></input>
	</div>
	
	<!-- FILLING REST OF WIDTH: 
<div name="test1" id="test1" style="position:absolute; left:0px; top:95px; width:50%; height:300px; z-index:5; background: #7BCDC9;">
This starts at the left edge, and goes all the way to the middle of the screen.
</div>
<div name="test2" id="test2" style="position:absolute; left:50%; top:95px; width:50%; height:300px; z-index:5; background: #4D3627;">
Starts in the middle, and goes all the way to the right edge.
</div>
	-->
	
</div>



</html>
