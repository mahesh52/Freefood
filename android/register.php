<?php
ob_start();
include 'config.php';
extract($_POST);
$date = date('Y-m-d');
$sessid = $_COOKIE['sessid'];
$msg = "";
if (isset($_POST) && $_POST['mobile'] != '' && $_POST['email'] != '' && $_POST['password'] != '') {

    $chk = mysql_fetch_array(mysql_query("select * from register where mobile='$mobile'"));
    $chk1 = mysql_fetch_array(mysql_query("select * from register where email='$email'"));
    if (empty($chk['guid']) && empty($chk1['guid'])) {
        mysql_query("INSERT INTO `register` (`name` ,`mobile` ,`email` ,`address` ,`city` ,`state` ,`date`,`password`,`pincode`,status,referred_by) VALUES ('$name', '$mobile', '$email', '$address', '$city', '$state', '$date','$password','$pincode',1,'$referred_by')");
        $ins = mysql_insert_id();
        setcookie("sessid", $ins, mktime(0, 0, 0, 12, 31, 2020));
        mysql_query("update cart set session_id='$_COOKIE[sessid]' where session_id='$sessid'");
        header('location:index.php');
    } else {
        $msg = "Mobile / Email Id Already Registered";
    }
}
?>

<?php include 'header_bg.php'; ?>
<?php
if($_COOKIE["sessid"] == ""){
    $cart = 0;
}else{
   $cart = mysql_num_rows(mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0")); 
}
?>
<script type="text/javascript" src="assets/js/jquery-2.1.4.js"></script>
<style>
    .slider-caption{
        bottom:10% !important;
		
    }
	.slider_trans{
		height:80% !important;
	}
	.swiper-slide.toolbar-icon{
	width:25% !important;
}

.contactform input.form_input{
	border: 1px solid #ddd;
    margin: 0 0 5px;
    padding: 2%;
    width: 90%;
}
.swiper-container{
	overflow:scroll !important;
	
}
.slider_trans{
	position : unset !important;
}
#otp_info{
	color:red;
}
otp_infoerror{
	color:red;
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
                                                <span class="subtitle" data-swiper-parallax="-60%">Sign Up</span>
                                                <div class="alert alert-info">
                                                    <?php echo $msg; ?>
                                                </div>
                                                <div class="contactform" >
                                                    <form name="myForm" method="post" action="register.php">
                                                        <input type="text" placeholder="Full Name" name="name"  class="form_input required"  required >
                                                        <input type="email"  placeholder="Email" name="email"  class="form_input required"   required >
                                                        <div id ="mob_div" >
                                                            <input type="text"  maxlength="11"  class="form_input required"  placeholder="Mobile" onkeypress="return isNumber(event)" name="mobile" id ="mobile" required >
                                                        </div>
                                                        <div id ="otp_div"  style ="display:none;">
                                                            <input  type="password" class="form_input required" placeholder="One time code" name="otp" id="otp" required >
                                                            <br>
                                                        </div>
                                                        <div  id = "otp_info"> 

                                                        </div>
                                                        <div id = "otp_infoerror"> 

                                                        </div>
                                                        <input type="password"  placeholder="Password" placeholder="Password" name="password" required class="form_input required" >
                                                        <!--input type="text" placeholder="Address" name="address" required class="form_input required"  >
                                                        <input type="text" placeholder="Pincode" name="pincode"  class="form_input required"  required -->
                                                        <input type="text" placeholder="City" name="city"  class="form_input required"  required >
                                                        <input type="text" placeholder="Area" name="state" required  class="form_input required" >
														 <input type="text" placeholder="Referred By" name="referred_by"  class="form_input" >
                                                        <input type="button" name="btnSubmit" onclick="return validate()"  value="Sign Up" class="form_submit"  >
<input type="hidden" id="mob_status" name="mob_status" value ="">

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

                                         <div class="swiper-slide toolbar-icon"><a href="contact.php" class="external"><img src="images/icons/white/phone.png" alt="" title="" /></a></div>
                                    </div>
                                </div>	 


                            </div>
                        </div>
                    </div>



                </div>
            </div>


        
           

         

        
           
 <script>

            $(function () {

                $("#mobile").change(function () {
                    $("#mob_status").val("0");
                    var mobile = $("#mobile").val();

                    if (mobile != "" && mobile.length >= 10) {

                        $(".loader").show();
                        $.ajax({
                            type: 'POST',
                            url: 'validateMobile.php',
                            data: "mobile=" + mobile + "&type=registration&req=generate",
                            success: function (data) {
                                $(".loader").hide();
                                if (data == 1) {
                                    $("#otp_infoerror").html('');
                                    $("#otp_info").slideUp('fast');
                                    $("#otp_info").html("Otp Send to your mobile number");
                                    $("#otp_info").hide().slideDown();
                                    setTimeout(function () {
                                        $("#otp_info").slideUp();
                                    }, 5000);
                                    $("#mob_div").removeClass("col-xs-12").addClass("col-xs-6");
                                    $("#otp_div").show();
                                } else {
                                    $("#otp_infoerror").slideUp('fast');
                                    $("#otp_infoerror").html("Already this mobile number is registered");
                                    $("#otp_infoerror").hide().slideDown();
                                    setTimeout(function () {
                                        $("#otp_infoerror").slideUp();
                                    }, 20000);
                                }
                            }
                        });
                    }


                });

            });
            function validate() {

                var mobile = $("#mobile").val();
                var otp = $("#otp").val();
                var mob_status = $("#mob_status").val();
                if (mobile != "" && mobile.length >= 10 && otp != "" && mob_status != "1") {
                    $(".loader").show();

                    $.ajax({
                        type: 'POST',
                        url: 'validateMobile.php',
                        data: "mobile=" + mobile + "&type=registration&req=validate&otp=" + otp,
                        async: false,
                        success: function (data) {

                            $(".loader").hide();
                            if (data == 1) {

                                document.myForm.submit();
                            } else if (data == 0) {

                                $("#mob_status").val("0");

                                $("#otp_infoerror").slideUp('fast');
                                $("#otp_infoerror").html("Invalid OTP");
                                $("#otp_infoerror").hide().slideDown();
                                setTimeout(function () {
                                    $("#otp_infoerror").slideUp();
                                }, 10000);

                                return false;
                            } else if (data == 2) {
                                $("#mob_status").val("0");

                                $("#otp_infoerror").slideUp('fast');
                                $("#otp_infoerror").html("Mobile number already registered");
                                $("#otp_infoerror").hide().slideDown();
                                setTimeout(function () {
                                    $("#otp_infoerror").slideUp();
                                }, 10000);

                                return false;
                            }
                        }
                    });
                }

            }

            function isNumber(evt) {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                    return false;
                }
                return true;
            }

        </script>
         
            <script type="text/javascript" src="js/jquery-1.10.1.min.js"></script>
              
    <?php include 'footer_bg.php'; ?>