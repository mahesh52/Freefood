<?php ob_start();
session_start();$date=date('Y-m-d H:i:s');extract($_POST);extract($_GET);
include 'secure.php';include '../../config.php'; 


if(isset($_POST)  && sizeof($_POST) > 0)
{
	
		$qty = $_POST["quantity"];
	
	$sql_check = mysql_num_rows(mysql_query("select * from erfvstock where product_id = '$product_id' and erfv_vendor = '$erfvvendor' "));
		if($sql_check > 0){
			mysql_query("update erfvstock set available_qty = available_qty+'$qty' where product_id = '$product_id' and erfv_vendor = '$erfvvendor' ");
		}else{
			mysql_query("INSERT INTO `erfvstock` (product_id,`erfv_vendor` ,`available_qty`) VALUES 
('$product_id','$erfvvendor','$qty')");
		}
			
		
	$sql_raw = mysql_query("select a.quantity,b.item_name,b.units,b.measures_in,b.item_price
				from products_mapping a,rawmaterials b  where a.rawmaterial_id = b.guid 
				and  product_id = '$product_id' and b.vendor = '$vendor' ");
				$raw_materials = "";
				$price = 0;
				while($row = mysql_fetch_array($sql_raw)){
					$raw_materials.= $qty.' X '. $row['item_name'].' '. $row['units'].' '.$row['measures_in']."," ;
					$price = ($price) + ($qty*$row['item_price']);
				}
				$raw_materials = rtrim($raw_materials, ',');
			mysql_query("INSERT INTO `erfvstock_history` (product_id,`stock_vendor` ,`erfv_vendor`,qty,raw_materials,date,amount) VALUES 
('$product_id','$vendor','$erfvvendor','$qty','$raw_materials','$date','$price')");

			
header('location:topups.php');	
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
                       Top Up For ERFV Vendor
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Admin</li>
                    </ol>
                </section>
<?php if(isset($_GET) && $_GET[action]=='add'){?>
                <!-- Main content -->
               <?php 
					
					$det=mysql_fetch_array(mysql_query("select * from products_mapping where product_id='$guid'  order by guid desc limit 1"));
					$det1=mysql_query("select * from products_mapping where product_id='$guid'");
					$prods = array();
					while($row2 = mysql_fetch_array($det1)){
						$prods[] = $row2["rawmaterial_id"];
						$prods[$row2["rawmaterial_id"]] = $row2["quantity"];
					}
					
					?>
				
				<form action="topups.php" method="post" name="form1" id="frm1" onSubmit="return valid()">
                <table class="table table-responsive table-bordered">
				 <tr><td>Select Stock Vendor </td>
                     <td><select class="form-control" name="vendor" id="vendor"   onchange = "loadTopupsNewwwss(this.value)" required >
             <option value="">Select Stock Vendor</option>
              <?php $qry1111=mysql_query("select * from stockvendor where status = 'Active' ");
			  while($row1111=mysql_fetch_assoc($qry1111))
			  {?>
				<option value='<?php echo $row1111[guid]; ?>'><?php echo $row1111[name]; ?></option>
			  <?php }?> 
				            	 	
			</select></td></tr>
   <tr><td>Select ERFV Vendor </td>
                     <td><select class="form-control" name="erfvvendor" id="erfvvendor"   required >
             <option value="">Select ERFV Vendor</option>
              <?php $qry111=mysql_query("select * from vendor where status = 'Active' and vendor_type = 'ERFV'");
			  while($row111=mysql_fetch_assoc($qry111))
			  {?>
				<option value='<?php echo $row111[guid]; ?>'><?php echo $row111[name]; ?></option>
			  <?php }?> 
				            	 	
			</select></td></tr>
                      <tr><td>Product </td>
                     <td><select class="form-control" name="product_id" id="product_id"  onchange = "loadTopupsNewww(this.value)" required >
             <option value="">Select Product</option>
              <?php $qry1=mysql_query("select * from products where status = 'Active' and guid in (select product_id from products_mapping) order by name asc");
			  while($row1=mysql_fetch_assoc($qry1))
			  {?>
				<option value='<?php echo $row1[guid]; ?>'><?php echo $row1[name]; ?></option>
			  <?php }?> 
				            	 	
			</select></td></tr>
			<!--tr><td>Top Up Type </td>
                     <td><select class="form-control" name="top_type"  id ="top_type"  required onchange = "loadTopups(this.value)">
             <option value="">Select Top Up</option>
              
				<option value='Installation'>Installation</option>
			 <option value='Monthly'>Monthly</option>
				            	 <option value='Other'>Other</option>	
			</select></td></tr-->
			<tr id = "topupsqty" ><td>Quantity </td>
                     <td>
					 <input  type="number" min="0" name="quantity" id="quantity" onchange = "loadTopupsNew(this.value)" class="form-control" placeholder="Qty" />
					 </td></tr>
                    <tr id = "topupselect" ><td>All Raw Materials </td>
                     <td>
					 <div id = "TopupMaterials">
					  N/A
					  </div>
					 </td></tr>
                      					
               <tr><td colspan="2">  
              
                    <button type="submit" name="Submit" value="Update" class="btn bg-yellow btn-block">Topup</button>  
                </td></tr></table>
            </form>
			
			<?php }else{?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="topups.php?action=add"><button type="button" class="btn btn-success">New topup</button></a>
                <section class="content">

				 <!-- top row -->
                  <table class="table table-responsive table-bordered">

                    	<thead>

                          <tr>

                        	

                            <th>Sno</th>
                            <th>Product </th>
                            <th>Stock Vendor</th>
                            <th>Erfv Vendor</th>
                            <th>Quantity</th>
                            <th>Raw Materials</th><th>Amount</th>
                            <th>Date</th>
                           
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

	
$query_clients="SELECT * FROM `erfvstock_history`  order by guid desc  Limit $start, $limit ";

$select1="SELECT * FROM `erfvstock_history`";

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

                                 <td>
								 <?php 
								 $sql_prod = mysql_fetch_array(mysql_query("select * from products where guid = '$client_count[product_id]'"));
								 echo $sql_prod['name'];
								 
								 ?>
								 </td>
                                 <td>
								 <?php $sql_prod1 = mysql_fetch_array(mysql_query("select * from stockvendor where guid = '$client_count[stock_vendor]'"));
								echo  $sql_prod1['name'];?>
								 </td>
                                  <td>
								  <?php $sql_prod11 = mysql_fetch_array(mysql_query("select * from vendor where guid = '$client_count[erfv_vendor]'"));
								echo  $sql_prod11['name'];?>
								  
								  </td>
                               <td><?php echo $client_count['qty'];?></td>
                               <td><?php echo $client_count['raw_materials'];?></td>
							   <td><?php echo $client_count['amount'];?></td>
							   <td><?php echo date('d-M-Y H:i:s',strtotime($client_count['date']));?></td>

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
			
			
       <script type="text/javascript" src="jquery_1.5.2.js" ></script>
      
<script>
function loadTopups(val){
	var qty =0;
	var product_id = $("#product_id").val();
	var vendor = $("#vendor").val();
//alert(product_id);
	//alert(vendor);
	if(val == "Other"){
		$("#topupsqty").show();
		//$("#topupselect").hide();
		var qty = $("#quantity").val();;	
	}
	else{
		$("#topupsqty").hide();
		//$("#topupselect").show();
	}	
	//alert(qty);alert(product_id);alert(val);alert(vendor);
	if(product_id != "" && val != "" && vendor != ""){
		//alert(678);
			$.ajax({
  type:"post",
  dataType:"text",
  url:"topupdetails.php",
  data:  "type="+val+"&product_id="+product_id+"&qty="+qty+"&vendor="+vendor,
  success: function(response){
	  $('#TopupMaterials').html(response);
  }
 });
	}
	else{
		$('#TopupMaterials').html('');
	}

}
function loadTopupsNew(val){
	var qty =0;
	var qty = $("#quantity").val();
	var product_id = $("#product_id").val();
	var vendor = $("#vendor").val(); 
	var type = "Other";
	 
	if(product_id != "" && type != "" && vendor != ""){
		$.ajax({
  type:"post",
  dataType:"text",
  url:"topupdetails.php",
  data:  "type="+type+"&product_id="+product_id+"&qty="+qty+"&vendor="+vendor,
  success: function(response){
	  $('#TopupMaterials').html(response);
  }
 });
	}else{
		$('#TopupMaterials').html('');
	}
}
function loadTopupsNewww(val){
	var qty =$("#quantity").val();
	var product_id =  $("#product_id").val();
	var type = "Other";
	var vendor = $("#vendor").val(); 
	if(product_id != "" && type != "" && vendor != ""){
		$.ajax({
  type:"post",
  dataType:"text",
  url:"topupdetails.php",
  data:  "type="+type+"&product_id="+product_id+"&qty="+qty+"&vendor="+vendor,
  success: function(response){
	  $('#TopupMaterials').html(response);
  }
 });
	}else{
		$('#TopupMaterials').html('');
	}
}
function loadTopupsNewwwss(val){
	var qty =$("#quantity").val();
	var product_id =  $("#product_id").val();
	var type = "Other";
	var vendor = $("#vendor").val(); 
	if(product_id != "" && type != "" && vendor != ""){
		$.ajax({
  type:"post",
  dataType:"text",
  url:"topupdetails.php",
  data:  "type="+type+"&product_id="+product_id+"&qty="+qty+"&vendor="+vendor,
  success: function(response){
	  $('#TopupMaterials').html(response);
  }
 });
	}else{
		$('#TopupMaterials').html('');
	}
}


</script>   <?php include "footer-scripts.php" ?>
    </body>
</html>