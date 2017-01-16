<?php header('Access-Control-Allow-Origin: *');
include('Crypto.php');
error_reporting(0);
include 'config.php';
$date = date('Y-m-d');


$workingKey = '5EBFD699D6E45BC1123351BF8E61ACCC';  //Working Key should be provided here.
$encResponse = $_POST["encResp"];   //This is the response sent by the CCAvenue Server
$rcvdString = decrypt($encResponse, $workingKey);  //Crypto Decryption used as per the specified working key.
$order_status = "";
$decryptValues = explode('&', $rcvdString);
$dataSize = sizeof($decryptValues);


 
for ($i = 0; $i < $dataSize; $i++) {
	
    $information = explode('=', $decryptValues[$i]);
	
    if ($i == 3) {
         $order_status = $information[1];
    }
    if ($information[0] == "merchant_param1") {
         $points = $information[1];
    }

    if ($information[0] == "merchant_param2") {
         $session_id = $information[1];
    }
    if ($information[0] == "merchant_param3") {
        $areacookie = $information[1];
    }
    if ($information[0] == "order_id") {
        $ins = $information[1];
    }
    if ($information[0] == "merchant_param4") {
        $payable = $information[1];
    }
    if ($information[0] == "merchant_param5") {
        $dis_points = $information[1];
    }
}

 $respo = json_encode($decryptValues);

mysql_query("INSERT INTO `online_payments` (`order_id` ,`response` ,`date`) "
                                . "VALUES ('$ins','".mysql_real_escape_string($respo)."', '$date')");

	if ($order_status == "Success") {


    $details = mysql_fetch_array(mysql_query("select * from register where guid='$session_id'"));
     
    $chk = mysql_fetch_array(mysql_query("select * from register where guid='$session_id'"));
    $tot = mysql_fetch_array(mysql_query("select sum(ctotal) from cart where session_id='$session_id' and order_id='' and cid>0"));
    if ($tot[0] > 0) {
        $chk_product = mysql_fetch_array(mysql_query("select * from cart where session_id='$session_id' and order_id='' and cid>0"));
        if ($payable > 0) {
            $tot_price = $payable;
        } else {
            $tot_price = $tot[0];
        }
        $login = mysql_query("select * from `couponsvendor` where status='Active' and FIND_IN_SET('$areacookie',area) order by guid asc limit 1");
        $no_rows = mysql_num_rows($login);
        $vendor = mysql_fetch_array($login);
        //mysql_query("INSERT INTO `orders` (`userid` ,`total` ,`date`,`status`,`time`,`getdate`,`gettime`,`pmode`,`area`,vendor_id) VALUES ('$session_id', '$tot_price', '$date','Not Delivered','$time','$deliverytime','Store','$pmode','$_COOKIE[area]','$vendor[guid]')");
        mysql_query("update orders set status = 'Delivered',ostatus ='Success' where guid = '$ins' ");
        //

        if ($points > 0) {
            if ($dis_points == 'yes') {
                $chk1 = mysql_fetch_array(mysql_query("select * from wallet where userid='$chk[userid]' and refid='$ins'"));
                if (empty($chk1['guid'])) {
                    mysql_query("INSERT INTO  `wallet` (`userid` ,`points` ,`refid` ,`date`,`status`) VALUES ('$chk[guid]', '$points',  '$ins',  '$date',  'Debit')");
                }
            }
            if ($dis_points == 'special') {
                $chk1 = mysql_fetch_array(mysql_query("select * from virtualwallet where userid='$chk[userid]' and refid='$ins'"));
                if (empty($chk1['guid'])) {
                    mysql_query("INSERT INTO  `virtualwallet` (`userid` ,`points` ,`refid` ,`date`,`status`) VALUES ('$chk[guid]', '$points',  '$ins',  '$date',  'Debit')");
                }
            }
        }
        mysql_query("update cart set order_id='$ins',area='$areacookie' where session_id='$session_id' and order_id='' and cid>0");
        $data = mysql_query("select b.coupon_type,b.validity,b.name as couponcode,b.coupon_value,a.cid as cid,b.coupon_vendor as coupon_vendor,a.cquantity  from cart a,coupons b where a.order_id ='$ins' and a.cid = b.guid  ");
        while ($row = mysql_fetch_array($data)) {
            $chk1112 = mysql_fetch_array(mysql_query("select * from couponsvendor where guid='$row[coupon_vendor]' "));
             mysql_query("INSERT INTO  `coupon_orders` (`coupon_code` ,`mobile_number` ,`user_id` ,`status`,`created_on`,coupon_id,coupon_value) "
                     . "VALUES ('$row[couponcode]', '$details[mobile]',  '$details[guid]',  '1',  '$date','$row[cid]','$row[coupon_value]')");
            if($row["coupon_type"] == "Food"){
				$final_cpn_value = $row['cquantity']*$row['coupon_value'];
				mysql_query("INSERT INTO  `freefood_coupons` (`coupon_code` ,`valid_date` ,`total_coupons` ,`coupon_value`,`products`,assigned_to,valid_upto) "
                     . "VALUES ('$row[couponcode]', '$date',  '$row[cquantity]',  '$final_cpn_value',  '0','$details[guid]','$row[validity]')");
			$chk=mysql_fetch_array(mysql_query("select * from wallet where userid='".$details['userid']."' and refid='".$ins."'"));
		if(empty($chk['guid']))
		{
mysql_query("INSERT INTO  `wallet` 
(`userid` ,`points` ,`refid` ,`date`,`status`) 
VALUES ('".$details['guid']."', '".$final_cpn_value."',  
'".$ins."',  '".$date."',  'Credit')");
	
		}
			
			}
            $message = "Dear $details[name] thanks for shopping at Free food. Here is coupon $row[couponcode] of worth $row[coupon_value] redeem at $chk1112[name], reach us at support@freefood.co.in";
            $sms = str_replace(" ", "%20", "$message");
            $url = "http://onlinebulksmslogin.com/spanelv2/api.php?username=freefd&password=free123&to=$details[mobile]&from=FREEFD&message=$sms"; 
         //   $url = "http://api.smscountry.com/SMSCwebservice_bulk.aspx?User=catchway&passwd=sanju100&mobilenumber=$details[mobile]&message=$sms&sid=FREFUD&mtype=N&DR=Y";
            get_data($url);
             mysql_query("update coupons set quantity=quantity-$row[cquantity] where guid='$row[cid]'");
        }
    }
	}
	$returnarr["status"] = "success";
	$returnarr["message"] = "Payment Success";
	echo json_encode($returnarr);