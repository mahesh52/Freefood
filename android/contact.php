<?php ob_start();
include 'config.php';
?><!DOCTYPE HTML>
<!DOCTYPE html>
<?php include 'header_bg.php'; ?>

<?php
if($_COOKIE["sessid"] == ""){
    $cart = 0;
}else{
   $cart = mysql_num_rows(mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0")); 
}
?>
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
                                            <div class="slider-caption" style = "bottom:40% !important;">
											<span style = "font-size:12px;" class="subtitle" data-swiper-parallax="-60%">
											<?php echo "TIMINGS - 11 AM to 9 PM"; ?>
											</span>
                                                <div class="logo_image" style="margin-top:90; margin-left:auto; margin-right:auto;" ><a href="#"><img src="images/logo.png" alt="" title=""/></a></div>
 <div class=""><p align="center"><?php echo $msg;?></p>
                <div class="col-xs-12" align="center"><br>
					<h3><i class="fa fa-phone" style="font-size:65px;  padding:16px; width:60px; height:60px; color:white; border-radius: 100px;"></i></h3>
					<h3 style = "color:#fff !important;font-weight:bold !important;">Call Us On</h3>
					
					<span class="btn btn-success col-xs-12" style="font-size:30px;color:#fff;font-weight:bold;">+919580666888</span><br>
				</div>
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

                                       <div class="swiper-slide toolbar-icon">
                                              <?php if($_COOKIE["sessid"] == ""){ ?>
                                            <a href="login.php"  data-view=".view-main"><img src="images/icons/white/cart.png" alt="" title="" />
                                                <span class="home-badge"><?php echo $cart; ?></span></a>
                                                 <?php } else{ ?>
                                            <a href="checkout.php" data-view=".view-main"><img src="images/icons/white/cart.png" alt="" title="" />
                                                <span class="home-badge"><?php echo $cart; ?></span></a>
                                            <?php }  ?>
                                        </div>

                                         <div class="swiper-slide toolbar-icon">
										 <a  href="contact.php" class="external">
										 <img src="images/icons/white/phone.png" alt="" title="" /></a></div>
                                    </div>
                                </div>	 


                            </div>
                        </div>
                    </div>



                </div>
            </div>


            

            <?php include 'footer_bg.php'; ?>
