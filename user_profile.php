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
	<base href="//blackmarket5.hostei.com" />
	<!-- CSS imports -->
	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/shop.css" TYPE="text/CSS">
	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/product.css" TYPE="text/CSS">
	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/user_profile.css" TYPE="text/CSS">
	<script>
		function showProfile(page){
			alert("page:" + page);
			if (page == 'orders'){
				alert("HELLO !");
			}
		}
	</script>
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
				// onClick='showProfile('orders');'
			}
			?>
		</div>
	</div>
	
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
