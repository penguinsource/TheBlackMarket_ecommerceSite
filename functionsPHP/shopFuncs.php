<?php

function printCategories($con, $selected){
    $query =   "SELECT * FROM category";								
	$result = mysqli_query($con, $query) or die(" Query failed ");
    
    $number = mysqli_num_rows($result);
    $selIndex = 1;
    
    while($row = mysqli_fetch_array($result)) {
        $name = $row['name'];
		$id = $row['id'];
		if ($id == $selected) break;
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
		$id = $row['id'];
        $class1 = ($id == $selected) ? "selmenuitem" : "menuitem";
        $class2 = ($i == $number) ? " menuitembottom" : "";
		$class3 = ($i == 1) ? "" : " menuitemtopborder";
        $class = $class1 . $class2 . $class3;
        $imgpre = ($i == ($selIndex - 1)) ? "<img style='display: ;position:relative; float:right;' src='../design/corner-br.png'>" : "";
        $imgpost = ($i == ($selIndex + 1)) ? "<img style='display: ;position:relative; float:right;' src='../design/corner-tr.png'>" : "";
        echo "";
        echo "<a href='shop/$id'> <div class ='$class'>$name $imgpre $imgpost</div></a>\n";
        $i++;
    }
}

function printProducts($con, $category){
	$query =   "SELECT * FROM product WHERE pcategory='$category'";								
	$result = mysqli_query($con, $query) or die(" Query failed ");
	
	$i = 1;
	while($row = mysqli_fetch_array($result)) {
		$id = $row['pid'];
		$img = $row['imageurl'];
		$name = $row['pname'];
		$price = $row['price'];
		$quantity = $row['quantity'];
		$br = "";
		
		//GET RATING HERE
		$rating = rand(0,5);
		$ratingString = "";
		if ($rating == 0){
			$ratingString = "No Rating";
		} else {
			$j = 0;
			// print full stars
			for ($j = 0; $j < $rating; $j++){
				$ratingString = $ratingString . "<img src='design/star.png'>";
			}
			
			//print empty stars
			for ($k = $j; $k < 5; $k++){
				$ratingString = $ratingString . "<img src='design/starempty.png'>";
			}
		}
		////////////////
		
		$border = " product-rightborder";
        if ($i == 4){
			$i = 1;
			$border = "";
			$br = "<br><br><br><br>";
		}
		$i++;
		
		echo "<div class='product$border'> \n";
			echo "<a href='products/$category/$id'> <img class='imgthumb' src='images/$img'> \n";
			echo "<p class='product-name'>$name</p> </a> \n";
			echo "<div class='product-rating'>";
				echo $ratingString;
			echo "</div>";
			echo "<div class='product-price'>$$price</div>";
			//EDIT LINK FOR CART
			echo "<div class='product-stock'>In Stock: $quantity <a href='somecartlinkiunno'><div class='testbutton'> Add to Cart</div></div></a>";
		echo "</div>";
		echo $br;
    }
}

?>