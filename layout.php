<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php include("functionsPHP/generalFuncs.php"); ?>
<?php checkPage(); ?>
<html>
  
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">

  <link href="design.css" rel="Stylesheet" type="text/css">
	<link href="design/stickybar.css" rel="Stylesheet" type="text/css">
  <link href="design/loginSlider.css" rel="Stylesheet" type="text/css">

  <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript" src="functionsJS/loginSlider.js"></script>
</head>

<body>
  <div id="header">
    <div id="stickymenu">
      <table border="0">
				<tr>
					<td><a href="#">Home</a></td>
					<td><a href="#">Shop</a></td>
				</tr>
			</table>
    </div>
    <div id="nlogin">
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
            <img src="design/BM_LOGO.png" />
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
