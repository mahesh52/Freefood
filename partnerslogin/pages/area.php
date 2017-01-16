<?php ob_start();
session_start();$date=date('Y-m-d');extract($_GET);
include 'secure.php';include '../../config.php'; 
$details=mysql_fetch_array(mysql_query("select * from cluster where guid='$_SESSION[partner_loginid]'"));
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
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       Area's
                        
                    </h1>
                    
                </section>

                   <table class="table table-responsive table-bordered">
                    	<thead>
                          <tr>
                            <th>Sno</th>
                            <th>Area's</th>
                           </tr>
                        </thead>
                        <tbody>
                         <?php 
$query_clients="SELECT * FROM `area` where clp='$_SESSION[partner_loginid]' order by guid desc ";
$select1="SELECT * FROM `area` where clp='$_SESSION[partner_loginid]'";
$query_clients=mysql_query($query_clients);
$total=mysql_num_rows(mysql_query($select1));
	$m=1;
						    while($client_count = mysql_fetch_assoc($query_clients)){
?>

                        	<tr>

                            	<td><?php echo $m; ?></td>
                               <td>
                               <?php echo $client_count['name'];?></td>
                              
                            </tr>

                          <?php $m++;} ?>

                        </tbody>

                      

                    </table>
                    </section>
            </aside>
			
            <!-- /.right-side -->
        </div>
        <!-- ./wrapper -->
        <!-- add new calendar event modal -->
        
       <?php include "footer-scripts.php" ?>
    </body>
</html>