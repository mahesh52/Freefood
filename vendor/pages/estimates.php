<?php ob_start();
session_start();
include 'secure.php';include '../../config.php'; 

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
                        Estimates
                        
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
                            <th>Car Make</th>

                           <th>Car Model</th>
                           <th>Amount</th>
                           
                           <th>Seller Details</th>
						   <th>Dealer Details</th>
                           
                           
                           </tr>

                        </thead>

                        <tbody>

                         <?php 
extract($_GET);include 'pageing.php';
						   
							$limit = 90; 								
$filePath="estmates.php";

if($page) 
{
$start = ($page - 1) * $limit; 			
}
else
{
$start = 0;						
$page=1;
}
$query_clients="SELECT * FROM `estimates` order by guid desc  Limit $start, $limit ";

$query_clients=mysql_query($query_clients);

$select1="SELECT * FROM `estimates`";

$total=mysql_num_rows(mysql_query($select1));

$otherParams="";

@$divs=$total%$limit;

	if($divs==0)

	{

	@$totals=(int)($total/$limit);

	}else{

	@$totals=(int)($total/$limit) + 1;

	}$m=1;
						    while($row = mysql_fetch_assoc($query_clients)){
							$car=mysql_fetch_array(mysql_query("select * from cars where guid='$row[car_id]'"));
							$car_make=mysql_fetch_array(mysql_query("select * from car_make where guid='$car[car_make]'"));
	  $car_model=mysql_fetch_array(mysql_query("select * from car_model where guid='$car[car_model]'"));
	  $est=mysql_fetch_array(mysql_query("select * from buyer where guid='$row[refid]'"));
	  $input=mysql_fetch_array(mysql_query("select * from buyer where guid='$car[refid]'"));
								 
					  ?>

                        	<tr>

                            	<td><?php echo $m; ?></td>

                                <td><?php echo $car_make[name];?></td>

                               <td><?php echo $car_model[name]; ?></td>
                               <td><?php echo $row[amount]; ?></td>
                                <td><?php echo $input[name];echo "<br>";
								echo $input[email];echo "<br>";
								echo $input[mobile]; ?></td>
                               <td><?php echo $est[name];echo "&nbsp;";echo $est[lname];echo "<br>";
							   echo $est[email];echo "<br>";
							   echo $est[mobile]; ?></td>
                              
                                </tr>

                          <?php $m++;} ?>

                        </tbody>

                        <tfoot>

                        	<tr>

                            	<th colspan="6"> Showing <?php echo $page;?> of <?php echo $totals;?> Pages </th>

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