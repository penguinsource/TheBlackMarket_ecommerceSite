<html>
<body>

<?php
include 'generalFuncs.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $file = fopen("data.json.txt", "r");
    
    $category;
    $cid;
    $image;
    $name;
    $price;
    $desc;
    
    while (!feof($file)) {
		$line = fgets($file);
		$json = json_decode($line, true);
		
		$category = $json['category'];
		$cid = $json['cid'];
        $image = $json['image'];
        $name = $json['name'];
        $price = $json['price'];
        $desc = $json['desc'];
        
        $con = connectToDB();
        
        $query = "INSERT INTO products VALUES ('$pid', '$category','$name','$desc','$image','$price')";
        echo "executing query: " . $query;
        mysql_query($con, $query);
        
        mysql_close($con);
	}
	fclose($file);
}

?>

<form name='test' action='insertScript.php' method='POST'>

	<input type="submit" name="insert">

</form>

</body>
</html>
