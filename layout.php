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
  <script type="text/javascript" src="jqEasySlidePanel/js/jquery.slidePanel.js"></script>

  <script language="javascript" type="text/javascript">
  
  // pushes the login button
  $(document).ready(function() {
    $("#blogin").click(function() {

    });
    
  // pushes the register button  
	$("#bregister").click(function() {
	    document.getElementById('passconf').setAttribute("style", "display: block");
			$('#loginPanel').animate({ width: '400px' }, 500);			
		});
  });  
  
  // set up the sliding panel
	$(document).ready(function(){
		$('#loginPanel').slidePanel({
			triggerName: '#trigger2',
			triggerTopPos: '0px',
			panelTopPos: '0px'
		});
	});
	</script>

</head>

<body>
  <div id="header">
    <div id="logo">
      <!-- no logo that fits -->
    </div>
    <div id="nlogo">
      <div id="title">
	      <!--<h1>BLACK MARKET BITCHES</h1>-->
      </div>
			<a href="#" id="trigger2" class="trigger right"> Login/Register</a>
      <div id="loginPanel" class="panel right">
			  <table>
			    <tr>
			      <td><input type="text" id="email" placeholder="Email"></input></td>
			      <td><input type="text" id="password" placeholder="Password"></input></td>
			      <td>
			        <input type="text" id="passconf" placeholder="Confirm Password" style="display: none">
			        </input>
			      </td>
			      <td><input type="button" id="blogin" value="Login"></input></td>
			      <td><input type="button" id="bregister" value="Register"></input></td>
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
        <div id="topmenu">
          <div id="logo">
            <img src="BM_LOGO.png" />
          </div>
          <div id="nlogo">              
            <p>mihai eats babies</p>
          </div>
        </div>      
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
