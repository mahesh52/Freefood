<?php
session_start();
?>
                  <?php 
				  
				  $user_id=$_GET["id"];
                     
					  include 'sql.php';
                 $result = mysql_query("SELECT * from intrestedin where id='$user_id' ");
while($row=mysql_fetch_array($result)){

$user_id=$row['id'];
$name=$row['name'];
$phone=$row['phone'];
$email=$row['email'];
$intrest=$row['intrest'];
$area=$row['area'];
$location=$row['location'];
}
 
 
?>                
                     


<?php
if(count($_POST)){
$message1=$_POST['message'];
$subject1=$_POST['subject'];
	
 include 'sql.php';
mysql_query("insert into updates (userid,subject,message) values('$user_id','$subject1','$message1') ");
$message1="<div> $name<br>$email<br>$phone<br>$area<br>title<br>$message1 <br> Thank You</div>";


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
  <title>All Users |Free Food</title>

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


  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="js/plugins/prism/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">

  </head>

<body>
  <!-- Start Page Loading -->
  
  <!-- End Page Loading -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START HEADER -->
  <header id="header" class="page-topbar">
        <!-- start header nav-->
        <div class="navbar-fixed">
            <nav class="navbar-color">
                <div class="nav-wrapper">
                    <ul class="left">                      
                      <li><h1 class="logo-wrapper"><a href="dashboard.php" class="brand-logo darken-1"><img src="images/logo-r.png" alt="Free Food"></a> <span class="logo-text">Free Food</span></h1></li>
                    </ul>
                    
                    
                    <!-- translation-button -->
                  
                    <!-- notifications-dropdown -->
                    
                </div>
            </nav>
        </div>
        <!-- end header nav-->
  </header>
  <!-- END HEADER -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START MAIN -->
  <div id="main">
    <!-- START WRAPPER -->
    <div class="wrapper">
      <aside id="left-sidebar-nav">
        <ul id="slide-out" class="side-nav fixed leftside-navigation">
            <li class="user-details cyan darken-2">
            <div class="row">
              
                <div class="col col s8 m8 l8">
                    <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown"><?php echo $_SESSION["admin_name"] ?></a>
                    <p class="user-roal">Administrator</p>
                </div>
            </div>
            </li>
            <li class="bold"><a href="dashboard.php" class="waves-effect waves-cyan">
		     <i class="mdi-action-dashboard"></i>My Dashboard</a>
            </li>
		    <li class="bold"><a href="intrestedusers.php" class="waves-effect waves-cyan">
			<i class="mdi-social-group"></i>Intrested Users </a>
            </li>
			<li><a href="index.php"><i class="mdi-action-lock-outline"></i> Logout</a>
            </li>
        </ul>
        <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu"></i></a>
        </aside><!-- END LEFT SIDEBAR NAV-->

      <!-- //////////////////////////////////////////////////////////////////////////// -->

	  	        <!-- START CONTENT -->
      <section id="content">
        
        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper">
            <!-- Search for small screen -->
            <div class="header-search-wrapper grey hide-on-large-only">
                
            </div>
          <!--<div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">Single Task</h5>
                <!--<ol class="breadcrumbs">
                    <li><a href="index.html">Dashboard</a></li>
                    <li><a href="#">Pages</a></li>
                    <li class="active">Todo Page</li>
                </ol>              </div>
            </div>
          </div>-->
        </div>
        <!--breadcrumbs end-->
        

        <!--start container-->
        <div class="container">
          <div class="section">
            <div class="col s12">
              <ul id="task-card" class="collection with-header">
			      <li class="collection-header cyan">
                      <h4 class="task-card-title">User Details</h4>
                     
                  </li>
				 
              </ul> <div class="row">
			  <div class= "input-field col s6" style="padding-left:50px"> 
			<span style="font-weight:bold">Name		:</span> <?php echo $name;?><br>
			
			
		<span style="font-weight:bold">Phone Number		: </span><?php  echo $phone ?><br>
			 
			 <span style="font-weight:bold">Email Id		: </span><?php  echo $email ?>	<br>
			 </div>
			 
			 
			 <div class="input-field col s6">
			 <span style="font-weight:bold">Area	:</span> <?php  echo $area ?><br>
			 <span style="font-weight:bold">Location		:</span> <?php  echo $location ?><br>
			<span style="font-weight:bold">Intrested in	:</span> <?php  echo $intrest ?>
			 
			 
<br></div>
</div><div class="row" style="margin-left:50px;"><div class= "input-field col s12"><h5> History of Messages </h5></div></div>
<?php
$res = mysql_query("SELECT * from updates where userid='$user_id' ORDER BY id DESC");
while($update=mysql_fetch_array($res)){

$subject=$update['subject'];
$message=$update['message'];
?>
 <div class="row" style="margin-left:50px;"><div class= "input-field col s12"><span style="font-weight:bold"> Subject		: </span><p><?php  echo $subject ?></p></div></div>
			
			 <div class="row" style="margin-left:50px;"><div class= "input-field col s12"><span style="font-weight:bold"> Message		: </span><p><?php  echo $message ?></p></div><br></div>
		 <div class="divider"></div> 		    
	 
			 
<?php } ?>
			   <br>
			  
			  <form  name="f1"  method="post" action="" class="card-panel">
				<h4>Send Message....</h4>
				<div class="row">				
  <div class="form-group">
    
    <input type="text" name="subject" id="subject"  style="width:100%;" placeholder="Add Subject....">
  </div>
  </div>
  <br>
<div class="row">				
  <div class="form-group">
    
    <textarea name="message" id="description" cols="50" rows="5"  style="width:100%;" placeholder="Add Message...."></textarea>
  </div>
  </div>
  <br><br>
  <center> <button type="submit" class="btn btn-success">Submit</button></center>
</form>
					</div>

            </div>
              </div>
				
          
             
			            </div>
		  
			 
			   </div>
          </div>
		                  
                </div>
          </div>
          </div>
		  <!-- Modal 1 end -->
          <!-- Floating Action Button -->
           
            <!-- Floating Action Button -->
        </div>
        <!--end container-->
      </section>
      <!-- END CONTENT -->

      <!-- //////////////////////////////////////////////////////////////////////////// -->
      <!-- START RIGHT SIDEBAR NAV-->
      <!-- LEFT RIGHT SIDEBAR NAV-->

    </div>
    <!-- END WRAPPER -->

  </div>
  <!-- END MAIN -->

	
	  
	  
	  
      <!-- //////////////////////////////////////////////////////////////////////////// -->
      <!-- START RIGHT SIDEBAR NAV-->
      <!-- LEFT RIGHT SIDEBAR NAV-->

    </div>
    <!-- END WRAPPER -->

  </div>
  <!-- END MAIN -->



  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START FOOTER -->
  <footer class="page-footer">
    <div class="footer-copyright">
      <div class="container">
               <span>Copyright © 2016 <a class="grey-text text-lighten-4" href="" target="_blank">Free Food </a> All rights reserved.</span>
 
 </div>
    </div>
  </footer>
  <!-- END FOOTER -->



    <!-- ================================================
    Scripts
    ================================================ -->
    
    <!-- jQuery Library -->
	<script src="js/jQuery-2.1.4.min.js"></script>
	 
    <!--materialize js-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <!--prism-->
    <script type="text/javascript" src="js/plugins/prism/prism.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <!-- chartist -->
    <script type="text/javascript" src="js/plugins/chartist-js/chartist.min.js"></script>   
    
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="js/custom-script.js"></script>
  


<div style="display:none;">
		
<?php
/**
 * This example shows making an SMTP connection with authentication.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require 'phpmail/PHPMailerAutoload.php';


//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();

$mail->SMTPDebug = 0;

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = "md-1.webhostbox.net";
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = 465;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;

$mail->SMTPSecure = "ssl";
//Username to use for SMTP authentication
$mail->Username = "kavya@hariprahlad.com";
//Password to use for SMTP authentication
$mail->Password = "HP@2015";
//Set who the message is to be sent from
$mail->setFrom('kavya@hariprahlad.com');
//Set an alternative reply-to address
$mail->addReplyTo('info@freefood.co.in');
//Set who the message is to be sent to
$mail->addAddress("info@freefood.co.in","$email");
//Set the subject line
$mail->Subject = '$subject1';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('phpmail/examples/contents.php'), dirname(__FILE__));


$mail->IsHTML(true);
$mail->Body = "$message1";
//Replace the plain text body with one created manually
$mail->AltBody = 'Thank You!!!<br>Free Food';
//Attach an image file

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}

?>
</div>
</body>

</html>