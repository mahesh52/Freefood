<?php
ob_start();
extract($_POST);
include 'config.php';

$date = date('Y-m-d');

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

$details = mysql_fetch_array(mysql_query("select * from register where guid='$_COOKIE[sessid]'"));

if ($details['guid'] == '') {
    header('location:login.php');
}


$qry2 = mysql_query("SELECT * FROM `cart` where order_id='' and session_id='$_COOKIE[sessid]' and order_id='' and pid>0");
$sql_erfv = mysql_fetch_array(mysql_query("select * from vendor where FIND_IN_SET('$_COOKIE[area]',area)"));
										$food_vendor_id = $sql_erfv["guid"];
										$vendor_type = $sql_erfv["vendor_type"];
while ($row2 = mysql_fetch_assoc($qry2)) {
    $fqty = 0;
    $chkqty[0] = 0;
    $cartqty[0] = 0;
    
    if($vendor_type == "ERFV"){
		$chkqty = mysql_fetch_array(mysql_query("select available_qty from erfvstock where product_id='$row2[pid]' and erfv_vendor='$food_vendor_id'"));
	}
	else{
		$chkqty = mysql_fetch_array(mysql_query("select sum(quantity) from vendor_quantity where product_id='$row2[pid]' and date='$date'"));
	}
	$cartqty = mysql_fetch_array(mysql_query("select sum(cquantity) from cart where pid='$row2[pid]' and date='$date' and order_id!=''"));
    $fqty = $chkqty[0] - $cartqty[0];
    if ($row2['cquantity'] > $fqty) {
        mysql_query("update cart set cquantity='0',price='0',ctotal='0' where guid='$row2[guid]'");
        header('location:checkout.php?msg=Review Your Order');
        exit;
    }
}


