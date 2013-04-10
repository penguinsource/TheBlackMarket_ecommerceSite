<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php include_once("functionsPHP/generalFuncs.php"); ?>
<?php include_once("functionsPHP/dbConnection.php"); ?>
<?php checkPage(); ?>

<html>

<head>
	<?php echo $GLOBALS['basehref']; // print the site's base href?>
    <link rel=STYLESHEET href="<?= $GLOBALS['baseURL']; ?>design/flexslider.css" type="text/CSS">
	<link rel=STYLESHEET href="<?= $GLOBALS['baseURL']; ?>design/mainmenu.css" type="text/CSS">
	<link rel=STYLESHEET href="<?= $GLOBALS['baseURL']; ?>design/shop.css" type="text/CSS">
	<link href='http://fonts.googleapis.com/css?family=Noto+Sans|Tauri|Economica|Istok+Web|Monda|Merriweather+Sans|Share+Tech+Mono|Roboto+Condensed|Oxygen|Maven+Pro' rel='stylesheet' type='text/css'>
	
	<script src="http://code.jquery.com/jquery-latest.js" type="text/javascript"></script>
	<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/jquery.animate-colors.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/shop.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/generalFuncs.js"></script>
	<script src="<?= $GLOBALS['baseURL']; ?>functionsJS/menuFuncs.js"></script>
    
    <script src="<?= $GLOBALS['baseURL']; ?>functionsJS/jquery.flexslider.js"></script>
    <script src="<?= $GLOBALS['baseURL']; ?>functionsJS/jquery.flexslider-min.js"></script>
	
	<link rel="icon" type="image/png" href="<?= $GLOBALS['baseURL']; ?>design/images/favicon.png">
	<title> Home </title>
</head>

<script>
    // Can also be used with $(document).ready()
    $(window).load(function() {
      $('.flexslider').flexslider({
        animation: "slide"
      });
      
      setInterval(nextSlide);
    });
    
    function nextSlide(){
        $('#slider').flexslider("next");
    }
</script>

<body>	
  
	<?php printMenu(); ?>

	<div class='main'>
		<div style="width:100%;height:40px;"> </div>			
		<div style="position:relative;">

        <!--<p style="text-align: center">WELCOME TO HOME PAGE</p>-->

                <!-- Place somewhere in the <body> of your page -->
        <div id="slide-wrapper">
            <div class="flexslider">
              <ul class="slides">
                <li>
                  <img src="images/slider1.jpg" />
                </li>
                <li>
                  <img src="images/slider2.jpg" />
                </li>
                <li>
                  <img src="images/slider3.jpg" />
                </li>
              </ul>
            </div>
        </div>
        
		</div>
	</div>
    
</body>

<?php //closeDBConnection($con);?>

</html>
