<?php
    // database file
    $dbConfig = "../config.ini";	       // for remote db
    //$dbConfig = "../configLocal.ini";	       // for local db
    //$dbConfig = "../configVM.ini";	       // for VM db
    
    function connectToDB(){
		getDBvars();	// get the vars to connect to the database
        // Create a connection to the database
        //$con = mysqli_connect("localhost","root","","410a3");
		$con = mysqli_connect($GLOBALS["host"], $GLOBALS["username"], $GLOBALS["password"], $GLOBALS["database_name"]);
        // Check connection
        if (mysqli_connect_errno($con)){
			//echo "Failed to connect to MySQL: " . mysqli_connect_error();
                        echo "<script>alert(\"fail\");</script>";
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
    
?>