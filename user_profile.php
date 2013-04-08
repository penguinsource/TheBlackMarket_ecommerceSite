<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php include("functionsPHP/generalFuncs.php"); ?>
<?php include("functionsPHP/shopFuncs.php"); ?>
<?php include("functionsPHP/productFuncs.php"); ?>
<?php include("functionsPHP/dbConnection.php"); ?>
<?php include ("functionsPHP/userprofileFuncs.php"); ?>
<?php 
	checkPage(); 
?>
<html>

<head>
	<?php echo $GLOBALS['basehref']; // print the site's base href?>
	<title>Profile</title>
	<!-- CSS imports -->
	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/mainmenu.css" TYPE="text/CSS">
	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/shop.css" TYPE="text/CSS">
	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/product.css" TYPE="text/CSS">
	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/user_profile.css" TYPE="text/CSS">
	
	<!-- script imports -->
	<script type="text/javascript" src="<?php echo $GLOBALS['baseURL']; ?>functionsJS/generalFuncs.js"></script>
	<script src='http://code.jquery.com/jquery-latest.min.js' type="text/javascript"></script>
	<script  src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.15/jquery-ui.min.js"></script>
	<script  src="<?= $GLOBALS['baseURL']; ?>functionsJS/jquery.animate-colors.js"></script>
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

	<?php printMenu(); ?>

	<!-- body start -->
<?php 
if (isset($_SESSION['email'])){ 
	$user = getUserInfo($_SESSION['email']);
}else{
	echo 'USER NOT LOGGED IN !';
};
?>

<div class='main'>

	<div style="border-bottom: 1px solid;border-color: #E4E4E4;width:100%;height:40px;"> </div>
	
	<div class="leftMenu">
		<div class="profileTitle"> Your Profile </div>
		<div class="profileMenu">
			<?php if (isset($_GET['profileOrders'])){
				echo "<div class='profileMenuTab'><span class='profileTab'> <a href='".$GLOBALS['baseURL']."user_profile.php'> Settings </a> </span></div> ";
				echo "<div class='profileMenuTabSel'><span class='profileTab'> <a href='".$GLOBALS['baseURL']."user_profile.php?profileOrders'> Orders </a> </span></div> ";
			} else {
				echo "<div class='profileMenuTabSel'><span class='profileTab'> <a href='". $GLOBALS['baseURL']."user_profile.php'> Settings </a> </span></div> ";
				echo "<div class='profileMenuTab'><span class='profileTab'> <a href='". $GLOBALS['baseURL']."user_profile.php?profileOrders'> Orders </a> </span></div> ";
				// onClick=\"showProfile('orders');\"
			}
			?>
		</div>
	</div>
	<?php
		if (isset($_GET['profileOrders'])){		// ORDERS PAGE OF USER PROFILE
			echo "<div class='mediumColumn' id='profileOrders'>";
			echo "<p> Current Orders </p>";
			echo "<div id='orders-header'>
				<span style='display:inline-block;width:68%;'> </span>   
				<span style='display:inline-block;width:8%;text-align:center;'>Qty</span>   
				<span style='display:inline-block;width:14%;text-align:center;'>Price</span>   
				<span style='display:inline-block;width:8%;text-align:center;'>Arrival Date</span>
			</div>";
			echo getUserCurrentOrders($user['userid']);
			echo "<div class='maxBorder'></div>";
			echo "<p> Past Orders </p>";
			echo getUserPastOrders($user['userid']);
			echo "<div class='maxBorder'></div>";
			echo "</div>";
		} else {	// SETTINGS PAGE OF USER PROFILE
			echo "<div class='smallColumn' id='profileSettings'>";
			echo "<p> First Name </p>";
			echo "<input type='text' name='fname' id='fname' value='". $user['firstname'] . "'></input>";
			echo "<p> Last Name </p>";
			echo "<input type='text' name='lname' id='lname' value='". $user['lastname'] . "'></input>";
			echo "<p> City </p>";
			echo "<input type='text' name='city' id='city' value='". $user['city'] . "'></input>";
			echo "<p> Postal Code </p>";
			echo "<input type='text' name='postalcode' id='postalcode' value='". $user['postal'] . "'></input>";
			echo "<p> Address </p>";
			echo "<input type='text' name='address' id='address' value='". $user['address'] . "'></input>";
			echo "<p> Phone Number </p>";
			echo "<input type='text' name='phonenumber' id='phonenumber' value='". $user['phone'] . "'></input>";
			echo "<br><br>";
			echo "<button onClick='updateUserProfile()'>Save Profile</button>";
			echo "</div>";
			
			echo "<div class='smallColumn' id='profileSettings'>";
			echo "<p>Email </p>";
			echo "<input type='text' name='email' id='email' value='". $user['email']. "' disabled></input>";
			echo "</div>";
		}
	?>
	
	<!-- ORDERS page:
	<div class='mediumColumn' id='profileOrders'>
		<p> Current Orders </p>
		<div class="maxBorder"></div>
		
		<div class="maxBorder"></div>
		
		<p> Past Orders </p>
		<div class="maxBorder"></div>
	</div>
	-->
	
	<!-- FILLING REST OF WIDTH: 
<div name="test1" id="test1" style="position:absolute; left:0px; top:95px; width:50%; height:300px; z-index:5; background: #7BCDC9;">
This starts at the left edge, and goes all the way to the middle of the screen.
</div>
<div name="test2" id="test2" style="position:absolute; left:50%; top:95px; width:50%; height:300px; z-index:5; background: #4D3627;">
Starts in the middle, and goes all the way to the right edge.
</div>
	-->
	
</div>

</body>

</html>



	<!--
	<div class='smallColumn' id='profileSettings'>
			<p> First Name </p>
			<input type='text' name='fname' id='fname' value='<?php echo $user['firstname']; ?>'></input>
			<p> Last Name </p>
			<input type='text' name='lname' id='lname' value='<?php echo $user['lastname']; ?>'></input>
			<p> City </p>
			<input type='text' name='city' id='city' value='<?php echo $user['city']; ?>'></input>
			<p> Postal Code </p>
			<input type='text' name='postalcode' id='postalcode' value='<?php echo $user['postal']; ?>'></input>
			<p> Address </p>
			<input type='text' name='address' id='address' value='<?php echo $user['address']; ?>'></input>
			<p> Phone Number </p>
			<input type='text' name='phonenumber' id='phonenumber' value='<?php echo $user['phone']; ?>'></input>
			<br><br>
			<button onClick="updateUserProfile()">Save Profile</button>
		
	</div>
	
	<div class='smallColumn' id='profileSettings'>
		<p>Email </p>
		<input type='text' name='email' id='email' value='<?php echo $user['email'] ?>' disabled></input>
	</div>
	-->
	
	
