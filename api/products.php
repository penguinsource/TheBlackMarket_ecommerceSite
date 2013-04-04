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
    $productsList = array("Products"=>$list);
    $json = json_encode($productsList, JSON_PRETTY_PRINT); // 
    echo $json;
      print_r($json);
    
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
    $json = json_encode($productDetails); //
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
    // check if there are enough products 
    $query = "SELECT * FROM product WHERE pid = '$pid'";
    $result = mysqli_query($con,$query);	        // query db
    $row = mysqli_fetch_assoc($result);
    $stockQuantity = $row["quantity"];
    
    if ($amount > $stockQuantity){
        echo "Not enough products in stock ! THIS SHOULD NEVER BE CALLED !";
        return;
    }
    $quantityRemaining = $stockQuantity - $amount;
    // substract amount from the current stock quantity and update database
    $queryInsert = "UPDATE product SET quantity = '$quantityRemaining' WHERE pid = '$pid'";
    mysqli_query($con, $queryInsert);
    
    $orderDetails = array();
    
    
}

?>
