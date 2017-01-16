<?php
ob_start();
include 'config.php';
$session_user = "";

//unset($_SESSION['user_session']);
//echo "<pre>";
//print_r($_SESSION);
if (isset($_SESSION) && $_SESSION['user_session'] != "") {
    $user_id_fs = $_SESSION['user_session'];
} else {
    $user_id_fs = "";
}
?>
<!DOCTYPE html>
<html>
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
    </head>
    <body id="mobile_wrap">

        <div class="statusbar-overlay"></div>

        <div class="panel-overlay"></div>

        <div class="panel panel-left panel-reveal">
            <div class="view view-subnav">
                <div class="pages">
                    <div data-page="panel-leftmenu" class="page pagepanel">	
                        <div class="page-content">
                            <nav class="main-nav icons_31">
                                <ul>
                                    <li><a href="food-categories.php" class="close-panel" data-view=".view-main"><img src="images/icons/white/food.png" alt="" title="" /><span>Food</span></a></li>
                                    <li><a data-view=".view-main" class="close-panel" href="store-categories.php"><img title="" alt="" src="images/icons/white/shop.png"><span>Store</span></a></li>
                                    <li><a data-view=".view-main" class="close-panel" href="cart.html"><img title="" alt="" src="images/icons/white/cart.png"><span class="">My Cart</span></a><span class="nav-badge"></span></li>
                                    <li><a href="offers.html" class="close-panel" data-view=".view-main"><img src="images/icons/white/gift.png" alt="" title="" /><span>Offers</span></a></li>
                                    <li><a href="faqs.html" class="close-panel" data-view=".view-main"><img src="images/icons/white/form.png" alt="" title="" /><span>FAQ's</span></a></li>

                                    <?php
                                    if ($user_id_fs != "") {
                                        ?>
                                        <li><a href="orders.php" class="close-panel" data-view=".view-main"><img src="images/icons/white/categories.png" alt="" title="" /><span>My Orders</span></a></li>	

                                        <li><a href="points.php" class="close-panel" data-view=".view-main"><img src="images/icons/white/blog.png" alt="" title="" /><span>My Points</span></a></li>	

                                        <li><a href="balance.php" class="close-panel" data-view=".view-main"><img src="images/icons/white/rupee.png" alt="" title="" /><span>Bal. &#8377;402.00</span></a></li>
                                        <li><a href="inbox.php" class="close-panel" data-view=".view-main"><img src="images/icons/white/message.png" alt="" title="" /><span>Inbox</span></a><span class="nav-badge">20</span></li>
                                        <li><a href="contact.php" class="close-panel" data-view=".view-main"><img src="images/icons/white/contact.png" alt="" title="" /><span>Email</span></a></li>
                                        <li><a  href="toggle.html" class="close-panel" data-view=".view-main"><img src="images/icons/white/settings.png" alt="" title="" /><span>Settings</span></a></li>
                                        <li><a href="#" onclick="logout();"  class="close-panel" data-view=".view-main"><img src="images/icons/white/lock.png" alt="" title="" /><span>Logout</span></a></li> 

    <?php
} else {
    ?>
                                        <li><a class="open-popup close-panel" data-popup=".popup-login" href="#"><img title="" alt="" src="images/icons/white/user.png"><span>Login</span></a></li>

                                        <li><a class="open-popup close-panel" data-popup=".popup-signup" href="#"><img title="" alt="" src="images/icons/white/user.png"><span>Register</span></a></li>

                                        <li><a class="open-popup close-panel" data-popup=".popup-forgot" href="#"><img title="" alt="" src="images/icons/white/user.png"><span>Forgot Password</span></a></li>

    <?php
}
?>




                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>  
        </div>

        <!-- <div class="panel panel-right panel-reveal">
           <div class="user_login_info">
               
                     <div class="user_thumb">
                     <img src="images/page_photo.jpg" alt="" title="" />
                       <div class="user_details">
                        <p>Welcome, <span>Jagadish</span></p>
                       </div>  
                       <div class="user_avatar"><img src="images/avatar.jpg" alt="" title="" /></div>       
                     </div>
                                     
                       <nav class="user-nav">
                         <ul>
                           <li><a href="features.html" class="close-panel"><img src="images/icons/white/food-categories.png" alt="" title="" /><span>Account Settings</span></a></li>
                           <li><a href="features.html" class="close-panel"><img src="images/icons/white/briefcase.png" alt="" title="" /><span>My Account</span></a></li>
                           <li><a href="features.html" class="close-panel"><img src="images/icons/white/message.png" alt="" title="" /><span>Messages</span><strong>12</strong></a></li>
                           <li><a href="features.html" class="close-panel"><img src="images/icons/white/love.png" alt="" title="" /><span>Favorites</span><strong>5</strong></a></li>
                           <li><a href="index.html" class="close-panel"><img src="images/icons/white/lock.png" alt="" title="" /><span>Logout</span></a></li>
                         </ul>
                       </nav>
           </div>
         </div>-->

        <div class="views">

            <div class="view view-main">

