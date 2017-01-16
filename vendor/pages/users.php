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

                <!-- Main content -->
                <section class="content">

				 <!-- top row -->
                   <table class="table table-responsive table-bordered">

                    	<thead>

                          <tr>

                        	

                            <th>Sno</th>
                            <th>Name</th>

                           <th>Email</th>
                           <th>Mobile</th>
                           <th>Registered On</th>
                           <th>Points Earned</th>
                           <th>Redeemed</th>
                           <th>Balance</th>
                           
                           </tr>

                        </thead>

                        <tbody>

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

$query_clients="SELECT * FROM `register`  order by guid desc  Limit $start, $limit ";

$query_clients=mysql_query($query_clients);

$select1="SELECT * FROM `register`";

$total=mysql_num_rows(mysql_query($select1));

$otherParams="";

@$divs=$total%$limit;

	if($divs==0)

	{

	@$totals=(int)($total/$limit);

	}else{

	@$totals=(int)($total/$limit) + 1;

	}$m=1;
						    while($client_count = mysql_fetch_assoc($query_clients)){$timing='';
							$credit=mysql_fetch_array(mysql_query("select sum(points) from wallet where userid='$client_count[guid]' and status='Credit'"));
				$debit=mysql_fetch_array(mysql_query("select sum(points) from wallet where userid='$client_count[guid]' and status='Debit'"));
				$wat=$credit[0]-$debit[0];
								//$check=mysql_fetch_array(mysql_query("select * from register where guid='$client_count[referral]'"));
								 
					  ?>

                        	<tr>

                            	<td><?php echo $m; ?></td>

                                <td><?php echo $client_count[name];?></td>

                               <td><?php echo $client_count[email]; ?></td>
                               <td><?php echo $client_count[mobile]; ?></td>
                               <td><?php echo date('d M Y', strtotime($client_count['date'])); ?></td>
                               <td><?php if($credit[0]==''){echo "0";}else{echo $credit[0];}?></td>
                               <td><?php if($debit[0]==''){echo "0";}else{echo $debit[0];}?></td>
                               <td><?php echo $wat;?></td>
                                </tr>

                          <?php $m++;} ?>

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