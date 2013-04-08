<?php 

	// GLOBAL VARIABLES --------------------------------------------------
	$localhostON = 0;		// 0 for 000webhost server
							// 1 for localhost mihai pc
							// 2 for vm consort (not setup; to add, just add another if below and the url)
							
	/*	<!-- <base href="//blackmarket5.hostei.com" />  KEEP THIS ONE IN MIND IF SMTHING DOESNT LOAD PROPERLY ( 2 // in front of base href)-->
	<base href="//cs410.cs.ualberta.ca:41061" />*/
	
	if ($localhostON == 0){
		$baseURL = "http://" . $_SERVER['HTTP_HOST'] . "/";				// 000webhost:  blackmarket5.hostei.com
		$basehref = "<base href='//blackmarket5.hostei.com' \/>";
	} else if ($localhostON == 1){
		$baseURL = "http://localhost/TheBlackMarket_ecommerceSite/";	// localhost mihai
		$basehref = "<base href=\"http://localhost/TheBlackMarket_ecommerceSite/\" />";
	} else if ($localhostON == 2){
		//$baseURL = "http://cs410-06.cs.ualberta.ca/";
		//$baseURL = "http://cs410.cs.ualberta.ca:41061/";
		$baseURL = "/";
		$basehref = "<base href=\"//cs410.cs.ualberta.ca:41061\" />";
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
	
	function printMenu(){
		echo "<div class='mainmenu'>\n";
			echo "<div id='menulogo'>\n";
				echo "<a href='/index'>\n";
					echo "<img valign='center' class='activelogo' src='/design/images/logo1-small.png'>\n";
					echo "<img valign='center' src='/design/images/logo2-small.png'>\n";
				echo "</a>\n";
			echo "</div>\n";
      
      $str = (isset($_SESSION['email'])) ? $_SESSION['email'] : "";
			
			echo "<div class='menulinks'>\n";
				echo "<div class='menulink'> <a href='/index'>HOME</a> </div>\n";
				echo "<div class='menulink'> <a href='/shop'>SHOP</a> </div>\n";
				echo "<div class='menulink'> <a href='/about'>ABOUT</a> </div>\n";
				echo "<div class='menulink'> <a href='/help'>HELP</a> </div>\n";
				echo "<div class='menulink'> <a href='/faq'>FAQ</a> </div>\n";
        
        if ($str == "admin") {
          echo "<div class='menulink'> <a href='/admin'>ADMIN</a> </div>\n";
        }
        
			echo "</div>\n";
			
			$carttotal = checkCart();            
			
			echo "<div id='userStuff'>\n";
				echo "<div id='shoppingCart'>\n";
					echo "<a href='/cart'> Cart ($carttotal)</a>\n";
				echo "</div>\n";
				
				echo "<div id='login-reg-form' style='display:none;'>\n";
					echo "<input type='text' id='input-email' class='nowrap' size='20' placeholder='Email'></input>\n";
					echo "<input id='input-pass' type='password' class='nowrap' size='12' placeholder='Password'></input>\n";
					echo "<input id='input-pass2' type='password' class='nowrap' size='12' placeholder='Confirm Pass'></input>\n";
					echo "<div id='blogindiv' style='display:inline-block;'><button id='blogin'>Login</button></div>\n";
					echo "<button id='bregister'>Register</button>\n";
				echo "</div>\n";
				
								
				echo "<a href='/user_profile'><div id='profile-link'>$str</div></a>\n";
				echo "<a href='javascript:void(0)'><div id='logout'>Logout</div></a>\n";
				
				echo "<a href='javascript:void(0)'><div id='btoggle'>[+] Login / Register</div></a>\n";
				echo "<br><div id='auth-alert'> </div>\n";
			echo "</div>\n";
			
			echo "<div class='blueline'> </div>\n";
		echo "</div>\n";
		
		$bool = isset($_SESSION['email']);
		
		echo "<script>\n";
			echo "toggleLoggedIn($bool);\n";
		echo "</script>\n";
	}
    
?>
