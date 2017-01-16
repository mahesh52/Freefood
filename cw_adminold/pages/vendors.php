<?php ob_start();
session_start();$date=date('Y-m-d');extract($_POST);extract($_GET);
include 'secure.php';include '../../config.php'; 
if(isset($_GET) && $_GET['deleteid']!='')
{
mysql_query("delete from vendor where guid='$_GET[deleteid]'");
header('location:vendors.php');	
}
if(isset($_POST) && $_POST['state']!='' && $_POST['Submit']=='Addvendor')
{$area='';
	$chk=mysql_fetch_array(mysql_query("select * from vendor where email='$email'"));
	if($state!='' && $chk['guid']=='')
	{
		for($i=0;$i<count($areas);$i++)
	{
	$chk=mysql_fetch_array(mysql_query("select * from area where guid='$areas[$i]'"));
	if($areas[$i]!='')
	{
	$area.=$areas[$i].',';
	}
	}
mysql_query("INSERT INTO `vendor` (`name` ,`state`,`area`,`mobile`,`email`,`password`,`address`,`pstatus`,`status`,`zonal`,`town`,`prebook`) VALUES ('$name','$state','$area','$mobile','$email','$password','$address','Pending','$status','$zonal','$town','$prebook')");


	}
	
header('location:vendors.php');	
}

if(isset($_POST) && $_POST['hidid']!='' && $_POST['Submit']=='Updatevendor') 
{$area='';
	for($i=0;$i<count($areas);$i++)
	{
	$chk=mysql_fetch_array(mysql_query("select * from area where guid='$areas[$i]'"));
	if($areas[$i]!='')
	{
	$area.=$areas[$i].',';
	}
	}
mysql_query("update `vendor` set `name`='$name',`state`='$state',`area`='$area',`mobile`='$mobile',`email`='$email',`password`='$password',`address`='$address',`status`='$status',`zonal`='$zonal',`town`='$town',`prebook`='$prebook' where guid='$hidid'");
header('location:vendors.php');	
}

