<?php ob_start();
session_start();$date=date('Y-m-d');extract($_POST);extract($_GET);
include 'secure.php';include '../../config.php'; 
if(isset($_GET) && $_GET['deleteid']!='')
{
mysql_query("delete from statepart where guid='$_GET[deleteid]'");

header('location:spartners.php');	
}

if(isset($_POST) && $_POST['state']!='' && $_POST['Submit']=='Addstate')
{
	$chk1=mysql_fetch_array(mysql_query("select * from statepart where email='$email'"));
	if($state!='' && $chk1['guid']=='')
	{
mysql_query("INSERT INTO `statepart` (`name` ,`state`,`mobile`,`email`,`password`,`address`,`status`) VALUES ('$name','$state','$mobile','$email','$password','$address','$status')");

	}
	
header('location:spartners.php');	
}

if(isset($_POST) && $_POST['hidid']!='' && $_POST['Submit']=='Updatestate') 
{
mysql_query("update `statepart` set `name`='$name',`state`='$state',`mobile`='$mobile',`email`='$email',`password`='$password',`address`='$address',`status`='$status' where guid='$hidid'");
	
header('location:spartners.php');	
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
                        State Partners
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Admin</li>
                    </ol>
                </section>

                <!-- Main content -->
                <?php if(isset($_GET) && $_GET[action]=='add'){?>
				
				<form action="spartners.php" method="post" name="form1" onSubmit="return valid()" enctype="multipart/form-data">
               <table class="table table-responsive table-bordered">

                     <tr><td>State</td>
                     <td><select class="form-control" name="state" required >
             <option value="">Select State</option>
              <?php $qry=mysql_query("select * from state order by name asc");
			  while($row=mysql_fetch_assoc($qry))
			  {
				echo "<option value='$row[guid]'>$row[name]</option>";  
			  }?>            	 	
			</select></td></tr>
                   <tr><td>State Partner Name</td><td>
                        <input type="text" name="name" class="form-control" placeholder="State Partner Name"/>
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
                    <tr><td>Status</td><td>
                        <input type="radio" name="status"  value="Active" checked/> Active
                        <input type="radio" name="status"  value="InActive"/> InActive
                    </td></tr>
               <tr><td colspan="2">                                                            
                    <button type="submit" name="Submit" value="Addstate" class="btn bg-yellow btn-block">Add State Partner</button>  
                </td></tr></table>
            </form>
				<?php }elseif(isset($_GET) && $_GET['action']=='edit'){
					$det=mysql_fetch_array(mysql_query("select * from statepart where guid='$guid'"));?>
				
				<form action="spartners.php" method="post" name="form1" onSubmit="return valid()">
               <table class="table table-responsive table-bordered">
<tr><td>State</td>
                     <td><select class="form-control" name="state" required >
             <option value="">Select State</option>
              <?php $qry=mysql_query("select * from state order by name asc");
			  while($row=mysql_fetch_assoc($qry))
			  {
				?><option value="<?php echo $row['guid'];?>" <?php if($det['state']==$row['guid']){?> selected<?php }?>><?php echo $row['name'];?></option><?php
			  }?>            	 	
			</select></td></tr>
           
                           <tr><td>State Partner Name</td><td>
                        <input type="text" name="name" class="form-control" placeholder="State Partner Name" value="<?php echo $det['name'];?>"/>
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
                    <tr><td>Status</td><td>
                        <input type="radio" name="status"  value="Active" <?php if($det['status']=='Active'){echo "checked";}?>/> Active
                        <input type="radio" name="status"  value="InActive" <?php if($det['status']=='InActive'){echo "checked";}?>/> InActive
                    </td></tr>
               <tr><td colspan="2">  
               <input type="hidden" name="hidid" value="<?php echo $det['guid'];?>">                                                          
                    <button type="submit" name="Submit" value="Updatestate" class="btn bg-yellow btn-block">Update State Partner</button>  
                </td></tr></table>
            </form><?php }else{?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="spartners.php?action=add"><button type="button" class="btn btn-success">Add State Partner</button></a>
                <section class="content">

				 <!-- top row -->
                   <table class="table table-responsive table-bordered">

                    	<thead>

                          <tr>

                        	

                            <th>Sno</th>
                            <th>State</th>
                            <th>State Partner Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Address</th>
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

$filePath="spartners.php";

if($page) 
{
$start = ($page - 1) * $limit; 			
}
else
{
$start = 0;						
$page=1;
}
$query_clients="SELECT * FROM `statepart`  order by guid desc  Limit $start, $limit ";

$query_clients=mysql_query($query_clients);

$select1="SELECT * FROM `statepart`";

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
								$det=mysql_fetch_array(mysql_query("select * from state where guid='$client_count[state]'"));
								?>

                        	<tr>

                            	<td><?php echo $m; ?></td>

                                 <td><?php echo $det['name'];?></td>
                               <td><?php echo $client_count['name'];?></td>
                               <td><?php echo $client_count['email'];?></td>
                               <td><?php echo $client_count['mobile'];?></td>
                               <td><?php echo $client_count['address'];?></td>
                               <td><?php echo $client_count['status'];?></td>
                               <td><a href="spartners.php?action=edit&guid=<?php echo $client_count['guid']; ?>"><button type="button" class="btn btn-default">Edit</button></a></td>
                                <td><a href="spartners.php?action=delete&deleteid=<?php echo $client_count['guid']; ?>" onClick="return delete1();"><button type="button" class="btn btn-danger">Delete</button></a></td>

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
function subcategories(s)
{//alert(s);
 $.ajax({
  type:"get",
  dataType:"text",
  url:"subcat.php",
  data:  "val="+s,
  success: function(response){
	  $('#subcagtegory').html(response);
  }
 });
}
function subcity(s)
{//alert(s);
 $.ajax({
  type:"get",
  dataType:"text",
  url:"subcity.php",
  data:  "val="+s,
  success: function(response){
	  $('#subcity').html(response);
  }
 });
}
</script>
       <?php include "footer-scripts.php" ?>
    </body>
</html>