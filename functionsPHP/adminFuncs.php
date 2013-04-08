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
function printStats($con, $opt, $from, $to) {
	// show appropriate data
	if ($opt == "recent") {
		displayTransactionHistory($con, $from, $to);
	} else if ($opt == "customers") {
		displayCustomerStats($con, $from, $to);	
	} else if ($opt == "products") {
		displayProductSales($con, $from, $to);
	} else if ($opt == "imports") {
		displayOtherStores($con, $from, $to);
	} else if ($opt == null) {
		return;
	}
}

// allow date range selection
function displayDateRange($opt) {
  // only display when necessary
  if ($opt == null) { return; }
  
  $range = "<p>Select Date Range</p>"
		."<input type='text' id='from' name='from' placeholder='From' />"
		."<input type='text' id='to' name='to' placeholder='To' />";//</div>";

	echo "$range";
}

// table items wrapping, use type=0 for <th> elem.s
function w($val, $type = 1) {
	$tag = ($type > 0) ? "td" : "th";
	return "<$tag>$val</$tag>";
}

// add date check to sql query - REPLACE INPUT
// REQUIRES USE OF USERORDERS TABLE!!
function addDateCheck($curQuery, $from, $to) {
  $res = $curQuery;
  
  $res .= ($from == null) ? "" : 
    " AND userOrders.delivery_date>=STR_TO_DATE('$from','%Y-%m-%d')";
	$res .= ($to == null) ? "" : 
    " AND userOrders.delivery_date<=STR_TO_DATE('$to', '%Y-%m-%d')";
  
  return $res;
}

