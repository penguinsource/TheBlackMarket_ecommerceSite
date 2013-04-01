<?php
/*
function printCategories($con, $selected){
    $query =  "SELECT * FROM category";								
	$result = mysqli_query($con, $query) or die(" Query failed ");
    
    $number = mysqli_num_rows($result);
    $selIndex = 1;
    
    while($row = mysqli_fetch_array($result)) {
        $name = $row['name'];
		if ($name == $selected) break;
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
        $class1 = ($name == $selected) ? "selmenuitem" : "menuitem";
        $class2 = ($i == $number) ? " menuitembottom" : "";
		$class3 = ($i == 1) ? "" : " menuitemtopborder";
        $class = $class1 . $class2 . $class3;
        $imgpre = ($i == ($selIndex - 1)) ? "<img style='display: ;position:relative; float:right;' src='../design/corner-br.png'>" : "";
        $imgpost = ($i == ($selIndex + 1)) ? "<img style='display: ;position:relative; float:right;' src='../design/corner-tr.png'>" : "";
        echo "";
        echo "<a href='shop/$name'> <div class ='$class'>$name $imgpre $imgpost</div></a>\n";
        $i++;
    }
}
*/
function printProduct($con, $prodID){
	$query = "SELECT * FROM product WHERE pid = '$prodID';";
	$result = mysqli_query($con, $query) or die("Query failed getting product details.");
	$row = mysqli_fetch_array($result);
	echo "Category: " . $row[1] . "<br>";
	echo "Description: " . $row[3] . "<br>";
	echo "Image url: " . $row[4] . "<br>";
	echo "Price: " . $row[5] . "<br>";
	echo "Quantity Available: " . $row[6] . "<br>";
}

?>