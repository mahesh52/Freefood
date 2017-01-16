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
$coupon_code = $request_string["coupon_code"];
//$deliverydate = $request_string["deliverydate"];
$spicy_level = $request_string["spicy_level"];
$deliverydate = date('Y-m-d H:i:s');
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
if(date(H) >=11 && date(H) < 21){
mysql_query("update register set name = '".$name."',email = '".$email."',
address = '".$address."',
city = '".$city."',state = '".$area."',pincode = '".$pincode."' where guid = '".$user_id."' ");

$details = mysql_fetch_array(mysql_query("select * from register where guid='".$user_id."'"));

$qry2 = mysql_query("SELECT * FROM `cart` where order_id='' and 
				session_id='".$user_id."' and order_id='' and pid>0");
$sql_erfv = mysql_fetch_array(mysql_query("select * from vendor where FIND_IN_SET('".$area_code."',area)"));
$food_vendor_id = $sql_erfv["guid"];
$vendor_type = $sql_erfv["vendor_type"];
while ($row2 = mysql_fetch_assoc($qry2)) {
    $fqty = 0;
    $chkqty[0] = 0;
    $cartqty[0] = 0;
    
    if($vendor_type == "ERFV"){
		$chkqty = mysql_fetch_array(mysql_query("select available_qty from erfvstock where product_id='".$row2['pid']."' and erfv_vendor='".$food_vendor_id."'"));
	}
	else{
		$chkqty = mysql_fetch_array(mysql_query("select sum(quantity) from vendor_quantity where product_id='".$row2['pid']."' and date='".$date."'"));
	}
	$cartqty = mysql_fetch_array(mysql_query("select sum(cquantity) from cart where pid='".$row2['pid']."' and date='".$date."' and order_id!=''"));
    $fqty = $chkqty[0] - $cartqty[0];
    if ($row2['cquantity'] > $fqty) {
        mysql_query("update cart set cquantity='0',price='0',ctotal='0' where guid='".$row2['guid']."'");
       echo json_encode(array("status"=>"error","message"=>"Please Review order"));exit;
    }
}

$chk = mysql_fetch_array(mysql_query("select * from register where guid='".$user_id."' "));
$tot = mysql_fetch_array(mysql_query("select sum(ctotal) from cart where session_id='".$user_id."' and order_id='' and pid>0"));
if ($tot[0] > 0) {
	 $tot_price = $tot[0];
	$sql_clp = mysql_fetch_array(mysql_query("select * from area where guid='".$area_code."'"));
    $login = mysql_query("select * from `cluster` where status='Active' and guid = '".$sql_clp['clp']."' order by guid asc limit 1");
    $no_rows = mysql_num_rows($login);
    $vendor = mysql_fetch_array($login);
	//echo "select * from `cluster` where status='Active' and guid = '".$sql_clp['clp']."' order by guid asc limit 1";
	
	 mysql_query("INSERT INTO `orders` 
	 (`userid` ,`total` ,`date`,`status`,`time`,`gettime`,`pmode`,
	 `area`,`pincode`,vendor_id,discount,referral_code) VALUES 
	 ('".$user_id."', '".$payable."', '".$date."',
	 'Not Delivered','".$tot_price."','Food',
	 '".$pmode."','".$area_code."','".$pincode."',
	 '".$vendor['guid']."','".$discount."','".$referral_code."')");
	 
    $ins = mysql_insert_id();
	if($discount > 0 && $coupon_code != "" && $ins != ""){
		  $sql = "select * from freefood_coupons where coupon_code = '".$coupon_code."' ";
	 $result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	if($row["valid_upto"] != "" && $row["assigned_to"] != "" && $row["products"] == "0"){
		$sql101 = mysql_fetch_array(mysql_query("select * from freefood_coupons where coupon_code = '".$coupon_code."' and assigned_to = '".$user_id."' and coupon_value > 0 order by guid asc limit 1 "));
		$sql_fd_coupons = mysql_query("update freefood_coupons set coupon_value = coupon_value-$discount where guid = '".$sql101['guid']."' ");
	}
		 $products = $row["products"];
		 $chknew=mysql_query("select * from cart where pid in ($products) and session_id='".$user_id."' and order_id='' order by price desc limit 1 ");
		$chk_rowsnew = mysql_fetch_array($chknew);
		$product_coupon = $chk_rowsnew["pid"];
		//echo "select * from cart where pid in ('$products') and session_id='$_COOKIE[sessid]' and order_id='$ins' ";
		
		mysql_query("INSERT INTO `freefood_coupons_used` (`order_id` ,`user_id` ,
		`coupon_code`,`product_id`) 
		VALUES ('".$ins."','".$user_id."', 
		'".$coupon_code."','".$product_coupon."')");
		}
		 mysql_query("update cart set order_id='".$ins."',area='".$area_code."',delivery_time = '".$deliverydate."',vendor_id='".$food_vendor_id."' where session_id='".$user_id."' and order_id='' and pid>0");
     $data_qry = mysql_query("select * from cart where session_id='".$user_id."' and order_id='".$ins."' ");
	$sql_erfv = mysql_fetch_array(mysql_query("select * from vendor where FIND_IN_SET('".$area_code."',area)"));
	$food_vendor_id = $sql_erfv["guid"];
	$vendor_type = $sql_erfv["vendor_type"];
	$prnames = "";
	$vat_total = 0;
	while ($row_data = mysql_fetch_array($data_qry)) {
		$chk = mysql_fetch_array(mysql_query("select * from products where guid='$row_data[pid]'"));
		 $vat =  round(((($chk['sprice']*$chk['vat'])/100)*$row_data['cquantity']));
$vat_total =   $vat_total+$vat;     
	   $rowguid = $row_data["guid"];
        $pid_db = $row_data["pid"];
		 mysql_query("update cart set vat = '".$vat."',delivery_time = '".$deliverydate."',spicy_level = '".$spicy_level."' where guid = '".$rowguid."' ");
		 if($vendor_type == "ERFV"){
			 $cquantityerfv = $row_data['cquantity'];
			mysql_query("update erfvstock set available_qty = available_qty-$cquantityerfv where product_id='".$pid_db."' and erfv_vendor='".$food_vendor_id."' ");
		}
		$pnamearr = mysql_fetch_array(mysql_query("select * from products where guid = '$pid_db'"));
		$prnames.=$pnamearr['name']."(".$row_data['cquantity'].")".",";
	}
	$prnames = rtrim($prnames,',');
	$chk=mysql_query("select * from cart where pid in ($products) and session_id='".$user_id."' and order_id='".$ins."' and pid >0 order by price desc limit 1 ");
		 $chk_prodss=mysql_num_rows(mysql_query("select * from cart where  session_id='".$user_id."' and order_id='".$ins."' and pid>0 "));
		 $chk_rows = mysql_num_rows($chk);
		 if($chk_prodss == 1 && $chk_rows ==1){
			 $newPayable = $payable-$discount-20+$vat_total;
		 }else{
			 $newPayable = $payable-$discount;
			 if($newPayable<=250){
				 $newPayable = $newPayable;
			 }
		 }
		 
		   $message = "Dear $details[name] thanks for shopping at Free food. Your order no. FF$ins for Rs.$newPayable will be delivered shortly For queries, reach us at support@freefood.co.in";
//echo $url;
//echo "<br>";
//echo $details['mobile'];
 $message1 = $url;
             $sms = str_replace(" ", "%20", $message);
			$message1 = str_replace("<SMS>", $sms, $message1);
			$message1 = str_replace("<MOBILE>", $details['mobile'], $message1);
			//echo $details['mobile'];
			//echo $url;exit;
			
			get_data($message1);
			$message1 = "Dear Vendor,your order no. FF$ins is waiting for your confirmation";
    $message2 = $url;
	$sms1 = str_replace(" ", "%20", $message1);
    $message2 = str_replace("<SMS>", $sms1, $message2);
			$message2 = str_replace("<MOBILE>", $vendor['mobile'], $message2);
			
			get_data($message2);
			
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
$message .= "<tr><td><strong>Amount:</strong> </td><td>" . $newPayable . "</td></tr>";
$message .= "<tr><td><strong>Items :</strong> </td><td>" . $prnames . "</td></tr>";
$message .= "<tr><td><strong>Delivery Address  :</strong> </td><td>" .$details[address]."," .$details[state].",".$details[city]. "</td></tr>";
	$message .= "</table>";
	$message .= "<p align = 'center'>© 2016-FreeFood. All rights reserved.</p><br>";
	$message .= "<p align = 'center'>reach us at support@freefood.co.in.</p>";
$message .= "</body></html>";
 $details['email'];
 $message;
 mail($to, $subject, $message, $headers);
	}
	echo json_encode(array("status"=>"success","order_id"=>"FF".$ins,"amount_pay"=>$newPayable));
}
else{
	echo json_encode(array("status"=>"error","message"=>"Please Review order"));
}
}
else{
	echo json_encode(array("status"=>"error","message"=>"Kitchen closed at this time"));
}
}
?>