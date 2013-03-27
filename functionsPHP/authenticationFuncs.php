<?php
	session_start();
	
	// GLOBAL VARIABLES:
    //$url_path = "http://localhost/a3";
	// local database vars
    /*$host = "localhost";
    $username = "root";
    $password = "";
    $database_name = "blackmarket";
	*/
	
	// NEW HOST: 
	$host = "mysql10.000webhost.com";
	$database_name = "a5900628_bmarket";
	$username = "a5900628_bmarket";
	$password = "blackmarket5";
	// //----------------------------------
	
	if (isset($_POST["loginName"])){
		loginUser();
		if (isset($_SESSION["email"])){
			echo $_SESSION["email"];
		}
	} else if (isset($_POST["registerName"])){
		registerUser();
		if (isset($_SESSION["email"])){
			echo $_SESSION["email"];
		}
	} else if (isset($_POST["logOut"])){
		logoutUser();
	} else {
		echo "fail request POST";
	}
	
    function connectToDB(){
	/*
		global $host;
		// reading database vars from file
		$handle = fopen("../config.ini", 'r');
		$parts = explode("  ", fgets($handle));
		echo "line:" . $parts[1] . "\n";
		$GLOBALS["host"] = $parts[1];
		echo "line:" . $GLOBALS["host"] . "\n";
		fclose($handle);
		*/
		
        // Create a connection to the database
        //$con = mysqli_connect("localhost","root","","410a3");
		$con = mysqli_connect($GLOBALS["host"], $GLOBALS["username"], $GLOBALS["password"], $GLOBALS["database_name"]);
        // Check connection
		
        if (mysqli_connect_errno($con)){
			//echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }else{
			//echo "Connection Successful !";
			return $con;
        }
    }
	
	function closeDBConnection($con){
            mysqli_close($con);
    }
	
    function registerUser(){
       $con = connectToDB();
        
        // validate email; should no be null or have an incorrect format
        if (isset($_POST['registerName'])){
            $email = $_POST['registerName'];
        }
        // check if email is empty
        if (($email == '') or ($email == null)){
                echo "Your email must be filled out !";
                die();
        }
        
        $emailRegex = '/^([a-zA-Z0-9])([a-zA-Z0-9\._-])*@(([a-zA-Z0-9])+(\.))+([a-zA-Z]{2,4})+$/';
        if(!preg_match($emailRegex,$email)){
                echo "That's not an email. Please retry !";
                die();
        }
        
        // validate password; should no be null or < 6 characters
        if (isset($_POST['registerPass'])){
            $password = $_POST['registerPass'];
        }
        if (($password == '') or ($password == null)){
            echo "Did you forget to write a password ?";
            die();
        }
        
        if (strlen($password) < 6){
            echo "Your password must have more than 6 characters. Please retry !";
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
		if (isset($_POST["loginName"]) and ($_POST['loginName'] != "")){
			$email = $_POST["loginName"];
        } else {
            echo "No username ? You need to register first !";
            die();
        }
        
         // grab the login password entered
		if (isset($_POST['loginPass']) and ($_POST['loginPass'] != "")){
			$password = $_POST['loginPass'];
        } else {
            echo "Did you forget your password?";
            die();
        }
		
        // query the email and password entered
        $loginQuery="SELECT * FROM user WHERE email = '$email' AND password = '$password'";
        
        $result = mysqli_query($con, $loginQuery);
        if (mysqli_num_rows($result) > 0){  // if true, then email and pass are correct
            $_SESSION['email']=$email;  	// save the email of the user in the session
        } else{
            echo "Incorect user/pass";
            die();
        }
        closeDBConnection($con);    		// close the database connection
    }
    
    function logoutUser(){
        session_destroy();
    }
    
    /*
    function registerUser2(){
        $con = connectToDB();
        
        // validate text fields..        
        $name = $_GET['Name'];
        if (($name == '') or ($name == null)){
                echo "Your name must be filled out !";
                die();
        }
        // check if another user has already registered with this name..
        $result = mysqli_query($con,"SELECT name FROM users WHERE name = '$name'");

        if (mysqli_num_rows($result) > 0){
                echo "A user with the name '" . $name . "' is already registered. Please " .
                "select a different name!";
                closeDBConnection($con);	// close db
                die();
        }
        
        $access = 5;
        if ($_GET['access'] == "admin"){
                $access = 1;
        } else {
                $access = 0;
        }
        
        $address = $_GET['Address'];
        $city = $_GET['City'];
        
        $postalCode = $_GET['PostalCode'];
        $postalRegex = '/[a-zA-Z][0-9][a-zA-Z](-| |)[0-9][a-zA-Z][0-9]/';
        if (($postalCode != '') or ($postalCode != null)){
                if (!preg_match($postalRegex, $postalCode)){
                        echo 'Invalid Postal Code entered !';
                        die();
                }
        }
        
        $email = $_GET['Email'];
        // check if email is empty
        if (($email == '') or ($email == null)){
                echo "Your email must be filled out !";
                die();
        }
        // validating email
        $emailRegex = '/^([a-zA-Z0-9])([a-zA-Z0-9\._-])*@(([a-zA-Z0-9])+(\.))+([a-zA-Z]{2,4})+$/';
        if(!preg_match($emailRegex,$email)){
                echo "Invalid email entered !";
                die();
        }
        
        // check if another user has already registered with this name..
        $result = mysqli_query($con,"SELECT name FROM users WHERE Email = '$email'");

        if (mysqli_num_rows($result) > 0){
                echo "A user with the email '" . $email . "' is already registered. Please " .
                "select a different email!";
                closeDBConnection($con);	// close db
                die();
        }
        
        $birthdate = $_GET['BirthDate'];
        $birthdateRegex = '/^(19|20)\d{2}[\-](0?[1-9]|1[0-2])[\-](0?[1-9]|[12][0-9]|3[01])$/';			//YYYY-MM-DD
        
        if (($birthdate != '') or ($birthdate != null)){
                if (!preg_match($birthdateRegex,$birthdate)){
                        echo "Invalid birth date entered !";
                        die();
                }
                echo '<br>it aint empty';
        }
        
        
        // insert into database
        $sql="INSERT INTO users (name, Access, Address, City, PostalCode, Email, BirthDate) VALUES" 
        . " ('$name','$access','$address', '$city', '$postalCode', '$email', '$birthdate')";

        if (!mysqli_query($con,$sql)){
                die('Error inserting into database.. ');
        }
        echo "<br> 1 record added";
        closeDBConnection($con);			// close the database connection
        
        // set cookies
        $timeForCookie = 3600;
        setcookie("name", $name, time()+$timeForCookie);  // expire in 1 hour
        setcookie("access", $access, time()+$timeForCookie);
        setcookie("address", $address, time()+$timeForCookie);
        setcookie("city", $city, time()+$timeForCookie);  
        setcookie("postalcode", $postalCode, time()+$timeForCookie); 
        setcookie("email", $email, time()+$timeForCookie); 
        setcookie("birthdate", $birthdate, time()+$timeForCookie); 

        //print_r($_COOKIE);
        //echo "<br>Cookie name is .. : " . $_COOKIE["name"];
        
        // redirect to the menu page
        //header( "Location: " . $GLOBALS["url_path"] . "/file1.html" );
        //redirect("menuPage.php");
        exit();
    }*/
    
?>