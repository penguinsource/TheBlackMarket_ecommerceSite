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

$(function() {

	var $sidebar = $("test"),
		$window = $(window),
		offset = $sidebar.offset(),
		topPadding = 20;

	$window.scroll(function() {
		if ($window.scrollTop() > offset.top) {
			$sidebar.stop().animate({
				marginTop: $window.scrollTop() - offset.top + topPadding
			});
		} else {
			$sidebar.stop().animate({
				marginTop: 0
			});
		}
	});

});