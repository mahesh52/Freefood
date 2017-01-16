<?php ob_start();
session_start();$date=date('Y-m-d');extract($_POST);extract($_GET);
include 'secure.php';include '../../config.php'; 
if(isset($_GET) && $_GET[action]=='delete')
{
mysql_query("delete from rawmaterials where guid='$_GET[deleteid]'");
header('location:rawmaterials.php');	
}

if(isset($_POST) &&  $_POST['hidid']=='' && sizeof($_POST) > 0)
{
	
	$item_name=str_replace("'","*_*",$item_name);
	$description=str_replace("'","*_*",$description);
			
mysql_query("INSERT INTO `rawmaterials` (vendor,`item_name` ,`brand_name` ,`shelf_conditions` ,`units`,
`measures_in` ,`item_price`,
`min_stock`,`description`,`status`) VALUES 
('$vendor','$item_name','$brand_name','$shelf_conditions' ,'$units','$measures_in' ,'$item_price',
'$min_stock',
'$description','$status')");
			
header('location:rawmaterials.php');	
}
if(isset($_POST) && $_POST[hidid]!='' && sizeof($_POST) > 0)
{
	

	$item_name=str_replace("'","*_*",$item_name);
	$description=str_replace("'","*_*",$description);
	mysql_query("update `rawmaterials` set `vendor`='$vendor' ,`item_name`='$item_name' ,
 `brand_name`='$brand_name' ,`shelf_conditions`='$shelf_conditions',`units`='$units',`measures_in`='$measures_in' ,
 `item_price`='$item_price' ,`min_stock`='$min_stock',`description`='$description',`status`='$status' where guid='$hidid'");

		
header('location:rawmaterials.php');
}
?>
<html>
<link rel="stylesheet" type="text/css" href="styles.css" />
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
         <script type="text/javascript" src="nicEdit.js"></script>
         <script type="text/javascript">
bkLib.onDomLoaded(function() {
new nicEditor({fullPanel : true}).panelInstance('description');
new nicEditor({fullPanel : true}).panelInstance('features');
new nicEditor({fullPanel : true}).panelInstance('specifications');
});
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
                       Raw Materials
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Admin</li>
                    </ol>
                </section>

                <!-- Main content -->
                <?php if(isset($_GET) && $_GET[action]=='add'){?>
				
				<form action="rawmaterials.php" method="post" name="form1" id="frm1" onSubmit="return valid()" enctype="multipart/form-data">
               <table class="table table-responsive table-bordered">

                      <tr><td>Stock Partner</td>
                     <td><select class="form-control" name="vendor" required >
             <option value="">Select Stock Partner</option>
              <?php $qry=mysql_query("select * from stockvendor where status = 'Active' order by name asc");
			  while($row=mysql_fetch_assoc($qry))
			  {
				echo "<option value='$row[guid]'>$row[name]</option>";  
			  }?>            	 	
			</select></td></tr>
                
                    
                      <tr><td><label>Item Name</label></td><td>
                        <input type="text" name="item_name" class="form-control" placeholder="Item Name" required/>
                    </td></tr>
					 <tr><td><label>Brand Name</label></td><td>
                        <input type="text" name="brand_name" class="form-control" placeholder="Brand Name" required/>
                    </td></tr>
					<tr><td><label>Shelf Conditions</label></td><td>
                       
						<select name="shelf_conditions"  id = "shelf_conditions">
						<option value = "Normal">Normal</option>
						<option value = "Freezer">Freezer</option>
						</select>
                    </td></tr>
					<tr><td><label>Item Qty </label></td><td>
                       <input type="number" min="0" value =0 name="units" class="form-control" placeholder="Units" required/>
                    </td></tr>
					<tr>
					<td><label>Measures In </label></td><td>
                       <select name="measures_in"  id = "measures_in">
						<option value = "Grams">Grams</option>
						<option value = "Litres">Litres</option>
						<option value = "Milli Litres">Milli Litres</option>
						<option value = "Pack">Pack</option>
						<option value = "Units">Units</option>
						</select>
                    </td>
					</tr>

                   <tr><td><label>Item Price</label></td>
                       <td><div class="input-group">
      <div class="input-group-addon">Rs</div>
      <input type="number" min="0" value =0 class="form-control" id="item_price" name="item_price" placeholder="Item Price"  required>
    </div>
                    </td></tr>
                    
					
					
                   <tr><td><label>Min Stock</label></td>
                       <td><div class="input-group">
      
      <input type="number" min="0" value =0 class="form-control" id="min_stock" name="min_stock" placeholder="Min Stock"  required>
    </div>
                    </td></tr>
					
                    <tr><td><label>Description</label></td><td>
                        <textarea type="text" name="description" id="description" rows="5" style="width:800px;" placeholder="Descritpion"></textarea>
                    </td></tr>
                    
                    

                    <tr><td>Status</td><td>
                        <input type="radio" name="status"  value="Active" checked/> Active
                        <input type="radio" name="status"  value="InActive"/> InActive
                    </td></tr> 
					
               <tr><td colspan="2">                                                            
                    <button type="submit" name="Submit" value="Update" class="btn bg-yellow btn-block">Add Item</button>  
                </td></tr></table>
            </form>
				<?php }elseif(isset($_GET) && $_GET[action]=='edit'){
					$det=mysql_fetch_array(mysql_query("select * from rawmaterials where guid='$guid'"));
					$item_name=str_replace("*_*","'",$det['item_name']);
					$description=str_replace("*_*","'",$det['description']);?>
				
				<form action="rawmaterials.php" method="post" name="form1" id="frm1" onSubmit="return valid()">
                <table class="table table-responsive table-bordered">

                      <tr><td>Stock Partner</td>
                     <td><select class="form-control" name="vendor" required onChange="return subzone(this.value);">
             <option value="">Select Stock Partner</option>
              <?php $qry=mysql_query("select * from stockvendor where status = 'Active' order by name asc");
			  while($row=mysql_fetch_assoc($qry))
			  { ?>
				<option <?php if($det['vendor']==$row['guid']){?> selected <?php } ?> value='<?php echo $row[guid]; ?>'><?php echo $row[name]; ?></option>
			  <?php }?>            	 	
			</select></td></tr>
                
                    
                      <tr><td><label>Item Name</label></td><td>
                        <input type="text" name="item_name" class="form-control" value="<?php echo $item_name;?>" placeholder="Item Name" required/>
                    </td></tr>
					 <tr><td><label>Brand Name</label></td><td>
                        <input type="text" name="brand_name" class="form-control" value="<?php echo $det['brand_name'];?>" placeholder="Brand Name" required/>
                    </td></tr>
					<tr><td><label>Shelf Conditions</label></td><td>
                       
						<select name="shelf_conditions"  id = "shelf_conditions">
						<option <?php if($det['shelf_conditions']=="Normal"){?> selected <?php } ?> value = "Normal">Normal</option>
						<option <?php if($det['shelf_conditions']=="Freezer"){?> selected <?php } ?> value = "Freezer">Freezer</option>
						</select>
                    </td></tr>
					<tr><td><label>Item Qty </label></td><td>
                       <input type="number" min="0" value="<?php echo $det['units'];?>" name="units" class="form-control" placeholder="Units" required/>
                    </td></tr>
					<tr>
					<td><label>Measures In </label></td><td>
                       <select name="measures_in"  id = "measures_in">
						<option <?php if($det['measures_in']=="Grams"){?> selected <?php } ?> value = "Grams">Grams</option>
						<option <?php if($det['measures_in']=="Litres"){?> selected <?php } ?> value = "Litres">Litres</option>
						<option <?php if($det['measures_in']=="Milli Litres"){?> selected <?php } ?> value = "Milli Litres">Milli Litres</option>
						<option <?php if($det['measures_in']=="Pack"){?> selected <?php } ?> value = "Pack">Pack</option>
						<option <?php if($det['measures_in']=="Units"){?> selected <?php } ?> value = "Units">Units</option>
						</select>
                    </td>
					</tr>

                   <tr><td><label>Item Price</label></td>
                       <td><div class="input-group">
      <div class="input-group-addon">Rs</div>
      <input type="number" min="0" value="<?php echo $det['item_price'];?>" class="form-control" id="item_price" name="item_price" placeholder="Item Price" onchange = "caluclateprices(this.value,1)" required>
    </div>
                    </td></tr>
                  
                   <tr><td><label>Min Stock</label></td>
                       <td><div class="input-group">
      
      <input type="number" min="0" value="<?php echo $det['min_stock'];?>" class="form-control" id="min_stock" name="min_stock" placeholder="Min Stock"  required>
    </div>
                    </td></tr>
					
                    <tr><td><label>Description</label></td><td>
                        <textarea type="text"  name="description" id="description" rows="5" style="width:800px;" placeholder="Descritpion"><?php echo $description;?></textarea>
                    </td></tr>
                    
                    

                    <tr><td>Status</td><td>
                        <input type="radio" name="status"  value="Active" <?php if($det['status']=='Active'){echo "checked";}?>/> Active
                        <input type="radio" name="status"  value="InActive" <?php if($det['status']=='InActive'){echo "checked";}?>/> InActive
                    </td></tr>  					
               <tr><td colspan="2">  
               <input type="hidden" name="hidid" value="<?php echo $det[guid];?>">                                                          
                    <button type="submit" name="Submit" value="Update" class="btn bg-yellow btn-block">Update Product</button>  
                </td></tr></table>
            </form><?php }else{?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="rawmaterials.php?action=add"><button type="button" class="btn btn-success">Add Item</button></a>
                <section class="content">

				 <!-- top row -->
                  <table class="table table-responsive table-bordered">

                    	<thead>

                          <tr>

                        	

                            <th>Sno</th>
                            <th>Item Name</th>
                            <th>Brand Name</th>
                            <th>Qty</th>
                            <th>Item Price</th>
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

$filePath="rawmaterials.php";

if($page) 
{
$start = ($page - 1) * $limit; 			
}
else
{
$start = 0;						
$page=1;
}

	
$query_clients="SELECT * FROM `rawmaterials`  order by guid desc  Limit $start, $limit ";

$select1="SELECT * FROM `rawmaterials`";

$query_clients=mysql_query($query_clients);

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
								
					?>

                        	<tr>

                            	<td><?php echo $m; ?></td>

                                 <td><?php echo $client_count['item_name'];?></td>
                                 <td><?php echo $client_count['brand_name'];?></td>
                                  <td><?php echo $client_count['units'].' '.$client_count['measures_in'];?></td>
                               <td><?php echo $client_count['item_price'];?></td>
                               <td><?php echo $client_count['status'];?></td>
							   <td><a href="rawmaterials.php?action=edit&guid=<?php echo $client_count[guid]; ?>"><button type="button" class="btn btn-default">Edit</button></a></td>
                                <td><a href="rawmaterials.php?action=delete&deleteid=<?php echo $client_count[guid]; ?>" onClick="return delete1();"><button type="button" class="btn btn-danger">Delete</button></a></td>

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
    <?php $sellprice=mysql_fetch_array(mysql_query("select * from commissions order by guid desc limit 0,1"));
    
    
    ?>

       <script type="text/javascript" src="jquery_1.5.2.js" ></script>
      
<script>
function caluclateprices(){
	
		var itemprice = $("#item_price").val();
	
	if(itemprice == ""){
		itemprice =0;
	}
	//alert(itemprice);
	var installation_stock = $("#installation_stock").val();
	//alert(installation_stock);
	if(installation_stock != ""){var installation_price =(parseFloat(itemprice)*parseFloat(installation_stock));  }
	else{ var installation_price =0;}
	//alert(installation_price);
	$("#installation_price").val(installation_price);
	var monthly_topup = $("#monthly_topup").val();
	if(monthly_topup != ""){ var monthly_topup_price =(parseFloat(itemprice)*parseFloat(monthly_topup)); }
	else{var monthly_topup_price =0; }
	//alert(monthly_topup_price);
	$("#monthly_topup_price").val(monthly_topup_price);
	var total_price = installation_price+monthly_topup_price;
	$("#total_price").val(total_price);
}


</script>   <?php include "footer-scripts.php" ?>
    </body>
</html>