<?php
ob_start();
include 'config.php';
extract($_POST);
$date = date('Y-m-d');
$details = mysql_fetch_array(mysql_query("select * from register where guid='$_COOKIE[sessid]'"));
if ($details['guid'] == '') {
    header('location:login.php');
}
$wat = 0;
$wat1 = 0;
$credit = mysql_fetch_array(mysql_query("select sum(points) from wallet where userid='$_COOKIE[sessid]' and status='Credit'"));
$debit = mysql_fetch_array(mysql_query("select sum(points) from wallet where userid='$_COOKIE[sessid]' and status='Debit'"));
$wat = $credit[0] - $debit[0];
$credit1 = mysql_fetch_array(mysql_query("select sum(points) from virtualwallet where userid='$_COOKIE[sessid]' and status='Credit'"));
$debit1 = mysql_fetch_array(mysql_query("select sum(points) from virtualwallet where userid='$_COOKIE[sessid]' and status='Debit'"));
$wat1 = $credit1[0] - $debit1[0];
?>
<?php $total = mysql_num_rows(mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and cid>0"));
$total_checkout = mysql_fetch_array(mysql_query("select sum(ctotal) from cart where session_id='$_COOKIE[sessid]' and order_id='' and cid>0"));
?> 
 <?php
                        
                        $total1 = 0;
						
                        $discount1 = 0;
						
                        $qry1 = mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and cid>0");
                        while ($row1 = mysql_fetch_assoc($qry1)) {
                            $chk1 = mysql_fetch_array(mysql_query("select * from coupons where guid='$row1[cid]'"));
                            $total1 = $total1 + $row1['ctotal'];
                            $chk1 = mysql_fetch_array(mysql_query("select * from coupons where guid='$row1[cid]'"));
                            $discount1 = $discount1 + (($chk1['sprice'] - $chk1['mprice']) * $row1['cquantity']);
							 
                            
                            
						}?>
							
 <?php
                                    $dis = 0;
                                    if ($points != '') {
                                        if ($points == 'yes') {

                                            if ($total_checkout[0] > $wat) {

                                                $minimuamamount = $total_checkout[0] - $discount1; //680
                                                if ($discount1 > $wat) {
                                                    $dis = $discount_new;
                                                } else {
                                                    $dis = $discount_new;
                                                }
                                            } else {

                                                $dis = $discount_new;
                                            }
                                        }
                                        if ($points == 'special') {
                                            if ($total_checkout[0] > $wat1) {
                                                $dis = $wat1;
                                            } else {
                                                $dis = $total_checkout[0];
                                            }
                                        }
                                    } else {
                                        $dis = 0;
                                    }
                                    //echo $dis;
                                    $pay = 0;
                                    $brn = 0;
                                    if ($dis > 0) {
                                        $pay = $total_checkout[0] - $dis;
                                    } else {
                                        $pay = $total_checkout[0];
                                    }
									if($total_checkout[0]>$wat){$paynew=$wat;}else{$paynew=$total_checkout[0];}
                                    ?>
									
<?php include 'header.php'; ?>
<style>
    .button_full{
        background-color: #b40406;
        border: 0 none !important;
        clear: both;
        float: left;
        font-size: 14px;
        font-weight: 700;
        margin: 0 0 20px;
        padding: 10px 0 10px 5%;
        width: 100%;
    }


</style>
<?php
if ($_COOKIE["sessid"] == "") {
    $cart = 0;
} else {
    $cart = mysql_num_rows(mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and cid>0"));
}
?>

<div class="pages">
    <div data-page="checkout" class="page no-toolbar no-navbar">
        <form name="form2" method="post" <?php if($pay > 0){ ?> action="ccavRequestHandler.php" <?php } else{?> action="couponthankyou.php" <?php } ?>>
            <div class="page-content">

                <div class="navbarpages whitebg bottomborder">
                    <div class="navbar_left">
                        <div class="logo_image"><a href="index.php"><img src="images/logo-small.png" alt="" title=""/></a></div>
                    </div>			
                    <a href="#" data-panel="left" class="open-panel">
                        <div class="navbar_right"><img src="images/icons/black/menu.png" alt="" title="" /></div>
                    </a>
                    <?php if ($_COOKIE["sessid"] == "") { ?>
                        <a href="login.php" class="close-panel" data-view=".view-main">
                            <div class="navbar_right whitebg"><img src="images/icons/black/cart.png" alt="" title="" /><span class='badge' id ="cartview" ><?php echo $cart; ?></span></div>
                        </a>
                    <?php } else { ?>
                        <a href="coupon-checkout.php" class="close-panel" data-view=".view-main">
                            <div class="navbar_right whitebg"><img src="images/icons/black/cart.png" alt="" title="" /><span class='badge' id ="cartview" ><?php echo $cart; ?></span></div>
                        </a>
<?php } ?>					
                </div>

                <div id="pages_maincontent">


                   <h2 class="page_title2"><a href="home-coupons.php"><i class="fa fa-angle-left" aria-hidden="true"></i><i class="fa fa-angle-left" aria-hidden="true"></i><i class="fa fa-angle-left" aria-hidden="true"></i><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                    <span class="page-title-head">&nbsp;&nbsp;CHECKOUT</span></h2>
                    <div class="page_single layout_fullwidth_padding">

                        <h4 class="checkout_title">ORDER DETAILS</h4>
                        <?php
                        $m = 0;
                        $total = 0;
                        $discount = 0;
						$discount_new =0;
                        $qry = mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and cid>0");
                        while ($row = mysql_fetch_assoc($qry)) {
                            $chk = mysql_fetch_array(mysql_query("select * from coupons where guid='$row[cid]'"));
                            $total = $total + $row['ctotal'];
                            $chk = mysql_fetch_array(mysql_query("select * from coupons where guid='$row[cid]'"));
                            $discount = $discount + (($chk['sprice'] - $chk['mprice']) * $row['cquantity']);
                            $couponvendor = mysql_fetch_array(mysql_query("select * from couponsvendor where guid='$chk[coupon_vendor]' "));
							$chk12 = mysql_fetch_array(mysql_query("select * from storecategory where guid='$chk[category]'"));
                                         $discount = $discount + (($chk['sprice'] - $chk['mprice']) * $row['cquantity']);
										// echo $chk12["points"];
										 if($total_checkout[0]>$wat){
											 if($wat-$discount_new > 0){
										 if(($wat * $chk12["points"])/100 > $wat-$discount_new){
											 $discount_new = $discount_new + ($wat-$discount_new);
										 }else{
											 $discount_new = $discount_new + ($wat * $chk12["points"])/100;
										 }
										 
									 }
										 }
										 else{
											
											  if($wat-$discount_new > 0){
												  // ($wat * $chk12["points"])/100;
											//echo ($chk['sprice'] * $chk12["points"])/100;
											 $discount_new = $discount_new + ($chk['sprice'] * $chk12["points"])/100;
										 
											  }
										 }
									 
										  $discount_new= floor($discount_new);
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
                                    <?php echo $couponvendor['name']; ?> Coupon of worth <?php echo $chk['coupon_value']; ?>/- </div>
                                <div class="order_item_price">
                                    <i class="fa fa-inr"></i>
                            <?php echo $row['ctotal']; ?></div>           
                            </div>
                            <?php
                        }
                        ?>









                        <h4 class="checkout_title">TOTAL</h4>      
                        <div class="carttotal_full">

                            <div class="carttotal_row_full">
                                <div class="carttotal_left">ORDER ITEMS</div>  <div class="carttotal_right"><i calss="fa fa-int"></i> <?php echo $total; ?></div>
                            </div>

                            <div class="carttotal_row_full">
                                <div class="carttotal_left">DISCOUNT</div>  <div class="carttotal_right"><i calss="fa fa-int"></i> 
                                    <?php
                                    
                                    $dis=0; 
						  if($points!=''){
							  if($points=='yes'){
                                                             
                                                              if($total_checkout[0]>$wat){
                                                                //  echo $discount;
                                                                  $minimuamamount = $total_checkout[0]-$discount;
																  //680
                                                                  if($discount > $wat){
                                                                      $dis=$discount_new;
                                                                  }
                                                                  else{
                                                                      $dis=$discount_new;
                                                                  }
                                                                  
                                                                  
                                                              }
                                                              else{
                                                                  $dis=$discount_new;
                                                                                                                                  
                                                              }
                                                              
                                                              }
							  if($points=='special'){
                                                              if($total_checkout[0]>$wat1){
                                                                  $dis=$wat1;
                                                                  
                                                              }else{
                                                                  $dis=$total_checkout[0];
                                                                  
                                                              }
                                                              
                                                              }
							  }else{
                                                              $dis=0;
                                                              
                                                          }
														  echo $dis;
														  $pay=0;$brn=0;
							  if($dis>0){$pay=$total_checkout[0]-$dis;}else{$pay=$total_checkout[0];}
							  if($total_checkout[0]>$wat){$paynew=$wat;}else{$paynew=$total_checkout[0];}
                                    
                                    ?>
                                </div>
                            </div>
                            <div class="carttotal_row_last">
                                <div class="carttotal_left">TOTAL</div> <div class="carttotal_right"><i calss="fa fa-int"></i> <?php echo $total_checkout[0]; ?></div>
                            </div>
                            <div class="carttotal_row_last">
                                <div class="carttotal_left">SUB TOTAL</div> <div class="carttotal_right"><i calss="fa fa-int"></i> <?php echo $pay; ?></div>
                            </div>
                        </div> 
                        <?php
                        $date = date('Y-m-d');
                        $cartqntynew = mysql_num_rows(mysql_query("select sum(cquantity) as items from cart where session_id='$_COOKIE[sessid]' and order_id='' and cid>0"));
                        mysql_query("INSERT INTO `orders` (`userid` ,`total` ,`date`,`status`,`gettime`,`pmode`,`area`,vendor_id,ostatus) "
                                . "VALUES ('$_COOKIE[sessid]', '$pay', '$date','Not Delivered','Coupons','Online','$_COOKIE[area]','0','Pending')");
                      //  echo "INSERT INTO `orders` (`userid` ,`total` ,`date`,`status`,`gettime`,`pmode`,`area`,vendor_id,ostatus) "
                       //         . "VALUES ('$_COOKIE[sessid]', '$pay', '$date','Not Delivered','Coupons','Online','$_COOKIE[area]','0','Pending')";
                        $ins = mysql_insert_id();
                        ?>
                        <input type="hidden" name="tid" id="tid" value = "<?php echo $ins; ?>" readonly />
                        <input type="hidden" name="merchant_id" value="108431"/>
                        <input type="hidden" name="order_id" value = "<?php echo $ins; ?>"/>
                        <input type="hidden" name="amount" value = "<?php echo $pay; ?>"/>
                        <input type="hidden" name="points" value="<?php echo $paynew; ?>">
                        <input type="hidden" name="currency" value="INR"/>
                        <input type="hidden" name="redirect_url" value="http://freefood.co.in/android/ccavResponseHandler.php"/>
                        <input type="hidden" name="cancel_url" value="http://freefood.co.in/android/welcome.php"/>
                        <input type="hidden" name="language" value="EN"/>
                        <input type="hidden" name="billing_name" value="<?php echo $details["name"]; ?>"/>
                        <input type="hidden" name="billing_address" value="Freefood" />
                        <input type="hidden" name="billing_city" value="<?php echo $details["city"]; ?>" />
                        <input type="hidden" name="billing_state" value="AP" />
                        <input type="hidden" name="billing_zip" value="500045" />
                        <input type="hidden" name="billing_country" value="India"/>
                        <input type="hidden" name="billing_tel" value="<?php echo $details["mobile"]; ?>"/>
                        <input type="hidden" name="billing_email" value="<?php echo $details["email"]; ?>"/>
                        <input type="hidden" name="merchant_param1" value="<?php echo $paynew; ?>"/>
						 <input type="hidden" name="merchant_param2" value="<?php echo $_COOKIE[sessid]; ?>"/>
                        <input type="hidden" name="merchant_param3" value="<?php echo $_COOKIE[area]; ?>"/>
                        
                        <input type="hidden" name="dis_points" value="<?php echo $points; ?>">
                        <input type="hidden" name="merchant_param5" value="<?php echo $points;?>">
                        <input type="hidden" name="payable" value="<?php echo $pay; ?>">
                        <input type="hidden" name="merchant_param4" value="<?php echo $pay;?>">

                        <button name="submit" type="submit" class="button_full btyellow"><i class="fa fa-shopping-cart"></i>Proceed Payment</button>

                    </div>
                </div>
            </div>

        </form>
    </div>
</div>

</div>
<?php include 'footer.php'; ?>