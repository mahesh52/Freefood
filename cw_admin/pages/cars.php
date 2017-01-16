<?php ob_start();
session_start();
include 'secure.php';include '../../config.php'; 
extract($_GET);
extract($_POST);
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
    <div class="modal fade" id="comments" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content header-success">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4  id="myModalLabel"> Estimates</h4>
              </div>
              <div class="modal-body" id="task_updates"></div>
               
            </div>
          </div>
        </div>
        <div class="modal fade" id="likes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content header-success">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4  id="myModalLabel"> Liked Dealers</h4>
              </div>
              <div class="modal-body" id="est_likes"></div>
               
            </div>
          </div>
        </div>
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
                        Cars
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Admin</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
<div><form name="form1" method="post" action="cars.php">
                                    <div class="col-sm-12 col-xs-12"><div class="col-sm-3">
                        <input type="text" class="form-control search-date" name="fromdate" placeholder="From Date" value="<?php echo $fromdate?>">
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control search-date" name="todate" placeholder="To Date" value="<?php echo $todate;?>">
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control" name="status">
                        <option value="Active" <?php if($status=='Active'){?>selected<?php } ?>>Active</option>
                        <option value="InActive" <?php if($status=='InActive'){?>selected<?php } ?>>InActive</option>
                        <option value="Closed" <?php if($status=='Closed'){?>selected<?php } ?>>Closed</option></select>
                    </div>
                     <div class="col-sm-3">
                        <button type="submit" class="btn btn-warning" name="search" value="Search">Search</button>
                    </div>
                    </div><div class="clearfix">&nbsp;</div>
                                 
                          </form></div>
				 <!-- top row -->
                   <table class="table table-responsive table-bordered">

                    	<thead>

                          <tr>

                        	

                            <th>Sno</th>
                            <th>Car Make</th>

                           <th>Car Model</th>
                           <th>Specification</th>
                           
                           <th>Postcode</th>
						  
                           <th>Added On</th>
                           <th>Seller Details</th>
                            <th>Status</th>
                             <th>Estimates</th>
                             <th>Liked Dealers</th>
                           </tr>

                        </thead>

                        <tbody>

                         <?php 

include 'pageing.php';
						    $gridId = $_GET[guid];
							$limit = 90; 								
$filePath="cars.php";
if($page) 
{
$start = ($page - 1) * $limit; 			
}
else
{
$start = 0;						
$page=1;
}
if($search!='')
{
 if($fromdate!=''){$from = date('Y-m-d',strtotime($_POST['fromdate']));}
if($todate!=''){$to = date('Y-m-d',strtotime($_POST['todate']));}
if($from!='' && $to!='')
{
 $var="(date Between '$from' and '$to') and status='$status'";
}
else
{
$var="status='$status'";	
}
$query_clients="SELECT * FROM `cars` where $var order by guid desc  Limit $start, $limit ";
$select1="SELECT * FROM `cars` where $var";
}
else
{
$query_clients="SELECT * FROM `cars` where status='Active' order by guid desc  Limit $start, $limit ";
$select1="SELECT * FROM `cars` where status='Active'";
}

$query_clients=mysql_query($query_clients);
$total=mysql_num_rows(mysql_query($select1));

$otherParams="fromdate=$fromdate&todate=$todate&status=$status";

@$divs=$total%$limit;

	if($divs==0)

	{

	@$totals=(int)($total/$limit);

	}else{

	@$totals=(int)($total/$limit) + 1;

	}$m=1;
						  if($total>0){  while($row = mysql_fetch_assoc($query_clients)){
							$car_make=mysql_fetch_array(mysql_query("select * from car_make where guid='$row[car_make]'"));
	  $car_model=mysql_fetch_array(mysql_query("select * from car_model where guid='$row[car_model]'"));
	   $estimates=mysql_num_rows(mysql_query("select * from estimates where car_id='$row[guid]'"));
	   $like=mysql_num_rows(mysql_query("select * from estimates where car_id='$row[guid]' and like_status='Yes'"));
	   $input=mysql_fetch_array(mysql_query("select * from buyer where guid='$row[refid]'"));
								 
				if($status=='Closed'){$dealer=mysql_fetch_array(mysql_query("select * from buyer where guid='$row[dealer]'"));}  ?>

                        	<tr>

                            	<td><?php echo $m; ?></td>

                                <td><?php echo $car_make[name];?></td>

                               <td><?php echo $car_model[name]; ?></td>
                               <td><span title="<?php echo $row[specification]; ?>"><?php if(strlen($row[specification])>30){echo substr($row[specification],0,30);echo "...";}else{echo $row[specification];}?></span></td>
                               <td><?php echo $row[pincode]; ?></td>
                               
                                <td><?php echo date('d M Y',strtotime($row['date'])); ?></td>
                                <td><?php echo $input[name];echo "<br>";
								echo $input[email];echo "<br>";
								echo $input[mobile]; ?></td>
                                <td><?php echo $row[status];echo "&nbsp;";
								if($status=='Closed'){echo "<br>(";echo $dealer[name];echo "&nbsp;";echo $dealer[lname];echo "<br>";
								echo $dealer[email];echo "<br>";
								echo $dealer[mobile];echo ")";} ?></td>
                                <td><span title="<?php echo $row[task];?>" class="comments" data-guid='<?php echo $row[guid];?>' style='cursor:pointer' data-toggle="modal" data-target="#comments"><?php echo $estimates; ?></span></td>
                                <td><span title="<?php echo $row[task];?>" class="likes" data-guid='<?php echo $row[guid];?>' style='cursor:pointer' data-toggle="modal" data-target="#likes"><?php echo $like; ?></span></td>
                                </tr>

                          <?php $m++;} ?>

                        </tbody>

                        <tfoot>

                        	<tr>

                            	<th colspan="6"> Showing <?php echo $page;?> of <?php echo $totals;?> Pages - Total : <?php echo $total;?> Records </th>

                            </tr>

                        </tfoot>
<?php }else{ ?>
										  <tr><td colspan="10" align="center">No Records</td></tr>
                                          <?php } ?>
                    </table>
                     <?php if($total>0){?><ul class="pagination">

                       <?php make_pages($page,$limit,$total,$filePath,$otherParams); ?>
                       

                    </ul><?php }?></section>
            </aside><!-- /.right-side -->
        </div>
        <!-- ./wrapper -->
        <!-- add new calendar event modal -->
       <?php include "footer-scripts.php" ?>
        <script src="../js/bootstrap-datepicker.js"></script>
       <script>
		 $('body').on('click','.comments',function(){
					var gid=$(this).data('guid');
					$.ajax({
					   type:"post",
					   dataType:"text",
					   url:"ajaxPages/ajax_comment.php",
					   data:  "guid="+gid,
					   success: function(response){
						  $('#task_updates').html(response);
						   }
					});
				});
				$('body').on('click','.likes',function(){
					var gid=$(this).data('guid');
					$.ajax({
					   type:"post",
					   dataType:"text",
					   url:"ajaxPages/ajax_like.php",
					   data:  "guid="+gid,
					   success: function(response){
						  $('#est_likes').html(response);
						   }
					});
				});
		   $('.search-date').datepicker({
			  todayHighlight: true
		  });
       </script>
       <script src="../js/mycalender/date.js" type="text/javascript"></script>
       <script src="../js/mycalender/my-calender-jquery.js" type="text/javascript"></script>
    </body>
     
</html>