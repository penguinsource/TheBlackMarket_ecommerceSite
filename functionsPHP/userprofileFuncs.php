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
    ."<input type='text' name='lname' id='lname' value='".$user['lastname']."' />"
    .p("City")
    ."<input type='text' name='city' id='city' value='".$user['city']."' />"
    .p("Postal Code")
    ."<input type='text' name='postalcode' id='postalcode' value='".$user['postal']."' />"
    .p("Address")
    ."<input type='text' name='address' id='address' value='".$user['address']."' />"
    .p("Phone Number")
    ."<input type='text' name='phonenumber' id='phonenumber' value='".$user['phone']."'/>"
    ."<br><br><input type='button' onClick='updateProfile()' value='Save Profile' /></div>"
    ."<div class='smallColumn' id='profileSettings'>"
    .p("Email")
    ."<input type='text' name='email' id='email' value='".$user['email']."' disabled />"
    ."</div>";
    
  return $value;
}

function displayCurrentOrders($user) {
  $con = connectToDB();

  $value = "<div class='mediumColumn' id='profileOrders'>";
  
  // init table
  $cols = array("Order#", "Products", "Price", "Arrival Date");
  $value .= createTableHeader($cols, 'profileTable', 'Current Orders', null, null);
  
  // query all use transactions
  $query = "SELECT * FROM userOrders WHERE userOrders.userid=".$user['userid'];
  // possible date check
  $res = mysqli_query($con, $query) or die(" Current Order Query Failed ");
  
  // get products
  while ($row = mysqli_fetch_array($res)) {  
    $oid = $row['orderid'];
    $date = $row['delivery_date'];
    //$date = 
    getUpdatedDelivery($con, $oid); // CURL
    
    $inner = "SELECT * FROM productOrders WHERE productOrders.orderid='".$oid."'";
    $ir = mysqli_query($con, $inner) or die(" User Profile Product Query Failed ");
    
    $items = "";
    $cost = 0;
    while ($prow = mysqli_fetch_array($ir)) {
      $pid = $prow['pid'];
      $qty = $prow['amount'];
      $price = $prow['totalprice'];
      
      $pname = getProductName($con, $pid);
      $items .= ($items == "") ? "" : ", ";
      $items .= $pname." [x$qty]";
      
      $cost += $price;
    }
          
    $next = array($oid, $items, $cost, $date);
    $value .= addTableRow($next);
  }
      
  $value .= "</tbody></table></div>";    
  closeDBConnection($con);
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

function getProductName($con, $pid) {
  $query = "SELECT * FROM product WHERE product.pid='".$pid."'";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_array($result);
  return $row['pname'];
}

function getUpdatedDelivery($con, $oid) {
  echo getUrlFromOID($con, $oid);
}

function getUrlFromOID($con, $oid) {
  $query = "SELECT * FROM orderSources WHERE orderSources.orderid='".$oid."'";
  $res = mysqli_query($con, $query) or die(" URL Query Failed ");
  $row = mysqil_fetch_array($res);
  return $row['storeurl'];
}

function getCurl($url){
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	$data = curl_exec($ch);
	curl_close($ch);
		
	return json_decode($data, true);
}


?>
