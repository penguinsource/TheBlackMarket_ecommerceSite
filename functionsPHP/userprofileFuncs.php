<?php

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
		SELECT product.pname, product.price
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
		$output .= "<td>'$row[0]'</td>";
		$output .= "<td>'$row[1]'</td>";
		$output .= "</tr>";
		$row = mysqli_fetch_row($result);
	}
	$output .= "</table>";
	closeDBConnection($con);    // close the database connection
	return $output;
}

?>
