<?php ob_start();
session_start();extract($_POST);extract($_GET);
include 'secure.php';include '../../config.php'; 
if(isset($_POST) && $_POST['hid']!='')
{//print_r($_POST);//	exit;
	
mysql_query("update comwallet set pstatus='$pstatus',points='$points',tcode='$tcode',remarks='$remarks' where guid='$hid'");
header('location:withdrawls.php');	
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
                        Withdrawals 
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
					 $check=mysql_fetch_array(mysql_query("select * from comwallet where guid='$_GET[gid]'"));
					 if($check['description']=='Town Partner'){
						  $det=mysql_fetch_array(mysql_query("select * from town where guid='$check[userid]'"));}
					  if($check['description']=='Zonal Partner'){
						  $det=mysql_fetch_array(mysql_query("select * from zonal where guid='$check[userid]'"));}
					  if($check['description']=='State Partner'){
						  $det=mysql_fetch_array(mysql_query("select * from statepart where guid='$check[userid]'"));}
						  if($check['description']=='Cluster Partner'){
						  $det=mysql_fetch_array(mysql_query("select * from cluster where guid='$check[userid]'"));}
					 ?>
                 <form name="form1" method="post" action="withdrawls.php">
					 <table class="table table-responsive table-bordered">
                     <tr><td>Email Id</td><td><input type="text" name="userid" class="form-control" value="<?php echo $det['email'];?>" readonly></td></tr>
                     <tr><td>Name</td><td><input type="text" name="name" class="form-control" value="<?php echo $det['name'];?>" readonly></td></tr>
                     <tr><td>Amount</td><td><input type="text" name="points" class="form-control" value="<?php echo $check['points'];?>" required></td></tr>
                     <tr><td>Transaction Code</td><td><input type="text" name="tcode" class="form-control" value="<?php echo $check['tcode'];?>"></td></tr>
                     <tr><td>Remarks</td><td><input type="text" name="remarks" class="form-control" value="<?php echo $check['remarks'];?>"></td></tr>
                     <tr><td>Status</td><td><input type="radio" name="pstatus" value="Pending" <?php if($check['pstatus']=='Pending'){ echo "checked";}?>> Pending <input type="radio" name="pstatus" value="Transfered" <?php if($check['pstatus']=='Transfered'){ echo "checked";}?>>Transfered
                     <input type="hidden" name="hid" value="<?php echo $check['guid']?>">
                     <input type="hidden" name="userid" value="<?php echo $det['guid']?>">
                     </td></tr>
                     <tr><td colspan="2"><input type="submit" name="submit" value="Submit" class="btn btn-success"></td></tr>
                     </table>
					 </form>
					 <?php }else{?>
                   <table class="table table-responsive table-bordered">

                    	<thead>

                          <tr>

                        	

                            <th>Sno</th>
                            <th>Email Id</th>
                             <th>Name</th>
                          
                           <th>Amount</th>
                           <th>Date</th>
                            <th>Status</th>
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

$filePath="withdrawls.php";
$page=1;
//echo "select * from cat  Limit $start, $limit";

$query_clients="SELECT * FROM `comwallet` where status='Debit'  order by guid desc  Limit $start, $limit ";

$query_clients=mysql_query($query_clients);

$select1="SELECT * FROM `comwallet` where status='Debit'";

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
								if($client_count['description']=='Town Partner'){
						  $det=mysql_fetch_array(mysql_query("select * from town where guid='$client_count[userid]'"));}
					  if($client_count['description']=='Zonal Partner'){
						  $det=mysql_fetch_array(mysql_query("select * from zonal where guid='$client_count[userid]'"));}
					  if($client_count['description']=='State Partner'){
						  $det=mysql_fetch_array(mysql_query("select * from statepart where guid='$client_count[userid]'"));}
						  if($client_count['description']=='Cluster Partner'){
						  $det=mysql_fetch_array(mysql_query("select * from cluster where guid='$client_count[userid]'"));}
						  
								?>

                        	<tr>

                            	<td><?php echo $m; ?></td>
								<td><?php echo $det['email']; ?></td>
                                <td><?php echo $det['name']; ?> </td>

                               <td><?php echo $client_count['points']; ?></td>
                              
                               <td><?php echo $client_count['date']; ?></td>
                               <td><?php echo $client_count['pstatus']; ?></td>
                               <td><a href="withdrawls.php?action=edit&gid=<?php echo $client_count['guid']; ?>">
                               <button class="btn bg-blue">Edit</button></a></td>

                            </tr>

                          <?php $m++;} ?>

                        </tbody>

                        <tfoot>

                        	<tr>

                            	<th colspan="10"> Showing <?php echo $page;?> of <?php echo $totals;?> Pages </th>

                            </tr>

                        </tfoot>
                        

                    </table>
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