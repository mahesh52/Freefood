<?php ob_start();
session_start();extract($_POST);

include 'secure.php';include '../../config.php'; 
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
                        <?php echo $_SESSION['partner_status'];?> Panel 
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active"><?php echo $_SESSION['partner_status'];?></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

				 <!-- top row -->
                   <div class="row total-collections-display">
                        <div class="col-sm-12 connectedSortable">
                            <div class="small-box bg-orange">
                                <div class="inner">
                                    <h3> Welcome To <?php echo $_SESSION['partner_status'];?> Panel
                                     <br> 
                                    </h3>
                                    <?php 
									if($_SESSION['partner_status']=="Cluster Partner")
{
	$credit=mysql_fetch_array(mysql_query("SELECT sum(points) FROM `clpwallet` where userid='$_SESSION[partner_loginid]' and status='Credit'"));
					 $debit=mysql_fetch_array(mysql_query("SELECT sum(points) FROM `clpwallet` where userid='$_SESSION[partner_loginid]' and status='Debit'"));
					 $bal=$credit[0]-$debit[0];
echo "<h3>Balance : $bal/-</h3>";
				 
}
									
									$orders=0;$products=0;
if($_SESSION['vendor_loginid']!=''){
$products=mysql_num_rows(mysql_query("select * from vendor_products where vendor_id='$_SESSION[vendor_loginid]'"));
$orders=mysql_num_rows(mysql_query("select * from orders where vendor_id='$_SESSION[vendor_loginid]'"));
$details=mysql_fetch_array(mysql_query("select * from vendor where guid='$_SESSION[vendor_loginid]'"));
$pendorders=mysql_num_rows(mysql_query("select * from orders where gettime='Food' and  ostatus='' and area='$details[area]'"));
?>
                                     <h3> 
                                        Total Products : <?php if($products==''){echo "0";}else{echo $products;}?>
                                       
                                    </h3><br>
                                     <h3> 
                                        Total Orders : <?php if($orders==''){echo "0";}else{echo $orders;}?>
                                       
                                    </h3>
                                   <h3> 
                                        Product Status : <?php echo $details['pstatus'];?></h3>
                                        <h3> 
                                        <a href="pending_orders.php" style="color:#FFF">New Orders : <?php if($pendorders==''){echo "0";}else{echo $pendorders;}?></a></h3><?php }?>
                                        <?php $orders=0;$products=0;
if($_SESSION['storevendor_loginid']!=''){
$products=mysql_num_rows(mysql_query("select * from store_vendor_products where vendor_id='$_SESSION[storevendor_loginid]'"));
$orders=mysql_num_rows(mysql_query("select * from orders where vendor_id='$_SESSION[storevendor_loginid]'"));
$details=mysql_fetch_array(mysql_query("select * from storevendor where guid='$_SESSION[storevendor_loginid]'"));
if($_SESSION['partner_status']=="Food Vendor")
{
$pendorders=mysql_num_rows(mysql_query("select * from orders where gettime='Food' and  ostatus='' and area='$details[area]'"));

}
if($_SESSION['partner_status']=="Store Vendor")
{
$pendorders=mysql_num_rows(mysql_query("select * from orders where gettime='Store' and  ostatus='' and area='$details[area]'"));
}

?>
                                     <h3> 
                                        Total Products : <?php if($products==''){echo "0";}else{echo $products;}?>
                                       
                                    </h3><br>
                                     <h3> 
                                        Total Orders : <?php if($orders==''){echo "0";}else{echo $orders;}?>
                                       
                                    </h3>
                                   <h3> 
                                        Product Status : <?php echo $details['pstatus'];?></h3>
                                        <h3> 
                                        <a href="spending_orders.php" style="color:#FFF">New Orders : <?php if($pendorders==''){echo "0";}else{echo $pendorders;}?></a></h3><?php }?>
                                      <!-- <h4>
                                       Active Users : <?php// echo $active;?>
                                    </h4>
                                    <h4>
                                       In Active Users :  <?php// echo $inactive;?>
                                    </h4>-->
                                </div>
                               
                               
                            </div>
                        </div><!-- /.col -->
                       <div><?php 
									if($_SESSION['partner_status']=="Cluster Partner")
{if($bal<$details['minbal']){?><a href="wallet.php"><h2><P align="center"><font color="#FF0000"><strong><?php echo "Running Out Of Balance";?></strong></font></P></h2></a><?php }}?></div>
                    <!-- /.row -->
</div></section>
            </aside><!-- /.right-side -->
        </div>
        <!-- ./wrapper -->
        <!-- add new calendar event modal -->
       <?php include "footer-scripts.php" ?>
     
    </body>
</html>