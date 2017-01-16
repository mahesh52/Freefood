<?php ob_start();include 'config.php';
function get_data($url) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
} 
extract($_POST);$date=date('Y-m-d');
$msg="";
$sessid=$_COOKIE['sessid'];
if(isset($_POST) && $_POST['submit']=='Click Here')
{
$chk=mysql_fetch_array(mysql_query("select * from register where (mobile='$mobile' and  email='$email' )"));
	if(!empty($chk['guid']))
	{
		$mobile =$chk['mobile'];
  $message = "Dear $chk[name] Here is your password $chk[password],we regret for the inconvenience caused, reach us at support@freefood.co.in";
            $sms = str_replace(" ", "%20", "$message");
            $url = "http://onlinebulksmslogin.com/spanelv2/api.php?username=freefd&password=free123&to=$mobile&from=FREEFD&message=$sms"; 
          
            get_data($url);
$msg="Password Sent To Your Mobile";
	}
	else
	{
	$msg="Wrong Mobile Number / Email Id";
	}
}
?>
<?php
if($_COOKIE["sessid"] == ""){
    $cart = 0;
}else{
   $cart = mysql_num_rows(mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0")); 
}
?>

<?php include 'header_bg.php'; ?>
<style>
.swiper-slide.toolbar-icon{
	width:25% !important;
}
</style>

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
                                                <span class="subtitle" data-swiper-parallax="-60%">Forgot Password</span>
                                                <div  style = "color:#fff !important;" id = "errormsg">
                                                    <?php echo $msg; ?>
                                                </div>
                                                <div class="loginform">
                                                     <form name="form2" method="post" action="forgot.php">
                                                        <input type="text" placeholder="Mobile Number" name="mobile"  class="form_input required"  required >
                                                       
                                                        <input type="email" class="form_input required"  placeholder="Email Id" name="email" required>
                                                        <input  name="submit" type="submit" class="form_submit" value = "Click Here" >
                                                        

                                                    </form>

                                                </div>
                                                <div>
                                                    <a style ="float:left;color: #fff;font-weight: bold;padding-left: 57px;" href ="login.php">Login</a>
                                                    <a style ="float:right;color: #fff;font-weight: bold;padding-right: 57px;" href ="register.php" >Sign Up</a>
                                                </div>


                                            </div>
                                        </div> 
                                    </div>

                                </div>

                                <div class="swiper-container-toolbar swiper-toolbar swiper-init" data-effect="slide" data-slides-per-view="5" data-slides-per-group="3" data-space-between="0" data-pagination=".swiper-pagination-toolbar">

                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide toolbar-icon">
                                            <?php if($_COOKIE["area"] == ""){ ?>
                                                <a href="login.php" data-view=".view-main"><img src="images/icons/white/food.png" alt="" title="" /></a>
                                            <?php   }else{ ?>
                                                <a href="category.php" data-view=".view-main"><img src="images/icons/white/food.png" alt="" title="" /></a>
                                                 <?php   } ?>
                                            
                                        </div>
                                        <div class="swiper-slide toolbar-icon">
                                            <?php if($_COOKIE["area"] == ""){ ?>
                                                <a href="login.php" data-view=".view-main"><img src="images/icons/white/shop.png" alt="" title="" /></a>
                                            <?php   }else{ ?>
                                                <a href="home-store.php" data-view=".view-main"><img src="images/icons/white/shop.png" alt="" title="" /></a>
                                                 <?php   } ?>
                                            
                                        </div>

<!--                                        <div class="swiper-slide toolbar-icon">
                                            
                                            <a href="offers.html" data-view=".view-main"><img src="images/icons/white/gift.png" alt="" title="" /></a>
                                        </div>-->

                                        <div class="swiper-slide toolbar-icon">
                                              <?php if($_COOKIE["sessid"] == ""){ ?>
                                            <a href="login.php"  data-view=".view-main"><img src="images/icons/white/cart.png" alt="" title="" />
                                                <span class="home-badge"><?php echo $cart; ?></span></a>
                                                 <?php } else{ ?>
                                            <a href="checkout.php" data-view=".view-main"><img src="images/icons/white/cart.png" alt="" title="" />
                                                <span class="home-badge"><?php echo $cart; ?></span></a>
                                            <?php }  ?>
                                        </div>

                                        <div class="swiper-slide toolbar-icon"><a href="contact.php" class="external"><img src="images/icons/white/phone.png" alt="" title="" /></a></div>
                                    </div>
                                </div>	 


                            </div>
                        </div>
                    </div>



                </div>
            </div>
            <script>
                function errorthr(){
                    $("#errormsg").html("Please select city and area");
                }
                </script>
 <?php include 'footer_bg.php'; ?>