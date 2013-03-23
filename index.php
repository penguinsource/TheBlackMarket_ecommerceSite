<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php include 'generalFuncs.php'; ?>
<?php checkPage(); ?>

<html>
  
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <link href="design.css" rel="Stylesheet" type="text/css">
</head>

<body>



<?php echo "Hello PHP !"; ?>
<?php $con = connectToDB(); // connect to the database ?>

<form name="registerForm" action="index.php" method="POST">
    <input type="text" name="emailReg" id="emailReg">
    <input type="text" name="passwordReg" id="passwordReg">
    <button name='registerBtn'>Register</button>
</form>

<form name="loginForm" action="index.php" method="POST">
    <input type="text" name="emailLogin" id="emailLogin">
    <input type="text" name="passwordLogin" id="passwordLogin">
    <button name='loginBtn'>Login</button>
    <br>
    <button name='logoutBtn'>Logout</button>
</form>
<br>


</body>

</html>
