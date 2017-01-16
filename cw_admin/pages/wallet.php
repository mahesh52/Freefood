<?php ob_start();
session_start();extract($_POST);extract($_GET);
include 'secure.php';include '../../config.php'; $date=date('Y-m-d');
if(isset($_POST) && $_POST['submit']!='' && $_POST['hid']!='')
{//print_r($_POST);	exit;
if($amount>0)
{
mysql_query("update  `clpwallet` set `points`='$amount',`status`='$status',`pstatus`='$status' where guid='$hid'");	
}

header('location:wallet.php');	
}?><!DOCTYPE html>
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
                        Wallet 
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Admin</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

				 <!-- top row -->
                  <?php if($_GET['action']=='edit'){
					  $chk=mysql_fetch_array(mysql_query("select * from clpwallet where guid='$_GET[gid]'"));
						  $det=mysql_fetch_array(mysql_query("select * from cluster where guid='$chk[userid]'"));
					 $credit=mysql_fetch_array(mysql_query("SELECT sum(points) FROM `clpwallet` where userid='$chk[userid]' and status='Credit'"));
					 $debit=mysql_fetch_array(mysql_query("SELECT sum(points) FROM `clpwallet` where userid='$chk[userid]' and status='Debit'"));
					 $bal=$credit[0]-$debit[0];?>
                 <form name="form1" method="post" action="wallet.php">
					 <table class="table table-responsive table-bordered">
                     <tr><td>Email Id</td><td><input type="text" name="userid" class="form-control" value="<?php echo $det['email'];?>" readonly></td></tr>
                     <tr><td>Name</td><td><input type="text" name="name" class="form-control" value="<?php echo $det['name'];?>" readonly></td></tr>
                     <tr><td>Balance</td><td><input type="text" name="balance" class="form-control" value="<?php echo $bal;?>" readonly></td></tr>
                     <tr><td>Amount</td><td><input type="text" name="amount" class="form-control" value="<?php echo $chk['points'];?>" required></td></tr>
                     <tr><td>Transaction Code</td><td><input type="text" name="tcode" class="form-control" value="<?php echo $chk['tcode'];?>" required></td></tr>
                     <tr><td>Remarks</td><td><input type="text" name="remarks" class="form-control" value="<?php echo $chk['remarks'];?>" required></td></tr>
                     
                     <tr><td>Status</td><td><input type="radio" name="status" value="Pending" <?php if($chk['status']=='Pending'){ echo "checked";}?>> Pending <input type="radio" name="status" value="Rejected" <?php if($chk['status']=='Rejected'){ echo "checked";}?>>Rejected&nbsp;
                     <input type="radio" name="status" value="Credit" <?php if($chk['status']=='Credit'){ echo "checked";}?>>Credit
                     <input type="hidden" name="hid" value="<?php echo $chk['guid']?>">
                     </td></tr>
                     <tr><td colspan="2"><input type="submit" name="submit" value="Submit" class="btn btn-success"></td></tr>
                     </table>
					 </form>
					
					 <?php }else{
						 ?>
<section class="content">
                   <table class="table table-responsive table-bordered">

                    	<thead>

                          <tr>
                            <th>Sno</th>
                           <th>Amount</th>
                           <th>Date</th>
                            <th>Status</th>
                            <th>Transaction Code</th>
                            <th>Remarks</th>
                            <th>Edit</th>
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

$query_clients="SELECT * FROM `clpwallet` where status='Pending' order by guid desc  Limit $start, $limit ";

$query_clients=mysql_query($query_clients);

$select1="SELECT * FROM `clpwallet` where status='Pending'";

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
                               <td><a href="wallet.php?action=edit&gid=<?php echo $client_count['guid']; ?>">
                               <button class="btn bg-blue">Edit</button></a></td>
                               
                                  </tr>

                          <?php $m++;} ?>

                        </tbody>

                        <tfoot>

                        	<tr>

                            	<th colspan="8"> Showing <?php echo $page;?> of <?php echo $totals;?> Pages </th>

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