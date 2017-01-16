 </div>


            <!-- Login Popup -->
            <div class="popup popup-login">
                <div class="content-block">
                    <h4>LOGIN</h4>
                    <div id="error">
                        <!-- error will be shown here ! -->
                    </div>
                    <div class="loginform">
                        <form id="LoginForm1" method="post">
                            <input type="text" id="Username" name="Username" value="" class="form_input required" placeholder="username" />
                            <input type="password" name="Password" id="Password"  value="" class="form_input required" placeholder="password" />
                            <div class="forgot_pass"><a href="#" data-popup=".popup-forgot" class="open-popup">Forgot Password?</a></div>
                            <input type="submit" name="submit" class="form_submit" id="submitLogin" value="SIGNIN" />
                        </form>
                        <div class="signup_bottom">
                            <p>Don't have an account?</p>
                            <a href="#" data-popup=".popup-signup" class="open-popup">SIGN UP</a>
                        </div>
                    </div>
                    <div class="close_popup_button">
                        <a href="#" class="close-popup"><img src="images/icons/black/menu_close.png" alt="" title="" /></a>
                    </div>
                </div>
            </div>

            <!-- Register Popup -->
            <div class="popup popup-signup">
                <div class="content-block">
                    <h4>REGISTER</h4>
                    <div id="errorreg">
                        <!-- error will be shown here ! -->
                    </div>
                    <div class="loginform">
                        <form id="register-form" method="post">
                            <input type="text" class="form_input required" placeholder="Full Name" name="name" id="name" >
                            <input type="email" class="form_input required" placeholder="Email" name="email" id="email"  >
                            <input type="number" class="form_input required" placeholder="Mobile" name="mobile" id="mobile" >
                            <input type="password" class="form_input required" placeholder="Password" name="password" id="password" >
                            <input type="text" class="form_input required" placeholder="Address" name="address" id="address">
                            <input type="text" class="form_input required" placeholder="Pincode" name="pincode" id="pincode" >
                            <input type="text" class="form_input required" placeholder="City" name="city" id="city">
                            <input type="text" class="form_input required" placeholder="Area" name="state" id="state">
                            <input type="submit" name="submit" class="form_submit" id="submitReg" value="SIGN UP" />
                        </form>
                        <!--<h5>- OR REGISTER WITH A SOCIAL ACCOUNT -</h5>
                        <div class="signup_social">
                                <a href="http://www.facebook.com/" class="signup_facebook external">FACEBOOK</a>
                                <a href="http://www.twitter.com/" class="signup_twitter external">TWITTER</a>            
                        </div>	-->	
                    </div>
                    <div class="close_popup_button">
                        <a href="#" class="close-popup"><img src="images/icons/black/menu_close.png" alt="" title="" /></a>
                    </div>
                </div>
            </div>

            <!-- Forgot Password Popup -->
            <div class="popup popup-forgot">
                <div class="content-block">
                    <h4>FORGOT PASSWORD</h4>
                     <div id="errorforgot">
                        <!-- error will be shown here ! -->
                    </div>
                    <div class="loginform">
                        <form id="ForgotForm" method="post">
                            <input type="text" name="Email" id="Email" value="" class="form_input required" placeholder="email" />
                            <input type="submit" name="submit" class="form_submit" id="submitForGot" value="RESEND PASSWORD" />
                        </form>
                        <div class="signup_bottom">
                            <p>Check your email and follow the instructions to reset your password.</p>
                        </div>
                    </div>
                    <div class="close_popup_button">
                        <a href="#" class="close-popup"><img src="images/icons/black/menu_close.png" alt="" title="" /></a>
                    </div>
                </div>
            </div>

            <!-- Social Icons Popup -->
            <div class="popup popup-social">
                <div class="content-block">
                    <h4>Social Share</h4>
                    <p>Share icons solution that allows you share and increase your social popularity.</p>
                    <ul class="social_share">
                        <li><a href="http://twitter.com/" class="external"><img src="images/icons/black/twitter.png" alt="" title="" /><span>TWITTER</span></a></li>
                        <li><a href="http://www.facebook.com/" class="external"><img src="images/icons/black/facebook.png" alt="" title="" /><span>FACEBOOK</span></a></li>
                        <li><a href="http://plus.google.com" class="external"><img src="images/icons/black/gplus.png" alt="" title="" /><span>GOOGLE</span></a></li>
                        <li><a href="http://www.dribbble.com/" class="external"><img src="images/icons/black/dribbble.png" alt="" title="" /><span>DRIBBBLE</span></a></li>
                        <li><a href="http://www.linkedin.com/" class="external"><img src="images/icons/black/linkedin.png" alt="" title="" /><span>LINKEDIN</span></a></li>
                        <li><a href="http://www.pinterest.com/" class="external"><img src="images/icons/black/pinterest.png" alt="" title="" /><span>PINTEREST</span></a></li>
                    </ul>
                    <div class="close_popup_button"><a href="#" class="close-popup"><img src="images/icons/black/menu_close.png" alt="" title="" /></a></div>
                </div>
            </div>

            <script type="text/javascript" src="js/jquery-1.10.1.min.js"></script>
            <script type="text/javascript" src="js/jquery.validate.min.js" ></script>
            <script type="text/javascript" src="js/framework7.js"></script>
            <script type="text/javascript" src="js/jquery.swipebox.js"></script>
            <script type="text/javascript" src="js/jquery.fitvids.js"></script>
            <script type="text/javascript" src="js/email.js"></script>
            <script type="text/javascript" src="js/circlemenu.js"></script>
            <script type="text/javascript" src="js/audio.min.js"></script>
            <script type="text/javascript" src="js/my-app.js"></script>
            <script type="text/javascript" src="js/script.js"></script>
    </body>
</html>