<?php
	session_start();
	include("dbConnection.php");
	/*
	if (isset($_POST["loginName"])){
		loginUser();
		if (isset($_SESSION["email"])){
			echo $_SESSION["email"];	// send back the email of the user logged in
		}
	} else if (isset($_POST["registerName"])){
		registerUser();
		if (isset($_SESSION["email"])){
			echo $_SESSION["email"];	// send back the email of the user logged in
		}
	} else if (isset($_POST["logOut"])){
		logoutUser();
	} else {
		echo "fail request POST! see file authenticationFuncs.php";	// incorrect POST request sent here..
	}
	*/
	if (isset($_POST['type'])){
		if ($_POST['type'] == 'login'){
			loginUser();
			if (isset($_SESSION["email"])){
				// send back the email of the user logged in
				echo json_encode(array('type'=>'success', 'value'=>$_SESSION["email"]));
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
		die('Error ! No type sent.. see file authenticationFuncs.php');
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
        . " (null,'$email','$password', null, null, null, null, null, null)";

        if (!mysqli_query($con,$registerQuery)){
                die('Error inserting into database.. ');
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
        closeDBConnection($con);    		// close the database connection
    }
    
    function logoutUser(){
        session_destroy();
    }
    /*
	function sendResponse($type, $value){
		$reponse = array();
	$response['type'] = $type;
	$response['value'] = $value:
	echo json_encode($response);
	}*/
?>
