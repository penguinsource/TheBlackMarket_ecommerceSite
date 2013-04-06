var togglecount = 0;
var registercount = 0;	
var btoggleWidth;

$(document).ready(function(){
	$('#login-reg-form').hide();
	$('#input-pass2').hide();
	$('#auth-alert').hide();
	
	btoggleWidth = $('#btoggle').outerWidth(true) + 5;
	
	$('#btoggle').click(function() {
		toggleDiv();
	});
	
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
					var response = JSON.parse(json);
					//$('#auth-alert').html = response.value;	
					alert("response value: " + response.value);
				}
			})
		
		}
		
		registercount++;
	});
	
	$('#blogin').click(function() {
		//LOGIN AJAX
		$.ajax({url: '/functionsPHP/authenticationService',
				type: 'POST', 
				data: { type : "login",  email : $('#input-email').val(), password : $('#input-pass').val()},
				success: function(json) {
					var response = JSON.parse(json);
					//$('#auth-alert').html = response.value;	
					alert("response value: " + response.value);
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
			
		registercount = 0;
	}
}