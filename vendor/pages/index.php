<?php ob_start();
session_start();extract($_POST);

include 'secure.php';include '../../config.php'; 
$orders=0;$products=0;
$products=mysql_num_rows(mysql_query("select * from vendor_products where vendor_id='$_SESSION[vendor_loginid]'"));
$orders=mysql_num_rows(mysql_query("select * from orders where vendor_id='$_SESSION[vendor_loginid]'"));
$details=mysql_fetch_array(mysql_query("select * from vendor where guid='$_SESSION[vendor_loginid]'"));
$pendorders=mysql_num_rows(mysql_query("select * from orders where gettime='Food' and  ostatus='' and area='$details[area]'"));

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
                        Vendor 
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Vendor</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

				 <!-- top row -->
                   <div class="row total-collections-display">
                        <div class="col-sm-6 connectedSortable">
                            <div class="small-box bg-orange">
                                <div class="inner">
                                    <h3> 
                                        Total Products : <?php if($products==''){echo "0";}else{echo $products;}?>
                                       
                                    </h3><br>
                                     <h3> 
                                        Total Orders : <?php if($orders==''){echo "0";}else{echo $orders;}?>
                                       
                                    </h3>
                                   <h3> 
                                        Product Status : <?php echo $details['pstatus'];?></h3>
                                        <h3> 
                                        <a href="pending_orders.php" style="color:#FFF">New Orders : <?php if($pendorders==''){echo "0";}else{echo $pendorders;}?></a></h3>
                                   <!-- <h4>
                                       Active Users : <?php// echo $active;?>
                                    </h4>
                                    <h4>
                                       In Active Users :  <?php// echo $inactive;?>
                                    </h4>-->
                                </div>
                               
                               
                            </div>
                        </div><!-- /.col -->
                       
                    <!-- /.row -->
</div></section>
            </aside><!-- /.right-side -->
        </div>
        <!-- ./wrapper -->
        <!-- add new calendar event modal -->
       <?php include "footer-scripts.php" ?>
     
    </body>
</html>