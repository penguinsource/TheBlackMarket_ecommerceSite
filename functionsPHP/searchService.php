<?php
	session_start();
	include('dbConnection.php');
	include('searchFuncs.php');
	/*if (isset($_POST['type'])){
		if ($_POST['type'] == 'login'){
			$carttotal = loginUser();
			if (isset($_SESSION["email"])){
				// send back the email of the user logged in
				echo json_encode(array('type'=>'success', 'value'=>$_SESSION["email"], 'cartTotal'=>$carttotal));
			}
		} else if ($_POST['type'] == 'register'){
			registerUser();
			if (isset($_SESSION["email"])){
				// send back the email of the user logged in
				echo json_encode(array('type'=>'success', 'value'=>$_SESSION["email"]));
			}
		} else if ($_POST['type'] == 'logout'){
			logoutUser();
		}
	} else {
		echo json_encode(array('type'=>'success', 'value'=>'Error ! No type sent.. see file authenticationFuncs.php'));
		die();
	}
	*/
	//echo "hello";

	
	if (isset($_POST['priceFilterLow'])){
		
	}
	if (isset($_POST['priceFilterHigh'])){
		
	}
	if (isset($_POST['priceFilterLow'])){
		
	}
	if (isset($_POST['dishwashers'])){
		//echo "it is set.. to smthing:";
	}else{
		//echo "its not !";
	}
	
	$allCategories = 1;
	if (isset($_POST['categories'])){
		$categoriesArray = json_decode(stripslashes($_POST['categories']));
		// print_r(stripslashes($_POST['categories']));
		$categoriesSelected = 0;
		foreach ($categoriesArray as $key => $value) {
			//echo "val: $key -> $value \n";
			if (!$value){$allCategories = 0;}else{$categoriesSelected++;}
		}
	}
	
	$con = connectToDB();		// open db connection
	$basicQuery = "SELECT * FROM product WHERE ";
	
	// APPENDING CATEGORIES to query
	if (!$allCategories){			// if not all categories are included in the query.. then go through each and see which is selected
		foreach ($categoriesArray as $key => $value) {
			if ($value){			// if category '$key' is selected
				if ($categoriesSelected > 1){
					$basicQuery .= "pcategory = '$key' OR ";	// append to Query the selected category
					--$categoriesSelected;
				}else {				// append selected category 
					$basicQuery .= "pcategory = '$key' ";	// this is the last category selected, don't add 'OR' at the end of the query
					--$categoriesSelected;
				}
			}
		}
	}	// else if all categories are included in the query, do not append anything to query
	
	//SELECT * FROM product WHERE pcategory = 'dishwashers' OR pcategory = 'freezers'
	
	//$basicQuery .= "price > '1000'";
	//echo "QUERY: ".$basicQuery." :END";
	echo stringOfQuery($con, $basicQuery);
	closeDBConnection($con);    // close the database connection
	
	/*
	
	search queries
	
	SELECT * FROM product WHERE price > '1000'
	SELECT * FROM product WHERE price > '1000' AND price < '1100'
	SELECT * FROM product WHERE price > '1000' AND price < '1100' AND pcategory = 'stoves_ranges'
	
	
	*/
?>
