<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php include("functionsPHP/generalFuncs.php"); ?>
<?php include("functionsPHP/shopFuncs.php"); ?>
<?php include("functionsPHP/productFuncs.php"); ?>
<?php include("functionsPHP/dbConnection.php"); ?>
<?php include ("functionsPHP/userprofileFuncs.php"); ?>
<?php include ("functionsPHP/searchFuncs.php"); ?>
<?php 
	checkPage(); 
?>

<html>

<head>
	<base href="//blackmarket5.hostei.com" />
	<!-- CSS imports -->
	
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
	$( "#priceRangeSlider" ).slider({
		range: true,
		min: 0,
		max: 5000,
		values: [ 0, 5000 ],
		slide: function( event, ui ) {
			//$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
			document.getElementById('priceAmount').innerHTML = "$" + $( "#priceRangeSlider" ).slider( "values", 0 ) +
				" - $" + $( "#priceRangeSlider" ).slider( "values", 1 );
		},
		stop: function(event, ui){
			document.getElementById('priceAmount').innerHTML = "$" + $( "#priceRangeSlider" ).slider( "values", 0 ) +
			" - $" + $( "#priceRangeSlider" ).slider( "values", 1 );
		}
		
	});
	document.getElementById('priceAmount').innerHTML = "$" + $( "#priceRangeSlider" ).slider( "values", 0 ) +
		" - $" + $( "#priceRangeSlider" ).slider( "values", 1 );
	});
	
	// QUANTITY SLIDER:
$(function() {
    $( "#quantitySlider" ).slider({
      range: "min",
      value: 37,
      min: 0,
      max: 22,
      slide: function( event, ui ) {
		document.getElementById('availAmount').innerHTML = $( "#quantitySlider" ).slider( "value" ) + " or more in-stock";
      },
	  stop: function(event, ui){
		document.getElementById('availAmount').innerHTML = $( "#quantitySlider" ).slider( "value" ) + " or more in-stock";
	  }
    });
    //$( "#amount3" ).val( "$" + $( "#slider-range-min" ).slider( "value" ) );
	document.getElementById('availAmount').innerHTML = $( "#quantitySlider" ).slider( "value" ) + " or more in-stock";
  });
  
	// WEIGHT SLIDER:
	$(function() {
	$( "#weightSlider" ).slider({
		range: true,
		min: 0,
		max: 1000,
		values: [ 0, 5000 ],
		slide: function( event, ui ) {
			document.getElementById('weightAmount').innerHTML = $( "#weightSlider" ).slider( "values", 0 ) +
				" - " + $( "#weightSlider" ).slider( "values", 1 ) + " lbs";
		},
		stop: function(event, ui){
			document.getElementById('weightAmount').innerHTML = $( "#weightSlider" ).slider( "values", 0 ) +
				" - " + $( "#weightSlider" ).slider( "values", 1 ) + " lbs";
		}
		
	});
	
	document.getElementById('weightAmount').innerHTML = $( "#weightSlider" ).slider( "values", 0 ) +
		" - " + $( "#weightSlider" ).slider( "values", 1 ) + " lbs";
	document.getElementById('weightAmount').innerHTML = $( "#weightSlider" ).slider( "values", 0 ) +
		" - " + $( "#weightSlider" ).slider( "values", 1 ) + " lbs";
	});
	</script>
  <!------- END JQUERY SLIDER IMPORTS -->
  
  <!-- Filter search scripts -->
  <script>
  function updateAvail(){
	alert("ha");
	document.getElementById('availAmount').innerHTML = $( "#slider-range-min" ).slider( "value" ) + " or more items";
  }
  
  function checkSlider(){
	//var value = $( ".selector" ).slider( "values", 0 );
	var value = $( ".selector" ).slider( "slider-range", "value" );
	//alert("value 0 is:"+value);
	alert('value 1 is ' + $( "#slider-range" ).slider( "values", 0 ) );
	alert('value 2 is ' + $( "#slider-range" ).slider( "values", 1 ) );
	//$( ".selector" ).slider( "values", [ 55, 105 ] );
	$( "#slider-range" ).slider( "values", [0, 100] )
  }

  <!-- END Filter search scripts -->
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
				<select id='searchType'>
					<option id='code' name='code' value='Code'>Code</option>
					<option id='name' name='name' value='Name'>Name</option>
					<option id='category' name='category' value='Category'>Category</option>
					<option id='category' name='category' value='Category'>Category</option>
				</select>
			</span>
		</div>
		<div class='searchFilters'>
			<!-- Price Filter -->
			<div class='filterTab'>
				<p> Price Range </p>
				<div id="priceRangeSlider"></div>
				<p class='pFilter' align='center' name='priceAmount' id='priceAmount'></p>
				<input type='checkbox'>Strict</input>
			</div>
			<!-- Categories Filter -->
			<div class='border80'></div>
			<div class='filterTab'>
				<p> Categories </p>
				  <input class='inputBox' type="checkbox" id="dishwashers" value="dishwashers"></input><label class='inputBox' for='dishwashers'>Dishwashers</label><br>
				  <input class='inputBox' type="checkbox" id="freezers" value="freezers"></input><label class='inputBox' for='freezers'>Freezers</label><br>
				  <input class='inputBox' type="checkbox" id="kitchen_appliances" value="kitchen_appliances"></input><label class='inputBox' for='kitchen_appliances'>Kitches Appliances</label><br>
				  <input class='inputBox' type="checkbox" id="microwaves" value="microwaves"></input><label class='inputBox' for='microwaves'>Microwaves</label><br>
				  <input class='inputBox' type="checkbox" id="refrigerators" value="refrigerators"></input><label class='inputBox' for='refrigerators'>Refrigerators</label><br>
				  <input class='inputBox' type="checkbox" id="stoves_ranges" value="stoves_ranges"></input><label class='inputBox' for='stoves_ranges'>Stoves/Ranges</label><br>
				  <input class='inputBox' type="checkbox" id="washers_dryers" value="washers_dryers"></input><label class='inputBox' for='washers_dryers'>Washers/Dryers</label><br>
			</div>
			<div class='border80'></div>
			<!-- Availability Filter -->
			<div class='filterTab'>
				  <p> Quantity </p>
				  <div id="quantitySlider"></div>
				  <p class='pFilter' align='center' name='availAmount' id='availAmount'></p>
			</div>
			<div class='border80'></div>
			<!-- Weights Filter -->
			<div class='filterTab'>
				  <p> Weight</p>
				  <div id="weightSlider"></div>
				  <p class='pFilter' align='center' name='weightAmount' id='weightAmount'></p>
			</div>
			<div class='border80'></div>
		</div>
		<!-- Search Results (Wrapper) -->
		
		<div id='searchContent' class='searchContent'>
		
			<?php /*$con = connectToDB();
			 $category = 'Freezers';
			printSearchResults($con, $category);
			printSearchResults($con, $category);
			printSearchResults($con, $category);
			closeDBConnection($con); */?>
			
			<!--
				<div class='searchResultHeader'>
					<span class='headerGen'>General</span> <span class='headerDesc'>Desc</span> <span class='headerQuantity'>Desc</span> 
					<span class='headerWeight'>Availability</span> <span class='headerDim'>Availability</span> <span class='headerPrice'>Price</span>
				</div>
				
			-->
			<div style='clear'></div>
			<br>
			<div class='border80'></div>
			<!-- Search Results Recommendations -->
			<div class='searchRecommendations'>
				<p>searchRecommendations</p>
			</div>
		
		</div>	
		
	</div>
</div>
<button onclick='checkSlider()'>aaa</button>
<button onclick='filterSearch()'>Filter !</button>

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
