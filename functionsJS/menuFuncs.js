var togglecount = 0;
var registercount = 0;	
var btoggleWidth;

$(document).ready(function(){
	$('#login-reg-form').hide();
	$('#input-pass2').hide();
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
		
			// REGISTRATION FUNCTION HERE
		
		}
		
		registercount++;
	});
	
	$('#blogin').click(function() {

		
		// LOGIn FUNCTION HERE

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
