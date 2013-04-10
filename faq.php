<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php include_once("functionsPHP/generalFuncs.php"); ?>
<?php include_once("functionsPHP/shopFuncs.php"); ?>
<?php include_once("functionsPHP/dbConnection.php"); ?>
<?php include_once("functionsPHP/ChromePhp.php"); ?>
<?php 
	checkPage(); 
	
	ChromePhp::log("email from shop: " . $_SESSION['email']);
?>
<html>

<head>
	<?php echo $GLOBALS['basehref']; // print the site's base href?>

	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/shop.css" TYPE="text/CSS">
	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/mainmenu.css" TYPE="text/CSS">
    <link href='http://fonts.googleapis.com/css?family=Noto+Sans|Tauri|Economica|Istok+Web|Monda|Merriweather+Sans|Share+Tech+Mono|Roboto+Condensed|Oxygen|Maven+Pro' rel='stylesheet' type='text/css'>
	
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.15/jquery-ui.min.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/jquery.animate-colors.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/shop.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/generalFuncs.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/menuFuncs.js"></script>
	
	<link rel="icon" type="image/png" href="<?= $GLOBALS['baseURL']; ?>design/images/favicon.png">
	<title> FAQ </title>
</head>

<body>

	<?php printMenu(); ?>

	<div class='main'>
		<div style="border-bottom: 1px solid;border-color: #E4E4E4;width:100%;height:40px;"> </div>
		
		<div style="position:relative;">
			
			<div class='body'>		
			
				<h2>FAQ</h2>
				Q: What technology can I use for implementing my project?<br><br>
				<em>A: You can use Java servlets, JSP, Perl script CGI, C/C++ CGI, PHP Python. Other technologies available in the lab are also possible.</em><br><br>
				Q: Can I implement my project at home and run it from my server at home?<br><br>
				<em>A: Yes you can. However, at demo time, you need to execute the demonstration from the lab.
You also need to provide your source code with the submission.</em><br><br>
				Q: Can I use another DBMS?<br><br>
				<em>A: Yes you can use any relational DBMS: ORACLE, DB2, Postgress, msql, SQL-server, etc.
Microsoft Access is not considered a RDBMS and cannot be used for this project.</em><br><br>
				Q: Will the look-and-feel of the implementation count or is it only the functionality of the
project that counts?<br><br>
				<em>A: The user interface will count. While it won’t count for very much in comparison to other
aspects of the project, the look and feel is what the user sees and it is what will distinguish
between implementations. In web-based applications, the interface is paramount.</em><br><br>
				
			
			</div>
		</div>
	</div>

</body>

</html>
