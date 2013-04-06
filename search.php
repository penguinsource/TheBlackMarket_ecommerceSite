<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php include("functionsPHP/generalFuncs.php"); ?>
<?php include("functionsPHP/shopFuncs.php"); ?>
<?php include("functionsPHP/productFuncs.php"); ?>
<?php include("functionsPHP/dbConnection.php"); ?>
<?php include ("functionsPHP/userprofileFuncs.php"); ?>
<?php 
	checkPage(); 
?>

<html>

<head>
	<base href="//blackmarket5.hostei.com" />
	<!-- CSS imports -->
	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/shop.css" TYPE="text/CSS">
	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/product.css" TYPE="text/CSS">
	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/user_profile.css" TYPE="text/CSS">
	<LINK REL=STYLESHEET HREF="<?= $GLOBALS['baseURL']; ?>design/search.css" TYPE="text/CSS">
	
	<!-- script imports -->
	<!-- other scripts: -->
	<script type="text/javascript" src="<?php echo $GLOBALS['baseURL']; ?>functionsJS/generalFuncs.js"></script>
	<script src='http://code.jquery.com/jquery-latest.min.js' type="text/javascript"></script>
	<script  src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.15/jquery-ui.min.js"></script>
	<script  src="<?= $GLOBALS['baseURL']; ?>functionsJS/jquery.animate-colors.js"></script>
	<script >
		$(document).ready(function(){
			$('.menuitem').hover(function () {
				$(this).stop(true, true).addClass('menuhover', 100);
				$(this).addClass('menuhover', 250);
			},
			function () {
				$(this).stop(true, true).removeClass('menuhover', 100);
				$(this).removeClass('menuhover', 100);
			});
		});
	</script>
	
	<!------- START JQUERY SLIDER IMPORTS --> 
	<!-- IMPORTED LOCALLY: --> <!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" /> -->
	<link rel='stylesheet' HREF="<?= $GLOBALS['baseURL']; ?>design/jquerySlider.css" TYPE="text/CSS">
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
	<link rel="stylesheet" href="/resources/demos/style.css" />
	<script>
	// PRICE SLIDER
	$(function() {
	$( "#slider-range" ).slider({
		range: true,
		min: 0,
		max: 500,
		values: [ 75, 300 ],
		slide: function( event, ui ) {
			$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
		}
	});
	
	$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
	" - $" + $( "#slider-range" ).slider( "values", 1 ) );
	});
	
	// CATEGORY SLIDER:
	/*
 $(function() {
    var select = $( "#minbeds" );
    var slider = $( "<div id='slider'></div>" ).insertAfter( select ).slider({
      min: 1,
      max: 6,
      range: "min",
      value: select[ 0 ].selectedIndex + 1,
      slide: function( event, ui ) {
        select[ 0 ].selectedIndex = ui.value - 1;
      }
    });
    $( "#minbeds" ).change(function() {
      slider.slider( "value", this.selectedIndex + 1 );
    });
  });*/
	</script>
  <!------- END JQUERY SLIDER IMPORTS --> 
  
  <script>
  function checkSlider(){
	//var value = $( ".selector" ).slider( "values", 0 );
	var value = $( ".selector" ).slider( "slider-range", "value" );
	//alert("value 0 is:"+value);
	alert('value 1 is ' + $( "#slider-range" ).slider( "values", 0 ) );
	alert('value 2 is ' + $( "#slider-range" ).slider( "values", 1 ) );
	//$( ".selector" ).slider( "values", [ 55, 105 ] );
	$( "#slider-range" ).slider( "values", [0, 100] )
  }
  </script>
</head>

<body>

<div class='main'>
<div style="border-bottom: 1px solid;border-color: #E4E4E4;width:100%;height:40px;"> </div>
	<div class='searchWrapper'>
		<div class='searchInput'>
			<span> Search: 
				<input type='text'> </input>
				<button>Go </button>
				<select>
					<option value='Code'>Code</option>
					<option value='Name'>Name</option>
					<option value='Category'>Category</option>
					<option value='Category'>Category</option>
				</select>
			</span>
		</div>
		<div class='searchFilters'>
			<div class='filterTab'>
				<p> Price Range </p>
				<div id="slider-range"></div>
				<input type='text' id='amount' class='filterResult' size="14" disabled/>
			</div>
			<div class='filterTab'>
				<p> Category </p>
				<div id="slider-range2"></div>
				<input type='text' id='amount2' class='filterResult' size="14" disabled/>
			</div>
		</div>
		<div class='searchContent'>
		
		</div>
	</div>
</div>
<button onclick='checkSlider()'>aaa</button>
<div id="slider"></div>
 

</body>

</html>

<!--
<script>
$( "#slider" ).slider();
</script>

				<div id="slider-range"></div>
				<p>
					<label for="amount">Price range:</label>
					<input type="text" id="amount" style="border: 0; color: #f6931f; font-weight: bold;" />
				</p>
				
-->
