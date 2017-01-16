<?php ob_start();
session_start();extract($_POST);

include 'secure.php';include '../../config.php'; 
$to_date = "";$from_date = "";$to_date1 = "";$from_date1 = "";
if(isset($_POST) && $_POST["from_date"] != ""){
	$from_date  = date('Y-m-d',strtotime($_POST["from_date"]));
	if($_POST["to_date"] != "" ){
	$to_date  = date('Y-m-d',strtotime($_POST["to_date"]));
	}else{
		$to_date = date('Y-m-d');
	}
	
	$condition1 = "date between '".$from_date."' and '".$to_date."'";
	$condition = " date(datetime) between '".$from_date."' and '".$to_date."' ";
	$condition2 = "date between '".$from_date."' and '".$to_date."'";
	$condition3 = " date(datetime) between '".$from_date."' and '".$to_date."' ";
	 $from_date1 = date('m/d/Y',strtotime($from_date));
	  $to_date1 = date('m/d/Y',strtotime($to_date));
}else{
$date = date('Y-m-d');
$condition1 = "date <= '".$date."'";
$condition = " date(datetime) <= '".$date."' ";
$condition2 = "date = '".$date."'";
$condition3 = " date(datetime) = '".$date."' ";
}
$category=mysql_num_rows(mysql_query("select * from city"));
$subcategory=mysql_num_rows(mysql_query("select * from area"));
?><!DOCTYPE html>
<html>
         <?php include "styles-files.php";
		 ?>
		 <style>
