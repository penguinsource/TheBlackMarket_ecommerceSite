<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php include("functionsPHP/generalFuncs.php"); ?>
<?php checkPage(); ?>
<html>
  
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <link href="design.css" rel="Stylesheet" type="text/css">
  <link href="jqEasySlidePanel/panelStyle.css" rel="Stylesheet" type="text/css">

  <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
  <script type="text/javascript" src="jqEasySlidePanel/js/jquery.slidePanel.min.js"></script>

  <script language="javascript" type="text/javascript"> 
  $(document).ready(function() {
    $("#blogin").click(function() {
      alert("Login button clicked");
    });
		$("#bregister").click(function() {
			alert("Register button clicked");
		});
  });  
  </script>

  <script type="text/javascript">
	$(document).ready(function(){
		$('#loginPanel').slidePanel({
			triggerName: '#trigger2',
			triggerTopPos: '20px',
			panelTopPos: '10px'
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
			<a href="#" id="trigger2" class="trigger right">Login/Register</a>
      <div id="loginPanel" class="panel right">
				<br /><br />
				<table border="0">
					<thead>
						<tr><th>Login</th><th>or</th><th>Register</th></tr>
					</thead>
					<tbody>
						<tr>
							<td><input type="text" value="Email" name="logEmail"></input></td>
							<td></td>
							<td><input type="text" value="Email" name="regEmail"></input></td>
						<tr>
						<tr>
							<td><input type="text" value="Password" name="logPassword"></input></td>
							<td></td>
							<td><input type="text" value="Password" name="regPassword"></input></td>
						</tr>
						<tr>
							<td><input type="button" value="Login" id="blogin"></input></td>
							<td></td>
							<td><input type="button" value="Register" id="bregister"></input></td>
						</tr>
					</tbody>
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
