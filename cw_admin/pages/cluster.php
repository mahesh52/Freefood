<?php ob_start();
session_start();$date=date('Y-m-d');extract($_POST);extract($_GET);
include 'secure.php';include '../../config.php'; 
if(isset($_GET) && $_GET['deleteid']!='')
{
mysql_query("update area set clp='' where clp='$_GET[deleteid]'");
mysql_query("delete from cluster where guid='$_GET[deleteid]'");

header('location:cluster.php');	
}
if(isset($_GET) && $_GET['del']!='')
{
mysql_query("update area set clp='' where guid='$_GET[del]'");
header('location:cluster.php');	
}
if(isset($_POST) && $_POST['state']!='' && $_POST['Submit']=='Addcluster')
{
	$chk1=mysql_fetch_array(mysql_query("select * from cluster where email='$email'"));
	if($state!='' && $chk1['guid']=='')
	{
mysql_query("INSERT INTO `cluster` (`name` ,`state`,`city`,`mobile`,`email`,`password`,`address`,`areas`,`zonal`,`town`,`status`,`minbal`) VALUES ('$name','$state','$city','$mobile','$email','$password','$address','Pending','$zonal','$town','$status','$minbal')");
$ins=mysql_insert_id();

for($i=0;$i<count($areas);$i++)
	{
		//if($i<5){
	$chk=mysql_fetch_array(mysql_query("select * from area where guid='$areas[$i]'"));
	if($chk['clp']=='')
	{
	
      mysql_query("update  `area` set clp='$ins' where guid='$areas[$i]'");
	}
	//}
	}
	}
	
header('location:cluster.php');	
}

