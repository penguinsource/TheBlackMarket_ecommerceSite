<?php

function p($elem) {
  return "<p>$elem</p>";
}

function showLeftMenu() {
  $output = "<div class='profileTitle'>Your Profile</div><div class='profileMenu'>";
  
  // choose active link
  $settingsTab = "";
  $ordersTab = "";  
  if (isset($_GET['profileOrders'])) {
    $ordersTab = "Sel";
  } else {
    $settingsTab = "Sel";
  }
  $output .= "<div class='profileMenuTab".$settingsTab."'><span class='profileTab'>"
    ."<a href='".$GLOBALS['baseURL']."user_profile'>Settings</a></span></div>"
    ."<div class='profileMenuTab".$ordersTab."'><span class='profileTab'>"
    ."<a href='".$GLOBALS['baseURL']."user_profile.php?profileOrders'>Orders</a></span></div>";
  
  $output .= "</div>";
  
  echo $output;
}

function showProfile() {
  if (isset($_SESSION['email'])) {
	  $user = getUserInfo($_SESSION['email']);
	} else {
	  header("Location: shop");
		exit;
	}	
	$tab = isset($_GET['profileOrders']) ? 1 : 0;

  $output = ($tab > 0) ? displayCurrentOrders($user) : displayProfileSettings($user);
  echo $output;
}

function displayProfileSettings($user) {
  $value = "<div class='smallColumn' id='profileSettings'>"
    .p("First Name")
    ."<input type='text' name='fname' id='fname' value='".$user['firstname']."' />"
    .p("Last Name")
    ."<input type='text' name='fname' id='fname' value='".$user['lastname']."' />"
    .p("City")
    ."<input type='text' name='city' id='city' value='".$user['city']."' />"
    .p("Postal Code")
    ."<input type='text' name='postalcode' id='postalcode' value='".$user['postal']."' />"
    .p("Address")
    ."<input type='text' name='address' id='address' value='".$user['address']."' />"
    .p("Phone Number")
    ."<input type='text' name='phonenumber' id='phonenumber' value='".$user['phone']."'/>"
    ."<br><br><button onClick='updateUserProfile()'>Save Profile</button></div>"
    ."<div class='smallColumn' id='profileSettings'>"
    .p("Email")
    ."<input type='text' name='email' id='email' value='".$user['email']."' disabled />"
    ."</div>";
    
  return $value;
}

function displayCurrentOrders($user) {
  $value = "<div class='mediumColumn' id='profileOrders'>";
  
  $cols = array("Products", "Price", "Arrival Date");
  $value .= createTableHeader($cols, 'profileTable', 'Current Orders', null, null);
  
  $vals = array("ITEMS", "INFINITY BILLION DOLLARS", "the day of the dead");
  $value .= addTableRow($vals);
  
  $value .= "</tbody></table></div>";
    
  return $value;
}

function getUserInfo($userEmail){
	$con = connectToDB();		// open db connection
	$query = "SELECT * FROM user WHERE email = '$userEmail';";
	$result = mysqli_query($con, $query) or die("Query failed getting user details.");
	$row = mysqli_fetch_assoc($result);
	closeDBConnection($con);    // close the database connection
	return $row;					// return array with all of user's info
}

function getUserCurrentOrders($userid) {
	return getUserOrders($userid, " AND userOrders.delivery_date >= DATE(NOW());");
}

function getUserPastOrders($userid) {
	return getUserOrders($userid, " AND userOrders.delivery_date < DATE(NOW());");
}

function getUserOrders($userid, $queryEnd) {
	$con = connectToDB();		// open db connection
	$query = "
		SELECT product.pname, product.imageurl, productOrders.amount, product.price, userOrders.delivery_date, product.pid, product.pcategory
		FROM userOrders, productOrders, product 
		WHERE 
			userOrders.userid = '$userid' AND
			productOrders.orderid = userOrders.orderid AND
			product.pid = productOrders.pid" . $queryEnd
	;
	$result = mysqli_query($con, $query) or die("Query failed getting order details.");
	$output = "<table class='ordersTable'>";
	$row = mysqli_fetch_row($result);
	if ($row == NULL) return "None";
	while ($row != NULL) {
		$output .= "<tr>";
		//echo "<a href='/product/dishwashers/$id'> <img src='images/$row[1]'></img> <div style='margin-left:20px;display:inline-block;'>$row[0]</div> </a>\n";
		$output .= "<td><a href='/product/$row[6]/$row[5]'>'$row[0]'</td>";
		//$output .= "<td><img src='images/$row[1]'></td>";
		$output .= "<td>'$row[2]'</td>";
		$output .= "<td>'$row[3]'</td>";
		$output .= "<td>'$row[4]'</td>";
		$output .= "</tr>";
		$row = mysqli_fetch_row($result);
	}
	$output .= "</table>";
	closeDBConnection($con);    // close the database connection
	return $output;
}

?>
