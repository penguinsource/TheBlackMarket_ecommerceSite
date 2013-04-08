<?php
	session_start();
	include('dbConnection.php');
	//include('searchFuncs.php');
	
	/* INIT BASIC QUERY */
	$con = connectToDB();		// open db connection
	$basicQuery = "SELECT * FROM product WHERE ";
	
	/* APPEND THE TYPE OF SEARCH AND ITS QUERY */
	
	// search types are: by code, by name, by category
	if (isset($_POST['searchType']) && isset($_POST['searchQuery'])){
		$searchType = $_POST['searchType'];
		$searchQuery = $_POST['searchQuery'];
		$basicQuery .= "($searchType LIKE '%$searchQuery%') ";
	}
	
	/* PARSE AND ANALYZE CATEGORIES SELECTED */
	$allCategories = 1;														// SELECTED category counter
	if (isset($_POST['categories'])){
		$categoriesArray = json_decode(stripslashes($_POST['categories']));	// decode the categories json
		// print_r(stripslashes($_POST['categories']));
		$categoriesSelected = 0;
		foreach ($categoriesArray as $key => $value) {						// check if all the categories are selected
			//echo "val: $key -> $value \n";								// count the # of categories that are selected
			if (!$value){$allCategories = 0;}else{$categoriesSelected++;}
		}
	}	
	
	/* APPENDING CATEGORIES TO THE QUERY */
	if (!$allCategories){			// if not all categories are included in the query.. then go through each and see which is selected
		if ($categoriesSelected){
		$basicQuery .= "AND ( ";		// if some categories are selected, append 'AND' as there are categories conditions to append
			foreach ($categoriesArray as $key => $value) {
				if ($value){			// if category '$key' is selected
					if ($categoriesSelected > 1){
						$basicQuery .= "pcategory = '$key' OR ";	// append to Query the selected category
						--$categoriesSelected;
					}else {				// append selected category 
						$basicQuery .= "pcategory = '$key' ) ";	// this is the last category selected, don't add 'OR' at the end of the query
						--$categoriesSelected;
					}
				}
			}
		}	// else no categories are selected at all
	}	// else all categories are selected and included in the query, do not append anything to query
	
	// APPENDING PRICES to the query
	if (isset($_POST['priceLowArg']) && isset($_POST['priceHighArg'])){
		$priceLow = $_POST['priceLowArg'];
		$priceHigh = $_POST['priceHighArg'];
		$basicQuery .= "AND (price > '$priceLow' AND price < '$priceHigh' ) ";
	}
	
	// APPENDING QUANTITY to the query
	if (isset($_POST['minQuantity'])){
		$minQuantity = $_POST['minQuantity'];
		$basicQuery .= "AND (quantity > '$minQuantity') ";
	}
	
	// APPENDING WEIGHT to the query
	if (isset($_POST['weightLowArg']) && isset($_POST['weightHighArg'])){
		$weightLow = $_POST['weightLowArg'];
		$weightHigh = $_POST['weightHighArg'];
		$basicQuery .= "AND (weight > '$weightLow' AND weight < '$weightHigh' ) ";
	}	
	
	$origResultCount = 0;	// global counter
	$modResultCount = 0;	// global counter
	$modified_results = '';
	//echo "QUERY>>>".$basicQuery."<<<END";
	$original_results =  stringOfQuery($con, $basicQuery);
	closeDBConnection($con);    // close the database connection
	
	$returnObject = array();
	// types: 'normal' ( no recommendations needed )
	// 		  'extra' ( too many results - constrained search results in 'modifiedResults' )
	//		  'few' ( too few results - broadened search results in 'modifiedResults' )
	
	$returnObject['type'] = 'normal';
	$returnObject['originalResults'] = $original_results;
	$returnObject['originalResultCount'] = $GLOBALS['origResultCount'];
	$returnObject['modifiedResults'] = $GLOBALS['modified_results'];
	//$returnObject['modifiedResultsCount'] = $GLOBALS['modResultCount'];
	echo (json_encode($returnObject));
	/*
	search queries
	
	//SELECT * FROM product WHERE pname LIKE '%%'
	SELECT * FROM product WHERE price > '1000'
	SELECT * FROM product WHERE price > '1000' AND price < '1100'
	SELECT * FROM product WHERE price > '1000' AND price < '1100' AND pcategory = 'stoves_ranges'
	//$basicQuery .= "price > '1000'";
		
	*/
	
	function searchQuery($con, $query){
		$resultCount;
		stringOfQuery($con, $query);
	}

function stringOfQuery($con, $query){						
	$result = mysqli_query($con, $query) or die(" Query failed ");
	$returnString = '';
	$returnString .= $query . "<br>";
	$i = 1;
	while($row = mysqli_fetch_array($result)) {
		$id = $row['pid'];
		$img = $row['imageurl'];
		$name = $row['pname'];
		$desc = $row['pdesc'];
		$price = $row['price'];
		$quantity = $row['quantity'];
		$category = $row['pcategory'];

		$br = "";
		
		// increase the resultCount
		$GLOBALS['origResultCount']++;
		
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
			//$border = "";
			$br = "<br><br><br><br>";
		}
		$i++;
		/*
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
		*/
		$returnString .= "<div class='product$border'>";
		$returnString .= "<a href='product/$category/$id'> <img class='imgthumb' src='images/$img'> ";
		$returnString .= "<p class='product-name'>$name</p> </a> ";
		$returnString .= "<div class='product-rating'>";
		$returnString .= $ratingString;
		$returnString .= "</div>";
		$returnString .= "<div class='product-price'>$$price</div>";
		$returnString .= "<div class='product-stock'>In Stock: $quantity <a href='javascript:void(0)'>
					<div onClick='addToCart(\"$id\",\"$name\",$price,\"$img\");' class='cart-button'> Add to Cart</div></a></div>";
		$returnString .= "</div>";
		//$returnString .= $br;
    }
	return $returnString;
}
?>
