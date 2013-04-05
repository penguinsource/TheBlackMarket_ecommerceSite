<?php 

	// GLOBAL VARIABLES --------------------------------------------------
	$localhostON = 1;		// 0 for 000webhost server
							// 1 for localhost mihai pc
							// 2 for vm consort (not setup; to add, just add another if below and the url)
							
	if ($localhostON == 0){
		$baseURL = "http://" . $_SERVER['HTTP_HOST'] . "/";				// 000webhost:  blackmarket5.hostei.com
	} else if ($localhostON == 1){
		$baseURL = "http://localhost/TheBlackMarket_ecommerceSite/";	// localhost mihai
	}
    /*    
    // NOT IMPLEMENTED PROPERLY -- :
    function checkLogin(){
        if (!isset($_COOKIE['name'])){
                //echo "<div id='centerPageContainer'><div id='simpleBodyContainer'><p style='text-align:center;'>Please <a href=\"index.php\">register</a> before taking any quizzes !</p></div></div>";
                //header("Location: index.php");
                return false;
        }
        return true;
    }
    */
	
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
    
	function checkCart(){
		if (isset($_SESSION['cart'])){
			$cartJSON = json_decode($_SESSION['cart'], true);
			$total = number_format($cartJSON['total'], 2);
			return "$$total";
		} else {
			return "$0.00";
		}
	}
    
?>