if(isset($_POST) && $_POST['submit']=='Update')
{
	//print_r($_POST);
	for($i=0;$i<count($product_id);$i++)
	{
	$chk=mysql_fetch_array(mysql_query("select * from vendor_products where vendor_id='$gid' and product_id='$product_id[$i]'"));
	if($chk['guid']=='')
	{
	if($price[$i]>0)
	{
      mysql_query("INSERT INTO  `vendor_products` (`vendor_id` ,`product_id` ,`price` ,`date`) VALUES ('$gid',  '$product_id[$i]',  '$price[$i]',  '$date')");
	}
	}
	else
	{
		
	 mysql_query("update `vendor_products`set `price`='$price[$i]' where guid='$chk[guid]'");	
	}
	}
	mysql_query("update `vendor`set `pstatus`='$pstatus' where guid='$gid'");
	?><script>
alert("Updated Successfully");
window.location='vendors.php';
</script><?php 	
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
                        Food Vendors
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Admin</li>
                    </ol>
                </section>

                <!-- Main content -->
                <?php if(isset($_GET) && $_GET[action]=='add'){?>
				
				<form action="vendors.php" method="post" name="form1" onSubmit="return valid()" enctype="multipart/form-data">
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
                     <td><span id="subcity"><select class="form-control" name="town" required onChange="return subcategories(this.value);">
             <option value="">Select Town Partner</option>
              </select></span></td></tr>
            <tr><td>Area</td>
                     <td><span id="subcagtegory"><select class="form-control" name="city" required>
             <option value="">Select Area</option>
                        	 	
			</select></span></td></tr>     
                     <tr><td>Vendor Name</td><td>
                        <input type="text" name="name" class="form-control" placeholder="Vendor Name" required/>
                    </td></tr>
                    <tr><td>Mobile</td><td>
                        <input type="text" name="mobile" class="form-control" placeholder="Mobile" required/>
                    </td></tr>
                    <tr><td>Email Id</td><td>
                        <input type="email" name="email" class="form-control" placeholder="Email ID" required/>
                    </td></tr>
                    <tr><td>Password</td><td>
                        <input type="password" name="password" class="form-control" placeholder="Password" required/>
                    </td></tr>
                    <tr><td>Address</td><td>
                        <input type="text" name="address" class="form-control" placeholder="Address"/>
                    </td></tr>
                    <tr><td>Pre Booking Vendor</td><td>
                        <input type="radio" name="prebook"  value="Yes" /> Yes
                        <input type="radio" name="prebook"  value="No" checked/> No
                    </td></tr>
                     <tr><td>Status</td><td>
                        <input type="radio" name="status"  value="Active" checked/> Active
                        <input type="radio" name="status"  value="InActive" /> InActive
                    </td></tr>
               <tr><td colspan="2">                                                            
                    <button type="submit" name="Submit" value="Addvendor" class="btn bg-yellow btn-block">Add Vendor</button>  
                </td></tr></table>
            </form>
				<?php }elseif(isset($_GET) && $_GET['action']=='products'){
					$vendor=mysql_fetch_array(mysql_query("select * from vendor where guid='$_GET[gid]'"));?>
                <form method="post" action="vendors.php">
                 <table class="table table-responsive table-bordered">

                    	<thead>

                          <tr>

                        	

                            <th>Vendor Name : <?php echo $vendor['name'];?></th><th>
                Mobile : <?php echo $vendor['mobile'];?></th><th>
                Email Id : <?php echo $vendor['email'];?></th></tr></thead></table>
            <table class="table table-responsive table-bordered">

                    	<thead>

                          <tr>

                        	

                            <th>Sno</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Product Name</th>
                            <th>Min Selling Price</th>
                            <th>Price</th>
                             </tr>

                        </thead>

                        <tbody>

                         <?php
 
$query_clients="SELECT * FROM `products` order by guid desc  ";

$select1="SELECT * FROM `products`";
$query_clients=mysql_query($query_clients);

$total=mysql_num_rows(mysql_query($select1));

$m=1;
						    while($client_count = mysql_fetch_assoc($query_clients)){
								$chk=mysql_fetch_array(mysql_query("select * from vendor_products where vendor_id='$_GET[gid]' and product_id='$client_count[guid]'"));
								if($chk['price']!=''){$price=$chk['price'];}else{$price=0;}
								$cat=mysql_fetch_array(mysql_query("select * from category where guid='$client_count[category]'"));
								$foodcat=mysql_fetch_array(mysql_query("select * from foodcategory where guid='$client_count[subcategory]'"));
								$pname=str_replace("*_*","'",$client_count['name']);
					?>

                        	<tr>

                            	<td><?php echo $m; ?></td>

                                 <td><?php echo $cat['name'];?></td>
                                 <td><?php echo $foodcat['name'];?></td>
                                  <td><?php echo $pname;?></td>
                                  <td><?php echo $client_count['sprice'];?></td>
                                  <td><input type="number" name="price[]" value="<?php echo $price;?>">
                                  <input type="hidden" name="product_id[]" value="<?php echo $client_count['guid'];?>">
                                  <input type="hidden" name="min_price[]" value="<?php echo $client_count['sprice'];?>">
                                  <input type="hidden" name="gid" value="<?php echo $vendor['guid'];?>"></td>
                                </tr>

                          <?php $m++;} ?>
<tr><td colspan="10">Status : <input type="radio" name="pstatus" value="Pending" required <?php if($vendor['pstatus']=='Pending'){?> checked<?php } ?>> Pending 
<input type="radio" name="pstatus" value="Accepted" required <?php if($vendor['pstatus']=='Accepted'){?> checked<?php } ?>> Accepted</td></tr>
<tr><td colspan="10"><button type="submit" name="submit" value="Update" class="btn btn-success">Update</button></td></tr>
                        </tbody>

                       

                    </table></form>
					<?php }elseif(isset($_GET) && $_GET['action']=='edit'){
					$det=mysql_fetch_array(mysql_query("select * from vendor where guid='$guid'"));?>
				
				<form action="vendors.php" method="post" name="form1" onSubmit="return valid()">
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
                     <td><span id="subcity"><select class="form-control" name="town" required onChange="return subcategories(this.value);">
             <option value="">Select Town Partner</option>
              <?php 
			 
			  $qry=mysql_query("select * from town where zonal='$det[zonal]' order by name asc");
			  while($row=mysql_fetch_assoc($qry))
			  {
				?><option value="<?php echo $row['guid'];?>" <?php if($det['town']==$row['guid']){?> selected<?php } ?>><?php echo $row['name'];?></option><?php
			  }?>            	 	
			</select></span></td></tr>
            <tr><td>Area</td>
                     <td><span id="subcagtegory">
                     <?php $spt=split(',',$det['area']);$m=0;
					 $st=mysql_fetch_array(mysql_query("select * from town where guid='$det[town]'"));
					 $news1=mysql_query("select * from area where refid='$st[city]' order by name asc ");
while ($state=mysql_fetch_assoc($news1)) {$m++;
if($m%8==0){echo "<br>";}?><label>
<input type="checkbox" name="areas[]" value="<?php echo $state['guid'];?>" <?php if(in_array($state['guid'],$spt)){?> checked<?php } ?>><?php echo $state['name'];?></label>&nbsp;
                <?php } ?></span></td></tr>
           
                    <tr><td>Vendor Name</td><td>
                        <input type="text" name="name" class="form-control" placeholder="Vendor Name" value="<?php echo $det['name'];?>" required/>
                    </td></tr>
                    <tr><td>Mobile</td><td>
                        <input type="text" name="mobile" class="form-control" placeholder="Mobile" value="<?php echo $det['mobile'];?>" required/>
                    </td></tr>
                    <tr><td>Email Id</td><td>
                        <input type="email" name="email" class="form-control" placeholder="Email ID" value="<?php echo $det['email'];?>" required/>
                    </td></tr>
                    <tr><td>Password</td><td>
                        <input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo $det['password'];?>" required/>
                    </td></tr>
                    <tr><td>Address</td><td>
                        <input type="text" name="address" class="form-control" placeholder="Address" value="<?php echo $det['address'];?>"/>
                    </td></tr>
                    <tr><td>Pre Booking Vendor</td><td>
                        <input type="radio" name="prebook"  value="Yes" <?php if($det['prebook']=='Yes'){echo "checked";}?>/> Yes
                        <input type="radio" name="prebook"  value="No" checked <?php if($det['prebook']=='No'){echo "checked";}?>/> No
                    </td></tr>
                     <tr><td>Status</td><td>
                        <input type="radio" name="status"  value="Active" <?php if($det['status']=='Active'){echo "checked";}?>/> Active
                        <input type="radio" name="status"  value="InActive" <?php if($det['status']=='InActive'){echo "checked";}?>/> InActive
                    </td></tr>
               <tr><td colspan="2">  
               <input type="hidden" name="hidid" value="<?php echo $det['guid'];?>">                                                          
                    <button type="submit" name="Submit" value="Updatevendor" class="btn bg-yellow btn-block">Update Vendor</button>  
                </td></tr></table>
            </form><?php }else{?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="vendors.php?action=add"><button type="button" class="btn btn-success">Add Vendor</button></a>
                <section class="content">

				 <!-- top row -->
                   <table class="table table-responsive table-bordered">

                    	<thead>

                          <tr>

                        	

                            <th>Sno</th>
                            <th>Town Partner</th>
                            <th>Area's</th>
                            <th>Vendor Details</th>
                            <th>Status</th>
                            <th>Products</th>
                            <th>Product Status</th>
                            <th>Edit</th>
 <th>Delete</th>
                           
                           </tr>

                        </thead>

                        <tbody>

                         <?php 
include 'pageing.php';
						    $gridId = $_GET[guid];
							$limit = 90; 								

$filePath="vendors.php";

if($page) 
{
$start = ($page - 1) * $limit; 			
}
else
{
$start = 0;						
$page=1;
}
$query_clients="SELECT * FROM `vendor`  order by guid desc  Limit $start, $limit ";

$query_clients=mysql_query($query_clients);

$select1="SELECT * FROM `vendor`";

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
								$spt=split(',',$client_count['area']);
								$det=mysql_fetch_array(mysql_query("select * from town where guid='$client_count[town]'"));
								
								$chk=mysql_num_rows(mysql_query("select * from vendor_products where vendor_id='$client_count[guid]'"));?>

                        	<tr>

                            	<td><?php echo $m; ?></td>

                                 <td><?php echo $det['name'];?></td>
                                  <td><?php  
								  for($j=0;$j<count($spt);$j++){if($spt[$j]!=''){
								  $csk=mysql_fetch_array(mysql_query("select * from area where guid='$spt[$j]'"));
								  ?>
                               <?php echo $j+1;echo ". "; echo $csk['name'];?><?php echo "<br>";}}?></td>
                               <td><?php echo $client_count['name'];echo "<br>"; echo $client_count['email'];echo "<br>"; echo $client_count['mobile'];?></td>
                               <td><?php echo $client_count['status'];?></td>
                               <td><a href="vendors.php?gid=<?php echo $client_count['guid'];?>&action=products">Total : <?php echo $chk;?></a></td>
                               <td><a href="vendors.php?gid=<?php echo $client_count['guid'];?>&action=products"><?php echo $client_count['pstatus'];?></a></td>
                               <td><a href="vendors.php?action=edit&guid=<?php echo $client_count['guid']; ?>"><button type="button" class="btn btn-default">Edit</button></a></td>
                                <td><a href="vendors.php?action=delete&deleteid=<?php echo $client_count['guid']; ?>" onClick="return delete1();"><button type="button" class="btn btn-danger">Delete</button></a></td>

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
  url:"subzone5.php",
  data:  "val="+s,
  success: function(response){
	  $('#subcity').html(response);
  }
 });
}

function subcategories(s)
{//alert(s);
 $.ajax({
  type:"get",
  dataType:"text",
  url:"subarea.php",
  data:  "val="+s,
  success: function(response){
	  $('#subcagtegory').html(response);
  }
 });
}
</script>
       <?php include "footer-scripts.php" ?>
    </body>
</html>