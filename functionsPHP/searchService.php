<?php
	session_start();
	include('dbConnection.php');
	include('searchFuncs.php');
	
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

	//echo "QUERY>>>".$basicQuery."<<<END";
	echo stringOfQuery($con, $basicQuery);
	closeDBConnection($con);    // close the database connection
	
	
	/*
	search queries
	
	//SELECT * FROM product WHERE pname LIKE '%%'
	SELECT * FROM product WHERE price > '1000'
	SELECT * FROM product WHERE price > '1000' AND price < '1100'
	SELECT * FROM product WHERE price > '1000' AND price < '1100' AND pcategory = 'stoves_ranges'
	//$basicQuery .= "price > '1000'";
		
	*/
?>
