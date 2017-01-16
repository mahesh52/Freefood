<?php include('Crypto.php') ?>
<?php
error_reporting(0);
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

								if ($order_status === "Success") {


    $details = mysql_fetch_array(mysql_query("select * from register where guid='$session_id'"));
     $details['guid'];
	if ($details['guid'] == '') {
        header('location:login.php');
    }
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
        <?php
    }
    //echo "<br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";
} else if ($order_status === "Aborted") { ?>
    
    <?php include 'header.php'; ?>
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
                                    <p>Your Payment Has Aborted.</p>     
                                    <p>OrderID  is <b>FF<?php echo $ins; ?></b>.</p>
                                    
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
            <?php 
} else if ($order_status === "Failure") { ?>
   <?php include 'header.php'; ?>
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
                                    <p>Your Payment Has Declined.</p>     
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
<?php } else { ?> 
    <?php include 'header.php'; ?>
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
                                    <p>Your Payment Has Failed.</p>     
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
<?php }
?>
