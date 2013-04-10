$(document).ready(function(){
    var origSrc = new Array();
    //save original src imgs
    for (var i = 0; i < 5; i++){
        var starid = "star" + i;
        origSrc[i] = $("#" + starid).attr("src");
    }
    
    $(".star").mouseenter(function() {
        var id = new String($(this).attr('id')); 
        id = parseInt(id.replace(/[^0-9]/g, ''));            
        
        console.log("this id:" + id);
        // fill i nall stars up to and includign the hovered
        for (var i = 0; i < (id+1); i++){
            var starid = "star" + i;
            $("#" + starid).attr("src", "/design/images/star.png");
        }
        
        //empty all stars after the hovered
        for (var i = (id + 1); i < 5; i++){
            var starid = "star" + i;
            $("#" + starid).attr("src", "/design/images/starempty.png");
        }
    }).mouseleave(function() {
        //recover original images
        for (var i = 0; i < 5; i++){
            var starid = "star" + i;
            $("#" + starid).attr("src", origSrc[i]); 
        }
    });
	
	$(".star").click(function() {
		var id = new String($(this).attr('id')); 
        id = parseInt(id.replace(/[^0-9]/g, '')) + 1;  
		
		$.ajax({url: '/functionsPHP/ratingService',
				type: 'POST', 
				data: { rating : id, pid: pid},
				success: function(response) {
					console.log(response);
					
					id = response - 1;
					
					// change rating to what is returned 
					for (var i = 0; i < (id+1); i++){
						var starid = "star" + i;
						$("#" + starid).attr("src", "/design/images/star.png");
					}
					
					//empty all stars after the hovered
					for (var i = (id + 1); i < 5; i++){
						var starid = "star" + i;
						$("#" + starid).attr("src", "/design/images/starempty.png");
					}
					
					for (var i = 0; i < 5; i++){
						var starid = "star" + i;
						origSrc[i] = $("#" + starid).attr("src");
					}
				}
			})
	});
});