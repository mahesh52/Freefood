<?php ob_start();
session_start();
include 'secure.php';include '../../config.php'; 
if(isset($_GET) && $_GET['action']=='delete')
{ 
	mysql_query("delete from videos where guid='$_GET[guid]'");
	header("location:videos.php");

}?><!DOCTYPE html>
<html>
<script>
	function delete1()

{

  if(window.confirm("Confirm delete"))

  {

  return true;

  }
 else
 return false;

}</script>
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
                        Admin 
                        <small>Control panel</small>
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
                            <th>Video</th>

                           <th>Posted By</th>
                           <th>Date</th>
                            <th>Delete</th>
                          
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

$filePath="videos.php";
$page=1;
//echo "select * from cat  Limit $start, $limit";

$query_clients="SELECT * FROM `videos`  order by guid desc  Limit $start, $limit ";

$query_clients=mysql_query($query_clients);

$select1="SELECT * FROM `videos`";

$total=mysql_num_rows(mysql_query($select1));

$otherParams="";

@$divs=$total%$limit;

	if($divs==0)

	{

	@$totals=(int)($total/$limit);

	}else{

	@$totals=(int)($total/$limit) + 1;

	}$m=1;
						    while($client_count = mysql_fetch_assoc($query_clients)){
								$check=mysql_fetch_array(mysql_query("select * from register where guid='$client_count[refid]'"));
								$date=strtotime($client_count[date]);?>

                        	<tr>

                            	<td><?php echo $m; ?></td>

                                <td><iframe width="100" height="100" src="https://www.youtube.com/embed/<?php echo $client_count[video];?>" frameborder="0" allowfullscreen></iframe><br><?php echo $client_count[video_title];?></td>

                               <td><?php echo $check[name];echo "<br>";echo $check[mobile];echo "<br>";echo $check[email]; ?></td>
                               <td><?php echo date('d M Y',$date); ?></td>
                               <td><a href="videos.php?action=delete&guid=<?php echo $client_count[guid];?>" onClick="return delete1()">
        <img src="../../assets/images/delete.jpg"></a></td>
                               

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