<?php
ob_start();
include 'config.php';
extract($_POST);
$date = date('Y-m-d');
$msg = $_GET["msg"];
$sessid = $_COOKIE['sessid'];

if (isset($_POST) && $_POST['submit'] == 'Login') {
    $chk = mysql_fetch_array(mysql_query("select * from register where (mobile='$mobile' || email='$mobile' ) and  password='$password' "));
    if (!empty($chk['guid'])) {
        if ($chk['status'] == 1) {
            setcookie("sessid", $chk['guid'], mktime(0, 0, 0, 12, 31, 2020));
            mysql_query("update cart set session_id='$_COOKIE[sessid]' where session_id='$sessid'");

            header('location:index.php');
        } else {
            $msg = "User is Blocked please contact our support";
        }
    } else {
        $msg = "Wrong Mobile Number / Email Id / Password";
    }
}
?>
<style>
.swiper-slide.toolbar-icon{
	width:25% !important;
}
</style>
<?php include 'header_bg.php'; ?>

<?php
if ($_COOKIE["sessid"] == "") {
    $cart = 0;
} else {
    $cart = mysql_num_rows(mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0"));
}
?>

<div class="views" >

    <div class="view view-main">



        <div class="pages">

            <div data-page="index" class="page homepage">
                <div class="page-content">

                    <div class="navbarpages nobg">
                        <a href="#" data-panel="left" class="open-panel">
                            <div class="navbar_left"><img src="images/icons/white/menu.png" alt="" title="" /></div>
                        </a>			

                        <a href="#" data-panel="right" class="open-panel">
                            <div class="navbar_right"><img src="images/icons/white/user.png" alt="" title="" /></div>
                        </a>					
                    </div>

                    <!-- Slider -->
                    <div class="swiper-container slidertoolbar swiper-init" data-effect="slide" data-parallax="true" data-pagination=".swiper-pagination" data-paginationClickable="true">
                        <div class="swiper-wrapper">

                            <div class="swiper-slide" style="background-image:url(images/slide1.jpg);">
                                <div class="slider_trans">
                                    <div class="slider-caption">

                                        <div class="logo_image" style="margin-top:90; margin-left:auto; margin-right:auto;" ><a href="index.php"><img src="images/logo.png" alt="" title=""/></a></div>

                                        <h2 data-swiper-parallax="-100%" style="text-shadow:2px 1px #000">Free Food</h2>
                                        <span class="subtitle" data-swiper-parallax="-60%">Login Here</span>
                                        <div class="alert alert-info">
<?php echo $msg; ?>
                                        </div>
                                        <div class="loginform">
                                            <form name="form2" method="post" action="login.php">
                                                <input type="text" placeholder="Mobile Number / Email Id" name="mobile" class="form_input required"  required >
                                                <input type="password"  placeholder="Password" name="password" required  class="form_input required" >
                                                <input type="submit" name = "submit" class="form_submit" value = "Login" >


                                            </form>

                                        </div>
                                        <div>
                                            <a style ="float:left;color: #fff;font-weight: bold;padding-left: 57px;" href ="forgot.php">Forgot Password</a>
                                            <a style ="float:right;color: #fff;font-weight: bold;padding-right: 57px;" href ="register.php" >Sign Up</a>
                                        </div>


                                    </div>
                                </div> 
                            </div>

                        </div>

                        <div class="swiper-container-toolbar swiper-toolbar swiper-init" data-effect="slide" data-slides-per-view="5" data-slides-per-group="3" data-space-between="0" data-pagination=".swiper-pagination-toolbar">

                            <div class="swiper-wrapper">
                                <div class="swiper-slide toolbar-icon">
<?php if ($_COOKIE["area"] == "") { ?>
                                        <a href="login.php" data-view=".view-main"><img src="images/icons/white/food.png" alt="" title="" /></a>
                                    <?php } else { ?>
                                        <a href="category.php" data-view=".view-main"><img src="images/icons/white/food.png" alt="" title="" /></a>
                                    <?php } ?>

                                </div>
                                <div class="swiper-slide toolbar-icon">
<?php if ($_COOKIE["area"] == "") { ?>
                                        <a href="login.php" data-view=".view-main"><img src="images/icons/white/shop.png" alt="" title="" /></a>
                                    <?php } else { ?>
                                        <a href="home-store.php" data-view=".view-main"><img src="images/icons/white/shop.png" alt="" title="" /></a>
                                    <?php } ?>

                                </div>

                                <div class="swiper-slide toolbar-icon">
<?php if ($_COOKIE["sessid"] == "") { ?>
                                        <a href="login.php"  data-view=".view-main"><img src="images/icons/white/cart.png" alt="" title="" />
                                            <span class="home-badge"><?php echo $cart; ?></span></a>
<?php } else { ?>
                                        <a href="checkout.php" data-view=".view-main"><img src="images/icons/white/cart.png" alt="" title="" />
                                            <span class="home-badge"><?php echo $cart; ?></span></a>
<?php } ?>
                                </div>

                                <div class="swiper-slide toolbar-icon"><a href="contact.php" class="external"><img src="images/icons/white/phone.png" alt="" title="" /></a></div>
                            </div>
                        </div>	 


                    </div>
                </div>
            </div>



        </div>
    </div>



<?php include 'footer_bg.php'; ?>