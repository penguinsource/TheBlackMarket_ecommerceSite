$(document).ready(function(){
	setInterval('swapImages()', 5000);

	$('.menuitem').hover(function () {
		$(this).stop(true, true).addClass('menuhover', 100);
		$(this).addClass('menuhover', 250);
	},
	function () {
		$(this).stop(true, true).removeClass('menuhover', 100);
		$(this).removeClass('menuhover', 100);
	});
});

function swapImages(){
  var $active = $('#menulogo .activelogo');
  var $next = ($('#menulogo .activelogo').next().length > 0) ? $('#menulogo .activelogo').next() : $('#menulogo img:first');
  $active.fadeOut(function(){
    $active.removeClass('activelogo');
    $next.fadeIn().addClass('activelogo');
  });
}