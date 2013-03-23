<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>

<head>
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

</body>

</html>
