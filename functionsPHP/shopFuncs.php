<?php

function printCategories($con, $selected){
    $query =   "SELECT * FROM category";								
	$result = mysqli_query($con, $query) or die(" Query failed ");
    
    while($row = mysqli_fetch_array($result)) {
		$name = $row['name'];
        $class = ($name == $selected) ? "selmenuitem" : "menuitem";
        
        echo " <div class ='$class'>$name</div>";
    }
}

?>