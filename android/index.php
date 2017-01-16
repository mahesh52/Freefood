<?php ob_start();
include 'config.php';
?><!DOCTYPE HTML>
<!DOCTYPE html>
<?php include 'header_bg.php'; ?>

<?php
$date = date('Y-m-d');$date1 = date('Y-m-d H:i:s');
if($_COOKIE["sessid"] == ""){
    $cart = 0;
}else{
	$login_info = mysql_num_rows(mysql_query("select * from login_details where user_id='$_COOKIE[sessid]' and date(dateandtime)='".$date."'"));
   $cart = mysql_num_rows(mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0")); 
   if($login_info == 0){
	   mysql_query("insert into login_details (userid,dateandtime)values('".$_COOKIE[sessid]."','".$date1."')");
   }
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
                                            <div class="slider-caption">
											<span style = "font-size:12px;" class="subtitle" data-swiper-parallax="-60%">
											<?php echo "TIMINGS - 11 AM to 9 PM"; ?>
											</span>
                                                <div class="logo_image" style="margin-top:90; margin-left:auto; margin-right:auto;" ><a href="#"><img src="images/logo.png" alt="" title=""/></a></div>

                                                <h2 data-swiper-parallax="-100%" style="text-shadow:2px 1px #000">Free Food</h2>
                                                <span class="subtitle" data-swiper-parallax="-60%">Your Home Food</span>
                                                <div class="loginform">
                                                    <form name="form1" method="post" action="welcome.php">
													<!--onChange="return subcategories(this.value);"-->
                                                        <select class="form_select" name="city" required onChange="return subcategories(this.value);" >
                                                            <option value = "">Select City</option>
                                                            <?php
                                                            $qry = mysql_query("select * from city order by name asc") or die('error');
                                                            while ($row = mysql_fetch_assoc($qry)) {
                                                                echo "<option value='$row[guid]'>$row[name]</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                        <span id="subcagtegory">
														
														   <select disabled  name="area" required class="form_select">
														   <option value = "">Select Area</option>
														   </select>
															
															</span>



                                                        <input type="submit" class="form_submit" value = "Find Now" >


                                                    </form>

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


            <script>
                function subcategories(s)
                {//alert(s);
                    $.ajax({
                        type: "get",
                        dataType: "text",
                        url: "sub.php",
                        data: "val=" + s,
                        success: function (response) {
                            $('#subcagtegory').html(response);
                        }
                    });
                }
            </script> 

            <?php include 'footer_bg.php'; ?>
