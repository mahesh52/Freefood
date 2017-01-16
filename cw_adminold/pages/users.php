<?php ob_start();
session_start();
include 'secure.php';include '../../config.php'; 
if(isset($_GET) && $_GET[deleteid]!='')
{
mysql_query("delete from register where guid='$_GET[deleteid]'");
header('location:users.php');	
}
?><!DOCTYPE html>
<html>
         <?php include "styles-files.php";
		 ?>
         <script type="text/javascript">
		 function delete1()
{
  if(window.confirm("Confirm delete"))
  {
  return true;
   }
 else
   return false;
}
		 </script>
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
                        Registered Users
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Admin</li>
                    </ol>
                </section>
<?php 
extract($_GET);include 'pageing.php';
						    $gridId = $_GET[guid];
							$limit = 90; 								
$filePath="users.php";
if($page) 
{
$start = ($page - 1) * $limit; 			
}
else
{
$start = 0;						


$page=1;
}
//echo "select * from cat  Limit $start, $limit";
if($fromdate!='' && $todate!='' && $userid!='')
{$from=date('Y-m-d',strtotime($fromdate));$to=date('Y-m-d',strtotime($todate));
$query_clients="SELECT * FROM `register` where (date Between '$from' and '$to') and (name LIKE '%$userid%' || mobile LIKE '%$userid%' || email LIKE '%$userid%') order by guid desc  Limit $start, $limit ";
$select1="SELECT * FROM `register` where (date Between '$from' and '$to') and (name LIKE '%$userid%' || mobile LIKE '%$userid%' || email LIKE '%$userid%')";	
}
elseif($fromdate!='' && $todate!='')
{$from=date('Y-m-d',strtotime($fromdate));$to=date('Y-m-d',strtotime($todate));
$query_clients="SELECT * FROM `register` where (date Between '$from' and '$to') and (name LIKE '%$userid%' || mobile LIKE '%$userid%' || email LIKE '%$userid%') order by guid desc  Limit $start, $limit ";
$select1="SELECT * FROM `register` where (date Between '$from' and '$to') and (name LIKE '%$userid%' || mobile LIKE '%$userid%' || email LIKE '%$userid%')";
}elseif($userid!='')
{
$query_clients="SELECT * FROM `register` where (name LIKE '%$userid%' || mobile LIKE '%$userid%' || email LIKE '%$userid%')  order by guid desc  Limit $start, $limit ";
$select1="SELECT * FROM `register` where (name LIKE '%$userid%' || mobile LIKE '%$userid%' || email LIKE '%$userid%')";
}
else
{
$query_clients="SELECT * FROM `register`  order by guid desc  Limit $start, $limit ";
$select1="SELECT * FROM `register`";
}

$query_clients=mysql_query($query_clients);
$total=mysql_num_rows(mysql_query($select1));

$otherParams="fromdate=$fromdate&todate=$todate&description=$description&search=Search";

@$divs=$total%$limit;

	if($divs==0)

	{

	@$totals=(int)($total/$limit);

	}else{

	@$totals=(int)($total/$limit) + 1;

	}?>
                <!-- Main content -->
                <section class="content">
