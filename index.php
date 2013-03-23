<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
  
<head>
<<<<<<< HEAD
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <link href="design.css" rel="Stylesheet" type="text/css">
</head>

<body>
  <!-- TESTING
  <p> Hello HTML </p>
  <?php echo "Hello PHP !"; ?>
  <?php header( 'Location: /other/blah.php' ) ; ?>
  -->

  <div class="topbar">
    <p>top shit</p>
  </div>
  <div class="content">
    <p>bottom shit</p>
  </div>
=======
<?php include 'generalFuncs.php'; ?>
<?php include 'registrationFuncs.php'; ?>
<!--

-->
</head>

<body>
<p> Hello HTML </p>

<?php
    if ($_SERVER["REQUEST_METHOD"] == 'POST'){
        if (isset($_POST["registerForm"])){
            echo "register";
        } else if (isset($_POST["registerForm"])){
            echo "login";
        }
    } // if this got a POST request..
?>

<?php echo "Hello PHP !"; ?>
<?php $con = connectToDB(); // connect to the database ?>

<form name="registerForm" action="index.php" method="POST">
    <button>Register</button>
</form>

<form name="loginForm" action="index.php" method="POST">
    <button>Login</button>
</form>

<div>
    
</div>
>>>>>>> b64e3edc959b66eb667f5f9c96aeb6350342028f

</body>

</html>
