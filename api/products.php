<?php
/*

// [#3] returns all the product ids that are currently in stock:
GET /products
return = {
  "products": [
      { "id": "c000001" },
      { "id": "c000002" }
   ]
}

// [#1] get more details about a given product
GET /products/:id
return = {
  id: "c000001",
  category:"oven",
  name:"OvenMaster",
  desc:"A really good oven!",
  img:"","price":"1999.99",
  weight:"200lbs",
  dim:"10x20x30",
  quantity:"3"
}

// [#2] purchase a product from another store by sending an HTTP POST request
POST /products/:id/order
params: amount
return = {
  order_id: "",
  "delivery_date": ""
}

*/

include("../functionsPHP/dbConnection.php");

/* echo "ORIGIN: " . $_SERVER["REMOTE_ADDR"]; */

if (isset($_GET["id"]) && (isset($_POST["amount"]))){ // #2
    // echo "id=".$_GET["id"];
    purchaseProduct($_GET['id'], $_POST["amount"]);
} else if (isset($_GET["id"])){ // #1
    //echo "ordering for id=".$_POST["id"];
    retProdDetails($_GET["id"]);
} else { // #3
    // return json with all products
    retAllProducts();
}

function retAllProducts(){
    $con = connectToDB();
    $query = "SELECT pid FROM product WHERE quantity > 0";
    $result = mysqli_query($con,$query);	        // query db	
    $list = array();
    
    while ($row = mysqli_fetch_array($result)){         // extract value from query
        $rowArray = array("id"=>$row[0]);
        array_push($list, $rowArray);
    }
    $productsList = array("products"=>$list);
    $json = json_encode($productsList); 
    echo $json;
    //print_r($json);
    
    closeDBConnection($con);
}

function retProdDetails($pID){
    $con = connectToDB();
    $query = "SELECT * FROM product WHERE pid = '$pID'";
    $result = mysqli_query($con,$query);	        // query db	
    $productDetails = array();                          // store the product details
   
    //$row = mysqli_fetch_array($result);
    $row = mysqli_fetch_assoc($result);

    // echo "pid:" . $row['pid'] . "<br>";
    $productDetails['id'] = $row['pid'];
    $productDetails['category'] = $row['pcategory'];
    $productDetails['name'] = $row['pname'];
    $productDetails['desc'] = $row['pdesc'];
    $productDetails['img'] = $row['imageurl'];
    $productDetails['price'] = $row['price'];
    //$productDetails['weight'] = $row['weight'];
    //$productDetails['dim'] = $row['dim'];
    $productDetails['quantity'] = $row['quantity'];
    $json = json_encode($productDetails); // encode the json and send it back.
    echo $json;
    
    closeDBConnection($con);
}

/*
    array_push($productDetails, array("id"=>$row['pid']));
    array_push($productDetails, array("category"=>$row['pcategory']));
    array_push($productDetails, array("name"=>$row['pname']));
    array_push($productDetails, array("desc"=>$row['pdesc']));
    array_push($productDetails, array("img"=>$row['imageurl']));
    array_push($productDetails, array("price"=>$row['price']));
    //array_push($productDetails, array("weight"=>$row['weight']));
    //array_push($productDetails, array("dim"=>$row['dim']));
    array_push($productDetails, array("quantity"=>$row['quantity']));
*/

function purchaseProduct($pid, $amount){
    $con = connectToDB();
    
	// all other stores will use ONE userid ( with email: $otherStoresUserid) when storing their orders in our db
	$otherStoresUserid = '';
	// userid for ALL the other stores
	$other_stores_useremail = "OTHER_STORES";
	// check if it exists in the db already;
	$queryCheckUser = "SELECT userid FROM user WHERE email = '$other_stores_useremail'";
	$resultUserid = mysqli_query($con, $queryCheckUser);
	$rowUserid =  mysqli_fetch_row($resultUserid);
	// if it does, take its userid (using it to record the purchases of other stores in our db)
	// saving the userid in var $otherStoresUserid (if it exists)
	$otherStoresUserid = $rowUserid[0];
	// if it doesn't, create a new user with email and pass $other_stores_useremail
	// and grab it's (auto incremented) userid stored in the user table
	if (($rowUserid == null) || ($rowUserid == "")){
		$addUseridQuery = "INSERT INTO user VALUES (null, '$other_stores_useremail', '$other_stores_useremail', null, null,".
		" null, null, null, null);";
		// create new user with email $other_stores_useremail ("OTHER_STORES")
		mysqli_query($con, $addUseridQuery);
		$queryCheckUser2 = "SELECT userid FROM user WHERE email = '$other_stores_useremail'";
		$resultUserid2 = mysqli_query($con, $queryCheckUser2);
		$rowUserid2 =  mysqli_fetch_row($resultUserid2);
		// saving the userid in var $otherStoresUserid
		$otherStoresUserid = $rowUserid2[0];
	}
	
	// Using '$rowUserid' as userid for all other stores. will add orders in table userOrders using it as userid.
	// For now, can't differentiate which store bought products from us, except that it's a different store.
	
    // check if there are enough products (fail-safe)
    $query = "SELECT * FROM product WHERE pid = '$pid'";
    $result = mysqli_query($con,$query);	        // query db
    $row = mysqli_fetch_assoc($result);
    $stockQuantity = $row["quantity"];
    
    if ($amount > $stockQuantity){
        echo "ERROR! Not enough products in stock ! THIS SHOULD NEVER BE CALLED !";
        return;
    }
    $quantityRemaining = $stockQuantity - $amount;  // check the # of in stock products
    
    // substract amount from the current stock quantity and update database
    $queryInsert = "UPDATE product SET quantity = '$quantityRemaining' WHERE pid = '$pid'";
    mysqli_query($con, $queryInsert);
    
    // get current count of orders
    $queryCount = "SELECT COUNT(*) FROM userOrders";
    $resCount = mysqli_query($con, $queryCount);
    $orderCount = mysqli_fetch_row($resCount);
    $orderid = "bmorder".($orderCount[0]+1);
    
    // --------------------------------------------
    // Add the user/transaction in table 'userOrders'
	
    // delivery date = today + 1 day (86400 seconds)
    $currDate = date("Y-m-d");
    $delivery_date = date('Y-m-d', strtotime($currDate . ' + 1 day'));
    $queryOrderIns = "INSERT INTO userOrders (orderid, userid, delivery_date) VALUES ('$orderid', '$otherStoresUserid', '$delivery_date');";
    mysqli_query($con, $queryOrderIns);
    
    // --------------------------------------------
    // Add the orderid/productid/amount in table 'productOrders'
    $queryOrderProducts = "INSERT INTO productOrders (orderid, pid, amount) VALUES ('$orderid', '$pid', '$amount');";
    mysqli_query($con, $queryOrderProducts);
	
	// Returning the json object with the order id and the delivery date
    $orderDetails = array();                        // store the order details
    $orderDetails['order_id'] = $orderid;           // save order details
    $orderDetails['delivery_date'] = $delivery_date;
    $json = json_encode($orderDetails);             // encode the json and send it back.
    echo $json;										// return json
    
    closeDBConnection($con);
}

?>
