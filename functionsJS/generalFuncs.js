function addToCart(id,name,price,img,quantity){
	if (!(/^\d+$/.test(quantity))) return;
	if (quantity > 999) return;
	
	console.log("quantity: " + quantity);
    //grab html values and stringify into JSON
	var item = {};
    item.id = id;
	item.name = name;
	item.price = price;
	item.img = img;
	item.quantity = quantity;
	var jsonStr = JSON.stringify(item);
    
    $.ajax({url: '/functionsPHP/cartService',
        type: 'POST', 
        data: { data: jsonStr, type: "add" },
        success: function(response) {
        	var cart = JSON.parse(response);
            document.getElementById("shoppingCart").innerHTML = "<a href='/cart'> Cart ($" + formatPrice(cart.total) + ")</a>";
			document.getElementById("alert").innerHTML="Item '" + item.name + "' successfully added to shopping cart.";	
        }
    })
}

function removeFromCart(id, name){
    $.ajax({url: '/functionsPHP/cartService',
        type: 'POST', 
        data: { id: id, type: "remove" },
        success: function(response) {
			console.log(response);
			var cart = JSON.parse(response);
			$("#cart-item-"+id).animate({height:'0px'}, 500, "linear",function()
					{	
						if(cart.products.length == 0){
							$("#cart-no-items").animate({height:'85px'}, 500);
						}
						$(this).remove();
					});
					
			
			
			document.getElementById("cart-total-price").innerHTML = "$" + formatPrice(cart.total);
			document.getElementById("shoppingCart").innerHTML = "<a href='/cart'> Cart ($" + formatPrice(cart.total) + ")</a>";
			document.getElementById("alert").innerHTML="Item '" + name + "' successfully removed from cart.";	
        }
    })
}

function updateCart(id,quantity,name,price){
	if (!(/^\d+$/.test(quantity))) return;
	if (quantity > 999) return;
	$.ajax({url: '/functionsPHP/cartService',
        type: 'POST', 
        data: { id: id, quantity : quantity, type: "update" },
        success: function(response) {
			console.log(response);
			var cart = JSON.parse(response);
			if (quantity == 0) {
				$("#cart-item-"+id).animate({height:'0px'}, 500, "linear",function()
					{	
						if(cart.products.length == 0){
							$("#cart-no-items").animate({height:'85px'}, 500);
						}
						$(this).remove();
					});
				
			} else {
				document.getElementById("price-" + id).innerHTML = "$" + formatPrice(quantity * price);
			}
			document.getElementById("cart-total-price").innerHTML = "$" + formatPrice(cart.total);
			document.getElementById("shoppingCart").innerHTML = "<a href='/cart'> Cart ($" + formatPrice(cart.total) + ")</a>";
			document.getElementById("alert").innerHTML="Updated quantity for '" + name + "'.";	
        }
    })
}

