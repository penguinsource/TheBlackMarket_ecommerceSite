<?php

$h = "h";
$d = "d";

function printAdminList($con, $selected){
    $query =   "SELECT * FROM admin";								
	$result = mysqli_query($con, $query) or die(" Query failed ");
    
    $number = mysqli_num_rows($result);
    $selIndex = 1;
    
    while($row = mysqli_fetch_array($result)) {
        $name = $row['name'];
		$id = $row['id'];
		if ($id == $selected) break;
		if ($selIndex == $number) {
			$selIndex = -1;
			break;
		}
        $selIndex++;
    }
    
    
    mysqli_data_seek($result, 0);
    $i = 1;
    while($row = mysqli_fetch_array($result)) {
		$name = $row['name'];
		$id = $row['id'];
        $class1 = ($id == $selected) ? "selmenuitem" : "menuitem";
        $class2 = ($i == $number) ? " menuitembottom" : "";
		$class3 = ($i == 1) ? "" : " menuitemtopborder";
        $class = $class1 . $class2 . $class3;
        $imgpre = ($i == ($selIndex - 1)) ? "<img style='display: ;position:relative; float:right;' src='../design/images/corner-br.png'>" : "";
        $imgpost = ($i == ($selIndex + 1)) ? "<img style='display: ;position:relative; float:right;' src='../design/images/corner-tr.png'>" : "";
        echo "";
        //echo "<a href='admin/$id'> <div class ='$class'>$name $imgpre $imgpost</div></a>\n";
				echo "<a href='admin?opt=$id'> <div class ='$class'>$name $imgpre $imgpost</div></a>\n";
        $i++;
    }
}

// print stats
function printStats($con, $opt) {
	if ($opt == "recent") {
		displayTransactionHistory($con, null, null);
		displayDateRange();
	} else if ($opt == "customers") {
		echo "<p>custy tracking</p>";
	} else if ($opt == "products") {
		echo "<p>graphable?</p>";
	} else if ($opt == "imports") {
		echo "<p>foreign aid</p>";
	}
}


// allow date range selection
function displayDateRange() {
	$range = "<div style='text-align:center'>"
		."<p>Select Date Range</p>"
		."<input type='text' id='from' name='from' placeholder='From' />"
		."<input type='text' id='to' name='to' placeholder='To' />"
		."</div>";

	echo "$range";
}


// return transaction history as a table
function displayTransactionHistory($con, $from, $to) {	
	$output = "";

	$select = "*";
	$view = "userOrders, user, productOrders, product";

	$condition = "userOrders.userid=user.userid";
	$condition .= " AND productOrders.orderid=userOrders.orderid";
	$condition .= " AND productOrders.pid=product.pid";
	// check dates here for condition

	//$ordering = "userOrders.delivery_date DESC";
	$ordering = null;

	$query = "SELECT $select FROM $view";
	$query .= ($condition == null) ? "" : " WHERE ".$condition;
	$query .= ($ordering == null) ? "" : " ORDER BY ".$ordering;

	//echo "<p>$query</p><br />";

	$result = mysqli_query($con, $query) or die(" Query failed ");

	// init table
	$tablein = "<table id='historyTable' class='tablesorter'>"
		."<caption>Transaction History</caption>";
	$tableout = "</tbody></table>";
	$header = "<thead><tr>"
		.w("Date",0)
		.w("Order ID",0)
		.w("User Email",0)
		.w("Product",0)
		.w("Quantity Sold",0)
		.w("Total Cost",0)
		."</tr></thead><tbody>";

	$output .= $tablein.$header;

	while ($row = mysqli_fetch_array($result)) {
		
		$date = $row['delivery_date'];
		$order = $row['orderid'];
		$email = $row['email'];
		$product = $row['pname'];
		$quantity = $row['amount'];
		$cost = $quantity * $row['price'];

		$rowVals = "<tr>"
			.w($date).w($order).w($email).w($product).w($quantity).w($cost)
			."</tr>";

		$output .= $rowVals;
	}


	$output .= $tableout;
	echo "$output";
}


// table items wrapping
function w($val, $type = 1) {
	$tag = ($type > 0) ? "td" : "th";
	return "<$tag>$val</$tag>";
}

?>