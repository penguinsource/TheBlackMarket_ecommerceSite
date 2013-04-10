<?php

function printCategories($con, $selected){
    $query =   "SELECT * FROM category;";								
	$result = mysqli_query($con, $query) or die("Shop Query getting categories failed");
    
    $number = mysqli_num_rows($result);
    $selIndex = 1;
    
    while($row = mysqli_fetch_array($result)) {
        $name = $row['name'];
		$id = $row['id'];
		//echo 'name: $name';
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
		//echo 'cate name:'.$name;
        $class1 = ($id == $selected) ? "selmenuitem" : "menuitem";
        $class2 = ($i == $number) ? " menuitembottom" : "";
		$class3 = ($i == 1) ? "" : " menuitemtopborder";
        $class = $class1 . $class2 . $class3;
        $imgpre = ($i == ($selIndex - 1)) ? "<img style='display: ;position:relative; float:right;' src='../design/images/corner-br.png'>" : "";
        $imgpost = ($i == ($selIndex + 1)) ? "<img style='display: ;position:relative; float:right;' src='../design/images/corner-tr.png'>" : "";
        echo "";
        echo "<a href='shop/$id'> <div class ='$class'>$name $imgpre $imgpost</div></a>\n";
        $i++;
    }
}

function printProducts($con, $category, $sortType){
	$query = "SELECT * FROM product WHERE pcategory='$category' ";
	
	// grabbing a sorted list of products (sorted by $sortType)
	if ($sortType == 'noSorting'){
	} else if ($sortType == 'lowestPrice'){
		$query .= "ORDER BY price ASC";
	} else if ($sortType == 'highestPrice'){
		$query .= "ORDER BY price DESC";
	}

	$result = mysqli_query($con, $query) or die(" Query failed ");
	
	$i = 1;
	while($row = mysqli_fetch_array($result)) {
		$id = $row['pid'];
		$img = $row['imageurl'];
		$name = $row['pname'];
		$desc = $row['pdesc'];
		$price = $row['price'];
		$quantity = $row['quantity'];
		$br = "";
		
		//GET RATING HERE
		$rating = getRating($con,$id);
		$ratingString = "";
		if ($rating == 0) {
			$ratingString = "No Rating";
		} else {
			$j = 0;
			// print full stars
			for ($j = 0; $j < $rating; $j++){
				$ratingString = $ratingString . "<img src='design/images/star.png'>";
			}
			
			//print empty stars
			for ($k = $j; $k < 5; $k++){
				$ratingString = $ratingString . "<img src='design/images/starempty.png'>";
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
			echo "<a href='product/$category/$id'> <img class='imgthumb' src='images/$img'> \n";
			echo "<p class='product-name'>$name</p> </a> \n";
			echo "<div class='product-rating'>";
				echo $ratingString;
			echo "</div>";
			echo "<div class='product-price'>$$price</div>";
			//EDIT LINK FOR CART
			echo "<div class='product-stock'>In Stock: $quantity <a href='javascript:void(0)'>
					<div onClick='addToCart(\"$id\",\"$name\",$price,\"$img\", 1);' class='cart-button'> Add to Cart</div></a></div>";
		echo "</div>";
		echo $br;
    }
}

function getRating($con, $pid){
	$query = "SELECT ratingSum, ratingCount FROM product WHERE pid='$pid';";								
	$result = mysqli_query($con, $query) or die(" Query failed ");
	$row = mysqli_fetch_array($result);
	
	$ratingSum = $row['ratingSum'];
	$ratingTotal = $row['ratingCount'];
	
	if ($ratingTotal == 0) return 0;
	
	return round($ratingSum/$ratingTotal);
}

?>
