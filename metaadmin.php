<html>
<body>

<?php
include 'functionsPHP/dbConnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $con = connectToDB();
    if (isset($_POST['insert'])){
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
            
            $query = "INSERT INTO product VALUES ('$cid', '$category','$name','$desc','$image','$price')";
            echo "INSERTED $cid <br>";
            mysqli_query($con, $query);
            
           
        }
        fclose($file);
    } else if(isset($_POST["quantities"])){
        $quan = $_POST['quantity'];
        $con = connectToDB();
            
        $query = "SELECT pid from product";
        
        $result = mysqli_query($con, $query);
    
        if ($result) {
            echo "setting all quantities to $quan <br>";
            while($row = mysqli_fetch_array($result)) {
                $cid = $row[0];
                
                $query = "UPDATE product SET quantity='$quan' WHERE pid='$cid'";
                mysqli_query($con, $query);
            }    
        }
    } else if(isset($_POST["updateCats"])){
            
        $query = "SELECT DISTINCT pcategory from product";
        
        $result = mysqli_query($con, $query);
    
        if ($result) {
            while($row = mysqli_fetch_array($result)) {
                $name = $row[0];
                
                $query = "INSERT INTO category VALUES ('$name')";
                echo "inserting category: '$name' <br>";
                mysqli_query($con, $query);
            }    
        }
    }
    mysqli_close($con);
    
}

?>

<form name='test' action='metaadmin.php' method='POST'>

	<input type="submit" name="insert" value="insert json products"><br>
    <input type="submit" name="quantities" value="SET Quantities"><input type="text" name="quantity"><br>
    <input type="submit" name="updateCats" value="Update Categories">
    
</form>

</body>
</html>
