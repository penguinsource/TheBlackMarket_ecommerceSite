<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php include("functionsPHP/generalFuncs.php"); ?>
<?php checkPage(); ?>
<html>
  
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">

  <link href="design.css" rel="Stylesheet" type="text/css">
	<link href="design/stickybar.css" rel="Stylesheet" type="text/css">
  <link href="design/loginSlider.css" rel="Stylesheet" type="text/css">
	<link href="design/searchBar.css" rel="Stylesheet" type="text/css">

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

    <div id="leftcolumn">      
      <p>left side</p>
    </div>

    <div id="contentwrapper">

      <div id="middlecolumn">      

        <div id="topMenu">
          <div id="topMenuLogo">
            <img src="design/BM_LOGO.png" />						
          </div>

          <div id="topMenuOpts"> 
						<div id="topMenuSearch">
							<div id="search"><input type="text" placeholder="Search"></input></div>
						</div>          
						   
            <table border='0'>
							<tr>
								<td><a href="#">Home</a></td>
								<td><a href="#">Categories</a></td>
								<td><a href="#">Order Products</a></td>
								<td><a href="#">Advanced Search</a></td>
								<td><a href="#">Contact Us</a></td>
							</tr>
						</table>
          </div>
					
        </div>      

	      <p>middle content type shit</p>
      </div>

      <div id="rightcolumn">
	      <p>right side</p>
      </div>
    </div>
    
    <div id="footer">
      <p>&bull; CMPUT 410 &bull;</p>
    </div>
  </div>
</body>

</html>
