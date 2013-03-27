	
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
		
		var url = "functionsPHP/authenticationFuncs.php";	// servlet to call..
		if (type == "logout"){
			var params = "logOut=1"; 
		} else if (type == "login"){
			var nameVal = document.getElementById("emailLogin").value;
			var passVal = document.getElementById("passwordLogin").value;
			var params = "loginName="+nameVal+"&loginPass="+passVal; 
		}

		xmlhttp.open("POST", url, true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
		xmlhttp.setRequestHeader("Content-length", params.length); 
		xmlhttp.setRequestHeader("Connection", "close"); 
		xmlhttp.send(params);
	}
	