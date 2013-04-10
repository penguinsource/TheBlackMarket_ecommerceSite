$(document).ready(function(){
	$('.menuitem').hover(function () {
		$(this).stop(true, true).addClass('menuhover', 100);
		$(this).addClass('menuhover', 250);
	},
	function () {
		$(this).stop(true, true).removeClass('menuhover', 100);
		$(this).removeClass('menuhover', 100);
	});
	
	$("#profileTable").tablesorter({ sortList: [[0, 0]] });
});
