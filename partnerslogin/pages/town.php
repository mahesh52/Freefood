<?php ob_start();
session_start();$date=date('Y-m-d');extract($_GET);
include 'secure.php';include '../../config.php'; 
$details=mysql_fetch_array(mysql_query("select * from zonal where guid='$_SESSION[partner_loginid]'"));
?><!DOCTYPE html>
<html>
         <?php include "styles-files.php";
		 ?>
       <script>
function goBack() {
    window.history.back();
}
</script>  
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
       	 <?php include "header.php"; ?>
		 <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
         	<?php include "side-nav.php"; ?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <?php if($_GET['view']!='' && $_GET['view']=='clp'){?>
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       <button type="button" class="btn btn-success" onclick="goBack()">Back</button> 
                       <?php 
					$town=mysql_fetch_array(mysql_query("select * from zone where guid='$_GET[zone]'"));
					?>  <?php echo $town['name'];?> <small>Town Partners</small> > <small>Cluster Partners</small>
                        
                    </h1>
                    
                </section>

                   <table class="table table-responsive table-bordered">
                    	<thead>
                          <tr>
                            <th>Sno</th>
                            <th>Cluster Partner Name</th>
                            <th>Area's</th>
                           </tr>
                        </thead>
                        <tbody>
                         <?php 
$query_clients="SELECT * FROM `cluster` where town='$_GET[clp]' order by guid desc ";
$select1="SELECT * FROM `cluster` where town='$_GET[clp]'";
$query_clients=mysql_query($query_clients);
$total=mysql_num_rows(mysql_query($select1));
	$m=1;
						    while($client_count = mysql_fetch_assoc($query_clients)){
								$det=mysql_fetch_array(mysql_query("select * from city where guid='$client_count[city]'"));
								$chk=mysql_query("select * from area where clp='$client_count[guid]'");?>

                        	<tr>

                            	<td><?php echo $m; ?></td>
                               <td><?php echo $client_count['name'];?></td>
                               <td><?php  $j=0;while($csk = mysql_fetch_assoc($chk)){$j++;?>
                               <?php echo $j;echo ". "; echo $csk['name'];?><?php echo "<br>";}?></td>
                              
                            </tr>

                          <?php $m++;} ?>

                        </tbody>

                      

                    </table>
                    </section>
            </aside>
			<?php }else {
				
				?>
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       <button type="button" class="btn btn-success" onclick="goBack()">Back</button> 
					   <?php 
					$town=mysql_fetch_array(mysql_query("select * from zone where guid='$details[zone]'"));
					?> <?php echo $town['name'];?> <small>Town Partners</small>
                        
                    </h1>
                    
                </section>

                   <table class="table table-responsive table-bordered">
                    	<thead>
                          <tr>
                            <th>Sno</th>
                            <th>Town</th>
                            <th>Town Partner Name</th>
                            <th>View Partners</th>
                           </tr>
                        </thead>
                        <tbody>
                         <?php 
						 
$query_clients="SELECT * FROM `town` where zonal='$_SESSION[partner_loginid]' order by guid desc ";
$select1="SELECT * FROM `town` where zonal='$_SESSION[partner_loginid]'";
$query_clients=mysql_query($query_clients);
$total=mysql_num_rows(mysql_query($select1));
	if($total>0){$m=1;
						    while($client_count = mysql_fetch_assoc($query_clients)){
								$det=mysql_fetch_array(mysql_query("select * from city where guid='$client_count[city]'"));
								$chk=mysql_num_rows(mysql_query("select * from cluster where town='$client_count[guid]'"));?>

                        	<tr>

                            	<td><?php echo $m; ?></td>

                                 <td><?php echo $det['name'];?></td>
                               <td><?php echo $client_count['name'];?></td>
                              <td><a href="town.php?view=clp&zone=<?php echo $details['zone'];?>&clp=<?php echo $client_count['guid'];?>">Cluster Partners : <?php echo $chk;?></a></td>
                               

                            </tr>

                          <?php $m++;}}else{?><tr><td colspan="4" align="center">No Records</td></tr><?php } ?>

                        </tbody>

                      

                    </table>
                    </section>
            </aside><?php 
				}
					?>
            <!-- /.right-side -->
        </div>
        <!-- ./wrapper -->
        <!-- add new calendar event modal -->
        
       <?php include "footer-scripts.php" ?>
    </body>
</html>