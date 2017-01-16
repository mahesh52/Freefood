<?php ob_start();
session_start();extract($_POST);extract($_GET);
include 'secure.php';include '../../config.php'; $date=date('Y-m-d');





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
                       Commissions
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Admin</li>
                    </ol>
                </section>

                <!-- Main content -->
                
                <section class="content">
<form name="form1" method="get" action="coms.php">
<table class="table table-responsive table-bordered">
<tr><td> <input type="text" name="fromdate" class="form-control datepicker" placeholder="From Date" value="<?php echo $fromdate; ?>"/></td>
<td> <input type="text" name="todate" class="form-control datepicker" placeholder="To Date" value="<?php echo $todate; ?>"/></td>
<td>
                       <td><button type="submit" name="search" value="Search" class="btn btn-success">Search</button></td></tr></table></form>
				 <!-- top row -->
                 
                 <?php include 'pageing.php';
						    $gridId = $_GET[guid];
							$limit = 90; 								

$filePath="coms.php";

if($page) 
{
$start = ($page - 1) * $limit; 			
}
else
{
$start = 0;						
$page=1;
}
if($fromdate!='' && $todate!='')
{$from=date('Y-m-d',strtotime($fromdate));$to=date('Y-m-d',strtotime($todate));
$query_clients="SELECT * FROM `comwallet` where (date Between '$from' and '$to') and userid='$_SESSION[partner_loginid]' and description='$_SESSION[partner_status]' order by guid desc  Limit $start, $limit ";
$select1="SELECT * FROM `comwallet` where (date Between '$from' and '$to') and userid='$_SESSION[partner_loginid]' and description='$_SESSION[partner_status]'";
$cmn="SELECT sum(points) FROM `comwallet` where (date Between '$from' and '$to') and userid='$_SESSION[partner_loginid]' and description='$_SESSION[partner_status]'";	
}
else
{
$query_clients="SELECT * FROM `comwallet` where userid='$_SESSION[partner_loginid]' and description='$_SESSION[partner_status]' order by guid desc  Limit $start, $limit ";
$select1="SELECT * FROM `comwallet` where userid='$_SESSION[partner_loginid]' and description='$_SESSION[partner_status]'";
$cmn="SELECT sum(points) FROM `comwallet` where userid='$_SESSION[partner_loginid]' and description='$_SESSION[partner_status]'";
}

$query_clients=mysql_query($query_clients);

$total=mysql_num_rows(mysql_query($select1));
$commission=mysql_fetch_array(mysql_query($cmn));

$otherParams="fromdate=$fromdate&todate=$todate&description=$description&search=Search";

@$divs=$total%$limit;

	if($divs==0)

	{

	@$totals=(int)($total/$limit);

	}else{

	@$totals=(int)($total/$limit) + 1;

	}?><p><strong>Total Commission Amount : <?php if($commission[0]==''){echo "0";}else{echo $commission[0];}?>/-</strong></p>
                   <table class="table table-responsive table-bordered">

                    	<thead>

                          <tr>

                        	

                            <th>Sno</th>
                            <th>User Id </th>
                            <th>Description</th>
                            <th>Commission</th>
                           <th>Updated On</th>
                           </tr>

                        </thead>

                        <tbody>

                         <?php 
$m=1;
						    while($client_count = mysql_fetch_assoc($query_clients)){
	if($client_count['description']=='Town Partner'){$chk=mysql_fetch_array(mysql_query("select * from town where guid='$client_count[userid]'"));}
	if($client_count['description']=='Zonal Partner'){$chk=mysql_fetch_array(mysql_query("select * from zonal where guid='$client_count[userid]'"));}
	if($client_count['description']=='State Partner'){$chk=mysql_fetch_array(mysql_query("select * from statepart where guid='$client_count[userid]'"));}
	?>

                        	<tr>

                            	<td><?php echo $m; ?></td>
                                 <td><?php if($client_count['userid']==0){echo "Company";}else{echo $chk['name'];}?></td>
                                 <td><?php echo $client_count['description'];?></td>
                                 <td><?php echo $client_count['points'];?></td>
                              <td><?php echo date('d M Y',strtotime($client_count['date']));?></td>
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
                       

                    </ul></section>
            </aside><!-- /.right-side -->
        </div>
        <!-- ./wrapper -->
        <!-- add new calendar event modal -->
       
       <?php include "footer-scripts.php" ?>
    </body>
</html>