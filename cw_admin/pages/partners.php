<?php ob_start();
session_start();
include 'secure.php';include '../../config.php'; 
if(isset($_GET) && $_GET[deleteid]!='')
{
mysql_query("delete from register where guid='$_GET[deleteid]'");
header('location:partners.php');	
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
                        Partner Requests
                        
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
                            <th>Area</th>
                            <th>Contact Details</th>
							<th>Role</th>
                           <th>Address</th>
                           <th>Message</th>
                           <th>Registered On</th>
                           
                           </tr>

                        </thead>

                        <tbody>

                         <?php 
extract($_GET);include 'pageing.php';
						    $gridId = $_GET[guid];
							$limit = 90; 								
$filePath="partners.php";
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

$query_clients="SELECT * FROM `partners`  order by guid desc  Limit $start, $limit ";

$query_clients=mysql_query($query_clients);

$select1="SELECT * FROM `partners`";

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
							
								$city=mysql_fetch_array(mysql_query("select * from city where guid='$client_count[city]'"));
								$state=mysql_fetch_array(mysql_query("select * from state where guid='$client_count[state]'"));
								$area=mysql_fetch_array(mysql_query("select * from area where guid='$client_count[area]'"));
								 
					  ?>

                        	<tr>

                            	<td><?php echo $m; ?></td>
                                <td><?php echo $state['name'];echo "<br>";echo $city['name'];echo "<br>"; echo $area['name'];?></td>

                                <td><?php echo $client_count['name'];echo "<br>"; echo $client_count['email'];  echo "<br>"; echo $client_count['mobile']; ?></td>
                               <td><?php echo $client_count['role']; ?></td>
                               <td><?php echo $client_count['address']; ?></td>
                               <td><?php echo $client_count['message']; ?></td>
                               <td><?php echo date('d M Y', strtotime($client_count['date'])); ?></td>
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