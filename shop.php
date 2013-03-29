<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php include("functionsPHP/generalFuncs.php"); ?>
<?php include("functionsPHP/shopFuncs.php"); ?>
<?php include("functionsPHP/dbConnection.php"); ?>
<?php checkPage(); ?>
<html>

<head>
	<!--<style type="text/css">
		body{font-family: Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;}
	</style>-->
	<LINK REL=STYLESHEET HREF="design/shop.css" TYPE="text/CSS">
</head>

<body>

<?php
    $con = connectToDB();
    $category = $_GET["category"];
/*echo "category: ". $_GET["category"] ."<br><br>";

echo "Hello from Blah !";
// this should be the page that displays products (of any category)

if (isset($_GET["productsType"])){
	// display ..
	// call the products of type 'productsType' from database
	echo "GET productsType is: ".$_GET["productsType"] . "<br>";
}
if (isset($_POST["productsType"])){
	// display ..
	// call the products of type 'productsType' from database
	echo "GET productsType is: ".$_POST["productsType"] . "<br>";
}

//not really tested, treat as pseudocode
//doesn't remove the base url
//$params = array();
$parts = explode('/', $_SERVER['REQUEST_URI']);
echo "<br> request uri is " . $_SERVER['REQUEST_URI'] . " <br>";
echo "parts: " . $parts[3] . " <br>"; */
//skip through the segments by 2
//for($i = 0; $i < count($parts); $i = $i++){
  //first segment is the param name, second is the value 
  //$params[$parts[$i]] = $parts[$i+1];
  //echo "a: " . $params[$parts[$i]] . " <br>";
//}

//and make it work with your exsisting code
//$_GET = $params;
?>
</body>

<div class='main'>
	<div class='sidemenu'>
        <?php printCategories($con, $category); ?>
    </div>
    
    <div class='body'>
        hi penis<br>
        hi penis<br>
        hi penis<br>
        hi penis<br>

    </div>
</div>

</html>
