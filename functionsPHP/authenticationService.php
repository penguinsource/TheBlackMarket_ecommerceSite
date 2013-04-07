<?php
	session_start();
	include("dbConnection.php");
	include("ChromePhp.php");
	
	if (isset($_POST['type'])){
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
			echo json_encode(array('type'=>'success', 'value'=>'logged out'));
		} else if ($_POST['type'] == 'checklogin'){
			if (isset($_SESSION["email"])){
				echo "1";
			} else {
				echo "0";
			}
			die();
		}
	} else {
		echo json_encode(array('type'=>'success', 'value'=>'Error ! No type sent.. see file authenticationFuncs.php'));
		die();
	}

    function registerUser(){
       $con = connectToDB();
		
        // validate email; should no be null or have an incorrect format
        if (isset($_POST['email'])){
            $email = $_POST['email'];
        }
        // check if email is empty
        if (($email == '') or ($email == null)){
				echo json_encode(array('type'=>'error', 'value'=>'Your email must be filled out !'));
                die();
        }
        
        $emailRegex = '/^([a-zA-Z0-9])([a-zA-Z0-9\._-])*@(([a-zA-Z0-9])+(\.))+([a-zA-Z]{2,4})+$/';
        if(!preg_match($emailRegex,$email)){
				echo json_encode(array('type'=>'error', 'value'=>'That\'s not an email. Please retry !'));
                die();
        }
		
		// Check for duplicate emails ------
		$queryCheckEmail = "SELECT COUNT(*) FROM user WHERE email = '$email';";
		$resultEmailCheck = mysqli_query($con, $queryCheckEmail) or die("Query failed checking user's email in db.");
		$emailValidity = mysqli_fetch_array($resultEmailCheck);
		
		// if there is another one.. then registration cannot continue as $email is already used by another user
		if ($emailValidity[0] > 0){
			echo json_encode(array('type'=>'error', 'value'=>'This email is already in use !'));
			die();
		}
        
		// check password to password written again
		if ($_POST['password'] != $_POST['password2']){
			echo json_encode(array('type'=>'error', 'value'=>'Password don\'t match'));
            die();
		}
		
        // validate password; should no be null or < 6 characters ------
        if (isset($_POST['password'])){
            $password = $_POST['password'];
        }
        if (($password == '') or ($password == null)){
			echo json_encode(array('type'=>'error', 'value'=>'Did you forget to write a password ?'));
            die();
        }
        
        if (strlen($password) < 6){
			echo json_encode(array('type'=>'error', 'value'=>'Your password must have more than 6 characters. Please retry !'));
            die();
        }
        
        // insert user into database
        $registerQuery="INSERT INTO user VALUES" 
        . " (null,'$email','$password', null, null, null, null, null, null, null)";

        if (!mysqli_query($con,$registerQuery)){
                die('Error inserting into database.. ');
        }
		
		// if a cart exists, save it to the user
		if (isset($_SESSION['cart'])){
			$query = "UPDATE user SET cart = '" . $_SESSION['cart'] . "' WHERE email = '$email'";
			mysqli_query($con, $query);
		}

        
        closeDBConnection($con);    // close the database connection
        
        //session_start();            // start a php session
        $_SESSION['email']=$email;  // save the email of the user in the session
    }
    
    function loginUser(){
        $con = connectToDB();   // connect to the database
        $email = "";
        $password = "";
        
        // grab the login email entered
		if (isset($_POST["email"]) and ($_POST['email'] != "")){
			$email = $_POST["email"];
        } else {
			echo json_encode(array('type'=>'error', 'value'=>'No username ? You need to register first !'));
            die();
        }
        
         // grab the login password entered
		if (isset($_POST['password']) and ($_POST['password'] != "")){
			$password = $_POST['password'];
        } else {
			echo json_encode(array('type'=>'error', 'value'=>'Did you forget your password?'));
            die();
        }
		
        // query the email and password entered
        $loginQuery="SELECT * FROM user WHERE email = '$email' AND password = '$password'";
        
        $result = mysqli_query($con, $loginQuery);
        if (mysqli_num_rows($result) > 0){  // if true, then email and pass are correct
            $_SESSION['email']=$email;  	// save the email of the user in the session
        } else{
			echo json_encode(array('type'=>'error', 'value'=>'Incorrect user or password'));
            die();
        }
			
		//load cart from db
		$query="SELECT * FROM user WHERE email = '$email'";
		$result = mysqli_query($con, $loginQuery);
		
		$cartTotal = "0.00";
        if($row = mysqli_fetch_array($result)) {
			$cart = $row['cart'];
			
			$mergedcart = mergeCarts($cart);
			
			if (isset($mergedcart)){
				$_SESSION['cart'] = $mergedcart;
				$query = "UPDATE user SET cart = '$mergedcart' WHERE email = '$email'";
				mysqli_query($con, $query);
				$cartJSON = json_decode($mergedcart, true);
				$cartTotal = $cartJSON['total']; 
			}
			/*
			// if cart exists in db, merge the session and db cart
			if (isset($cart) && !($cart == "")){
				$_SESSION['cart'] = $cart;
				$cartJSON = json_decode(stripslashes($cart), true);
				$cartTotal = $cartJSON['total'];
			//if cart doesn't exist, try to save current cart to db
			} else {
				if (isset($_SESSION['cart'])){
					$cartJSON = json_decode(stripslashes($_SESSION['cart']), true);
					$cartTotal = $cartJSON['total'];
					$query = "UPDATE user SET cart = '" . $_SESSION['cart'] . "' WHERE email = '$email'";
					mysqli_query($con, $query);
				}
			}*/
		}
        closeDBConnection($con);    		// close the database connection
		
		return $cartTotal;
    }
    
    function logoutUser(){
		ChromePhp::log("logging out");
        unset($_SESSION['email']);
		session_destroy();
    }
	
	//takes json string $cart as param, merges with session cart, returns json string mergedcart
	function mergeCarts($cart){
		//if server cart isnt null
		if (isset($cart) && !($cart == "")){
			//if both are set, merge them
			if (isset($_SESSION['cart'])){
				ChromePhp::log("both are set, merging");
			
				$dbCart = json_decode($cart, true);
				$sessionCart = json_decode($_SESSION['cart'], true);
				
				// merge each item
				foreach($sessionCart['products'] as $sessionItem){
					//if item exits in dbcart, sum up the quantities
					$index = exists($sessionItem['id'], $dbCart['products']);
					if (isset($index)){
						$dbCart['products'][$index]['quantity'] += $sessionItem['quantity'];
					} else {		// else insert the item into the dbCart
						array_push($dbCart['products'], $sessionItem);
					}					
				}
				
				//sum up the totals
				$dbCart['total'] += $sessionCart['total'];
				
				//encode back to json 
				return json_encode($dbCart);
				
			} else {	// else return just the session cart
				ChromePhp::log("only db cart set, returning db cart");
				return $cart;
			}
		} else {	//server cart is null
			// if session cart is set, return it
			if (isset($_SESSION['cart'])){
				ChromePhp::log("only session cart set, returning session cart");
				return $_SESSION['cart'];
			} else {	//if neither is set, return null
				ChromePhp::log("neither set, returning null");
				return null;
			}
		}
	}
	
	function exists($id, $jsonArray){
		$i = 0;
		foreach ($jsonArray as $item){
			if ($item['id'] == $id){
				return $i;
			}
			$i++;
		} 

		return null;
	}

?>