if(isset($_POST) && $_POST['hidid']!='' && $_POST['Submit']=='Updatecluster') 
{
mysql_query("update `cluster` set `name`='$name',`state`='$state',`city`='$city',`mobile`='$mobile',`email`='$email',`password`='$password',`address`='$address',zonal='$zonal',town='$town',status='$status',minbal='$minbal' where guid='$hidid'");
$cls=mysql_num_rows(mysql_query("select * from area where clp='$hidid'"));
for($i=0;$i<count($areas);$i++)
	{
	//if($cls<5)
	//{
		$chk=mysql_fetch_array(mysql_query("select * from area where guid='$areas[$i]'"));
	
	if($chk['clp']=='')
	{
	
      mysql_query("update  `area` set clp='$hidid' where guid='$areas[$i]'");
	//$cls++;
	}
	//}
	}
	
header('location:cluster.php');	
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
                        Clusters
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Admin</li>
                    </ol>
                </section>

                <!-- Main content -->
                <?php if(isset($_GET) && $_GET[action]=='add'){?>
				
				<form action="cluster.php" method="post" name="form1" onSubmit="return valid()" enctype="multipart/form-data">
               <table class="table table-responsive table-bordered">

                     <tr><td>State Partner</td>
                     <td><select class="form-control" name="state" required onChange="return subzone(this.value);">
             <option value="">Select State Partner</option>
              <?php $qry=mysql_query("select * from statepart order by name asc");
			  while($row=mysql_fetch_assoc($qry))
			  {
				echo "<option value='$row[guid]'>$row[name]</option>";  
			  }?>            	 	
			</select></td></tr>
             <tr><td>Zonal Partner</td>
                     <td><span id="subzone"><select class="form-control" name="zonal" required onChange="return subcity(this.value);">
             <option value="">Select Zonal Partner</option>
              </select></span></td></tr>
              <tr><td>Town Partner</td>
                     <td><span id="subcity"><select class="form-control" name="town" required onChange="return subtown(this.value);">
             <option value="">Select Town Partner</option>
              </select></span></td></tr>
              
              
            <tr><td>Area</td>
                     <td><span id="subtown"><select class="form-control" name="area" required>
             <option value="">Select Area</option>
                        	 	
			</select></span></td></tr>     
                     <tr><td>Cluster Name</td><td>
                        <input type="text" name="name" class="form-control" placeholder="Cluster Name"/>
                    </td></tr>
                    <tr><td>Mobile</td><td>
                        <input type="text" name="mobile" class="form-control" placeholder="Mobile"/>
                    </td></tr>
                    <tr><td>Email Id</td><td>
                        <input type="email" name="email" class="form-control" placeholder="Email ID"/>
                    </td></tr>
                    <tr><td>Password</td><td>
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                    </td></tr>
                    <tr><td>Address</td><td>
                        <input type="text" name="address" class="form-control" placeholder="Address"/>
                    </td></tr>
                     <tr><td>Minumum Balance</td><td>
                        <input type="text" name="minbal" class="form-control" placeholder="Minumum Balance"/>
                    </td></tr>
                    <tr><td>Status</td><td>
                        <input type="radio" name="status"  value="Active" checked/> Active
                        <input type="radio" name="status"  value="InActive"/> InActive
                    </td></tr>
               <tr><td colspan="2">                                                            
                    <button type="submit" name="Submit" value="Addcluster" class="btn bg-yellow btn-block">Add Cluster</button>  
                </td></tr></table>
            </form>
				<?php }elseif(isset($_GET) && $_GET['action']=='edit'){
					$det=mysql_fetch_array(mysql_query("select * from cluster where guid='$guid'"));?>
				
				<form action="cluster.php" method="post" name="form1" onSubmit="return valid()">
               <table class="table table-responsive table-bordered">


<tr><td>State Partner</td>
                     <td><select class="form-control" name="state" required onChange="return subzone(this.value);">
             <option value="">Select State Partner</option>
              <?php $qry=mysql_query("select * from statepart order by name asc");
			  while($row=mysql_fetch_assoc($qry))
			  {
				?><option value="<?php echo $row['guid'];?>" <?php if($det['state']==$row['guid']){?> selected<?php } ?>><?php echo $row['name'];?></option><?php  
			  }?>            	 	
			</select></td></tr>
           <tr><td>Zonal Partner</td>
                     <td><span id="subzone"><select class="form-control" name="zonal" required onChange="return subcity(this.value);">
             <option value="">Select Zonal Partner</option>
              <?php $qry=mysql_query("select * from zonal where state='$det[state]' order by name asc");
			  while($row=mysql_fetch_assoc($qry))
			  {
				?><option value="<?php echo $row['guid'];?>" <?php if($det['zonal']==$row['guid']){?> selected<?php } ?>><?php echo $row['name'];?></option><?php
			  }?>            	 	
			</select></span></td></tr>
             <tr><td>Town Partner</td>
                     <td><span id="subcity"><select class="form-control" name="town" required onChange="return subtown(this.value);">
             <option value="">Select Town Partner</option>
              <?php 
			 
			  $qry=mysql_query("select * from town where zonal='$det[zonal]' order by name asc");
			  while($row=mysql_fetch_assoc($qry))
			  {
				?><option value="<?php echo $row['guid'];?>" <?php if($det['town']==$row['guid']){?> selected<?php } ?>><?php echo $row['name'];?></option><?php
			  }?>            	 	
			</select></span></td></tr>
            
          
            <tr><td>Add Area's</td>
                     <td><span id="subtown">  <?php $m=0;
					  $st=mysql_fetch_array(mysql_query("select * from town where guid='$det[town]'"));
					 $news1=mysql_query("select * from area where refid='$st[city]' and clp='' order by name asc ");

while ($state=mysql_fetch_assoc($news1)) {$m++;
if($m%8==0){echo "<br>";}?><label>
<input type="checkbox" name="areas[]" value="<?php echo $state['guid'];?>"><?php echo $state['name'];?></label>&nbsp;
                <?php } ?></span></td></tr>
           
                    <tr><td>Cluster Name</td><td>
                        <input type="text" name="name" class="form-control" placeholder="Cluster Name" value="<?php echo $det['name'];?>"/>
                    </td></tr>
                    <tr><td>Mobile</td><td>
                        <input type="text" name="mobile" class="form-control" placeholder="Mobile" value="<?php echo $det['mobile'];?>"/>
                    </td></tr>
                    <tr><td>Email Id</td><td>
                        <input type="email" name="email" class="form-control" placeholder="Email ID" value="<?php echo $det['email'];?>"/>
                    </td></tr>
                    <tr><td>Password</td><td>
                        <input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo $det['password'];?>"/>
                    </td></tr>
                    <tr><td>Address</td><td>
                        <input type="text" name="address" class="form-control" placeholder="Address" value="<?php echo $det['address'];?>"/>
                    </td></tr>
                    <tr><td>Minumum Balance</td><td>
                        <input type="text" name="minbal" class="form-control" placeholder="Minumum Balance" value="<?php echo $det['minbal'];?>"/>
                    </td></tr>
                    <tr><td>Status</td><td>
                        <input type="radio" name="status"  value="Active" <?php if($det['status']=='Active'){echo "checked";}?>/> Active
                        <input type="radio" name="status"  value="InActive" <?php if($det['status']=='InActive'){echo "checked";}?>/> InActive
                    </td></tr>
               <tr><td colspan="2">  
               <input type="hidden" name="hidid" value="<?php echo $det['guid'];?>">                                                          
                    <button type="submit" name="Submit" value="Updatecluster" class="btn bg-yellow btn-block">Update Cluster</button>  
                </td></tr></table>
            </form><?php }else{?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="cluster.php?action=add"><button type="button" class="btn btn-success">Add Cluster</button></a>
                <section class="content">

				 <!-- top row -->
                   <table class="table table-responsive table-bordered">

                    	<thead>

                          <tr>

                        	

                            <th>Sno</th>
                            <th>Town Partner</th>
                            <th>Cluster Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Area's</th>
                            <th>Min Balance</th>
                            <th>Status</th>
                            <th>Edit</th>
 <th>Delete</th>
                           
                           </tr>

                        </thead>

                        <tbody>

                         <?php 
include 'pageing.php';
						    $gridId = $_GET[guid];
							$limit = 90; 								

$filePath="cluster.php";

if($page) 
{
$start = ($page - 1) * $limit; 			
}
else
{
$start = 0;						
$page=1;
}
$query_clients="SELECT * FROM `cluster`  order by guid desc  Limit $start, $limit ";

$query_clients=mysql_query($query_clients);

$select1="SELECT * FROM `cluster`";

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
								$det=mysql_fetch_array(mysql_query("select * from town where guid='$client_count[town]'"));
								$chk=mysql_query("select * from area where clp='$client_count[guid]'");?>

                        	<tr>

                            	<td><?php echo $m; ?></td>

                                 <td><?php echo $det['name'];?></td>
                               <td><?php echo $client_count['name'];?></td>
                               <td><?php echo $client_count['email'];?></td>
                               <td><?php echo $client_count['mobile'];?></td>
                               <td>
                               
                               <?php  $j=0;while($csk = mysql_fetch_assoc($chk)){$j++;?>
                               <a href="cluster.php?action=del&del=<?php echo $csk['guid'];?>" onClick="return delete1();"><?php echo $j;echo ". "; echo $csk['name'];?></a><?php echo "<br>";}?></td>
                               <td><?php echo $client_count['minbal']; ?></td>
                               <td><?php echo $client_count['status'];?></td>
                               <td><a href="cluster.php?action=edit&guid=<?php echo $client_count['guid']; ?>"><button type="button" class="btn btn-default">Edit</button></a></td>
                                <td><a href="cluster.php?action=delete&deleteid=<?php echo $client_count['guid']; ?>" onClick="return delete1();"><button type="button" class="btn btn-danger">Delete</button></a></td>

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
        <script>
function subzone(s)
{//alert(s);
 $.ajax({
  type:"get",
  dataType:"text",
  url:"subzone1.php",
  data:  "val="+s,
  success: function(response){
	  $('#subzone').html(response);
  }
 });
}
function subcity(s)
{//alert(s);
 $.ajax({
  type:"get",
  dataType:"text",
  url:"subzone3.php",
  data:  "val="+s,
  success: function(response){
	  $('#subcity').html(response);
  }
 });
}
function subtown(s)
{//alert(s);
 $.ajax({
  type:"get",
  dataType:"text",
  url:"subzone4.php",
  data:  "val="+s,
  success: function(response){
	  $('#subtown').html(response);
  }
 });
}
</script>
       <?php include "footer-scripts.php" ?>
    </body>
</html>