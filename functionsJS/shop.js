
function goToSortedPage(cat){
	var sortType = document.getElementById('sortBy').value;	
	// redirect to new link with GET sortBy
	window.location = "/shop/"+cat + "/" + sortType;
}