$chk = mysql_fetch_array(mysql_query("select * from register where guid='$_COOKIE[sessid]'"));
$tot = mysql_fetch_array(mysql_query("select sum(ctotal) from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0"));
if ($tot[0] > 0) {
	
    $chk_product = mysql_fetch_array(mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0"));
    $tot_price = $tot[0];
	$sql_clp = mysql_fetch_array(mysql_query("select * from area where guid='$_COOKIE[area]'"));
    $login = mysql_query("select * from `cluster` where status='Active' and guid = '$sql_clp[clp]' order by guid asc limit 1");
    $no_rows = mysql_num_rows($login);
    $vendor = mysql_fetch_array($login);
	//if($payable < 250){
	//	$payable = $payable+20;
	//}
	
				
				
    mysql_query("INSERT INTO `orders` (`userid` ,`total` ,`date`,`status`,`time`,`gettime`,`pmode`,`area`,`pincode`,vendor_id,discount) VALUES ('$_COOKIE[sessid]', '$payable', '$date','Not Delivered','$tot_price','Food','$pmode','$_COOKIE[area]','$pincode','$vendor[guid]','$discount')");
    $ins = mysql_insert_id();
	if($discount > 0 && $coupon_code != "" && $ins != ""){
		  $sql = "select * from freefood_coupons where coupon_code = '".$coupon_code."' ";
	 $result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	if($row["valid_upto"] != "" && $row["assigned_to"] != "" && $row["products"] == "0"){
		$sql101 = mysql_fetch_array(mysql_query("select * from freefood_coupons where coupon_code = '".$coupon_code."' and assigned_to = '".$_COOKIE['sessid']."' and coupon_value > 0 order by guid asc limit 1 "));
		$sql_fd_coupons = mysql_query("update freefood_coupons set coupon_value = coupon_value-$discount where guid = '".$sql101['guid']."' ");
	}
		 $products = $row["products"];
		 $chknew=mysql_query("select * from cart where pid in ($products) and session_id='$_COOKIE[sessid]' and order_id='' order by price desc limit 1 ");
		$chk_rowsnew = mysql_fetch_array($chknew);
		$product_coupon = $chk_rowsnew["pid"];
		//echo "select * from cart where pid in ('$products') and session_id='$_COOKIE[sessid]' and order_id='$ins' ";
		
		mysql_query("INSERT INTO `freefood_coupons_used` (`order_id` ,`user_id` ,`coupon_code`,`product_id`) VALUES ('$ins','$_COOKIE[sessid]', '$coupon_code','$product_coupon')");
	}
    mysql_query("update cart set order_id='$ins',area='$_COOKIE[area]',delivery_time = '$deliverydate' where session_id='$_COOKIE[sessid]' and order_id='' and pid>0");
    $data_qry = mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='$ins' ");
	$sql_erfv = mysql_fetch_array(mysql_query("select * from vendor where FIND_IN_SET('$_COOKIE[area]',area)"));
										$food_vendor_id = $sql_erfv["guid"];
										$vendor_type = $sql_erfv["vendor_type"];
										$prnames = "";
    while ($row_data = mysql_fetch_array($data_qry)) {
		 $chk = mysql_fetch_array(mysql_query("select * from products where guid='$row_data[pid]'"));
		 $vat =  round(((($chk['sprice']*$chk['vat'])/100)*$row_data['cquantity']));
        $rowguid = $row_data["guid"];
        $pid_db = $row_data["pid"];
        $deliver_dateattr = "deliver_date_" . $pid_db;
        $pre_order_statusattr = "pre_order_status_" . $pid_db;
         $spicy_levelattr  = "spicy_level_".$pid_db;
        $deliver_date = $$deliver_dateattr;
        $pre_order_status = $$pre_order_statusattr;
        $spicy_level = $$spicy_levelattr;
        if ($pre_order_status == "1") {
            $deliverydate = date('Y-m-d H:i:s');
        } else if ($pre_order_status == "0") {
            $deliverydate = $deliver_date;
            $deliverydate = explode(" ", $deliverydate);
            $time = $deliverydate[1] . " " . $deliverydate[2] . " " . $deliverydate[3];
            $deliverydate = date('Y-m-d H:i:s', strtotime($time));
        }
        mysql_query("update cart set vat = '$vat',delivery_time = '$deliverydate',spicy_level = '$spicy_level' where guid = '$rowguid' ");
		if($vendor_type == "ERFV"){
			mysql_query("update erfvstock set available_qty = available_qty-$row_data[cquantity] where product_id='$pid_db' and erfv_vendor='$food_vendor_id' ");
		}
		$pnamearr = mysql_fetch_array(mysql_query("select * from products where guid = '$pid_db'"));
		$prnames.=$pnamearr['name']."(".$row_data[cquantity].")".",";
    }
	$prnames = rtrim($prnames,',');
	$chk=mysql_query("select * from cart where pid in ($products) and session_id='$_COOKIE[sessid]' and order_id='$ins' and pid >0 order by price desc limit 1 ");
		 $chk_prodss=mysql_num_rows(mysql_query("select * from cart where  session_id='$_COOKIE[sessid]' and order_id='$ins' and pid>0 "));
		 if($products != 0){
			 $chk_rows = mysql_num_rows($chk);
		 }
		 else{
			 $chk_rows = 0;
		 }
		 
		 if($chk_prodss == 1 && $chk_rows ==1){
			 $newPayable = $payable-$discount-20;
		 }else{
			 
			 $newPayable = $payable-$discount;
			 if($newPayable<=250){
				// if($discount > 0){
				//	 $newPayable = $newPayable+20;
				// }else{
					// $newPayable = $newPayable;
				// }
				 
			 }
		 }
	
	
    $message = "Dear $details[name] thanks for shopping at Free food. Your order no. FF$ins for Rs.$newPayable will be delivered shortly For queries, reach us at support@freefood.co.in";


    $sms = str_replace(" ", "%20", "$message");
    $url = "http://onlinebulksmslogin.com/spanelv2/api.php?username=freefd&password=free123&to=$details[mobile]&from=FREEFD&message=$sms"; 
	//$vendor[guid]
     //$url = "http://api.smscountry.com/SMSCwebservice_bulk.aspx?User=catchway&passwd=sanju100&mobilenumber=$details[mobile]&message=$sms&sid=FREFUD&mtype=N&DR=Y";
	 get_data($url);
	 $message1 = "Dear Vendor,your order no. FF$ins is waiting for your confirmation";
    $sms1 = str_replace(" ", "%20", "$message1");
    $url1 = "http://onlinebulksmslogin.com/spanelv2/api.php?username=freefd&password=free123&to=$vendor[mobile]&from=FREEFD&message=$sms1"; 
    get_data($url1);
	
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
$message .= "<tr><td><strong>Delivery Address  :</strong> </td><td>" .$details[address] .$details[state].$details[city]. "</td></tr>";
	$message .= "</table>";
	$message .= "<p align = 'center'>© 2016-FreeFood. All rights reserved.</p><br>";
	$message .= "<p align = 'center'>reach us at support@freefood.co.in.</p>";
$message .= "</body></html>";
 $details['email'];
 $message;
 mail($to, $subject, $message, $headers);
	}

    //include 'vendorsms.php';
}if ($ins == '') {
    header('location:index.php');
} else {
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
            <p>Your Order <br />Has Been successfully completed.</p>     
            <p>OrderID  <br />For your reference is <b>FF<?php echo $ins; ?></b>.</p>
              <p> Want to add more products...?<br />
              <a href="welcome.php" class="button_full btyellow" style = "padding:0;width:35%;margin-left: 35%;margin-top: 10px;">
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