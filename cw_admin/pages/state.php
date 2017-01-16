<?php ob_start();
session_start();$date=date('Y-m-d');extract($_POST);extract($_GET);
include 'secure.php';include '../../config.php'; 
if(isset($_GET) && $_GET[deleteid]!='')
{
mysql_query("delete from state where guid='$_GET[deleteid]'");
header('location:state.php');	
}
if(isset($_POST) && $_POST[event]!='' && $_POST[hidid]=='')
{
mysql_query("INSERT INTO `state` (`name`) VALUES ('$event')");
header('location:state.php');	
}
if(isset($_POST) && $_POST[hidid]!='')
{
mysql_query("update `state` set `name`='$event' where guid='$hidid'");
header('location:state.php');	
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
                       States
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Admin</li>
                    </ol>
                </section>

                <!-- Main content -->
                <?php if(isset($_GET) && $_GET[action]=='add'){?>
				
				<form action="state.php" method="post" name="form1" onSubmit="return valid()">
               <table class="table table-responsive table-bordered">

                          <tr><td>
                        <input type="text" name="event" class="form-control" placeholder="State Name"/>
                    </td></tr>
                             
                    
               <tr><td>                                                            
                    <button type="submit" name="Submit" value="Update" class="btn bg-yellow btn-block">Add State Name</button>  
                </td></tr></table>
            </form>
				<?php }elseif(isset($_GET) && $_GET[action]=='edit'){
					$det=mysql_fetch_array(mysql_query("select * from state where guid='$guid'"));?>
				
				<form action="state.php" method="post" name="form1" onSubmit="return valid()">
               <table class="table table-responsive table-bordered">

                          <tr><td>
                        <input type="text" name="event" class="form-control" placeholder="State Name" value="<?php echo $det[name];?>"/>
                    </td></tr>
                             
                    
               <tr><td>  
               <input type="hidden" name="hidid" value="<?php echo $det[guid];?>">                                                          
                    <button type="submit" name="Submit" value="Update" class="btn bg-yellow btn-block">Update State Name</button>  
                </td></tr></table>
            </form><?php }else{?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="state.php?action=add"><button type="button" class="btn btn-success">Add State</button></a>
                <section class="content">

				 <!-- top row -->
                   <table class="table table-responsive table-bordered">

                    	<thead>

                          <tr>

                        	

                            <th>Sno</th>
                            <th>State</th>
                            
                            <th>Edit</th>
 <th>Delete</th>
                           
                           </tr>

                        </thead>

                        <tbody>

                         <?php 
include 'pageing.php';
						    $gridId = $_GET[guid];
							$limit = 90; 								
$filePath="state.php";

if($page) 
{
$start = ($page - 1) * $limit; 			
}
else
{
$start = 0;						

$page=1;
}
$query_clients="SELECT * FROM `state`  order by guid desc  Limit $start, $limit ";

$query_clients=mysql_query($query_clients);

$select1="SELECT * FROM `state`";

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
								//$check=mysql_fetch_array(mysql_query("select * from state where guid='$client_count[referral]'"));
								?>

                        	<tr>

                            	<td><?php echo $m; ?></td>

                                <td><?php echo $client_count[name];?></td>
                               
                               <td><a href="state.php?action=edit&guid=<?php echo $client_count[guid]; ?>"><button type="button" class="btn btn-default">Edit</button></a></td>
                                <td><a href="state.php?action=delete&deleteid=<?php echo $client_count[guid]; ?>" onClick="return delete1();"><button type="button" class="btn btn-danger">Delete</button></a></td>

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
                       

                    </ul></section><?php } ?>
            </aside><!-- /.right-side -->
        </div>
        <!-- ./wrapper -->
        <!-- add new calendar event modal -->
       <?php include "footer-scripts.php" ?>
    </body>
</html>