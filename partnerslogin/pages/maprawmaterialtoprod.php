<?php ob_start();
session_start();$date=date('Y-m-d');extract($_POST);extract($_GET);
include 'secure.php';include '../../config.php'; 
if(isset($_GET) && $_GET[action]=='delete')
{
mysql_query("delete from products_mapping where product_id='$_GET[deleteid]'");
header('location:maprawmaterialtoprod.php');	
}

if(isset($_POST) &&  $_POST['hidid']=='' && sizeof($_POST) > 0)
{
	$raw_materials = $_POST["raw_material"];
	//$raw_material_qty = $_POST["raw_material_qty"];
	for($i=0;$i<sizeof($raw_materials);$i++){
		$rawmaterial_id =  $raw_materials[$i];
		 $rawqtyattr = "raw_material_qty".$rawmaterial_id;
		
		if($_POST[$rawqtyattr] != "" && $_POST[$rawqtyattr] >0){
			
			mysql_query("INSERT INTO `products_mapping` (product_id,`rawmaterial_id` ,`quantity`) VALUES 
('$product_id','$raw_materials[$i]','$_POST[$rawqtyattr]')");
		}
	}
		

			
header('location:maprawmaterialtoprod.php');	
}
if(isset($_POST) && $_POST[hidid]!='' && sizeof($_POST) > 0)
{
	
	mysql_query("delete from products_mapping where product_id='$_POST[hidid]'");
	$raw_materials = $_POST["raw_material"];
	//$raw_material_qty = $_POST["raw_material_qty"];
	
	for($i=0;$i<sizeof($raw_materials);$i++){
		$rawmaterial_id =  $raw_materials[$i];
		$rawqtyattr = "raw_material_qty".$rawmaterial_id;
		if($_POST[$rawqtyattr] != "" && $_POST[$rawqtyattr] >0){
			mysql_query("INSERT INTO `products_mapping` (product_id,`rawmaterial_id` ,`quantity`) VALUES 
('$product_id','$raw_materials[$i]','$_POST[$rawqtyattr]')");
		}
	}

		
header('location:maprawmaterialtoprod.php');
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
                       Map Products to Raw Materials
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Admin</li>
                    </ol>
                </section>

                <!-- Main content -->
                <?php if(isset($_GET) && $_GET[action]=='add'){?>
				
				<form action="maprawmaterialtoprod.php" method="post" name="form1" id="frm1" onSubmit="return valid()" enctype="multipart/form-data">
               <table class="table table-responsive table-bordered">

                      
                <tr><td>Product </td>
                     <td><select class="form-control" name="product_id" required >
             <option value="">Select Product</option>
              <?php $qry1=mysql_query("select * from products where status = 'Active' and guid not in (select product_id from products_mapping) order by name asc");
			  while($row1=mysql_fetch_assoc($qry1))
			  {
				echo "<option value='$row1[guid]'>$row1[name]</option>";   }?>          	 	
			</select></td></tr>
                    
                      <tr><td><label>Raw Materials</label></td><td>
					  <?php $qry11=mysql_query("select * from rawmaterials where status = 'Active' order by item_name asc");
			  while($row11=mysql_fetch_assoc($qry11))
			  { ?>
                        <input type="checkbox" name="raw_material[]" class="form-control" value = "<?php echo $row11["guid"]; ?>" />
						<?php echo $row11["item_name"]; ?> <?php echo $row11["units"]; ?> <?php echo $row11["measures_in"]; ?>
						<input style = "width:20%;margin-left:30%;margin-top: -27px;" type="number" min="0" name="raw_material_qty<?php echo $row11["guid"]; ?>" class="form-control" placeholder="Qty" />
						<?php }?>
                    </td></tr>
					
					
               <tr><td colspan="2">                                                            
                    <button type="submit" name="Submit" value="Update" class="btn bg-yellow btn-block">Map New Product</button>  
                </td></tr></table>
            </form>
				<?php }elseif(isset($_GET) && $_GET[action]=='edit'){
					
					$det=mysql_fetch_array(mysql_query("select * from products_mapping where product_id='$guid'  order by guid desc limit 1"));
					$det1=mysql_query("select * from products_mapping where product_id='$guid'");
					$prods = array();
					while($row2 = mysql_fetch_array($det1)){
						$prods[] = $row2["rawmaterial_id"];
						$prods[$row2["rawmaterial_id"]] = $row2["quantity"];
					}
					
					?>
				
				<form action="maprawmaterialtoprod.php" method="post" name="form1" id="frm1" onSubmit="return valid()">
                <table class="table table-responsive table-bordered">

                      <tr><td>Product </td>
                     <td><select class="form-control" name="product_id" required >
             <option value="">Select Product</option>
              <?php $qry1=mysql_query("select * from products where status = 'Active' and guid  in (select product_id from products_mapping) order by name asc");
			  while($row1=mysql_fetch_assoc($qry1))
			  {?>
				<option <?php if($det['product_id']==$row1['guid']){?> selected <?php } ?> value='<?php echo $row1[guid]; ?>'><?php echo $row1[name]; ?></option>
			  <?php }?> 
				            	 	
			</select></td></tr>
                    
                      <tr><td><label>Raw Materials</label></td><td>
					  <?php $qry11=mysql_query("select * from rawmaterials where status = 'Active' order by item_name asc");
			  while($row11=mysql_fetch_assoc($qry11))
			  { ?>
		  
                        <input <?php if (in_array($row11["guid"], $prods)){?> checked <?php } ?>  type="checkbox" name="raw_material[]" class="form-control" value = "<?php echo $row11["guid"]; ?>" />
						<?php echo $row11["item_name"]; ?> <?php echo $row11["units"]; ?> <?php echo $row11["measures_in"]; ?>
						<input <?php if (in_array($row11["guid"], $prods)){?>value = "<?php echo $prods[$row11["guid"]]; ?>" <?php } ?> style = "width:20%;margin-left:30%;margin-top: -27px;" type="number" min="0" name="raw_material_qty<?php echo $row11["guid"]; ?>" class="form-control" placeholder="Qty" />
						<?php }?>
                    </td></tr>					
               <tr><td colspan="2">  
               <input type="hidden" name="hidid" value="<?php echo $det[product_id];?>">                                                          
                    <button type="submit" name="Submit" value="Update" class="btn bg-yellow btn-block">Update Product</button>  
                </td></tr></table>
            </form><?php }else{?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--a href="maprawmaterialtoprod.php?action=add"><button type="button" class="btn btn-success">Map New Product</button></a-->
                <section class="content">

				 <!-- top row -->
                  <table class="table table-responsive table-bordered">

                    	<thead>

                          <tr>

                        	

                            <th>Sno</th>
                            <th> Name</th>
                            <th>Raw Materials</th>
                            
                            
                           
                           </tr>

                        </thead>

                        <tbody>

                         <?php 
include 'pageing.php';
						    $gridId = $_GET[guid];
							$limit = 90; 								

$filePath="maprawmaterialtoprod.php";

if($page) 
{
$start = ($page - 1) * $limit; 			
}
else
{
$start = 0;						
$page=1;
}

	
$query_clients="SELECT *  FROM `products` where status = 'Active' and guid in (select product_id from products_mapping) order by guid desc  Limit $start, $limit ";

$select1="SELECT *  FROM `products` where status = 'Active' and guid in (select product_id from products_mapping) ";

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

                                 <td><?php echo $client_count['name'];?></td>
                                 <td>
								 <?php 
								 $sql_raw = mysql_query("select a.quantity,b.item_name,b.units,b.measures_in
								 from products_mapping a,rawmaterials b  where a.rawmaterial_id = b.guid 
								 and  product_id = '$client_count[guid]' ");
								 while($row_raw = mysql_fetch_array($sql_raw)){
								 ?>
								 <?php echo $row_raw['item_name'].' '. $row_raw['units'].' '.$row_raw['measures_in'];?>
								 of <b><?php echo $row_raw['quantity'];?></b> Qty
								 <br>
							<?php } ?>
								 </td>
                                  
							   
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

   <?php include "footer-scripts.php" ?>
    </body>
</html>