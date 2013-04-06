<?php

// pro side menu
function printAdminList($con, $selected){
  $query = "SELECT * FROM admin";								
	$result = mysqli_query($con, $query) or 
		die(" Query failed ");
    
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
			echo "<a href='admin?opt=$id'> <div class ='$class'>$name $imgpre $imgpost</div></a>\n";
      $i++;
  }
}

// print stats
// ============= PASS DATES HERE =============
function printStats($con, $opt) {
	// show appropriate data
	if ($opt == "recent") {
		displayTransactionHistory($con, null, null);
	} else if ($opt == "customers") {
		displayCustomerStats($con, null, null);	
	} else if ($opt == "products") {
		displayProductSales($con, null, null);
	} else if ($opt == "imports") {
		echo "<p>foreign aid</p>";
	}

	// allow date range selection
	displayDateRange();
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

// table items wrapping, use type=0 for <th> elem.s
function w($val, $type = 1) {
	$tag = ($type > 0) ? "td" : "th";
	return "<$tag>$val</$tag>";
}

// create a table header
function createTableHeader($columns, $id, $caption) {
	$table = "<table id='$id' class='tablesorter'>"
		."<caption>$caption</caption><thead><tr>";

	foreach($columns as $val) {
		$table .= w($val,0);
	}

	$table .= "</tr></thead><tbody>";
	return $table;
}

// add a row to table
function addTableRow($values) {
	$output = "<tr>";
	foreach ($values as $val) {
		$output .= w($val);
	}
	$output .= "</tr>";
	return $output;
}

// return transaction history as a table
function displayTransactionHistory($con, $from, $to) {	
	$output = "";

	// query all transactions
	$view = "userOrders, user, productOrders, product";
	$condition = "userOrders.userid=user.userid"
		." AND productOrders.orderid=userOrders.orderid"
		." AND productOrders.pid=product.pid";
	// check dates here for condition
	$query = "SELECT * FROM $view";
	$query .= ($condition == null) ? "" : " WHERE ".$condition;
	$result = mysqli_query($con, $query) or 
		die(" Transaction History Query Failed ");

	// init table
	$columns = array("Date", "Order ID", "User Email", 
		"Product", "Quantity Sold", "Total Cost");
	$output .= createTableHeader($columns, "historyTable", "Transaction History");

	// fill table
	while ($row = mysqli_fetch_array($result)) {		
		// get numbers
		$quantity = $row['amount'];
		$cost = $quantity * $row['price'];

		// add row to table
		$values = array($row['delivery_date'], $row['orderid'], 
			$row['email'], $row['pname'], $quantity, $cost);
		$output .= addTableRow($values);
	}

	// close table
	$output .= "</tbody></table>";
	echo "$output";
}


// display customer stats as a table
function displayCustomerStats($con, $from, $to) {
	$output = "";

	// find all users
	$queryUsers = "SELECT * FROM user";			
	$allUsers = mysqli_query($con, $queryUsers) or 
		die(" User Query Failed ");

	// prep transaction query
	$queryNumTrans = "SELECT COUNT(*) FROM userOrders WHERE userOrders.userid=";

	// prep purchases query
	$view = "userOrders, productOrders, product";
	$cond = " WHERE userOrders.orderid=productOrders.orderid"
		." AND productOrders.pid=product.pid"
		." AND userOrders.userid=";
	// add date check here
	$queryPurchases = "SELECT SUM(price) FROM ".$view.$cond;	

	// init table
	$columns = array("Email", "Name", "# Transactions", "Total Purchases");
	$output .= createTableHeader($columns, "customerTable", "Customer Statistics");
	
	// fill table
	while ($userRow = mysqli_fetch_array($allUsers)) {		
		// customer name		
		$first = $userRow['firstname'];
		$last = $userRow['lastname'];
		$name = "";
		$name .= ($first != null) ? $first : "";
		$name .= ($last != null) ? " ".$last : "";
		$name = ($name == "") ? "unspecified" : $name;		

		// customer id
		$uid = $userRow['userid'];

		// number of transactions
		$numTrans = mysqli_query($con, $queryNumTrans.$uid) or 
			die(" Query Failed: Transaction Count - ".$email." ");
		$count = mysqli_fetch_array($numTrans);

		// total purchases
		$purchases = mysqli_query($con, $queryPurchases.$uid) or
			die(" Query Failed: Purchase Sum - ".$email." ");
		$total = mysqli_fetch_array($purchases);

		// add row to table
		$values = array($userRow['email'], $name, $count[0], round($total[0], 2));
		$output .= addTableRow($values);
	}

	// close table
	$output .= "</tbody></table>";
	echo "$output";
}

// display sales by product
function displayProductSales($con, $from, $to) {
	$ouput = "";

	// find all products
	$queryProducts = "SELECT * FROM product";
	$allProducts = mysqli_query($con, $queryProducts) or
		die(" Product Query Failed ");

	// find all sales
	$salesQuery = "SELECT SUM(amount) FROM productOrders WHERE productOrders.pid='";
	
	// init table
	$columns = array("ID", "Product", "Category", "Quantity Purchased", "Gross Income");
	$output .= createTableHeader($columns, "productTable", "Overall Product Sales");

	// fill the table
	while ($prodRow = mysqli_fetch_array($allProducts)) {
		// product id
		$pid = $prodRow['pid'];

		// get total sales	
		$sales = mysqli_query($con, $salesQuery.$pid."'") or 
			die(" Sales Query Fail ");

		$qa = mysqli_fetch_array($sales);
		$qty = empty($qa[0]) ? 0 : $qa[0];

		// get gross income
		$total = $prodRow['price'] * $qty;

		// add row to table
		$values = array($pid, $prodRow['pname'], $prodRow['pcategory'], $qty, $total);
		$output .= addTableRow($values);
	}

	$output .= "</tbody></table>";
	echo "$output";
}

?>