<?php ob_start();
session_start();$date=date('Y-m-d');extract($_POST);extract($_GET);
include 'secure.php';include '../../config.php'; 
if(isset($_GET) && $_GET[deleteid]!='')
{
mysql_query("delete from zone where guid='$_GET[deleteid]'");
header('location:zone.php');	
}
if(isset($_POST) && $_POST[event]!='' && $_POST[hidid]=='')
{
mysql_query("INSERT INTO `zone` (`name`,`refid`) VALUES ('$event','$refid')");
header('location:zone.php');	
}
if(isset($_POST) && $_POST[hidid]!='')
{
mysql_query("update `zone` set `name`='$event',`refid`='$refid' where guid='$hidid'");
header('location:zone.php');	
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
                       Zones
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Admin</li>
                    </ol>
                </section>

                <!-- Main content -->
                <?php if(isset($_GET) && $_GET[action]=='add'){?>
				
				<form action="zone.php" method="post" name="form1" onSubmit="return valid()">
               <table class="table table-responsive table-bordered">
 <tr><td>State</td>
                     <td><select class="form-control" name="refid" required>
             <option value="">Select State</option>
              <?php $qry=mysql_query("select * from state order by name asc");
			  while($row=mysql_fetch_assoc($qry))
			  {
				?><option value='<?php echo $row["guid"];?>'><?php echo $row['name'];?></option><?php
			  }?>            	 	
			</select></td></tr>
                          <tr><td>Zone</td><td>
                        <input type="text" name="event" class="form-control" placeholder="Zone Name"/>
                    </td></tr>
                             
                    
               <tr><td>&nbsp;</td><td>                                                            
                    <button type="submit" name="Submit" value="Update" class="btn bg-yellow btn-block">Add Zone Name</button>  
                </td></tr></table>
            </form>
				<?php }elseif(isset($_GET) && $_GET[action]=='edit'){
					$det=mysql_fetch_array(mysql_query("select * from zone where guid='$guid'"));?>
				
				<form action="zone.php" method="post" name="form1" onSubmit="return valid()">
               <table class="table table-responsive table-bordered">
 <tr><td>State</td>
                     <td><select class="form-control" name="refid" required>
             <option value="">Select State</option>
              <?php $qry=mysql_query("select * from state order by name asc");
			  while($row=mysql_fetch_assoc($qry))
			  {
				?><option value='<?php echo $row["guid"];?>' <?php if($det['refid']==$row['guid']){?> selected<?php } ?>><?php echo $row['name'];?></option><?php
			  }?>            	 	
			</select></td></tr>
                          <tr><td>Zone</td><td>
                        <input type="text" name="event" class="form-control" placeholder="Zone Name" value="<?php echo $det['name'];?>"/>
                    </td></tr>
                             
                    
               <tr><td>&nbsp;</td><td>  
               <input type="hidden" name="hidid" value="<?php echo $det[guid];?>">                                                          
                    <button type="submit" name="Submit" value="Update" class="btn bg-yellow btn-block">Update Zone Name</button>  
                </td></tr></table>
            </form><?php }else{?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="zone.php?action=add"><button type="button" class="btn btn-success">Add Zone</button></a>
                <section class="content">

				 <!-- top row -->
                   <table class="table table-responsive table-bordered">

                    	<thead>

                          <tr>

                        	

                            <th>Sno</th>
                            <th>State</th>
                            <th>Zone</th>
                            
                            <th>Edit</th>
 <th>Delete</th>
                           
                           </tr>

                        </thead>

                        <tbody>

                         <?php 
include 'pageing.php';
						    $gridId = $_GET[guid];
							$limit = 90; 								
$filePath="zone.php";

if($page) 
{
$start = ($page - 1) * $limit; 			
}
else
{
$start = 0;						

$page=1;
}
$query_clients="SELECT * FROM `zone`  order by guid desc  Limit $start, $limit ";

$query_clients=mysql_query($query_clients);

$select1="SELECT * FROM `zone`";

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
								$check=mysql_fetch_array(mysql_query("select * from state where guid='$client_count[refid]'"));
								?>

                        	<tr>

                            	<td><?php echo $m; ?></td>
<td><?php echo $check['name'];?></td>
                                <td><?php echo $client_count['name'];?></td>
                               
                               <td><a href="zone.php?action=edit&guid=<?php echo $client_count['guid']; ?>"><button type="button" class="btn btn-default">Edit</button></a></td>
                                <td><a href="zone.php?action=delete&deleteid=<?php echo $client_count['guid']; ?>" onClick="return delete1();"><button type="button" class="btn btn-danger">Delete</button></a></td>

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