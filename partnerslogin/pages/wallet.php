<?php ob_start();
session_start();extract($_POST);extract($_GET);
if($_SESSION['partner_status']!='Cluster Partner'){header('location:logout.php');}
include 'secure.php';include '../../config.php'; $date=date('Y-m-d');
if(isset($_POST) && $_POST['submit']!='')
{//print_r($_POST);	exit;
$chk=mysql_fetch_array(mysql_query("SELECT * FROM `clpwallet` where tcode='$tcode'"));
if($amount>0 && $chk['guid']=='')
{
mysql_query("INSERT INTO  `clpwallet` (`userid` ,`points` ,`pstatus` ,`date`,`status`,`description`,`tcode`,`remarks`) VALUES ('$_SESSION[partner_loginid]', '$amount',  'Pending',  '$date',  'Pending','$_SESSION[partner_status]','$tcode','$remarks')");	
header('location:wallet.php?msg=Transaction Code Existed');
}
else{
header('location:wallet.php?msg=Request Sent Successfully');
}
}?><!DOCTYPE html>
<html>
         <?php include "styles-files.php";
		 ?>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
       	 <?php include "header.php"; ?>
		 <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
         	<?php include "side-nav.php"; 
			 $credit=mysql_fetch_array(mysql_query("SELECT sum(points) FROM `clpwallet` where userid='$_SESSION[partner_loginid]' and status='Credit'"));
					 $debit=mysql_fetch_array(mysql_query("SELECT sum(points) FROM `clpwallet` where userid='$_SESSION[partner_loginid]' and status='Debit'"));
					 $bal=$credit[0]-$debit[0];?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Wallet Balance : <?php echo $bal;?>/-
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Admin</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

				 <!-- top row -->
                  <?php if($_GET['action']=='add'){
					  
						  if($_SESSION['partner_status']=='Cluster Partner'){
						  $det=mysql_fetch_array(mysql_query("select * from cluster where guid='$_SESSION[partner_loginid]'"));}
					 $credit=mysql_fetch_array(mysql_query("SELECT sum(points) FROM `clpwallet` where userid='$_SESSION[partner_loginid]' and status='Credit'"));
					 $debit=mysql_fetch_array(mysql_query("SELECT sum(points) FROM `clpwallet` where userid='$_SESSION[partner_loginid]' and status='Debit'"));
					 $bal=$credit[0]-$debit[0];?>
                 <form name="form1" method="post" action="wallet.php">
					 <table class="table table-responsive table-bordered">
                     <tr><td>Email Id</td><td><input type="text" name="userid" class="form-control" value="<?php echo $det['email'];?>" readonly></td></tr>
                     <tr><td>Name</td><td><input type="text" name="name" class="form-control" value="<?php echo $det['name'];?>" readonly></td></tr>
                     <tr><td>Balance</td><td><input type="text" name="balance" class="form-control" value="<?php echo $bal;?>" readonly></td></tr>
                     <tr><td>Amount</td><td><input type="text" name="amount" class="form-control" value="<?php echo $check['amount'];?>" required></td></tr>
                     <tr><td>Transaction Code</td><td><input type="text" name="tcode" class="form-control" value="<?php echo $check['tcode'];?>" required></td></tr>
                     <tr><td>Remarks</td><td><input type="text" name="remarks" class="form-control" value="<?php echo $check['remarks'];?>" required></td></tr>
                     <tr><td colspan="2"><input type="submit" name="submit" value="Submit" class="btn btn-success"></td></tr>
                     </table>
					 </form>
					
					 <?php }else{
						 ?>
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="wallet.php?action=add"><button type="button" class="btn btn-success">Wallet Request</button></a><section class="content">
                   <table class="table table-responsive table-bordered">

                    	<thead>

                          <tr>
                            <th>Sno</th>
                           <th>Amount</th>
                           <th>Date</th>
                            <th>Status</th>
                            <th>Transaction Code</th>
                            <th>Remarks</th>
                            
                           </tr>

                        </thead>

                        <tbody>

                         <?php 
extract($_GET);include 'pageing.php';
						    $gridId = $_GET[guid];
							$limit = 90; 								

if($page) 

$start = ($page - 1) * $limit; 			

else

$start = 0;						

$filePath="wallet.php";
$page=1;
//echo "select * from cat  Limit $start, $limit";

$query_clients="SELECT * FROM `clpwallet` where userid='$_SESSION[partner_loginid]' order by guid desc  Limit $start, $limit ";

$query_clients=mysql_query($query_clients);

$select1="SELECT * FROM `clpwallet` where userid='$_SESSION[partner_loginid]'";

$total=mysql_num_rows(mysql_query($select1));

$otherParams="";

@$divs=$total%$limit;

	if($divs==0)

	{

	@$totals=(int)($total/$limit);

	}else{

	@$totals=(int)($total/$limit) + 1;

	}$m=1;
	if($total==0){?>
	<tr><td colspan="8" align="center"><font color="#FF0000">No Records</font></td></tr></tbody></table>
	<?php
	}else{while($client_count = mysql_fetch_assoc($query_clients)){
								?>

                        	<tr>

                            	<td><?php echo $m; ?></td>
                               <td><?php echo $client_count['points']; ?></td>
                               <td><?php echo $client_count['date']; ?></td>
                               <td><?php echo $client_count['pstatus']; ?></td>
                               <td><?php if($client_count['tcode']==''){echo "---";}else{echo $client_count['tcode'];} ?></td>
                               <td><?php if($client_count['remarks']==''){echo "---";}else{echo $client_count['remarks'];} ?></td>
                               
                                  </tr>

                          <?php $m++;} ?>

                        </tbody>

                        <tfoot>

                        	<tr>

                            	<th colspan="6"> Showing <?php echo $page;?> of <?php echo $totals;?> Pages </th>

                            </tr>

                        </tfoot>
                        

                    </table></section>
                     <ul class="pagination">

                       <?php make_pages($page,$limit,$total,$filePath,$otherParams); ?>
                       

                    </ul><?php }} ?></section>
            </aside><!-- /.right-side -->
        </div>
        <!-- ./wrapper -->
        <!-- add new calendar event modal -->
       <?php include "footer-scripts.php" ?>
    </body>
</html>