<?php 
    
    // GLOBAL VARIABLES:
    //$url_path = "http://localhost/a3";
    $host = "localhost";
    $username = "root";
    $password = "";
    $database_name = "blackmarket";
    
    /*
    // GLOBAL VARIABLES:
    $host = "mysql3.000webhost.com";
    $username = "a4179199_blackma";
    $password = "blackmarket5";
    $database_name = "a4179199_blackma";
    */
    function connectToDB(){
        // Create a connection to the database
        //$con = mysqli_connect("localhost","root","","410a3");
        $con = mysqli_connect($GLOBALS["host"], $GLOBALS["username"], $GLOBALS["password"], $GLOBALS["database_name"]);
        // Check connection
        if (mysqli_connect_errno($con)){
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
				
        }else{
                echo "Connection Successful !";
                return $con;
        }
    }
	
    function closeDBConnection($con){
            mysqli_close($con);
    }
    
    // NOT IMPLEMENTED PROPERLY -- :
    function checkLogin(){
        if (!isset($_COOKIE['name'])){
                //echo "<div id='centerPageContainer'><div id='simpleBodyContainer'><p style='text-align:center;'>Please <a href=\"index.php\">register</a> before taking any quizzes !</p></div></div>";
                //header("Location: index.php");
                return false;
        }
        return true;
    }
    
    function redirect($url){
        header("Location: " . $url);
    }
    
    function checkPage(){
        // start session if any user is logged in..
		session_start();
		
        /*
        // if a POST request was made ..
        if ($_SERVER["REQUEST_METHOD"] == 'POST'){
              if (isset($_POST["registerBtn"])){
                registerUser();
              } else if (isset($_POST["loginBtn"])){
                loginUser(); 
              } else if (isset($_POST["logoutBtn"])){
                logoutUser(); 
              }
			  
			  // ajax check if login is correct
			  if (isset($_POST["loginName"])){
				//loginUser();
				echo ">> Looooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooogged in ! << ";
			  }
        }*/
    }
    
    
?>