<form name="form1" method="get" action="users.php">
<table class="table table-responsive table-bordered">
<tr><td> <input type="text" name="userid" class="form-control" placeholder="Name / Email ID / Mobile" value="<?php echo $userid; ?>"/></td>
<td> <input type="text" name="fromdate" class="form-control datepicker" placeholder="From Date" value="<?php echo $fromdate; ?>"/></td>
<td> <input type="text" name="todate" class="form-control datepicker" placeholder="To Date" value="<?php echo $todate; ?>"/></td>
                        <td>
                       <td><button type="submit" name="search" value="Search" class="btn btn-success">Search</button></td></tr></table></form>
				 <!-- top row -->
                   <table class="table table-responsive table-bordered">

                    	<thead>

                          <tr>

                        	

                            <th>Sno</th>
                            <th>Name</th>
                           <th>Email</th>
                           <th>Mobile</th>
                           <th>Points Earned</th>
                           <th>Redeemed</th>
                           <th>Balance</th>
                           <th>Virtual Amount Earned</th>
                           <th>Redeemed</th>
                           <th>Balance</th>
                           
                           </tr>

                        </thead>

                        <tbody>

                         <?php $m=1;$s1=0;$s2=0;$s3=0;$s4=0;$bal=0;$bal1=0;
						    while($client_count = mysql_fetch_assoc($query_clients)){$timing='';
		if($fromdate!='' && $todate!='')
			{
		$credit=mysql_fetch_array(mysql_query("select sum(points) from wallet where userid='$client_count[guid]' and status='Credit' and (date Between '$from' and '$to')"));
		$debit=mysql_fetch_array(mysql_query("select sum(points) from wallet where userid='$client_count[guid]' and status='Debit' and (date Between '$from' and '$to')"));
		$wat=$credit[0]-$debit[0];
		$credit1=mysql_fetch_array(mysql_query("select sum(points) from virtualwallet where userid='$client_count[guid]' and status='Credit' and (date Between '$from' and '$to')"));
		$debit1=mysql_fetch_array(mysql_query("select sum(points) from virtualwallet where userid='$client_count[guid]' and status='Debit' and (date Between '$from' and '$to')"));
		$wat1=$credit1[0]-$debit1[0];
			}
			else
			{
			$credit=mysql_fetch_array(mysql_query("select sum(points) from wallet where userid='$client_count[guid]' and status='Credit'"));
		$debit=mysql_fetch_array(mysql_query("select sum(points) from wallet where userid='$client_count[guid]' and status='Debit'"));
		$wat=$credit[0]-$debit[0];	
		$credit1=mysql_fetch_array(mysql_query("select sum(points) from virtualwallet where userid='$client_count[guid]' and status='Credit'"));
		$debit1=mysql_fetch_array(mysql_query("select sum(points) from virtualwallet where userid='$client_count[guid]' and status='Debit'"));
		$wat1=$credit1[0]-$debit1[0];
			}
								//$check=mysql_fetch_array(mysql_query("select * from register where guid='$client_count[referral]'"));
								 
					  ?>

                        	<tr>

                            	<td><?php echo $m; ?></td>

                                <td><?php echo $client_count['name'];?></td>

                               <td><?php echo $client_count['email']; ?></td>
                               <td><?php echo $client_count['mobile']; ?></td>
                               <td><?php if($credit[0]==''){echo "0";}else{echo $credit[0];$s1=$s1+$credit[0];}?></td>
                               <td><?php if($debit[0]==''){echo "0";}else{echo $debit[0];$s2=$s2+$debit[0];}?></td>
                               <td><?php $bal=$bal+$wat;echo $wat;?></td>
                               <td><?php if($credit1[0]==''){echo "0";}else{echo $credit1[0];$s3=$s3+$credit1[0];}?></td>
                               <td><?php if($debit1[0]==''){echo "0";}else{echo $debit1[0];$s4=$s4+$debit1[0];}?></td>
                               <td><?php $bal1=$bal1+$wat1;echo $wat1;?></td>
                                </tr>

                          <?php $m++;} ?>
<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td><strong>Total : </strong></td><td><strong><?php echo $s1;?></strong></td>
<td><strong><?php echo $s2;?></strong></td>
<td><strong><?php echo $bal;?></strong></td>
<td><strong><?php echo $s3;?></strong></td>
<td><strong><?php echo $s4;?></strong></td>
<td><strong><?php echo $bal1;?></strong></td></tr>
                        </tbody>

                        <tfoot>

                        	<tr>

                            	<th colspan="12"> Showing <?php echo $page;?> of <?php echo $totals;?> Pages </th>

                            </tr>

                        </tfoot>

                    </table>
                     <ul class="pagination">

                       <?php make_pages($page,$limit,$total,$filePath,$otherParams); ?>
                       

                    </ul></section>
            </aside><!-- /.right-side -->
        </div>
        <!-- ./wrapper -->
        <!-- add new calendar event modal -->
       <?php include "footer-scripts.php" ?>
    </body>
</html>