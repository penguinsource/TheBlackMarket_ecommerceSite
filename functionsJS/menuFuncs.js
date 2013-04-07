var togglecount = 0;
var registercount = 0;	
var btoggleWidth;

$(document).ready(function(){
	//$('#login-reg-form').hide();
	$('#input-pass2').hide();
	$('#auth-alert').hide();
	$('#page-alert').hide();
	
	btoggleWidth = $('#btoggle').outerWidth(true) + 5;
	$('#auth-alert').css('marginLeft', $('#shoppingCart').outerWidth(true) + 5);
	
	$('#btoggle').click(function() {
		toggleDiv();
	});
	
	
	// register button onclick
	$('#bregister').click(function() {
		
		
		if (registercount < 1) {
			$('#input-pass2').stop().animate({
				width: 'toggle',
			}, 500);			
			
			$('#blogindiv').animate(
				{ width: 'toggle',
			}, 500);
		} else {
			//REGISTER AJAX
			$.ajax({url: '/functionsPHP/authenticationService',
				type: 'POST', 
				data: { type : "register",  email : $('#input-email').val(), password : $('#input-pass').val(), password2 : $('#input-pass2').val()},
				success: function(json) {
					console.log(json);
					var response = JSON.parse(json);
					
					if (response.type == "success") {
						$('#auth-alert').stop().hide();					//hide alert if its visible
						$('#profile-link').text(response.value);		// set email link
						$('#profile-link').stop().animate({				// show email link
							width: 'toggle', paddingRight : '15px'
						}, 500);	
						$('#logout').stop().animate({					// show logout button
							width: 'toggle', paddingRight : '15px'
						}, 500);
						
						$('#login-reg-form').stop().animate({width: 'toggle'}, 500, "linear", function(){
							$('#input-pass2').hide();
							$('#blogindiv').show();
							registercount = 0;
						});
						
						$('#btoggle').stop().animate({ width: 'toggle'} , 500);
						$('#btoggle').html('[+] Login / Register');
							
						registercount = 0;
						togglecount = 0;
					} else {
						//error alert
						$('#auth-alert').css('marginLeft', $('#shoppingCart').outerWidth(true) + 5);
						$('#auth-alert').stop().hide();
						$('#auth-alert').text(response.value);
						$('#auth-alert').stop().animate({height: 'toggle'}, 250, 'linear', function(){
							$('#auth-alert').delay(5000).animate({height: 'toggle'}, 250);
						});
					}
				}
			})
		
		}
		
		registercount++;
	});
	
	//login on click
	$('#blogin').click(function() {
		//LOGIN AJAX
		$.ajax({url: '/functionsPHP/authenticationService',
				type: 'POST', 
				data: { type : "login",  email : $('#input-email').val(), password : $('#input-pass').val()},
				success: function(json) {
					console.log(json);
					var response = JSON.parse(json);
					
					if (response.type == "success") {
						$('#auth-alert').stop().hide();					//hide alert if its visible
						$('#profile-link').text(response.value);		// set email link
						$('#profile-link').stop().animate({				// show email link
							width: 'toggle', paddingRight : '15px'
						}, 500);	
						$('#logout').stop().animate({					// show logout button
							width: 'toggle', paddingRight : '15px'
						}, 500);
						
						$('#login-reg-form').stop().animate({width: 'toggle'}, 500, "linear", function(){
							$('#input-pass2').hide();
							$('#blogindiv').show();
							registercount = 0;
						});
						
						$('#btoggle').stop().animate({ width: 'toggle'} , 500);
						$('#btoggle').html('[+] Login / Register');
							
						registercount = 0;
						togglecount = 0;
						
						//set cart total
						if (response.cartTotal != "") {
							document.getElementById("shoppingCart").innerHTML = "<a href='/cart'> Cart ($" + formatPrice(response.cartTotal) + ")</a>";
							
							var url = window.location.href;
							url = url.split('#').pop().split('?').pop();
							var page = url.substring(url.lastIndexOf('/') + 1);
							
							//if on cart page, refresh to build cart
							if (page == "cart" || page == "order"){
								location.reload();
							}
						}
					} else {
						//error alert
						$('#auth-alert').css('marginLeft', $('#shoppingCart').outerWidth(true) + 5);
						$('#auth-alert').stop().hide();
						$('#auth-alert').text(response.value);
						$('#auth-alert').stop().animate({height: 'toggle'}, 250, 'linear', function(){
							$('#auth-alert').delay(5000).animate({height: 'toggle'}, 250);
						});
					}
				}
			})

	});
	
	//logout on click
	$('#logout').click(function() {
		//LOGOUT AJAX
		$.ajax({url: '/functionsPHP/authenticationService',
				type: 'POST', 
				data: { type : "logout"},
				success: function(response) {
					console.log(response);
					
					document.getElementById("shoppingCart").innerHTML = "<a href='/cart'> Cart ($0.00)</a>";
					
					$('#profile-link').stop().animate({
							width: 'toggle', paddingRight : 'toggle'
						}, 500);
					$('#logout').stop().animate({					// hide logout button
							width: 'toggle', paddingRight : 'toggle'
						}, 500);
					$('#btoggle').show();
					$('#btoggle').stop().animate({					// show login toggle button text
						width: btoggleWidth
					}, 500);
					
					var url = window.location.href;
							url = url.split('#').pop().split('?').pop();
							var page = url.substring(url.lastIndexOf('/') + 1);
							
							//if on cart page, refresh to build cart
							if (page == "cart" || page == "order"){
								location.reload();
							}
				}
			})

	});
});

$(document).mouseup(function (e)
{
    var div = $('#userStuff');

    if (div.has(e.target).length === 0 && isEven(togglecount) === false)
    {
        toggleDiv();
    }
});

function isEven(someNumber) {
	return (someNumber % 2 === 0) ? true : false;
};

function toggleDiv(){
	togglecount++;
	
	if (isEven(togglecount) === false) {
		$('#login-reg-form').stop().animate({
			width: 'toggle',
		}, 500);			
		
		$('#btoggle').stop().animate(
			{ width: '25px'}, 500, "linear", function(){
				$('#btoggle').html('[ - ]');
			});
		
		
		
	} else if (isEven(togglecount) === true) {
		$('#login-reg-form').stop().animate({width: 'toggle'}, 500, "linear", function(){
			$('#input-pass2').hide();
			$('#blogindiv').show();
			registercount = 0;
		});
		
		$('#btoggle').stop().animate(
			{ width: btoggleWidth} , 500);
			
		$('#btoggle').html('[+] Login / Register');
		
		$('#auth-alert').stop().hide();
			
		registercount = 0;
	}
}

function toggleLoggedIn(loggedIn){
	if (loggedIn){
		$('#btoggle').hide();
		$('#profile-link').css('paddingRight', '15px');
	} else {
		$('#profile-link').hide();
		$('#logout').hide();
	}
}