function orderFunc(){

	console.log("click");
	
	$.ajax({url: '/functionsPHP/orderService',
		type: 'POST',
		data: { nothing : 'nothing'},
		success: function(response) {
			console.log(response);
			window.location.href = response;
		}
	})		

}

function checkUserLoggedIn(){
	$.ajax({url: '/functionsPHP/authenticationService',
        type: 'POST', 
        data: { type : 'checklogin'},
        success: function(response) {
			console.log(response);
			if (response == '0'){
				toggleDiv();
				$('#input-email').focus();
				$('#auth-alert').css('marginLeft', $('#shoppingCart').outerWidth(true) + 5);
				$('#auth-alert').stop().hide();
				$('#auth-alert').text('Please login or register before placing an order');
				$('#auth-alert').stop().animate({height: 'toggle'}, 250, 'linear', function(){
					$('#auth-alert').delay(5000).animate({height: 'toggle'}, 250);
				});
			} else {
				checkEmptyCart();
			}
        }
		
		
    })		
}

function checkEmptyCart(){
	$.ajax({url: '/functionsPHP/cartService',
        type: 'POST', 
        data: { type : 'checkcart'},
        success: function(response) {
			console.log(response);
        	if (response == '0'){
				$(this).scrollTop(0);
				$('#page-alert').clearQueue().hide();
				$('#page-alert').html('<span style="padding-left:15px;"> Cannot place an order with an empty cart </span>');
				$('#page-alert').stop().animate({height: 'toggle'}, 250, 'linear', function(){
					$('#page-alert').delay(5000).animate({height: 'toggle'}, 250);
				});
			} else {
				checkAddressComplete();
			}				
        }
		
		
    })	
}

function checkAddressComplete(){
	$.ajax({url: '/functionsPHP/authenticationService',
        type: 'POST', 
        data: { type : 'checkaddress'},
        success: function(response) {
			console.log(response);
        	if (response != ""){
				$(this).scrollTop(0);
				$('#page-alert').clearQueue().hide();
				$('#page-alert').html('<span style="padding-left:15px;"> Please fill out your ' + response + ' in your profile (located in top right) </span>');
				$('#page-alert').stop().animate({height: 'toggle'}, 250, 'linear', function(){
					$('#page-alert').delay(5000).animate({height: 'toggle'}, 250);
				});
			} else {
				window.location.href = "/order";
			}				
        }		
		
    })	
}

