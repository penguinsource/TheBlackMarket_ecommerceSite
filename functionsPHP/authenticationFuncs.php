<?php
	session_start();
	// database file
	$dbConfig = "../config.ini";
	//$dbConfig = "../configLocal.ini";
	
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
		echo "fail request POST! see file authenticationFuncs.php";	// incorrect POST request sent here..
	}
	
    function connectToDB(){
		getDBvars();	// get the vars to connect to the database
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
	
	function getDBvars(){
		global $host, $username, $password, $database_name;
		// reading database vars from file
		$handle = fopen($GLOBALS["dbConfig"], 'r');
		while(!feof($handle)){
			$parts = explode(" ", fgets($handle));
			if (isset($parts[1]) && isset($parts[2])){
				if (trim($parts[0]) == "host"){
					$host = trim($parts[2]);
					//echo "host:".$host."<br>";
				} else if (trim($parts[0]) == "username"){
					$username = trim($parts[2]);
					//echo "user:".$username."<br>";
				} else if (trim($parts[0]) == "password"){
					$password = trim($parts[2]);
					//echo "pass:".$password."<br>";
				} else if (trim($parts[0]) == "database_name"){
					$database_name = trim($parts[2]);
					//echo "db:".$database_name."<br>";
				}
			}
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
    
?>