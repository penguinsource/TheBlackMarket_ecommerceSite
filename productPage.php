<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php include("functionsPHP/generalFuncs.php"); ?>
<?php checkPage(); ?>
<html>
<head>
</head>

<body>

<?php

echo "Hello from Blah !";
// this should be the page that displays products (of any category)

if (isset($_GET["productsType"])){
	// display ..
	// call the products of type 'productsType' from database
	
}


?>
</body>

</html>