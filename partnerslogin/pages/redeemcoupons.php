<?php
ob_start();
session_start();
extract($_POST);
extract($_GET);
error_reporting(0);
include 'secure.php';
include '../../config.php';
if (isset($_GET) && $_GET['action'] == 'redeem') {
    $date1 = date('Y-m-d H:i:s');
    //echo "update coupon_orders set status='0' where id='$guid'";exit;
    mysql_query("update coupon_orders set status='0' where id='$guid'");
    $data = mysql_fetch_array(mysql_query("select * from coupon_orders where id='$guid'"));
    $data1 = mysql_fetch_array(mysql_query("select * from coupons where guid='$data[coupon_id]'"));
    $chk = mysql_num_rows(mysql_query("select * from comwallet where refid='$guid' and status='Credit' and description = 'Coupons Vendor' "));
    if ($chk == 0) {
        mysql_query("INSERT INTO  `comwallet` (`userid` ,`points` ,`refid` ,`date`,`status`,`description`) "
            . "VALUES ('$data1[coupon_vendor]', '$data[coupon_value]',  '$guid',  '$date1',  'Credit','Coupons Vendor')");
    }
    header('location:redeemcoupons.php');	
}
?><!DOCTYPE html>
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
                        Redeem Coupons Here

                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active"><?php echo $_SESSION['partner_status']; ?></li>
                    </ol>
                </section>
                <section class="content">
                    
                        <form method="post" action="redeemcoupons.php">
                            <table class="table table-responsive table-bordered">
                                <tr><td>Customer Mobile</td>
                                    <td>
                                        <input type="text" class="form_input required" placeholder="Mobile" name="mobile" required value="<?php echo $mobile; ?>">
                                    </td>
                                    <td>Coupon</td>
                                    <td>
                                        <input type="text" class="form_input required" placeholder="Coupon Code" name="coupon"  value="<?php echo $coupon; ?>">
                                    </td>
                                    <td><button type="submit" name="Search" value="Search" class="btn btn-warning">Search</button>
                                    </td></tr></table></form>
 <?php
                    if (isset($_POST) && $_POST['Search'] == 'Search') {
                       
                        if ($coupon != "" && $mobile != "") {
                            $sql = "select b.coupon_code,b.coupon_value,b.id from coupons a,coupon_orders b where a.guid = b.coupon_id and b.mobile_number = '$mobile' and b.coupon_code = '$coupon' and b.status = '1' and a.coupon_type = 'Offline' and a.coupon_vendor = '$_SESSION[partner_loginid]'  ";
                        }
                        if ($coupon != "" && $mobile == "") {
                            $sql = "select b.coupon_code,b.coupon_value,b.id from coupons a,coupon_orders b where a.guid = b.coupon_id and b.coupon_code = '$coupon'  and b.status = '1' and a.coupon_type = 'Offline' and a.coupon_vendor = '$_SESSION[partner_loginid]'  ";
                        }
                        if ($coupon == "" && $mobile != "") {
                            $sql = "select b.coupon_code,b.coupon_value,b.id from coupons a,coupon_orders b where a.guid = b.coupon_id and b.mobile_number = '$mobile' and b.status = '1' and a.coupon_type = 'Offline' and a.coupon_vendor = '$_SESSION[partner_loginid]'  ";
                        }
                      //  echo $sql;
                        $result = mysql_query($sql);
                        ?>
                        <table class="table table-responsive table-bordered">

                            <thead>

                                <tr>
                                    <th>Coupon Code</th>
                                    <th>Value</th>
                                    <th>Redeem</th>
                                </tr>

                            </thead>

                            <tbody>
                                <?php while ($row = mysql_fetch_array($result)) { ?>
                                    <tr>

                                        <td><?php echo $row["coupon_code"]; ?></td>
                                        <td><?php echo $row["coupon_value"]; ?></td>
                                        <td><a href="coupondetails.php?action=redem&guid=<?php echo $row[id]; ?>"><button type="button" class="btn btn-default">Redeem</button></a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } ?> 
                </section>
            </aside><!-- /.right-side -->
        </aside><!-- /.right-side -->
    </div>
    <!-- ./wrapper -->
    <!-- add new calendar event modal -->
    <?php include "footer-scripts.php" ?>

</body>
</html>