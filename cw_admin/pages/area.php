<?php ob_start();
session_start();$date=date('Y-m-d');extract($_POST);extract($_GET);
include 'secure.php';include '../../config.php'; 
if(isset($_GET) && $_GET['deleteid']!='')
{
mysql_query("delete from area where guid='$_GET[deleteid]'");
header('location:area.php');	
}
if(isset($_POST) && $_POST[refid]!='' && $_POST[hidid]=='')
{
	//$chk=mysql_fetch_array(mysql_query("select * from area where email='$email'"));
	if($topic!='' && $refid!='' && $zone!='')
	{//echo "INSERT INTO `area` (`name` ,`refid`,`food`,`store`,`state`,`zone`) VALUES ('$topic','$refid','$food','$store','$state','$zone')";exit;
mysql_query("INSERT INTO `area` (`name` ,`refid`,`food`,`store`,`state`,`zone`,coupons) VALUES ('$topic','$refid','$food','$store','$state','$zone','$coupons')");
	}
	
header('location:area.php');	
}
if(isset($_POST) && $_POST[hidid]!='')
{
mysql_query("update `area` set `name`='$topic',`refid`='$refid',`food`='$food',`store`='$store',coupons='$coupons',`state`='$state',`zone`='$zone' where guid='$hidid'");
header('location:area.php');	
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
                        Area's
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Admin</li>
                    </ol>
                </section>

                <!-- Main content -->
                <?php if(isset($_GET) && $_GET[action]=='add'){?>
				
				<form action="area.php" method="post" name="form1" onSubmit="return valid()" enctype="multipart/form-data">
               <table class="table table-responsive table-bordered">
<tr><td>State</td>
                     <td><select class="form-control" name="state" required onChange="return subzones(this.value);">
             <option value="">Select State</option>
              <?php $qry=mysql_query("select * from state order by name asc");
			  while($row=mysql_fetch_assoc($qry))
			  {
				?><option value='<?php echo $row["guid"];?>' <?php if($det['state']==$row['guid']){?> selected<?php } ?>><?php echo $row['name'];?></option><?php
			  }?>            	 	
			</select></td></tr>
             <tr><td>Zone</td><td><span id="subzones">
                                <select class="form-control" name="zone" required>
             <option value="">Select Zone</option>
			</select></span></td></tr>
                     <tr><td>City</td>
                     <td><span id="subcategory"><select class="form-control" name="refid" required>
             <option value="">Select City</option>

			</select></span></td></tr>     
                    <tr><td>Area</td><td>
                        <input type="text" name="topic" class="form-control" placeholder="Area"/>
                    </td></tr>
                      <tr><td>Available</td><td>
                        <input type="checkbox" name="food" value="yes"/> &nbsp;Food &nbsp;&nbsp;
                        <input type="checkbox" name="store" value="yes"/> &nbsp;Store 
                         <input type="checkbox" name="coupons" value="yes"/> &nbsp;Coupons 
                    </td></tr>
                     
               <tr><td colspan="2">                                                            
                    <button type="submit" name="Submit" value="Update" class="btn bg-yellow btn-block">Add Area</button>  
                </td></tr></table>
            </form>
				<?php }elseif(isset($_GET) && $_GET[action]=='edit'){
					$det=mysql_fetch_array(mysql_query("select * from area where guid='$guid'"));?>
				
				<form action="area.php" method="post" name="form1" onSubmit="return valid()">
               <table class="table table-responsive table-bordered">

                          <tr><td>State</td>
                     <td><select class="form-control" name="state" required onChange="return subzones(this.value);">
             <option value="">Select State</option>
              <?php $qry=mysql_query("select * from state order by name asc");
			  while($row=mysql_fetch_assoc($qry))
			  {
				?><option value='<?php echo $row["guid"];?>' <?php if($det['state']==$row['guid']){?> selected<?php } ?>><?php echo $row['name'];?></option><?php
			  }?>            	 	
			</select></td></tr>
             <tr><td>Zone</td><td><span id="subzones">
                                <select class="form-control" name="zone" required>
             <option value="">Select Zone</option>
              <?php $qry=mysql_query("select * from zone order by name asc");
			  while($row=mysql_fetch_assoc($qry))
			  {
				?><option value='<?php echo $row["guid"];?>' <?php if($det['zone']==$row['guid']){?> selected<?php } ?>><?php echo $row['name'];?></option><?php
			  }?>            	 	
			</select></span></td></tr>
            <tr><td>City</td>
                     <td><span id="subcategory"><select class="form-control" name="refid" required>
             <option value="">Select City</option>
              <?php $qry=mysql_query("select * from city where refid='$det[state]' order by name asc");
			  while($row=mysql_fetch_assoc($qry))
			  {
				?><option value='<?php echo $row["guid"];?>' <?php if($det['refid']==$row['guid']){?> selected<?php } ?>><?php echo $row['name'];?></option><?php
			  }?>            	 	
			</select></span></td></tr>
           
            <tr><td>Area</td><td>
                        <input type="text" name="topic" class="form-control" placeholder="Area" value="<?php echo $det['name'];?>"/>
                    </td></tr>
                             
                     <tr><td>Available</td><td>
                        <input type="checkbox" name="food" value="yes" <?php if($det['food']=='yes'){?> checked<?php }?>/> &nbsp;Food &nbsp;&nbsp;
                        <input type="checkbox" name="store" value="yes" <?php if($det['store']=='yes'){?> checked<?php }?>/> &nbsp;Store &nbsp;&nbsp;
                        <input type="checkbox" name="coupons" value="yes" <?php if($det['coupons']=='yes'){?> checked<?php }?> /> &nbsp;Coupons 
                    </td></tr>
                   
               <tr><td colspan="2">  
               <input type="hidden" name="hidid" value="<?php echo $det['guid'];?>">                                                          
                    <button type="submit" name="Submit" value="Update" class="btn bg-yellow btn-block">Update Area</button>  
                </td></tr></table>
            </form><?php }else{?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="area.php?action=add"><button type="button" class="btn btn-success">Add Area</button></a>
                <section class="content">
<form method="get" action="area.php"><table class="table table-responsive table-bordered">
                   <tr><td><input type="text" class="form-control" name="area" placeholder="Area Name" required  value="<?php echo $area;?>"> 
			 </td>
            <td><button type="submit" name="Search" value="Search" class="btn btn-warning">Search</button></td></tr></table></form>
				 <!-- top row -->
                   <table class="table table-responsive table-bordered">

                    	<thead>

                          <tr>

                        	

                            <th>Sno</th>
                            <th>State</th>
                            <th>Zone</th>
                            <th>City</th>
                            <th>Area</th>
                            <th>Food</th>
                            
                            <th>Store</th>
                            <th>Coupons</th>
                            <th>Edit</th>
 <th>Delete</th>
                           
                           </tr>

                        </thead>

                        <tbody>

                         <?php 
include 'pageing.php';
						    $gridId = $_GET[guid];
							$limit = 90; 								

$filePath="area.php";

if($page) 
{
$start = ($page - 1) * $limit; 			
}
else
{
$start = 0;						
$page=1;
}

if($Search!='')
{
$query_clients="SELECT * FROM `area` where name LIKE '%$area%'  order by guid desc  Limit $start, $limit ";
$select1="SELECT * FROM `area` where name LIKE '%$area%'";	
}
else{
$query_clients="SELECT * FROM `area`  order by guid desc  Limit $start, $limit ";
$select1="SELECT * FROM `area`";
}

$query_clients=mysql_query($query_clients);

$total=mysql_num_rows(mysql_query($select1));

$otherParams="area=$area&Search=$Search";

@$divs=$total%$limit;

	if($divs==0)

	{

	@$totals=(int)($total/$limit);

	}else{

	@$totals=(int)($total/$limit) + 1;

	}$m=1;
						    while($client_count = mysql_fetch_assoc($query_clients)){
								$det3=mysql_fetch_array(mysql_query("select * from zone where guid='$client_count[zone]'"));
								$det2=mysql_fetch_array(mysql_query("select * from state where guid='$client_count[state]'"));
								$det=mysql_fetch_array(mysql_query("select * from city where guid='$client_count[refid]'"));?>

                        	<tr>

                            	<td><?php echo $m; ?></td>
<td><?php echo $det2['name'];?></td>
<td><?php echo $det3['name'];?></td>
                                 <td><?php echo $det['name'];?></td>
                                  <td><?php echo $client_count['name'];?></td>
                                   <td><?php if($client_count['food']!=''){echo $client_count['food'];}else{echo "No";}?></td>
                                    <td><?php if($client_count['store']!=''){echo $client_count['store'];}else{echo "No";}?></td>
                                <td><?php if($client_count['coupons']!=''){echo $client_count['coupons'];}else{echo "No";}?></td>
                               <td><a href="area.php?action=edit&guid=<?php echo $client_count['guid']; ?>"><button type="button" class="btn btn-default">Edit</button></a></td>
                                <td><a href="area.php?action=delete&deleteid=<?php echo $client_count['guid']; ?>" onClick="return delete1();"><button type="button" class="btn btn-danger">Delete</button></a></td>

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
                       

                    </ul></section><?php } ?>
            </aside><!-- /.right-side -->
        </div>
        <!-- ./wrapper -->
        <!-- add new calendar event modal -->
       <?php include "footer-scripts.php" ?>
       <script>
	   function subzones(s)
{//alert(s);
 $.ajax({
  type:"get",
  dataType:"text",
  url:"subzones.php",
  data:  "val="+s,
  success: function(response){
	  $('#subzones').html(response);
  }
 });
}
function subcategories(s)
{//alert(s);
 $.ajax({
  type:"get",
  dataType:"text",
  url:"foodarea.php",
  data:  "val="+s,
  success: function(response){
	  $('#subcategory').html(response);
  }
 });
}
</script>
    </body>
</html>