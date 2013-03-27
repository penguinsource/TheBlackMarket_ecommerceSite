	
	function authenticate(type){
		//alert("type of req:" + type + ", value:" + document.getElementById("name").value);
		var xmlhttp;
		if (window.XMLHttpRequest){	// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		xmlhttp.onreadystatechange=function(){
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
			// this will have to be changed into something more professional but for now this will do..
			document.getElementById('userLoggedIn').innerHTML="Logged in : " + xmlhttp.responseText;
				if (xmlhttp.responseText == ""){
					document.getElementById('userLoggedIn').innerHTML="Logged in : Nobody is logged in..";
				}
			}
		}
		
		var url = "functionsPHP/authenticationService.php";	// servlet to call..
		if (type == "logout"){
			var params = "logOut=1"; 
		} else if ((type == "login") || (type == "register")){
			var nameVal = document.getElementById(type+"Email").value;
			var passVal = document.getElementById(type+"Pass").value;
			var params = type+"Name="+nameVal+"&"+type+"Pass="+passVal; 
		}

		xmlhttp.open("POST", url, true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
		xmlhttp.setRequestHeader("Content-length", params.length); 
		xmlhttp.setRequestHeader("Connection", "close"); 
		xmlhttp.send(params);
	}
	