.icons .fa{ margin-right:8px !important;}
.icons{ padding:8px;}
.bgcolor{ background-color:#C2C2C2; height:100%; position: relative;  }
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
$( function() {
    $("#datepicker").datepicker();$("#datepicker1").datepicker();
  } );
  </script>
<link href="css_dashboard/bootstrap.css" rel="stylesheet">
<link href="css_dashboard/dashboard.css" rel="stylesheet">
<script src="https://use.fontawesome.com/30588b302d.js"></script>
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
                        Admin 
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Admin</li>
                    </ol>
                </section>
				 <div class="row">
				 <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 col-md-offset-3 col-lg-offset-3 col-xs-offset-3"> 
				 <form method = "post" action = "index.php">
From Date				 
<input type = "text" name = "from_date" id = "datepicker"  value = "<?php  echo $from_date1;?>" />
To Date <input type = "text" name = "to_date" id = "datepicker1" value = "<?php  echo $to_date1;?>" />
			 
<input type = "submit" value = "Search" />
</form>
				 </div>
				 </div><br>
                <!-- Main content -->
                <div class="row">
   <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12"> 
 
	  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
         <div class="dashboard-box">
          <h3 class="box-titles">App Downloads</h3>
       <div class="circles">
      		 <span class="dashboard-numbers"><i class="fa fa-users fa-2x"></i></span>
       </div>
     
       <table width="100%" border="0" align="center" >
  <tbody>
  <?php 
  $sql1 = mysql_fetch_array(mysql_query("select count(*) as total from register where ".$condition1." "));
  
  $sql2 = mysql_fetch_array(mysql_query("select count(*) as today from register where ".$condition2." "));
  ?>
    <tr>
      <td align="right" class="dashboard-box-table-title" >Total</td>
      <td align="left" valign="middle"><?php echo $sql1["total"]; ?></td>
    </tr>
    <tr>
      <td align="right" class="dashboard-box-table-title" >Today:</td>
      <td align="left" valign="middle"><?php echo $sql2["today"]; ?></td>
    </tr>
    
 
  </tbody>
</table>

             <div class="title">App Downloads</div>
         </div>
       

      </div>
      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
         <div class="dashboard-box">
          <h3 class="box-titles">Total Business</h3>
       <div class="circles">
      		 <span class="dashboard-numbers"><i class="fa fa-database fa-2x"></i></span>
       </div>
     
       <table width="100%" border="0" align="center" >
  <tbody>
  <?php 
  //echo "select sum(total) as today from orders where status = 'Delivered' and date(datetime) = '".$date."'";
  $sql7 = mysql_fetch_array(mysql_query("select ifnull(sum(total),0) as total from orders where gettime = 'Store' and status not in ('Not Delivered','Declined') and ".$condition." "));
  
  $sql8= mysql_fetch_array(mysql_query("select ifnull(sum(total),0) as today from orders where ".$condition3." and gettime = 'Store' and status  not in ('Not Delivered','Declined') "));
  //echo "select ifnull(sum(total),0) as today from orders where ".$condition3." and gettime = 'Store' and status  not in ('Not Delivered','Declined') ";
  ?>
  <?php 
  //echo "select sum(total) as today from orders where status = 'Delivered' and date(datetime) = '".$date."'";
  $sql3 = mysql_fetch_array(mysql_query("select ifnull(sum(total),0) as total from orders a,cart b  where a.guid = b.order_id and  order_status not in ('Not Delivered','Declined','') and gettime = 'Food' and order_status is not null and ".$condition." ")  );
  $sql4 = mysql_fetch_array(mysql_query("select ifnull(sum(total),0) as today from orders a,cart b  where a.guid = b.order_id and  ".$condition3." and  order_status not in ('Not Delivered','Declined','')  and gettime = 'Food' and  order_status is not null"));
 
  ?>
    <tr>
      <td align="right" class="dashboard-box-table-title" >Total</td>
      <td align="left" valign="middle"><?php echo $sql3["total"]+$sql7["total"]; ?></td>
    </tr>
    <tr>
      <td align="right" class="dashboard-box-table-title" >Today:</td>
      <td align="left" valign="middle"> <?php echo $sql4["today"]+$sql8['today']; ?></td>
    </tr>
    
 
  </tbody>
</table>

             <div class="title">Total Business</div>
         </div>
       

      </div>
      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
         <div class="dashboard-box">
          <h3 class="box-titles">Food Business</h3>
       <div class="circles">
      		 <span class="dashboard-numbers"><i class="fa fa-cutlery fa-2x"></i></span>
       </div>
     <?php 
  //echo "select sum(total) as today from orders where status = 'Delivered' and date(datetime) = '".$date."'";
  $sql5 = mysql_fetch_array(mysql_query("select ifnull(sum(total),0) as total from orders a,cart b  where a.guid = b.order_id  and  order_status not in ('Not Delivered','Declined','') and gettime = 'Food' and order_status is not null  and ".$condition."  "));
  $sql6= mysql_fetch_array(mysql_query("select ifnull(sum(total),0) as today from orders a,cart b  where a.guid = b.order_id and  ".$condition3." and  order_status not in ('Not Delivered','Declined','') and gettime = 'Food' and order_status is not null "));
  ?>
       <table width="100%" border="0" align="center" >
  <tbody>
    <tr>
      <td align="right" class="dashboard-box-table-title" >Total</td>
      <td align="left" valign="middle"><?php echo $sql5["total"]; ?></td>
    </tr>
    <tr>
      <td align="right" class="dashboard-box-table-title" >Today:</td>
      <td align="left" valign="middle"> <?php echo $sql6["today"]; ?></td>
    </tr>
    
 
  </tbody>
</table>

             <div class="title">Food Business</div>
         </div>
       

      </div>
      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
         <div class="dashboard-box">
          <h3 class="box-titles">Store Business</h3>
       <div class="circles">
      		 <span class="dashboard-numbers"><i class="fa fa-shopping-cart fa-2x"></i></span>
       </div>
     
       <table width="100%" border="0" align="center" >
  <tbody>
    <tr>
      <td align="right" class="dashboard-box-table-title" >Total</td>
      <td align="left" valign="middle"><?php echo $sql7["total"]; ?></td>
    </tr>
    <tr>
      <td align="right" class="dashboard-box-table-title" >Today:</td>
      <td align="left" valign="middle"> <?php echo $sql8["today"]; ?></td>
    </tr>
    
 
  </tbody>
</table>

             <div class="title">Store Business</div>
         </div>
       

      </div>
      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
         <div class="dashboard-box">
          <h3 class="box-titles">Coupons Business</h3>
       <div class="circles">
      		 <span class="dashboard-numbers"><i class="fa fa-shopping-cart fa-2x"></i></span>
       </div>
     <?php 
  //echo "select sum(total) as today from orders where status = 'Delivered' and date(datetime) = '".$date."'";
  $sql9 = mysql_fetch_array(mysql_query("select sum(total) as total from orders where status = 'Delivered' and gettime = 'Coupons' and ".$condition."  "));
  $sql10= mysql_fetch_array(mysql_query("select ifnull(sum(total),0) as today from orders where status = 'Delivered' and ".$condition3."  and gettime = 'Coupons' "));
  ?>
       <table width="100%" border="0" align="center" >
  <tbody>
    <tr>
      <td align="right" class="dashboard-box-table-title" >Total</td>
      <td align="left" valign="middle"><?php echo $sql9["total"]; ?></td>
    </tr>
    <tr>
      <td align="right" class="dashboard-box-table-title" >Today:</td>
      <td align="left" valign="middle"> <?php echo $sql10["today"]; ?></td>
    </tr>
    
 
  </tbody>
</table>

             <div class="title">Coupons Business</div>
         </div>
       

      </div>
      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
         <div class="dashboard-box">
          <h3 class="box-titles">Food Vendors</h3>
       <div class="circles">
      		 <span class="dashboard-numbers"><i class="fa fa-cutlery fa-2x"></i></span>
       </div>
     <?php 
  //echo "select sum(total) as today from orders where status = 'Delivered' and date(datetime) = '".$date."'";
  $sql11 = mysql_fetch_array(mysql_query("select count(*) as food from vendor where status = 'Active'  and vendor_type = 'Food'  "));
  $sql12= mysql_fetch_array(mysql_query("select count(*) as erfv from vendor where status = 'Active' and vendor_type = 'ERFV' "));
  ?>
       <table width="100%" border="0" align="center" >
  <tbody>
    <tr>
      <td align="right" class="dashboard-box-table-title" >Food</td>
      <td align="left" valign="middle"><?php echo $sql11["food"]; ?></td>
    </tr>
    <tr>
      <td align="right" class="dashboard-box-table-title" >ERFV:</td>
      <td align="left" valign="middle"><?php echo $sql12["erfv"]; ?></td>
    </tr>
    
 
  </tbody>
</table>

             <div class="title">Food Vendors</div>
         </div>
       

      </div>
      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
         <div class="dashboard-box">
          <h3 class="box-titles">Number of CLPs</h3>
       <div class="circles">
      		 <span class="dashboard-numbers"><i class="fa fa-line-chart fa-2x"></i></span>
       </div>
     
       <table width="100%" border="0" align="center" >
  <tbody>
  <?php 
  
  $sql13= mysql_fetch_array(mysql_query("select count(*) as clp from cluster where status = 'Active' "));
  ?>
    <tr>
      <td align="right" class="dashboard-box-table-title" >Total`</td>
      <td align="left" valign="middle"><?php echo $sql13["clp"]; ?></td>
    </tr>
   <tr>
      <td align="right" class="dashboard-box-table-title" >&nbsp;</td>
      <td align="left" valign="middle">&nbsp;</td>
    </tr>
    
 
  </tbody>
</table>

             <div class="title">Number of CLPs</div>
         </div>
       

      </div>      
      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
         <div class="dashboard-box">
          <h3 class="box-titles">Number of TPs</h3>
       <div class="circles">
      		 <span class="dashboard-numbers"><i class="fa fa-list-alt fa-2x"></i></span>
       </div>
     
       <table width="100%" border="0" align="center" >
  <tbody>
  
   <?php 
  
  $sql13= mysql_fetch_array(mysql_query("select count(*) as clp from town where status = 'Active' "));
  ?>
    <tr>
      <td align="right" class="dashboard-box-table-title" >Total</td>
      <td align="left" valign="middle"><?php echo $sql13["clp"]; ?></td>
    </tr>
    <tr>
      <td align="right" class="dashboard-box-table-title" >&nbsp;</td>
      <td align="left" valign="middle">&nbsp;</td>
    </tr>
    
 
  </tbody>
</table>

             <div class="title">Number of TPs</div>
         </div>
       

      </div>       
      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
         <div class="dashboard-box">
          <h3 class="box-titles">No Of Store Vendors</h3>
       <div class="circles">
      		 <span class="dashboard-numbers"><i class="fa fa-shopping-cart fa-2x"></i></span>
       </div>
     
       <table width="100%" border="0" align="center" >
  <tbody>
   <?php 
  
  $sql14= mysql_fetch_array(mysql_query("select count(*) as storevend from storevendor where status = 'Active' "));
  ?>
    <tr>
      <td align="right" class="dashboard-box-table-title" >Total</td>
      <td align="left" valign="middle"><?php echo $sql14["storevend"]; ?></td>
    </tr>
    <tr>
      <td align="right" class="dashboard-box-table-title" >&nbsp;</td>
      <td align="left" valign="middle">&nbsp;</td>
    </tr>
    
 
  </tbody>
</table>

             <div class="title">No Of Store Vendors</div>
         </div>
       

      </div>       
      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
         <div class="dashboard-box">
          <h3 class="box-titles">No Of Stock Vendors</h3>
       <div class="circles">
      		 <span class="dashboard-numbers"><i class="fa fa-shopping-bag fa-2x"></i></span>
       </div>
     
       <table width="100%" border="0" align="center" >
  <tbody>
    <?php 
  
  $sql15= mysql_fetch_array(mysql_query("select count(*) as stockvend from stockvendor where status = 'Active' "));
  ?>
    <tr>
      <td align="right" class="dashboard-box-table-title" >Total</td>
      <td align="left" valign="middle"><?php echo $sql15["stockvend"]; ?></td>
    </tr>
    <tr>
      <td align="right" class="dashboard-box-table-title" >&nbsp;</td>
      <td align="left" valign="middle">&nbsp;</td>
    </tr>
    
 
  </tbody>
</table>

             <div class="title">No Of Stock Vendors</div>
         </div>
       

      </div>
      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
         <div class="dashboard-box">
          <h3 class="box-titles">Today Logged In Users</h3>
       <div class="circles">
      		 <span class="dashboard-numbers"><i class="fa fa-users fa-2x"></i></span>
       </div>
     
       <table width="100%" border="0" align="center" >
  <tbody>
    <?php 
  
  $sql16= mysql_fetch_array(mysql_query("select count(distinct userid) as totr from login_details where ".$condition3." and userid != '' "));
  ?>
    <tr>
      <td align="right" class="dashboard-box-table-title" >Total</td>
      <td align="left" valign="middle"><?php echo $sql16["totr"]; ?></td>
    </tr>
    <tr>
      <td align="right" class="dashboard-box-table-title" >&nbsp;</td>
      <td align="left" valign="middle">&nbsp;</td>
    </tr>
    
 
  </tbody>
</table>

             <div class="title">Today Logged In Users</div>
         </div>
       

      </div>
      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
         <div class="dashboard-box">
          <h3 class="box-titles">Orders</h3>
       <div class="circles">
      		 <span class="dashboard-numbers"><i class="fa fa-shopping-bag fa-2x"></i></span>
       </div>
     
       <table width="100%" border="0" align="center" >
  <tbody><?php 
  
  $sql17= mysql_fetch_array(mysql_query("select count(*) as total_f  from orders a,cart b  where a.guid = b.order_id  and  order_status not in ('Not Delivered','Declined','') and gettime = 'Food' and order_status is not null and ".$condition." "));
  $sql18= mysql_fetch_array(mysql_query("select count(*) as today_f  from orders a,cart b  where a.guid = b.order_id  and  order_status not in ('Not Delivered','Declined','') and gettime = 'Food' and order_status is not null and ".$condition3." "));
  $sql19= mysql_fetch_array(mysql_query("select count(*) as total_s  from orders where  status not in ('Not Delivered','Declined') and gettime = 'Store' and ".$condition." "));
  $sql20= mysql_fetch_array(mysql_query("select count(*) as today_s  from orders where status not in ('Not Delivered','Declined') and gettime = 'Store' and ".$condition3." "));
  ?>
    <tr>
      <td align="right" class="dashboard-box-table-title" >Food</td>
      <td align="left" valign="middle">Total : <?php echo $sql17["total_f"]; ?> &nbsp; Today: <?php echo $sql18["today_f"]; ?></td>
    </tr>
    <tr>
      <td align="right" class="dashboard-box-table-title" >Store:</td>
      <td align="left" valign="middle">Total : <?php echo $sql19["total_s"]; ?> &nbsp; Today: <?php echo $sql20["today_s"]; ?></td>
    </tr>
    
 
  </tbody>
</table>

             <div class="title">Orders</div>
         </div>
       

      </div>
        


</div>
 </div>
            </aside><!-- /.right-side -->
        </div>
        <!-- ./wrapper -->
        <!-- add new calendar event modal -->
       <?php include "footer-scripts.php" ?>
     
    </body>
</html>
