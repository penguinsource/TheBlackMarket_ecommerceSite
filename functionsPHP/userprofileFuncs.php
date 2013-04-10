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

function showProfile($tab, $user) {
  $output = "";
  
  if ($tab == null) {             // settings
    $output .= "<div class='mediumColumn' id='profileOrders'>"
      ."<p>Current Orders</p>"
      ."<div id='orders-header'>"
      ."<span style='display:inline-block;width:68%;'></span>"
      ."<span style='display:inline-block;width:8%;text-align:center;'>Quantity</span>"
      ."<span style='display:inline-block;width:14%;text-align:center;'>Price</span>"
      ."<span style='display:inline-block;width:8%;text-align:center;'>Arrival Date</span>"
      ."</div>";
  } else {                        // order
    $output .= "<div class='smallColumn' id='profileSettings'>"
      .p("First Name")
      ."<input type='text' name='fname' id='fname' value='".$user['firstname']."'></input>"
      .p("Last Name")
      ."<input type='text' name='fname' id='fname' value='".$user['lastname']."'></input>"
      .p("City")
  }
  
  echo $output;

/*
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
*/
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
