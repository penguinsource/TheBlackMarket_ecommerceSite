<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php include("functionsPHP/generalFuncs.php"); ?>
<?php include("functionsPHP/shopFuncs.php"); ?>
<?php include("functionsPHP/dbConnection.php"); ?>
<?php 
	checkPage(); 
	$baseURL = "http://" . $_SERVER[HTTP_HOST] . "/";
?>
<html>

<head>
	<!--<style type="text/css">
		body{font-family: Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;}
	</style>-->
	<LINK REL=STYLESHEET HREF="<?= $baseURL; ?>design/shop.css" TYPE="text/CSS">
	<base href="//blackmarket5.hostei.com" />
	
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script  src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.15/jquery-ui.min.js"></script>
	<script  src="<?= $baseURL; ?>functionsJS/jquery.animate-colors.js"></script>
	<script >
		$(document).ready(function(){
			$('.menuitem').hover(function () {
				$(this).stop(true, true).addClass('menuhover', 100);
				$(this).addClass('menuhover', 250);
			},
			function () {
				$(this).stop(true, true).removeClass('menuhover', 100);
				$(this).removeClass('menuhover', 100);
			});
		});
	</script>
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
	<div class='sidemenu' id='sidemenu'>
        <?php printCategories($con, $category); ?>
    </div>
    
    <div class='body'>
        Lorem Impsum Shmipsum Dipsum

    </div>
</div>

</html>
