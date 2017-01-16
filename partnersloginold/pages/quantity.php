<?php ob_start();
session_start();extract($_POST);extract($_GET);
if($_SESSION['partner_status']!="Food Vendor"){header('location:logout.php');}
include 'secure.php';include '../../config.php'; $date=date('Y-m-d');
$details=mysql_fetch_array(mysql_query("select * from vendor where guid='$_SESSION[vendor_loginid]'"));
if($details['pstatus']=='Pending'){header("location:products.php");}
if($details['prebook']=='Yes'){$area="prebook='Yes' and ";}
$spt=split(',',$details['area']);
for($j=0;$j<count($spt);$j++){if($spt[$j]!=''){
	$area.="FIND_IN_SET('".$spt[$j]."',`area`) AND ";
}}
$area=substr($area,0,-4);
if(isset($_POST) && $_POST['submit']=='Update')
{
	//print_r($_POST);
	for($i=0;$i<count($product_id);$i++)
	{
	$chk=mysql_fetch_array(mysql_query("select * from vendor_products where vendor_id='$_SESSION[vendor_loginid]' and product_id='$product_id[$i]'"));
	if($chk['guid']!='')
	{
		$chkqty=mysql_fetch_array(mysql_query("select * from vendor_quantity where vendor_id='$_SESSION[vendor_loginid]' and product_id='$product_id[$i]' and date='$date'"));
	if($quantity[$i]>0 && $chkqty['guid']=='')
	{
      mysql_query("INSERT INTO  `vendor_quantity` (`vendor_id` ,`product_id` ,`price`, `quantity` ,`date`) VALUES ('$_SESSION[vendor_loginid]',  '$product_id[$i]',  '$price[$i]','$quantity[$i]',  '$date')");
	}
	else
	{
	 mysql_query("update `vendor_quantity` set `quantity`='$quantity[$i]' where guid='$chkqty[guid]'");	
	}
	}
	
	}
?><script>
alert("Updated Successfully");
window.location='quantity.php';
</script><?php 	
}

?><!DOCTYPE html>
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
                       Products Update Today ( <?php echo date('d M Y');?> ) Quantity
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active"><?php echo $_SESSION['partner_status'];?></li>
                    </ol>
                </section>

                <!-- Main content -->
               
                <section class="content">

				 <!-- top row -->
                   <form method="get" action="quantity.php"><table class="table table-responsive table-bordered">
                   <tr><td><select class="form-control" name="category" required onChange="return subcategories(this.value);">
             <option value="">Select Category</option>
              <?php $qry=mysql_query("select * from category order by name asc");
			  while($row=mysql_fetch_assoc($qry))
			  {
				?><option value='<?php echo $row['guid'];?>' <?php if($row['guid']==$category){?>selected<?php } ?>><?php echo $row['name'];?></option>  
			  <?php }?>            	 	
			</select></td><td>
                        <span id="subcagtegory"><select class="form-control" name="subcategory">
             <option value="">Select Sub Category</option>
             <?php if($category!=''){ $qry=mysql_query("select * from foodcategory where refid='$category' order by name asc");
			  while($row=mysql_fetch_assoc($qry))
			  {
				?><option value="<?php echo $row['guid'];?>" <?php if($subcategory==$row['guid']){?> selected<?php } ?>><?php echo $row['name'];?></option><?php
			  }}?>  
			</select></span>
                    </td>
            <td><button type="submit" name="Search" value="Search" class="btn btn-warning">Search</button></td></tr></table></form>
             <form method="post" action="quantity.php">
            <table class="table table-responsive table-bordered">

                    	<thead>

                          <tr>

                        	

                            <th>Sno</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                             </tr>

                        </thead>

                        <tbody>

                         <?php 
include 'pageing.php';
						    $gridId = $_GET[guid];
							$limit = 90; 								

$filePath="quantity.php";

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
	if($category!='' && $subcategory!='')
	{
$query_clients="SELECT * FROM `products` where category='$category' and subcategory='$subcategory' and $area order by guid desc  Limit $start, $limit ";

$select1="SELECT * FROM `products` where category='$category' and subcategory='$subcategory' and $area";
	}
	elseif($category!='' && $subcategory=='')
	{
		$query_clients="SELECT * FROM `products` where category='$category' and $area order by guid desc  Limit $start, $limit ";

$select1="SELECT * FROM `products` where category='$category' and $area";
	}
}
else{
	
$query_clients="SELECT * FROM `products` where $area order by guid desc  Limit $start, $limit ";

$select1="SELECT * FROM `products` where $area";
}
$query_clients=mysql_query($query_clients);

$total=mysql_num_rows(mysql_query($select1));

$otherParams="category=$category&subcategory=$subcategory&Search=$Search";

@$divs=$total%$limit;

	if($divs==0)

	{

	@$totals=(int)($total/$limit);

	}else{

	@$totals=(int)($total/$limit) + 1;

	}$m=1;
						    while($client_count = mysql_fetch_assoc($query_clients)){
								$chk=mysql_fetch_array(mysql_query("select * from vendor_products where vendor_id='$_SESSION[vendor_loginid]' and product_id='$client_count[guid]'"));
								$chkqty=mysql_fetch_array(mysql_query("select * from vendor_quantity where vendor_id='$_SESSION[vendor_loginid]' and product_id='$client_count[guid]' and date='$date'"));
								if($chk['price']>0){$price=$chk['price'];if($chkqty['quantity']>0){$quantity=$chkqty['quantity'];}else{$quantity=0;}
								$cat=mysql_fetch_array(mysql_query("select * from category where guid='$client_count[category]'"));
								$foodcat=mysql_fetch_array(mysql_query("select * from foodcategory where guid='$client_count[subcategory]'"));
								$pname=str_replace("*_*","'",$client_count['name']);
					?>

                        	<tr>

                            	<td><?php echo $m; ?></td>

                                 <td><?php echo $cat['name'];?></td>
                                 <td><?php echo $foodcat['name'];?></td>
                                  <td><?php echo $pname;?></td>
                                  <td><input type="number" name="quantity[]" value="<?php echo $quantity;?>">
                                  <input type="hidden" name="price[]" value="<?php echo $price;?>">
                                  <input type="hidden" name="product_id[]" value="<?php echo $client_count['guid'];?>">
                                  <input type="hidden" name="min_price[]" value="<?php echo $client_count['sprice'];?>"></td>
                                </tr>

                          <?php $m++;}} ?>
                          
<tr><td colspan="10"><button type="submit" name="submit" value="Update" class="btn btn-success">Update</button></td></tr>
                        </tbody>

                        <tfoot>

                        	<tr>

                            	<th colspan="10"> Showing <?php echo $page;?> of <?php echo $totals;?> Pages </th>

                            </tr>

                        </tfoot>

                    </table></form>
                     <ul class="pagination">

                       <?php make_pages($page,$limit,$total,$filePath,$otherParams); ?>
                       

                    </ul></section>
            </aside><!-- /.right-side -->
        </div>
        <!-- ./wrapper -->
        <!-- add new calendar event modal -->
    
       <script type="text/javascript" src="jquery_1.5.2.js" ></script>
       <script type="text/javascript" src="ajaxupload.3.5.js" ></script>

<script type="text/javascript" src="uploader.js" ></script>
<script>
function subcategories(s)
{//alert(s);
 $.ajax({
  type:"get",
  dataType:"text",
  url:"foodsub.php",
  data:  "val="+s,
  success: function(response){
	  $('#subcagtegory').html(response);
  }
 });
}

</script>   <?php include "footer-scripts.php" ?>
    </body>
</html>