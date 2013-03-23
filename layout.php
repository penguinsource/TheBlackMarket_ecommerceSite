<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php include("functionsPHP/generalFuncs.php"); ?>
<?php checkPage(); ?>
<html>
  
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <link href="design.css" rel="Stylesheet" type="text/css">
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <script language="javascript" type="text/javascript"> 
  $(document).ready(function() {
    $("#slide").click(function() {
      if ($("#slide").val() == "<") {
	$("#slide").val(">");
        $("#login").animate({right:0});
      }
      else if ($("#slide").val() == ">") {
        $("#slide").val("<");
	$("#login").animate({right:-250});
      }
    });
    $("#blogin").click(function() {
      alert("Login button clicked");
    });
  });

  
  </script>
</head>

<body>
  <div id="header">
    <div id="logo">
      <img src="BM_LOGO.png" />
    </div>
    <div id="nlogo">
      <div id="title">
	<h1>BLACK MARKET BITCHES</h1>
      </div>
      <div id="login">
	<table border="0">
	  <tr>
	    <td><input type="button" id="slide" value="<"></input></td>
	    <td><input type="text" name="email" value="Email"></input></td>
	  </tr>
	  <tr>
	    <td></td>
	    <td><input type="text" name="password" value="Password"></input></td>
	    <td><input type="button" name="blogin" value="login" id="blogin"></input></td>
	  </tr>
	</table>
      </div>
    </div>
  </div>

  <div id="page">
    <div id="nav">      
      <p>some random nav bar</p>
    </div>

    <div id="content">
      <div id="store">
	<p>middle content type shit</p>
      </div>

      <div id="userbar">
	<p>user bar content</p>
      </div>
    </div>
    
    <div id="footer">
      <p>&bull; CMPUT 410 &bull;</p>
    </div>
  </div>
</body>

</html>
