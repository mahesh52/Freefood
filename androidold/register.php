<?php ob_start();include 'config.php';
extract($_POST);$date=date('Y-m-d');
$sessid=$_COOKIE['sessid'];
if(isset($_POST) && $_POST['submit']=='update' && $_POST['mobile']!='' && $_POST['email']!='' && $_POST['password']!='')
{
$chk=mysql_fetch_array(mysql_query("select * from register where mobile='$mobile'"));
$chk1=mysql_fetch_array(mysql_query("select * from register where email='$email'"));
	if(empty($chk['guid']) &&  empty($chk1['guid']))
	{
mysql_query("INSERT INTO `register` (`name` ,`mobile` ,`email` ,`address` ,`city` ,`state` ,`date`,`password`,`pincode`) VALUES ('$name', '$mobile', '$email', '$address', '$city', '$state', '$date','$password','$pincode')");
$ins=mysql_insert_id();
setcookie("sessid" ,$ins, mktime (0, 0, 0, 12, 31, 2020));
mysql_query("update cart set session_id='$_COOKIE[sessid]' where session_id='$sessid'");
header('location:welcome.php');
	}
	else
	{
	$msg="Mobile / Email Id Already Registered";
	}
}
?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
	<!-- For IE -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- For Resposive Device -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
	<link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon.png">
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="Free Food" />
	<title>Free Food</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="assets/css/animsition.min.css" rel="stylesheet">
    <script type="text/javascript" src="assets/js/jquery-2.1.4.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    
    <script>

   	  	$(function(){

			$('#left-nav').click(function(){

				$('.side-tabs-mobile').animate({left: '0px'});

			});

			$('#close-btn').click(function(){

				$('.side-tabs-mobile').animate({left: '-210px'});
    
			});

		});
		
		
		
	
   </script>
    
</head>

<body>
    <?php include 'menu.php';?>
	<!--header>
        <div class="col-xs-1 padd-sm" id="left-nav"><a href="javascript:void0;" class="pull-right menu-icon button-1"><i class="fa fa-align-center"></i></a></div>
        <div class="col-xs-6 no-padd"><a href="index.php"><img src="assets/images/logo1.png" class="img-responsive" width="110"/></a></div>
    </header-->
    
    
    <section class="status-bar">
        <article>
            <div class="col-xs-1"><a href="welcome.php"><i class="fa fa-angle-left"></i></a></div>
            <div class="col-xs-10 text-small" align="center">Register</div>
            <div class="col-xs-1"></div>
        </article>
    </section>
    <section class="animsition item bg-pink content-part" data-animsition-in-class="fade-in-down-sm" data-animsition-out-class="fade-out-down-sm" data-animsition-in-duration="2000">
        <article>
            <div class=""><p align="center"><?php echo $msg;?></p>
            <form name="form2" method="post" action="register.php">
                <div class="col-xs-12"><br>
					<li class="list-group-item">
							  <input type="text" class="form-control" placeholder="Full Name" name="name" required><br>
							  <div class="col-xs-6 no-padd"><input type="email" class="form-control" placeholder="Email" name="email" required ><br></div>
							  <div class="col-xs-6 no-padd"><input type="number" class="form-control" placeholder="Mobile" name="mobile" required ><br></div>
							  <input type="password" class="form-control" placeholder="Password" name="password" required><br>
                               <input type="text" class="form-control" placeholder="Address" name="address" required><br>
                               <input type="text" class="form-control" placeholder="Pincode" name="pincode" required><br>
							  <input type="text" class="form-control" placeholder="City" name="city" required><br>
							  <input type="text" class="form-control" placeholder="Area" name="state" required><br>
							  <div class="clearfix"></div>
						  </li><br>
					<button type="submit" name="submit" value="update" class="btn btn-success col-xs-12">Submit</button>
				</div></form>
            </div>
        </article>
    </section>
    
  <script src="assets/js/animsition.min.js" charset="utf-8"></script>
  <script>
  $( document ).ready(function() {
    var $animsition = $('.animsition');
    $animsition
      .animsition()
      .one('animsition.inStart',function(){
        $(this).append('');
        console.log('event -> inStart');
      })
      .one('animsition.inEnd',function(){
        $('.target', this).html('');
        console.log('event -> inEnd');
      })
      .one('animsition.outStart',function(){
        console.log('event -> outStart');
      })
      .one('animsition.outEnd',function(){
        console.log('event -> outEnd');
      });
  });
  </script>
  
  
  
</body>
</html>