<?php include 'header.php';?>



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

                                                <div class="logo_image" style="margin-top:90; margin-left:auto; margin-right:auto;" ><a href="#"><img src="images/logo.png" alt="" title=""/></a></div>

                                                <h2 data-swiper-parallax="-100%" style="text-shadow:2px 1px #000">Free Food</h2>
                                                <span class="subtitle" data-swiper-parallax="-60%">Your Home Food</span>
                                                <div class="loginform">

                                                    <form method="post" name="detailsform" id="detailsform" novalidate="novalidate" action="welcome.php">


                                                        <select name="city" class="form_input required" required onChange="return subcategories(this.value);">
                                                            <option value="">Select City</option>
                                                            <?php
                                                            $qry = mysql_query("select * from city order by name asc") or die('error');
                                                            while ($row = mysql_fetch_assoc($qry)) {
                                                                echo "<option value='$row[guid]'>$row[name]</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                        <span id="subcagtegory">					 
                                                            <select class="form-control form_input" name="area" required>
                                                                <option value="">Select Area</option>
                                                            </select>
                                                        </span>
                                                                            <!--<input type="text" placeholder="city" class="form_input required" value="Enter City" name="city">
                                                                            <input type="text" placeholder="area" class="form_input required" value="Enter Area" name="area">
                                                        
                                                       
                                                        <a href="food-store.html">-->

                                                        <input type="submit" value="Next" id="submit" class="form_submit" name="submit" />

                                                        <!--</a>-->
                                                    </form>

                                                </div>

                                                <a href="#" class="swiper_read_more external">+91 - xxx xxx xxxx</a>
                                            </div>
                                        </div> 
                                    </div>
                                    <!--           <div class="swiper-slide" style="background-image:url(images/slide2.jpg);">
                                                 <div class="slider_trans">		  
                                                         <div class="slider-caption">
                                                         <h2 data-swiper-parallax="-100%">RELAXING MASSAGE</h2>
                                                         <span class="subtitle" data-swiper-parallax="-60%">FACE POLISH</span>
                                                         <p data-swiper-parallax="-30%">Massage for the body is a popular beauty treatment. Natural cosmetic treatments for men and women. </p>
                                                          <a href="tel:23234234" class="swiper_read_more external">APPOINTMENT</a>
                                                         </div>	
                                                 </div>	
                                               </div>
                                               <div class="swiper-slide" style="background-image:url(images/slide3.jpg);">
                                                 <div class="slider_trans">		  
                                                         <div class="slider-caption">
                                                         <h2 data-swiper-parallax="-100%">DAY OF BEAUTY</h2>
                                                         <span class="subtitle" data-swiper-parallax="-60%">HAIR SALON</span>
                                          
                                                         <a href="tel:23234234" class="swiper_read_more external">CONTACT</a>
                                                         </div>
                                                </div>
                                            </div> 		   
                                             </div>
                                             <div class="swiper-pagination"></div>-->
                                </div>

                                <div class="swiper-container-toolbar swiper-toolbar swiper-init" data-effect="slide" data-slides-per-view="5" data-slides-per-group="3" data-space-between="0" data-pagination=".swiper-pagination-toolbar">

                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide toolbar-icon"><a href="food-categories.php" data-view=".view-main"><img src="images/icons/white/food.png" alt="" title="" /></a></div>
                                        <div class="swiper-slide toolbar-icon"><a href="shop-categories.php" data-view=".view-main"><img src="images/icons/white/shop.png" alt="" title="" /></a></div>

                                        <div class="swiper-slide toolbar-icon"><a href="offers.php" data-view=".view-main"><img src="images/icons/white/gift.png" alt="" title="" /></a></div>

                                        <div class="swiper-slide toolbar-icon"><a href="cart.php" data-view=".view-main"><img src="images/icons/white/cart.png" alt="" title="" /></a></div>

                                        <div class="swiper-slide toolbar-icon"><a href="tel:xxxxx" class="external"><img src="images/icons/white/phone.png" alt="" title="" /></a></div>
              <!--			  <div class="swiper-slide toolbar-icon"><a href="about.html" data-view=".view-main"><img src="images/icons/white/love.png" alt="" title="" /></a></div>
                                        <div class="swiper-slide toolbar-icon"><a href="about.html" data-view=".view-main"><img src="images/icons/white/map.png" alt="" title="" /></a></div>
                                        <div class="swiper-slide toolbar-icon"><a href="about.html" data-view=".view-main"><img src="images/icons/white/blog.png" alt="" title="" /></a></div>
                                        <div class="swiper-slide toolbar-icon"><a href="about.html" data-view=".view-main"><img src="images/icons/white/settings.png" alt="" title="" /></a></div>
                                        <div class="swiper-slide toolbar-icon"><a href="contact.html" data-view=".view-main"><img src="images/icons/white/contact.png" alt="" title="" /></a></div>-->
                                    </div>
                                </div>	 


                            </div>
                        </div>
                    </div>



                </div>
           <?php include 'footer.php';?>