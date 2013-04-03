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

if (isset($_GET["id"])){ // #1
    // echo "id=".$_GET["id"];
    retProdDetails($_GET["id"]);
} else if (isset($_POST["id"]) && isset($_POST["order"])){ // #2
    //echo "ordering for id=".$_POST["id"];
    
} else { // #3
    // return json with all products
    retAllProducts();
}

echo "hello from products page";

function retAllProducts(){
    $con = connectToDB();
    $query = "SELECT pid FROM product WHERE quantity > 0";
    $result = mysqli_query($con,$query);	        // query db	
    $list = array();
    
    while ($row = mysqli_fetch_array($result)){         // extract value from query
        echo $row[0] . ", ";
        $rowArray = array("id"=>$row[0]);
        array_push($list, $rowArray);
    }
    $productsList = array("Products"=>$list);
    $json = json_encode($productsList); // 
    echo $json;
    
    closeDBConnection($con);
}

function retProdDetails($pID){
    $con = connectToDB();
    $query = "SELECT * FROM product WHERE pid = '$pID'";
    $result = mysqli_query($con,$query);	        // query db	
    $productDetails = array();                          // store the product details
   
    //$row = mysqli_fetch_array($result);
    $row = mysqli_fetch_assoc($result);
    echo "pid:" . $row['pid'] . "<br>";
    //$row = mysqli_fetch_assoc($result);
    echo "category:" . $row['pcategory'];
    
    //echo $row[0] . "<br>" . $row[1] . "<br>" . $row[2] . "<br>" .
    //$row[3] . "<br>" . $row[4]. "<br>" . $row[5]. "<br>" . $row[6] . "<br>";
    //$rowArray = array("id"=>$row[0]);
    //array_push($productDetails, $rowArray);
    
    $json = json_encode($productsList); // 
    closeDBConnection($con);
}

?>