// create a table header
function createTableHeader($columns, $id, $caption, $from, $to) {
  $cap = $caption;
  $cap .= ($from == null) ? "" : "<font color='green'> FROM: </font>$from";
  $cap .= ($to == null) ? "" : "<font color='red'> TO: </font>$to";

	$table = "<table id='$id' name='$id' class='tablesorter'>"
		."<caption>$cap</caption><thead><tr>";

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
  $displaying = 25;   // number of reports to display...until the table does it for me

	// query all transactions
	$select = "SELECT * FROM userOrders, user";
	$condition = " WHERE userOrders.userid=user.userid";

	$query = $select.$condition;  
  $query = addDateCheck($query, $from, $to);
  
  $query .= " ORDER BY userOrders.delivery_date DESC";  
  
	$result = mysqli_query($con, $query) or 
		die(" Transaction History Query Failed ");
    
  // transaction query
  $orderSelect = "SELECT * FROM productOrders, product";
  $orderCondition = " WHERE productOrders.pid=product.pid"
    ." AND productOrders.orderid='";
  $orderQuery = $orderSelect.$orderCondition;

	// init table
	$columns = array("Date", "User Email", 
		"Products", "Total Cost");
	$output .= createTableHeader($columns, "historyTable", "Transaction History", $from, $to);

	// fill table
  $i = 0;
	while (($row = mysqli_fetch_array($result))   && $i < $displaying) {		
    // get all products in the order
    $oid = $row['orderid'];
    $oq = $orderQuery.$oid."'";
    $oq = addDateCheck($oq, $from, $to);
    
    $o_res = mysqli_query($con, $oq) or die(" Order Query Failed ");
       
    $products = "";
    $cost = 0;
    while ($orow = mysqli_fetch_array($o_res)) {
      $prod = $orow['pname'];
      $qty = $orow['amount'];
      $tag = $orow['price'];
      
      $products .= ($products == "") ? "" : ", ";
      $products .= $prod." [x$qty]";
      
      $cost += $qty * $tag;
    }
        
    // get purchaser

		// add row to table
		$values = array($row['delivery_date'], $row['email'], $products, $cost);
		$output .= addTableRow($values);
    $i++;
	}
  
  if ($i == 0) { 
    echo "<p style='text-align: center'><font color='red'>No transactions found between given dates.</font></p>";
    return;
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

	$queryPurchases = "SELECT SUM(price) FROM ".$view.$cond;	

	// init table
	$columns = array("Email", "Name", "# Transactions", "Total Purchases");
	$output .= createTableHeader($columns, "customerTable", "Customer Statistics", $from, $to);

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
    $ntFinalQuery = addDateCheck($queryNumTrans.$uid, $from, $to);    
		$numTrans = mysqli_query($con, $ntFinalQuery) or 
			die(" Query Failed: Transaction Count - ".$email." ");
		$count = mysqli_fetch_array($numTrans);

		// total purchases
    $pFinalQuery = addDateCheck($queryPurchases.$uid, $from, $to);
		$purchases = mysqli_query($con, $pFinalQuery) or
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
  $salesSelect = "SELECT SUM(amount) FROM productOrders, userOrders";
  $salesCondition = 
    " WHERE productOrders.orderid=userOrders.orderid AND productOrders.pid=\"";  
	$salesQuery = $salesSelect.$salesCondition;
	
	// init table
	$columns = array("ID", "Product", "Category", "Quantity Purchased", "Gross Income");
	$output .= createTableHeader($columns, "productTable", "Overall Product Sales", $from, $to);

	// fill the table
	while ($prodRow = mysqli_fetch_array($allProducts)) {
		// product id
		$pid = $prodRow['pid'];

		// get total sales	
    $query = $salesQuery.$pid."\"";
    $query = addDateCheck($query, $from, $to);    
		$sales = mysqli_query($con, $query) or 
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

// partner retailer information
function displayOtherStores($con, $from, $to) {
  $output = "";

  // get other store orders
  $select = "SELECT * FROM userOrders";
  $condition = " WHERE EXISTS "
    ."(SELECT * FROM orderSources WHERE userOrders.orderid=orderSources.orderid)";
    
  $query = $select.$condition;    
  $query = addDateCheck($query, $from, $to);        
  
  $sources = mysqli_query($con, $query) or 
    die(" Order Sources Query Failed ");
        
  // order query
  $orderQuery = "SELECT * FROM productOrders WHERE productOrders.orderid='";
  // product query
  $prodQuery = "SELECT * FROM product WHERE product.pid='";  
  // user query
  $userQuery = "SELECT * FROM user WHERE user.userid='";  
  // store query
  $storeQuery = "SELECT * FROM orderSources WHERE orderSources.orderid='";
  
  // init table
  $columns = array("Partner", "User Email", "Products", "Total Cost");
  $output .= createTableHeader($columns, "storeTable", "Partner Retailer Orders", $from, $to);
  
  $i = 0;
  while ($row = mysqli_fetch_array($sources)) {
    $uid = $row['userid'];
    $oid = $row['orderid'];
  
    // get store
    $sq = $storeQuery.$oid."'";
    $s_res = mysqli_query($con, $sq) or die(" Store Query Failed ");
    $storeRow = mysqli_fetch_array($s_res);
    $store = $storeRow['storename'];
    
    // get user    
    $uq = $userQuery.$uid."'";
    $u_res = mysqli_query($con, $uq) or die(" User Query Failed ");
    $userRow = mysqli_fetch_array($u_res);
    $email = $userRow['email'];
    
    // get products
    $oq = $orderQuery.$oid."'";
    $o_res = mysqli_query($con, $oq) or die(" Order Query Failed ");    
    
    $items = "";
    $cost = 0;
    while ($orderRow = mysqli_fetch_array($o_res)) {
      $pid = $orderRow['pid'];
      $qty = $orderRow['amount'];
      
      $pq = $prodQuery.$pid."'";
      $p_res = mysqli_query($con, $pq) or die(" Product Query Failed ");
      $prodRow = mysqli_fetch_array($p_res);
      $pname = $prodRow['pname'];
      $price = $prodRow['price'];
      
      $items .= ($items == "") ? "" : ", ";
      $items .= $pname." [x$qty]";
      
      $cost += $qty * $price;      
    }

    $values = array($store, $email, $items, $cost);
    $output .= addTableRow($values);
    
    $i++;
  }
  
  if ($i == 0) { 
    echo "<p style='text-align: center'><font color='red'>No transactions found between given dates.</font></p>";
    return;
  }
  
  $output .= "</tbody></table>";
  echo $output;
}


?>