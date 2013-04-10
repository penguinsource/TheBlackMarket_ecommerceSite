<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php include_once("functionsPHP/generalFuncs.php"); ?>
<?php include_once("functionsPHP/dbConnection.php"); ?>
<?php checkPage(); ?>

<html>

<head>
	<?php echo $GLOBALS['basehref']; // print the site's base href?>
    <LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/flexslider.css" TYPE="text/CSS">
	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/mainmenu.css" TYPE="text/CSS">
	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/shop.css" TYPE="text/CSS">
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
		<div style="border-bottom: 1px solid;border-color: #E4E4E4;width:100%;height:40px;"> </div>			
		<div style="position:relative;">

        <!--<p style="text-align: center">WELCOME TO HOME PAGE</p>-->

                <!-- Place somewhere in the <body> of your page -->
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
            <li>
              <img src="images/slider4.jpg" />
            </li>
          </ul>
        </div>
        
		</div>
	</div>
    
</body>

<?php closeDBConnection($con);?>

</html>
