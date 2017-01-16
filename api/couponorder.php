<?php 
header('Access-Control-Allow-Origin: *');
include 'config.php';
include 'functions.php';
$date=date('Y-m-d');
$request = json_decode(file_get_contents('php://input'), true);
$returnarr = array();
$request_string = $request["metaData"];
$user_id = $request_string["user_id"];
$area_code = $request_string["area_code"];
$payable = $request_string["payable"];
$pmode = $request_string["pmode"];
$discount = $request_string["discount"];
$deliverytime = $request_string["deliverytime"];
$points = $request_string["available_points"];
$dis_points = $request_string["discount_applied"];
$referral_code = $request_string["referral_code"];
if(strtoupper($dis_points) == "YES" ){
$payable = $payable-$discount;
}

$details = mysql_fetch_array(mysql_query("select * from register where guid='".$user_id."'"));
	//echo "select sum(ctotal) from cart where session_id='".$user_id."' and order_id='' and sid>0";
	$tot=mysql_fetch_array(mysql_query("select sum(ctotal) as total from cart where session_id='".$user_id."' and order_id='' and cid>0"));
	//$total_checkout=mysql_fetch_array(mysql_query("select sum(ctotal) as total from cart where session_id='".$user_id."' and order_id='' and cid>0"));
if($tot[0]>0)
{
	if($payable>0 )
{
	$chk_product=mysql_fetch_array(mysql_query("select * from cart where session_id='".$user_id."' and order_id='' and sid>0"));
	if($payable>0){
	$tot_price=$payable;}else{$tot_price=$tot[0];}
        $login = mysql_query("select * from `storevendor` where status='Active' and FIND_IN_SET('".$area_code."',area) order by guid asc limit 1");
    $no_rows = mysql_num_rows($login);
    $vendor = mysql_fetch_array($login);
	
	mysql_query("INSERT INTO `orders` (`userid` ,`total` ,`date`,`status`,`gettime`,
	`pmode`,`area`,vendor_id,ostatus,referral_code) "
                                . "VALUES ('".$user_id."', '".$tot_price."', 
								'".$date."','Not Delivered','Coupons','Online','".$area_code."','0','Pending','".$referral_code."')");
								$ins=mysql_insert_id();
								
	 echo json_encode(array("status"=>"success",
	 "tid"=>$ins,"merchant_id"=>108431,"order_id"=>$ins,"amount"=>$tot_price,
	 "points"=>$payable,"currency"=>"INR","language"=>"EN",
	 "redirect_url"=>"http://freefood.co.in/android/ccavResponseHandler.php",
	 "cancel_url"=>"http://freefood.co.in/api/couponcancel.php",
	  "form_action"=>"http://freefood.co.in/android/ccavRequestHandler.php",
	 "billing_name"=>$details["name"],"billing_address"=>"Freefood",
	 "billing_city"=>$details["city"],"billing_state"=>"AP","billing_email"=>$details["email"],
	 "billing_zip"=>500045,"billing_country"=>"India"
	 ,"billing_tel"=>$details["mobile"],"merchant_param1"=>$payable,
	 "merchant_param2"=>$user_id,"merchant_param3"=>$area_code,
	 "dis_points"=>$points,"merchant_param5"=>$points,
	 "payable"=>$payable,"merchant_param4"=>$payable));

}
else{
	
	$chk_product=mysql_fetch_array(mysql_query("select * from cart where session_id='".$user_id."' and order_id='' and cid>0"));
	if($payable>0){
	$tot_price=$payable;}else{$tot_price=$tot[0];}
        $login = mysql_query("select * from `couponsvendor` where status='Active' and FIND_IN_SET('".$area_code."',area) order by guid asc limit 1");
    $no_rows = mysql_num_rows($login);
    $vendor = mysql_fetch_array($login);
	mysql_query("INSERT INTO `orders` (`userid` ,`total` ,`date`,`status`,`time`,`getdate`,`gettime`,`pmode`,`area`,vendor_id,referral_code) VALUES ('".$user_id."', '".$tot_price."', '".$date."','Not Delivered','".$time."','".$deliverytime."','Coupons','Points','".$area_code."','".$vendor['guid']."','".$referral_code."')");
	$ins=mysql_insert_id();
	mysql_query("update orders set pmode = 'Points',status = 'Delivered',ostatus ='Success' where guid = '".$ins."' ");
	
	if($points>0){
			if($dis_points=='yes')
			{
			$chk1=mysql_fetch_array(mysql_query("select * from wallet where userid='".$chk['userid']."' and refid='".$ins."'"));
			if(empty($chk1['guid']))
		{
	mysql_query("INSERT INTO  `wallet` (`userid` ,`points` ,`refid` ,`date`,`status`) VALUES ('".$chk['guid']."', '".$points."',  '".$ins."',  '".$date."',  'Debit')");
		}
			}
			
			}
			mysql_query("update cart set order_id='".$ins."',area='".$area_code."' where session_id='".$user_id."' and order_id='' and cid>0");
$data = mysql_query("select b.name as couponcode,b.coupon_value,a.cid as cid,b.coupon_vendor as coupon_vendor,a.cquantity  from cart a,coupons b where a.order_id ='".$ins."' and a.cid = b.guid  ");
        while ($row = mysql_fetch_array($data)) {
            $chk1112 = mysql_fetch_array(mysql_query("select * from couponsvendor where guid='".$row['coupon_vendor']."' "));
             mysql_query("INSERT INTO  `coupon_orders` (`coupon_code` ,`mobile_number` ,`user_id` ,`status`,`created_on`,coupon_id,coupon_value) "
                     . "VALUES ('".$row['couponcode']."', '".$details['mobile']."', 
					 '".$details['guid']."',  '1',  '".$date."','".$row['cid']."',
					 '".$row['coupon_value']."')");
            
            $message = "Dear $details[name] thanks for shopping at Free food. Here is coupon $row[couponcode] of worth $row[coupon_value] redeem at $chk1112[name], reach us at support@freefood.co.in";
            $sms = str_replace(" ", "%20", $message);
			$url = str_replace("<SMS>", $sms, $url);
			$url = str_replace("<MOBILE>", $details['mobile'], $url);
get_data($url);
             mysql_query("update coupons set quantity=quantity-$row[cquantity] where guid='$row[cid]'");
			 
			 if($details['email'] != ""){
		$to = $details['email'];
	$_POST['req-email'] = "noreply@freefood.co.in";

$subject = 'Free Food Order Details';

$headers = "From: " . strip_tags($_POST['req-email']) . "\r\n";
$headers .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$message = '<html><body>';
$message .= '<img src="http://freefood.co.in/android/images/logo.png" alt="Free Food" align = "center"/><br>';
$message .= "<p>Hi $details[name],<br>

Thanks for using Freefood! Your order has been placed and will be delivered shortly.
Looking forward to serve you.</p> <br>";
$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
$message .= "<tr style='background: #eee;'><td><strong>Order ID:</strong> </td><td>" . $ins . "</td></tr>";
$message .= "<tr><td><strong>Amount:</strong> </td><td>" . $row[coupon_value]."(".$chk1112[name].")"."</td></tr>";
$message .= "<tr><td><strong>Coupon Code :</strong> </td><td>$row[couponcode]</td></tr>";

	$message .= "</table>";
	$message .= "<p align = 'center'>© 2016-FreeFood. All rights reserved.</p><br>";
	$message .= "<p align = 'center'>reach us at support@freefood.co.in.</p>";
$message .= "</body></html>";
 $details['email'];
 $message;
 mail($to, $subject, $message, $headers);
}
        }
		echo json_encode(array("status"=>"success","order_id"=>"FF".$ins,"amount_pay"=>$tot_price));
}}
else{
	echo json_encode(array("status"=>"error","message"=>"Please Review order"));
}		
?>