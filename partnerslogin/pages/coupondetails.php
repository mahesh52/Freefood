<?php
ob_start();
session_start();
extract($_POST);
extract($_GET);
error_reporting(0);
include 'secure.php';
include '../../config.php';
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

$valid_from = date('Y-m-d H:i:s');
$valid_to = date('Y-m-d H:i:s', strtotime("+30 minutes"));
if (isset($_GET) && $_GET['action'] == 'redem') {
//    $date1 = date('Y-m-d H:i:s');
    //echo "update coupon_orders set status='0' where id='$guid'";exit;
    //mysql_query("update coupon_orders set status='0' where id='$guid'");
    $data = mysql_fetch_array(mysql_query("select * from coupon_orders where id='$guid'"));
    $data1 = mysql_fetch_array(mysql_query("select * from coupons where guid='$data[coupon_id]'"));
    $data11 = mysql_fetch_array(mysql_query("select * from register where guid='$data[user_id]'"));
     $otp = mt_rand(100000, 999999);
$mobile = $data["mobile_number"];
        $update = mysql_query("update freefood_otp_details set status =0 where otp_for = '$data[coupon_code]' and status =1 and mobile_number = '$mobile' ");
        $result = mysql_query("INSERT INTO `freefood_otp_details` (`mobile_number` ,`otp_for` ,`otp` ,`created_date` ,`valid_from` ,`valid_to`,`status`) "
                . "VALUES ('$mobile', '$data[coupon_code]', '$otp', '$valid_from', '$valid_from', '$valid_to','1')");
         if ($result) {
             $message = "Dear $data11[name], $otp is the password to redeem your coupon $data[coupon_code] valid for 30Mins. For queries, reach us at support@freefood.co.in";
            $sms = str_replace(" ", "%20", "$message");
            $url = "http://onlinebulksmslogin.com/spanelv2/api.php?username=freefd&password=free123&to=$mobile&from=FREEFD&message=$sms"; 
           // $url = "http://api.smscountry.com/SMSCwebservice_bulk.aspx?User=catchway&passwd=sanju100&mobilenumber=$mobile&message=$sms&sid=FREFUD&mtype=N&DR=Y";
            get_data($url);
           // echo 1;
        }
    
//    $chk = mysql_num_rows(mysql_query("select * from comwallet where refid='$guid' and status='Credit' and description = 'Coupons Vendor' "));
//    if ($chk == 0) {
//        mysql_query("INSERT INTO  `comwallet` (`userid` ,`points` ,`refid` ,`date`,`status`,`description`) "
//            . "VALUES ('$data1[coupon_vendor]', '$data[coupon_value]',  '$guid',  '$date1',  'Credit','Coupons Vendor')");
////    }
//    header('location:redeemcoupons.php');	
}
    
    if (isset($_POST) && $_POST['action'] == 'redeem') {
    $date1 = date('Y-m-d H:i:s');
    //echo "update coupon_orders set status='0' where id='$guid'";exit;
    mysql_query("update coupon_orders set status='0' where id='$guid'");
    $data = mysql_fetch_array(mysql_query("select * from coupon_orders where id='$guid'"));
    $data1 = mysql_fetch_array(mysql_query("select * from coupons where guid='$data[coupon_id]'"));
    $chk = mysql_num_rows(mysql_query("select * from comwallet where refid='$guid' and status='Credit' and description = 'Coupons Vendor' "));
    if ($chk == 0) {
        $get_otp = "select * from freefood_otp_details where otp_for = '$data[coupon_code]' and otp = '$otp' and status =1 and mobile_number = '$data[mobile_number]' and valid_to >= '$valid_from'";
        $result = mysql_query($get_otp);
        $num_rows = mysql_num_rows($result);
        if ($num_rows > 0) {
            $row = mysql_fetch_array($result);
            $id = $row["id"];
            $update = mysql_query("update freefood_otp_details set status =0 where id = '$id' ");
            mysql_query("INSERT INTO  `comwallet` (`userid` ,`points` ,`refid` ,`date`,`status`,`description`) "
            . "VALUES ('$data1[coupon_vendor]', '$data[coupon_value]',  '$guid',  '$date1',  'Credit','Coupons Vendor')");
            
             header('location:redeemcoupons.php');	
        }
        else{
             header('location:coupondetails.php?action=redem&msg=invali OTP&guid='.$guid);	
        }
        
        
    }
    else{
         header('location:redeemcoupons.php');	
    }
   
}

    ?>
<html>
         <?php include "styles-files.php";
		 ?>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
       	 <?php include "header.php"; ?>
		 <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
         	<?php include "side-nav.php"; ?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Coupons Redeem 
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Admin</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

				 <!-- top row -->
                                 <p color =red><?php echo $_GET["msg"]; ?></p>
                 <form name="form1" method="post" action="coupondetails.php">
					 <table class="table table-responsive table-bordered">
                     <tr><td>Name </td><td><input type="text" name="userid" class="form-control" value="<?php echo $data11['name'];?>" readonly></td></tr>
                     <tr><td>Mobile </td><td><input type="text" name="name" class="form-control" value="<?php echo $data['mobile_number'];?>" readonly></td></tr>
                     <tr><td>Coupon Code</td><td><input type="text" name="balance" class="form-control" value="<?php echo $data['coupon_code'];?>" readonly></td></tr>
                     <tr><td>Email</td><td><input type="text" name="amount" readonly class="form-control" value="<?php echo $data11['email'];?>" required></td></tr>
                     <tr><td>One Time Password</td><td><input type="text" name="otp" class="form-control" value="" required></td></tr>
                     <tr><td colspan="2"><input type="submit" name="submit" value="Redeem" class="btn btn-success"></td></tr>
                     </table>
                     <input type ="hidden" name ="action" value ="redeem" />
                     <input type ="hidden" name ="guid" value ="<?php echo $data['id'];?>" />
                     
					 </form>
					
					 
                   
                   

                      </section>
            </aside><!-- /.right-side -->
        </div>
        <!-- ./wrapper -->
        <!-- add new calendar event modal -->
       <?php include "footer-scripts.php" ?>
    </body>
</html>

