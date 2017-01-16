<?php
include 'config.php';
$page_name = basename($_SERVER['PHP_SELF']);
if ($_COOKIE["sessid"] == "") {
    $cart = 0;
    $wat1=0;
} else {
    $cart = mysql_num_rows(mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0"));
    
}
$details = mysql_fetch_array(mysql_query("select * from register where guid='$_COOKIE[sessid]'"));
if ($details['guid'] == '') {
	$wat=0;$wat1=0;
}
else{
	$wat=0;$wat1=0;
				$credit=mysql_fetch_array(mysql_query("select sum(points) from wallet where userid='$_COOKIE[sessid]' and status='Credit'"));
				$debit=mysql_fetch_array(mysql_query("select sum(points) from wallet where userid='$_COOKIE[sessid]' and status='Debit'"));
				$wat=$credit[0]-$debit[0];
				
}
?><html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">

        <title>Free Food</title>
        <link rel="stylesheet" href="css/framework7.css">
        <link rel="stylesheet" href="style.css">
        <link type="text/css" rel="stylesheet" href="css/swipebox.css" />
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,700,900' rel='stylesheet' type='text/css'>
        <link type="text/css" rel="stylesheet" href="font-awesome/css/font-awesome.min.css" />
        <link type="text/css" rel="stylesheet" href="css/ddown.css" />

    </head>
    <body id="mobile_wrap" <?php if ($page_name == "store-checkout.php") { ?>  onload="myFunction()"  <?php } ?>>
        <div class="panel panel-left panel-reveal">
            <div class="view view-subnav">
                <div class="pages">
                    <div data-page="panel-leftmenu" class="page pagepanel">	
                        <div class="page-content">
                            <nav class="main-nav icons_31">
                                <ul>
								<li><a href="index.php" class="close-panel" data-view=".view-main"><img src="images/icons/white/food.png" alt="" title="" /><span>Home</span></a></li>
                                    <?php if ($_COOKIE["sessid"] == "") { ?>
                                        <li><a data-view=".view-main" class="close-panel" href="login.php">
                                                <img title="" alt="" src="images/icons/white/cart.png">
                                                 <span class="">Cart(<?php echo $cart; ?>)</span></a>
                                        </li>
                                        </li>

                                    <?php } else { ?>
                                        <li><a data-view=".view-main" class="close-panel" href="checkout.php">
                                                <img title="" alt="" src="images/icons/white/cart.png">
                                                 <span class="">Cart(<?php echo $cart; ?>)</span></a>
                                        </li>
                                        </li>

                                    <?php } ?>


                                    <li><a href="orders.php" class="close-panel" data-view=".view-main"><img src="images/icons/white/categories.png" alt="" title="" /><span>Orders</span></a></li>	

                                    <li><a href="points.php" class="close-panel" data-view=".view-main"><img src="images/icons/white/blog.png" alt="" title="" /><span>Points(<?php echo $wat; ?>)</span></a></li>	


                                    <li><a href="faqs.php" class="close-panel" data-view=".view-main"><img src="images/icons/white/form.png" alt="" title="" /><span>FAQ's</span></a></li>
 <?php if ($details['guid'] == '') { ?>
                                    <li><a class="open-popup close-panel" data-popup=".popup-login" href="login.php"><img title="" alt="" src="images/icons/white/user.png"><span>Login</span></a></li>
                                    <li><a class="open-popup close-panel" data-popup=".popup-signup" href="register.php"><img title="" alt="" src="images/icons/white/user.png"><span>Register</span></a></li>
									<li><a class="open-popup close-panel" data-popup=".popup-forgot" href="forgot.php"><img title="" alt="" src="images/icons/white/user.png"><span>Forgot Password</span></a></li>
                                    <?php } ?>
                                    <?php if ($details['guid'] != "") { ?>
                                    <li><a href="logout.php" class="close-panel" data-view=".view-main"><img src="images/icons/white/lock.png" alt="" title="" /><span>Logout</span></a></li> 
                                    <?php } ?>

                                    
                                    <li><a class="open-popup close-panel" data-popup=".popup-forgot" href="#"><img title="" alt="" src="images/icons/white/back.png"><span>Back</span></a></li>


                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
        <div class="views" >

            <div class="view view-main">