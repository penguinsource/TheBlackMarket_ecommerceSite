<?php

function printCategories($con, $selected){
    $query =   "SELECT * FROM category";								
	$result = mysqli_query($con, $query) or die(" Query failed ");
    
    $number = mysqli_num_rows($sql);
    $i = 1;
    
    while($row = mysqli_fetch_array($result)) {
		$name = $row['name'];
        $class1 = ($name == $selected) ? "selmenuitem" : "menuitem";
        $class2 = ($i == $number) ? " menuitembottom" : "";
        $class = $class1 . $class2;
        
        echo "<a href='shop.php?category=$name'> <div class ='$class'>$name</div></a>\n";
        $i++;
    }
}

?>