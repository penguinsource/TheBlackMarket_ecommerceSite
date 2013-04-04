function addToCart(id,name,desc,price){
    //grab html values and stringify into JSON
	var item = {};
    item.id = id;
	item.name = name;
	item.desc = desc;
	item.price = price;
	var jsonStr = JSON.stringify(item);
    
    $.ajax({url: '/functionsPHP/cartService',
        type: 'POST', 
        data: { json: jsonStr, type: "add" },
        success: function(response) {
            document.getElementById("shoppingCart").innerHTML = "<a href='/cart'>Shopping Cart ($" + response + ")</a>";
			document.getElementById("alert").innerHTML="Item '" + item.name + "' successfully added to shopping cart.";	
        }
    })
}