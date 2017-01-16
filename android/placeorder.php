<?php

ob_start();
include 'config.php';
extract($_POST);
$date = date('Y-m-d'); //print_r($_POST);exit;
$sessid = $_COOKIE['sessid'];
$details = mysql_fetch_array(mysql_query("select * from register where guid='$_COOKIE[sessid]'"));
if ($details['guid'] == '') {
    header('location:login.php');
}
$total_price = 0;
$total = mysql_num_rows(mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0"));
$total_price = mysql_fetch_array(mysql_query("select sum(ctotal) from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0"));
$total_price = $total_price[0];
//echo "update register set city = '$city',state = '$state' where guid='$_COOKIE[sessid]' ";exit;
$sql_update = mysql_query("update register set city = '$city',state = '$state' where guid='$_COOKIE[sessid]' ");
if ($total == 0) {
    header('location:welcome.php');
}

?><?php include 'header.php'; ?>
        <script type="text/javascript" src="assets/js/jquery-2.1.4.js"></script>

        <style>
             .button_full{
        background-color: #b40406;
    border-left: 0 solid #b40406;
    clear: both;
    float: left;
    font-size: 14px;
    font-weight: 700;
    margin: 0 0 20px;
    padding: 10px 0 10px 5%;
    width: 100%;
	border: 0 none !important;
    }
        </style>
    
        <div class="pages">
            <form name="form2" method="post" action="thankyou.php">
            <div data-page="checkout" class="page no-toolbar no-navbar">
<?php
if($_COOKIE["sessid"] == ""){
    $cart = 0;
}else{
   $cart = mysql_num_rows(mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0")); 
}


?>
                <div class="page-content">

                    <div class="navbarpages whitebg bottomborder">
                        <div class="navbar_left">
                            <div class="logo_image"><a href="index.php"><img src="images/logo-small.png" alt="" title=""/></a></div>
                        </div>			
                        <a href="#" data-panel="left" class="open-panel">
                            <div class="navbar_right"><img src="images/icons/black/menu.png" alt="" title="" /></div>
                        </a>
                     <?php if($_COOKIE["sessid"] == ""){ ?>
                    <a href="login.php" class="close-panel" data-view=".view-main">
                    <div class="navbar_right whitebg"><img src="images/icons/black/cart.png" alt="" title="" /><span class='badge' id ="cartview" ><?php echo $cart; ?></span></div>
                </a>
                <?php } else{ ?>
                <a href="checkout.php" class="close-panel" data-view=".view-main">
                    <div class="navbar_right whitebg"><img src="images/icons/black/cart.png" alt="" title="" /><span class='badge' id ="cartview" ><?php echo $cart; ?></span></div>
                </a>
                 <?php }  ?>				
                    </div>

                    <div id="pages_maincontent">


                        <h2 class="page_title">CHECKOUT</h2>



                        <div class="page_single layout_fullwidth_padding">



                            <h4 class="checkout_title">ORDER DETAILS</h4>
                            <?php  
                            $m = 0;
                                    $total = 0;
                                    $discount = 0;
									//$vat_total = 0;
                            $qry =mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0"); 
                             while ($row = mysql_fetch_assoc($qry)) {
                                 $chk = mysql_fetch_array(mysql_query("select * from products where guid='$row[pid]'"));
                                  $total = $total + $row['ctotal'];
								  $vat =  ((($chk['sprice']*$chk['vat'])/100)*$row['cquantity']);
								  $vat_total = $vat_total +$vat;
                                  $chk = mysql_fetch_array(mysql_query("select * from products where guid='$row[pid]'"));
                                  $discount = $discount + (($chk['sprice'] - $chk['mprice']) * $row['cquantity']);
                                        ?>
                            <div class="order_item">
                                
                                <div class="order_item_title"><span> 
                                        <?php
                                                if (empty($chk['guid'])) {
                                                    echo "0";
                                                } else {
                                                    echo $row['cquantity'];
                                                }
                                                ?> X </span> 
                                    <?php echo $chk['name']; ?> </div>
                                <div class="order_item_price">
                                    <i class="fa fa-inr"></i>
                                        <?php echo $row['ctotal']; ?></div>           
                            </div>
                            <?php
                                 
                             }
                            ?>

                             <input type="hidden" name="pincode" value="<?php echo $pincode;?>">
                
                <?php  $data_qry =mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0"); 
                while($row_data = mysql_fetch_array($data_qry)){
                    $pid_db = $row_data["pid"];
                    $deliver_dateattr = "deliver_date_".$pid_db;
                    $pre_order_statusattr = "pre_order_status_".$pid_db;
                    $spicy_levelattr  = "spicy_level_".$pid_db;
                    $deliver_date = $$deliver_dateattr;
                    $pre_order_status = $$pre_order_statusattr;
                    $spicy_level = $$spicy_levelattr;
                    ?>
                 <input type="hidden" name="<?php echo $deliver_dateattr; ?>" value="<?php echo $deliver_date;?>">
                  <input type="hidden" name="<?php echo $pre_order_statusattr; ?>" value="<?php echo $pre_order_status;?>">
                   <input type="hidden" name="<?php echo $spicy_levelattr; ?>" value="<?php echo $spicy_level;?>">
                           
 <?php }
                ?>
                            <h4 class="checkout_title">SELECT PAYMENT</h4>

                            <div class="contactform">
                                <div class="checkout_select">

                                    <label class="label-radio item-content">

                                      <input  type="radio" checked name="pmode" value="COD"  checked >
                                        <div class="item-inner">
                                            <div class="item-title">Cash on Delivery</div>
                                        </div>
                                    </label>
                                    <!--label class="label-radio item-content">

                                        <input type="radio" name="pmode" value="Card"  >
                                        <div class="item-inner">
                                            <div class="item-title">Swipe Card</div>
                                        </div>
                                    </label-->
                                    <label class="label-radio item-content">

                                        <input type="radio" name="pmode" value="PayTM QR" >
                                        <div class="item-inner">
                                            <div class="item-title">PayTM QR Scanner</div>
                                        </div>
                                    </label>
                                </div>
                            </div>



<?php $vat_total = round($vat_total);?>
                            <h4 class="checkout_title">TOTAL</h4>      
                            <div class="carttotal_full">
                                <div class="carttotal_row_full">
                                    <div class="carttotal_left">CART TOTAL</div>  <div class="carttotal_right"><i calss="fa fa-int"></i> <?php echo $total_price;?></div>
                                </div>
								<div class="carttotal_row_full">
                                    <div class="carttotal_left">VAT</div>  <div class="carttotal_right"><i calss="fa fa-int"></i> <?php echo $vat_total;?></div>
                                </div>
                               <input type="hidden" name="payable_new" id="payable_new" value="<?php echo $total_price;?>">
                                <div class="carttotal_row_full">
                                    <div class="carttotal_left">CHARGES</div>  <div class="carttotal_right" id = "cart_total_charges"><i calss="fa fa-int"></i> <?php if($total_price+$vat_total < 250){$total_price = $total_price +20;$charges=20;?>20<?php }else{$charges=0;?>0<?php } ?> </div>
									<input type ="hidden" id = "charges" value = "<?php echo $charges; ?>" />
                                </div>
								<div class="carttotal_row_full">
                                    <div class="carttotal_left"><b>Have Promo Code : </b>
									<input style = "height: 30px;margin-left: 3%;"type = "text" class="form_input" maxlength = 8 name = "coupon_code" id = "coupon_code" />
									<img style = "margin-top: -31px;margin-left: 90%;" id = "apply_coupon" src="images/apply.jpg" onclick = "applyCoupon();"/>
									<img style = "margin-top: -31px;margin-left: 95%;display:none;" id = "clear_coupon" src="images/Cancel.png" onclick = "clearCoupon();"/>
									<span style = "color: red;font-weight: bold;margin-left: 10px;" id = "error_coupon"></span></div>  
                                </div>
								<div class="carttotal_row_full">
                                    <div class="carttotal_left">DISCOUNT</div>  <div class="carttotal_right"><i calss="fa fa-int"></i> <span id = "discount_coupon">0</span> </div>
                                </div>
								<?php  $total_price = $total_price +$vat_total; ?>
                                <div class="carttotal_row_last">
                                    <div class="carttotal_left">TOTAL</div> <div class="carttotal_right" id = "cart_total_price"><i calss="fa fa-int"></i> <?php echo $total_price;?></div>
                                </div>
                            </div> 
							<input type="hidden" name="payable_old" id="payable_old" value="<?php echo $total_price;?>">
							<input type="hidden" name="payable" id="payable" value="<?php echo $total_price;?>">
							<input type="hidden" name="discount" id="discount" value="0">
                            <button name="submit" type="submit" class="button_full btyellow"><i class="fa fa-shopping-cart"></i> Place Order</button>
                            


                        </div>
                    </div>


                </div>
            </div>
                </form>
        </div>


    
    <script>
        function SetActiveGlyphStep(stepNumber) {
            $steps = $('.glyphstep');
            if (stepNumber !== parseInt(stepNumber) || stepNumber < $steps.length || stepNumber > $steps.length) {
                stepNumber = 1;
            }
            $('.glyphstep').each(function (index) {
                if (index < stepNumber) {
                    $(this).removeClass('glyphactive');
                    $(this).removeClass('glyphcomplete');
                    $(this).addClass('glyphcomplete');
                } else if (index == stepNumber) {
                    $(this).removeClass('glyphactive');
                    $(this).removeClass('glyphcomplete');
                    $(this).addClass('glyphactive');
                } else {
                    $(this).removeClass('glyphactive');
                    $(this).removeClass('glyphcomplete');
                }
            });
        }
        $(document).ready(function () {
            SetActiveGlyphStep(3);
        });
		function clearCoupon(){
			//cart_total_charges
			$("#coupon_code").removeAttr('readonly');
			$("#coupon_code").val('');
			$("#discount").val('0');
			$("#error_coupon").show();
			var payable = $("#payable").val();
			//$("#payable").val(payable);
			var charges = $("#charges").val();
			$("#cart_total_price").html(payable);
			$("#cart_total_charges").html(charges);
			$("#discount_coupon").html(0);
			$("#apply_coupon").show();
			$("#clear_coupon").hide();
		}
		function applyCoupon(){
			//cart_total_charges
			$("#coupon_code").attr('readonly','readonly');
			var coupon_code = $("#coupon_code").val();
			var charges = $("#charges").val();
			if(coupon_code != ""){
				var data = "coupon_code="+coupon_code;
				$.ajax({
                        type: "post",
                        url: "couponcheck.php",
                        data: data,
                        success: function (response) {
							//console.log(response);debugger;
							respo = JSON.parse(response);
							
							if(respo.code == 1){
								var discount = parseFloat(respo.message);
								var charges_resp = parseFloat(respo.charges);
								var payable = $("#payable_new").val();
								$("#discount_coupon").html(discount);
								$("#cart_total_charges").html(charges_resp);
								var newpayable = parseFloat(payable)-discount+charges_resp;
								//$("#payable").val(newpayable);
								$("#cart_total_price").html(newpayable);
								$("#coupon_code").attr('readonly','readonly');
								$("#apply_coupon").hide();
								$("#clear_coupon").show();
								$("#discount").val(discount);
								$("#error_coupon").html('');
							}
							else{
								$("#coupon_code").removeAttr('readonly');
								$("#coupon_code").val('');
								$("#discount").val('');
								$("#error_coupon").show();
								$("#error_coupon").html(respo.message).fadeOut(10000);
								$("#apply_coupon").show();
								$("#clear_coupon").hide();
								
							}
							//console.log(response);debugger;
						}
                    });
			}
			else{
				$("#error_coupon").show();
				$("#error_coupon").html('Enter coupon/Promo code').fadeOut(10000);
			}
		}
    </script>

<?php include 'footer.php'; ?>