function formatPrice(x) {
	if (x == 0) return "0.00";
	x = parseFloat(Math.round(x * 100) / 100).toFixed(2);
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function updateUserProfile(){
	var fnameInp = document.getElementById('fname').value;
	var lnameInp = document.getElementById('lname').value;
	var cityInp = document.getElementById('city').value;
	var postalInp = document.getElementById('postalcode').value;
	var addressInp = document.getElementById('address').value;
	var phoneInp = document.getElementById('phonenumber').value;
	$.ajax({url: '/functionsPHP/userprofileService',
        type: 'POST', 
        data: { fname: fnameInp, lname: lnameInp, city: cityInp, postal: postalInp, address: addressInp, phone: phoneInp},
        success: function(response) {
        	alert("Profile Updated Successfully!");
        }
    })	
}

// apply search filters and get new filtered search results
function filterSearch(){
	// grab the filter values
	var priceLow = $( "#priceRangeSlider" ).slider( "values", 0 );
	var priceHigh = $( "#priceRangeSlider" ).slider( "values", 1 ); // in between price high and low
	var minimum_quantity =  $( "#quantitySlider" ).slider( "value" );	// quantity or MORE
	var weightLow = $( "#weightSlider" ).slider( "values", 0 ); // in between price high and low
	var weightHigh = $( "#weightSlider" ).slider( "values", 1 ); // in between price high and low
	//alert('low price: '+priceLow+' high:'+priceHigh+' q:'+minimum_quantity+' weight:'+weightLow);
	
	// seeing which categories to look in
	var allSelected = true;
	
	categoriesArr = new Array();
	// grab the categories selected
	categoriesArr[0] = (document.getElementById('dishwashers').checked) ? 1 : 0;
	categoriesArr[1] = (document.getElementById('freezers').checked) ? 1 : 0;
	categoriesArr[2] = (document.getElementById('kitchen_appliances').checked) ? 1 : 0;
	categoriesArr[3] = (document.getElementById('microwaves').checked) ? 1 : 0;
	categoriesArr[4] = (document.getElementById('refrigerators').checked) ? 1 : 0;
	categoriesArr[5] = (document.getElementById('stoves_ranges').checked) ? 1 : 0;
	categoriesArr[6] = (document.getElementById('washers_dryers').checked) ? 1 : 0;
	
	// create json with all the categories selected
	var category= {
		"dishwashers":categoriesArr[0],
		"freezers":categoriesArr[1],
		"kitchen_appliances":categoriesArr[2],
		"microwaves":categoriesArr[3],
		"refrigerators":categoriesArr[4],
		"stoves_ranges":categoriesArr[5],
		"washers_dryers":categoriesArr[6]
	}
	
	// stringify the array
	var cateJSON = JSON.stringify(category);
	//alert("json:" + cateJSON);
	
	// loading screen
	//document.getElementById('searchContent').innerHTML = "<img style='position: relative; left: 50%; top: 150px;' src='design/images/loadingScreen.gif' /><h3>Loading</h3>";
	document.getElementById('searchContent').innerHTML = "<img style='position: relative; left: 50%; top: 150px;' src='design/images/ajax-loader2.gif' /><p style='position: relative; left: 49%; top: 150px; font-weight: bold;'>Loading</h3>";
	// grab the search type and the search query
	var searche = document.getElementById('searchType');
	var typeOfSearch = searche.options[searche.selectedIndex].id;		// GET the search type
	var searchQueryValue = document.getElementById('searchQuery').value;
	var sortType = document.getElementById('sortBy').value;
	
	$.ajax({url: '/functionsPHP/searchService',
        type: 'POST',
        data: { priceLowArg: priceLow, priceHighArg: priceHigh, minQuantity: minimum_quantity, weightLowArg: weightLow, weightHighArg: weightHigh, searchType:typeOfSearch ,
				searchQuery: searchQueryValue, categories: cateJSON, sortBy: sortType},
        success: function(response) {
        	//alert("response: " + response);

			console.log(response);
			obj = JSON.parse(response);
			
			// grab all the variables
			resultType = obj['type'];
			
			originalResults = obj['originalResults'];
			origResultCount = obj['originalResultCount'];
			
			modResults = obj['modifiedResults'];
			modResultsCount = obj['modifiedResultsCount'];
			
			originalFiltersText = obj['origFilters'];
			modFiltersText = obj['modFilters'];
			
			// recList = obj['recomQueryList'];
			
			//mod
			if (resultType == 'normal'){		// no recommendations for type 'normal', as of right now
				document.getElementById('searchResultsCount').innerHTML = origResultCount + " products found.<br><span style='color: gray;'>" + originalFiltersText + "</span> <br><br> <div class='border60'></div>";
				document.getElementById('searchContent').innerHTML = originalResults;
				
				// document.getElementById('searchContentRecom').innerHTML = modResults;
				// document.getElementById('searchResultsCountRecom').innerHTML = modResultsCount + ' products recommended for you.<br>' + modFiltersText + "<br>";
			
				// show the div ( in case it's hidden ) DELETE THESE:
				//document.getElementById('searchContentRecom').className = 'searchRecom';
				//document.getElementById('searchResultsCountRecom').className = 'searchRecomHeader';
				document.getElementById('searchResultsCountRecom').className = 'hidden';
				document.getElementById('searchContentRecom').className = 'hidden';
			} else if (resultType == 'few'){
				expandBtn = "<br><button id='expandBtnid' onclick=\"expandSearch('expand')\" class='showResultsButton'>Expand Search</button>";
				document.getElementById('searchResultsCount').innerHTML = origResultCount + " products found.<br> <span style='color: gray;'>" + originalFiltersText + "</span> <br><br> <div class='border60'></div>";
				document.getElementById('searchContent').innerHTML = expandBtn + "<br>" + originalResults;
				
				// hide the extra div
				document.getElementById('searchResultsCountRecom').className = 'hidden';
				document.getElementById('searchContentRecom').className = 'hidden';
			} else if (resultType == 'extra'){
				showMoreButton = "<br><button id='showResultsBound' onclick=\"narrowSearch('more')\" class='showResultsButton'>Show all results</button>";
				document.getElementById('searchResultsCount').innerHTML = modResultsCount + " products recommended for you.<br> <span style='color: gray;'>" + modFiltersText + "</span> <br><br> <div class='border60'></div>";
				document.getElementById('searchContent').innerHTML = showMoreButton + "<br>" + modResults;
				
				// hide the extra div
				document.getElementById('searchResultsCountRecom').className = 'hidden';
				document.getElementById('searchContentRecom').className = 'hidden';
			}
			//} else if (resultType == 'few'){
				
			//} else if (resultType == 'extra'){	// if there are too many, show recommended ones and a button to show more
				
			//}
			
			
        }
    })
}
