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

$name = $request_string["name"];
$email = $request_string["email"];
$address = $request_string["address"];
$city = $request_string["city"];
$pincode = $request_string["pincode"];
$area = $request_string["area"];
$referral_code = $request_string["referral_code"];
 if($user_id == ""){
echo json_encode(array("status"=>"error","message"=>"Please update your app and continue"));exit;
}else{
mysql_query("update register set name = '".$name."',email = '".$email."',
address = '".$address."',
city = '".$city."',state = '".$area."',pincode = '".$pincode."' where guid = '".$user_id."' ");

$details = mysql_fetch_array(mysql_query("select * from register where guid='".$user_id."'"));
	//echo "select sum(ctotal) from cart where session_id='".$user_id."' and order_id='' and sid>0";
	$tot=mysql_fetch_array(mysql_query("select sum(ctotal) from cart where session_id='".$user_id."' and order_id='' and sid>0"));
if($tot[0]>0)
{
	$chk_product=mysql_fetch_array(mysql_query("select * from cart where session_id='".$user_id."' and order_id='' and sid>0"));
	if($payable>0){
	$tot_price=$payable;}else{$tot_price=$tot[0];}
        $login = mysql_query("select * from `storevendor` where status='Active' and FIND_IN_SET('".$area_code."',area) order by guid asc limit 1");
    $no_rows = mysql_num_rows($login);
    $vendor = mysql_fetch_array($login);
	if($tot_price < 250){
		$tot_price = $tot_price+20;
	}
	mysql_query("INSERT INTO `orders` (`userid` ,`total` ,`date`,`status`,`time`,`getdate`,`gettime`,`pmode`,`area`,vendor_id,referral_code) VALUES ('".$user_id."', '".$tot_price."', '".$date."','Not Delivered','".$time."','".$deliverytime."','Store','".$pmode."','".$area_code."','".$vendor['guid']."','".$referral_code."')");
	$ins=mysql_insert_id();
	$message="Dear $details[name] thanks for shopping at Free food. Your order no. FF$ins for Rs.$tot_price will be delivered shortly For queries, reach us at support@freefood.co.in"; 
	$message1 = $url;
 $sms = str_replace(" ", "%20", $message);
			$message1 = str_replace("<SMS>", $sms, $message1);
			$message1 = str_replace("<MOBILE>", $details['mobile'], $message1);
get_data($message1);

$message1 = "Dear Vendor,your order no. FF$ins is waiting for your confirmation";
   $message2 = $url;
  $sms1 = str_replace(" ", "%20", $message1);
    $message2 = str_replace("<SMS>", $sms1, $message2);
	$message2 = str_replace("<MOBILE>", $vendor['mobile'], $message2);
	get_data($message2);
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
			mysql_query("update cart set order_id='".$ins."',area='".$area_code."' where session_id='".$user_id."' and order_id='' and sid>0");
$data_qry = mysql_query("select * from cart where session_id='".$user_id."' and order_id='".$ins."' ");$prnames = "";
 while ($row_data = mysql_fetch_array($data_qry)) {
	  $pid_db = $row_data["sid"];
	  $pnamearr = mysql_fetch_array(mysql_query("select * from storeproducts where guid = '".$pid_db."'"));
		$prnames.=$pnamearr['name']."(".$row_data[cquantity].")".",";
 }$prnames = rtrim($prnames,',');
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
$message .= "<tr><td><strong>Amount:</strong> </td><td>" . $tot_price . "</td></tr>";
$message .= "<tr><td><strong>Items :</strong> </td><td>" . $prnames . "</td></tr>";
$message .= "<tr><td><strong>Delivery Address  :</strong> </td><td>" .$details[address] .$details[state].$details[city]. "</td></tr>";
	$message .= "</table>";
	$message .= "<p align = 'center'>© 2016-FreeFood. All rights reserved.</p><br>";
	$message .= "<p align = 'center'>reach us at support@freefood.co.in.</p>";
$message .= "</body></html>";
 $details['email'];
 $message;
 mail($to, $subject, $message, $headers);
}
echo json_encode(array("status"=>"success","order_id"=>"FF".$ins,"amount_pay"=>$tot_price));
}
else{
	echo json_encode(array("status"=>"error","message"=>"Please Review order"));
}
}
		
?>