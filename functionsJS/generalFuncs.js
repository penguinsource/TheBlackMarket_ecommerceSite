function addToCart(id,name,desc,price){
    //grab html values and stringify into JSON
	var item = {};
    item.id = id;
	item.name = name;
	item.desc = desc;
	item.price = price;
	item.quantity = 1;
	var jsonStr = JSON.stringify(item);
    
    $.ajax({url: '/functionsPHP/cartService',
        type: 'POST', 
        data: { data: jsonStr, type: "add" },
        success: function(response) {
        		var cart = JSON.parse(response);
            document.getElementById("shoppingCart").innerHTML = "<a href='/cart'>Shopping Cart ($" + formatPrice(cart.total) + ")</a>";
			document.getElementById("alert").innerHTML="Item '" + item.name + "' successfully added to shopping cart.";	
        }
    })
}

function removeFromCart(id,name,desc,price){
    $.ajax({url: '/functionsPHP/cartService',
        type: 'POST', 
        data: { data: id, type: "remove" },
        success: function(response) {
        		var cart = JSON.parse(response);
            document.getElementById("shoppingCart").innerHTML = "<a href='/cart'>Shopping Cart ($" + formatPrice(cart.total) + ")</a>";
			document.getElementById("alert").innerHTML="Item '" + item.name + "' successfully removed from cart.";	
        }
    })
}

function updateCart(id,quantity){
	$.ajax({url: '/functionsPHP/cartService',
        type: 'POST', 
        data: { data: id, quantity : quantity, type: "update" },
        success: function(response) {
        		var cart = JSON.parse(response);
            document.getElementById("shoppingCart").innerHTML = "<a href='/cart'>Shopping Cart ($" + formatPrice(cart.total) + ")</a>";
			document.getElementById("alert").innerHTML="Updated quantity for '" + item.name + "'.";	
        }
    })
}

function formatPrice(x) {
	x - parseFloat(Math.round(x * 100) / 100).toFixed(2);
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
        	alert("Updated Profile !" + response);
        }
    })
	
}
