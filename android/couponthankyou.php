<?php ob_start();extract($_POST);
include 'config.php';$date=date('Y-m-d');
function get_data($url) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}
$details=mysql_fetch_array(mysql_query("select * from register where guid='$_COOKIE[sessid]'"));
if($details['guid']==''){header('location:login.php');}
$ins = $order_id;
	$chk=mysql_fetch_array(mysql_query("select * from register where guid='$_COOKIE[sessid]'"));
	$tot=mysql_fetch_array(mysql_query("select sum(ctotal) from cart where session_id='$_COOKIE[sessid]' and order_id='' and cid>0"));
	if ($tot[0] > 0) {
        $chk_product = mysql_fetch_array(mysql_query("select * from cart where session_id='$_COOKIE[area]' and order_id='' and cid>0"));
        if ($payable > 0) {
            $tot_price = $payable;
        } else {
            $tot_price = $tot[0];
        }
        $login = mysql_query("select * from `couponvendor` where status='Active' and FIND_IN_SET('$_COOKIE[area]',area) order by guid asc limit 1");
        $no_rows = mysql_num_rows($login);
        $vendor = mysql_fetch_array($login);
        //mysql_query("INSERT INTO `orders` (`userid` ,`total` ,`date`,`status`,`time`,`getdate`,`gettime`,`pmode`,`area`,vendor_id) VALUES ('$session_id', '$tot_price', '$date','Not Delivered','$time','$deliverytime','Store','$pmode','$_COOKIE[area]','$vendor[guid]')");
        mysql_query("update orders set pmode = 'Points',status = 'Delivered',ostatus ='Success' where guid = '$ins' ");
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
        mysql_query("update cart set order_id='$ins',area='$_COOKIE[area]' where session_id='$_COOKIE[sessid]' and order_id='' and cid>0");
        $data = mysql_query("select b.name as couponcode,b.coupon_value,a.cid as cid,b.coupon_vendor as coupon_vendor,a.cquantity  from cart a,coupons b where a.order_id ='$ins' and a.cid = b.guid  ");
        while ($row = mysql_fetch_array($data)) {
            $chk1112 = mysql_fetch_array(mysql_query("select * from couponsvendor where guid='$row[coupon_vendor]' "));
             mysql_query("INSERT INTO  `coupon_orders` (`coupon_code` ,`mobile_number` ,`user_id` ,`status`,`created_on`,coupon_id,coupon_value) "
                     . "VALUES ('$row[couponcode]', '$details[mobile]',  '$details[guid]',  '1',  '$date','$row[cid]','$row[coupon_value]')");
            
            $message = "Dear $details[name] thanks for shopping at Free food. Here is coupon $row[couponcode] of worth $row[coupon_value] redeem at $chk1112[name], reach us at support@freefood.co.in";
            $sms = str_replace(" ", "%20", "$message");
            $url = "http://onlinebulksmslogin.com/spanelv2/api.php?username=freefd&password=free123&to=$details[mobile]&from=FREEFD&message=$sms"; 
         //   $url = "http://api.smscountry.com/SMSCwebservice_bulk.aspx?User=catchway&passwd=sanju100&mobilenumber=$details[mobile]&message=$sms&sid=FREFUD&mtype=N&DR=Y";
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
    }if($ins==''){header('location:index.php');}else{
?><?php include 'header.php'; ?>
     <script type="text/javascript" src="assets/js/jquery-2.1.4.js"></script>

        <style>
            .button_full{
                background-color: #b40406;
                border-left: 5px solid #b40406;
                clear: both;
                float: left;
                font-size: 14px;
                font-weight: 700;
                margin: 0 0 20px;
                padding: 10px 0 10px 5%;
                width: 93%;
            }

        </style>
    </head>
    <body id="mobile_wrap">
             <div class="pages">
  <div data-page="success" class="page no-toolbar no-navbar">
    <div class="page-content">
    
	<div class="navbarpages whitebg bottomborder">
		<div class="navbar_left">
			<div class="logo_image"><a href="index.php"><img src="images/logo-small.png" alt="" title=""/></a></div>
		</div>			
		<a href="#" data-panel="left" class="open-panel">
			<div class="navbar_right"><img src="images/icons/black/menu.png" alt="" title="" /></div>
		</a>
		<a href="welcome.php" class="close-panel" data-view=".view-main">
			<div class="navbar_right whitebg"><img src="images/icons/black/cart.png" alt="" title="" /><span class='badge'>0</span></div>
		</a>					
	</div>
     
     <div id="pages_maincontent">

	<div class="page_single layout_fullwidth_padding">
            <div class="success_message">
            <span>Thank You!</span>
            <img src="images/icons/black/rocket.png" alt="" title="" />
            <p>Your Order Has Been successfully completed.</p>     
            <p>OrderID  is <b>FF<?php echo $ins; ?></b>.</p>
            
              <p> Want to add more products...?<br />
              <a href="welcome.php" class="button_full btyellow" style = "padding:0;width:35%;margin-top: 10px;">
                  Continue 
                  
              </a>
            </p>
           
         
            </div>
      </div>
      
      </div>
      
      
    </div>
  </div>
</div>
    
     <?php include 'footer.php'; ?>
    <?php } ?>