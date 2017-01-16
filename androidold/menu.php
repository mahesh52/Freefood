<?php  $details=mysql_fetch_array(mysql_query("select * from register where guid='$_COOKIE[sessid]'"));?>
<div style="" class="side-tabs-mobile menu-bg">
      <div class="col-xs-12 menu-head no-padd">
        <a href="javascript:void(0);" class="pull-right" id="close-btn"><i class="fa fa-close"></i></a><br />
        <img src="assets/images/logo-food.png" style="margin-left: 50px;" width="100" class="img-responsive img-circle" />
        <h4><?php if($details['name']!=''){echo $details['name'];}else{echo "<a href='login.php'>Please Login</a>";}?></h4>
      </div>
      <div class="clearfix"></div>
      <div class="menu-item">
        <a href="shipping-address.php"><i class="fa fa-map-marker"></i> My Profile</a>
      </div>
      <div class="menu-item">
        <a href="orders.php"><i class="fa fa-history"></i> My Orders</a>
      </div>
      <div class="menu-item">
        <a href="wallet.php"><i class="fa fa-history"></i> My Wallet</a>
      </div>
     <!--div class="menu-item">
        <a href="#"><i class="fa fa-bell"></i> Notifications</a>
      </div>
      <div class="menu-item">
        <a href="#"><i class="fa fa-map-pin"></i> Track</a>
      </div-->
      <div class="menu-item">
        <a href="#"><i class="fa fa-exclamation-triangle"></i> Help</a>
      </div>
      <div class="menu-item">
        <a href="tel:+919580666888"><i class="fa fa-phone"></i> Call Us</a>
      </div>
      <div class="menu-item">
        <a href="#"><i class="fa fa-star"></i> Rate App</a>
      </div>
      <?php if($details['guid']==''){?><div class="menu-item">
        <a href="register.php"><i class="fa fa-star"></i> Register</a>
      </div><?php }else{?>
	  <div class="menu-item">
        <a href="logout.php"><i class="fa fa-star"></i> Logout</a>
      </div>
	  <?php }?>
    </div>