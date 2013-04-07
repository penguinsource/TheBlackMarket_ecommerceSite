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
