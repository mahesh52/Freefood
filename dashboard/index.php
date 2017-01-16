<?php
session_start();
?>
<?php
if(count($_POST)){
$x1=$_POST["phone"];
$x2=$_POST["password"];

include 'sql.php';
$result =mysql_query(" select * from admin where phone='$x1' and password = '$x2'  ");
$count =mysql_num_rows($result);

if($count == 1)
{
	$res =mysql_query(" select * from admin where phone='$x1' and password = '$x2'  ");
$admin=mysql_fetch_array($res);
$_SESSION["admin_name"]=$admin["name"];
header("location:dashboard.php");
}
else
header("location:index.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<!--================================================================================
	Item Name: Materialize - Material Design Admin Template
	Version: 3.1
	Author: GeeksLabs
	Author URL: http://www.themeforest.net/user/geekslabs
================================================================================ -->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
  <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
  <title>Free Food</title>

  <!-- Favicons-->
  <link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">
  <!-- Favicons-->
  <link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">
  <!-- For iPhone -->
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
  <!-- For Windows Phone -->


  <!-- CORE CSS-->
  
  <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- Custome CSS-->    
    <link href="css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/layouts/page-center.css" type="text/css" rel="stylesheet" media="screen,projection">

  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="js/plugins/prism/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
  
</head>
<body class="cyan">
 <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->

	       <div id="login-page" class="row">
    <div class="col s12 z-depth-4 card-panel">
      <form class="login-form" method="POST" action="">
	  

        <div class="row">
          <div class="input-field col s12 center">
            <img src="images/materialize-logo.png" alt="" class=" responsive-img valign profile-image-login">
            <p class="center login-form-text"> Admin Login</p>
          </div>
        </div>
        <div class="row margin">
		<div class="form-group">
            
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input id="PhoneNumber" type="text" name="phone" >
            <label for="PhoneNumber" class="center-align">Phone Number</label>
			         
          </div>
        </div>
		</div>
        <div class="row margin">
		<div class="form-group">
                        
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="password" type="password" name="password">
            <label for="password">Password</label>
			
          </div>
        </div>
		</div>
        
      
        <div class="row">
          <div class="input-field col s12">
            <button type="submit" name="submit" class="btn waves-effect waves-light col s12">Login</button>
          </div>
        </div>
        

      </form>
    </div>
  </div>

</div>
	
    <!-- ================================================
    Scripts
    ================================================ -->

  <!-- jQuery Library -->
  <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>
  <!--materialize js-->
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <!--prism-->
  <script type="text/javascript" src="js/plugins/prism/prism.js"></script>
  <!--scrollbar-->
  <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

      <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="js/custom-script.js"></script>

</body>

</html>