<?php

    function registerUser(){
        $con = connectToDB();
        
        // validate email; should no be null or have an incorrect format
        $email = $_POST['email'];
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
        $password = $_POST['password'];
        if (($password == '') or ($password == null)){
            echo "Did you forget to write a password ?";
            die();
        }
        
        if (strlen($password) < 6){
            echo "Your password must have more than 6 characters. Please retry !";
            die();
        }
        
    }
    
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
        setcookie("name", $name, time()+$timeForCookie);  /* expire in 1 hour */
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
    }

?>