<?php

function printSearchResults($con, $category){
	$query =   "SELECT * FROM product WHERE pcategory='$category'";								
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
		$rating = rand(0,5);
		$ratingString = "";
		if ($rating == 0){
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
					<div onClick='addToCart(\"$id\",\"$name\",$price,\"$img\");' class='cart-button'> Add to Cart</div></a></div>";
		echo "</div>";
		echo $br;
    }
}

?>