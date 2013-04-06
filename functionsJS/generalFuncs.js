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
	alert("fname:"+fnameInp);
	$.ajax({url: '/functionsPHP/userprofileService',
        type: 'POST', 
        data: { fname: fnameInp, lname: lnameInp, city: cityInp, postal: postalInp, address: addressInp, phone: phoneInp},
        success: function(response) {
        	alert("Updated Profile !" + response);
        }
    })	
}

function goToOrder(){
	$.ajax({url: '/functionsPHP/authenticationService',
        type: 'POST', 
        data: { type : 'checklogin'},
        success: function(response) {
			console.log(response);
        	if (response == '1') {
				window.location.href = "/order";
			} else if (response == '0'){
				toggleDiv();
				$('#input-email').focus();
				$('#auth-alert').css('marginLeft', $('#shoppingCart').outerWidth(true) + 5);
				$('#auth-alert').stop().hide();
				$('#auth-alert').text('Please login or register before placing an order');
				$('#auth-alert').stop().animate({height: 'toggle'}, 250, 'linear', function(){
					$('#auth-alert').delay(5000).animate({height: 'toggle'}, 250);
				});
			}
        }
    })	
}

// apply search filters and get new filtered search results
function filterSearch(){
	var priceLow = $( "#priceRangeSlider" ).slider( "values", 0 );
	var priceHigh = $( "#priceRangeSlider" ).slider( "values", 1 ); // in between price high and low
	var quantity =  $( "#quantitySlider" ).slider( "value" );	// quantity or MORE
	var weightLow = $( "#weightSlider" ).slider( "values", 0 ); // in between price high and low
	var weightHigh = $( "#weightSlider" ).slider( "values", 1 ); // in between price high and low
	alert('low price: '+priceLow+' high:'+priceHigh+' q:'+quantity+' weight:'+weightLow);
	//var dish= null;
	$.ajax({url: '/functionsPHP/searchService',
        type: 'POST',
        data: { priceLow: fnameInp, priceHigh: lnameInp, quantity: cityInp, weightLow: postalInp, weightHigh: addressInp, dishwashers: ''},
        success: function(response) {
        	alert("response: " + response);
        }
    })
}
