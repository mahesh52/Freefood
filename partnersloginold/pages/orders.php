<?php ob_start();
session_start();extract($_POST);
include 'secure.php';include '../../config.php'; $date=date('Y-m-d');
if($_SESSION['partner_status']=="Food Vendor")
{
$details=mysql_fetch_array(mysql_query("select * from vendor where guid='$_SESSION[vendor_loginid]'"));
	$spt=split(',',$details['area']);
for($j=0;$j<count($spt);$j++){if($spt[$j]!=''){
	$area.="FIND_IN_SET('".$spt[$j]."',`area`) AND ";
}}
}
if($_SESSION['partner_status']=="Store Vendor")
{
$details=mysql_fetch_array(mysql_query("select * from storevendor where guid='$_SESSION[storevendor_loginid]'"));
	$spt=split(',',$details['area']);
for($j=0;$j<count($spt);$j++){if($spt[$j]!=''){
	$area.="FIND_IN_SET('".$spt[$j]."',`area`) AND ";
}}
$area=substr($area,0,-4);
}

if(isset($_POST) && $_POST['Submit']=='Update')
{
	$det=mysql_fetch_array(mysql_query("select * from orders where guid='$editid'"));
	
	mysql_query("update orders set courier='$courier',status='$status' where guid='$editid'");
	if($status=='Delivered' && $det['gettime']=='Food')
	{
		$chk=mysql_fetch_array(mysql_query("select * from wallet where userid='$det[userid]' and refid='$editid'"));
		if(empty($chk['guid']))
		{
	mysql_query("INSERT INTO  `wallet` (`userid` ,`points` ,`refid` ,`date`,`status`) VALUES ('$det[userid]', '$det[total]',  '$editid',  '$date',  'Credit')");
	$profit=mysql_fetch_array(mysql_query("select sum(profit) from cart where order_id='$editid'"));
	if($profit[0]>0)
	{mysql_query("INSERT INTO  `virtualwallet` (`userid` ,`points` ,`refid` ,`date`,`status`) VALUES ('$det[userid]', '$profit[0]',  '$editid',  '$date',  'Credit')");
	}
		}
	}
header('location:orders.php?st='.$det['gettime']);	
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
                       <?php echo ucfirst($_GET['st']);?> Orders
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Admin</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
<?php if(isset($_GET) && $_GET[action]=='edit'){
	$edit=mysql_fetch_array(mysql_query("select * from orders where guid='$_GET[gid]'"));
	$check=mysql_fetch_array(mysql_query("select * from register where guid='$edit[userid]'"));
	?>
				
				<form action="orders.php" method="post" name="form1" onSubmit="return valid()">
               <table class="table table-responsive table-bordered">
 <tr><td>Name</td><td>
                        <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $check['name'];?>" readonly/>
                    </td></tr>
                     <tr><td>Email</td><td>
                        <input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo $check['email'];?>" readonly/>
                    </td></tr>
                     <tr><td>Mobile</td><td>
                        <input type="text" name="mobile" class="form-control" placeholder="Mobile" value="<?php echo $check['mobile'];?>" readonly/>
                    </td></tr>
                     <tr><td>Door No</td><td>
                        <input type="text" name="address" class="form-control" placeholder="Doorno" value="<?php echo $check['doorno'];?>" readonly/>
                    </td></tr>
                    <tr><td>LandMark</td><td>
                        <input type="text" name="address" class="form-control" placeholder="Landmark" value="<?php echo $check['landmark'];?>" readonly/>
                    </td></tr>
                    <tr><td>City</td><td>
                        <input type="text" name="address" class="form-control" placeholder="City" value="<?php echo $check['city'];?>" readonly/>
                    </td></tr>
                    <tr><td>State</td><td>
                        <input type="text" name="address" class="form-control" placeholder="State" value="<?php echo $check['state'];?>" readonly/>
                    </td></tr>
                    <tr><td colspan="2"><table class="table table-responsive table-bordered">
                    <tr><td>Product</td><td>Name</td><td>Packs</td><td>Price</td><td>Total Price</td>
                         <?php
						 $prd=mysql_query("select * from cart where order_id='$edit[guid]'");
						 $n=0;
			  while($prods=mysql_fetch_assoc($prd)){$n++;
			  if($prods['sid']>0){$products=mysql_fetch_array(mysql_query("select * from storeproducts where guid='$prods[sid]'"));
			  $qry1=mysql_query("select * from imagefiles where sid='$products[guid]' order by guid asc");}else{
				  $products=mysql_fetch_array(mysql_query("select * from products where guid='$prods[pid]'"));
				  $qry1=mysql_query("select * from imagefiles where cid='$products[guid]' order by guid asc");}?><tr>
              <td width="10%"><?php $m=0;
			  while($row1=mysql_fetch_assoc($qry1))
			  {
				 $str=substr($row1[image],-3);
				 if($str!='pdf'){if($m==0){$m++;?><img src="../../android/uploaded_files/<?php echo $row1['image'];?>" width="100" height="100"/><?php }}}?></td>
              <td class="align_left" width="44%"><?php echo $products['name'];?> <br> Quantity:<?php echo $products['quantity'];?> </td>
              <?php if($prods['price']==''){$price=$products['price'];}else{$price=$prods['price'];}?>
               <td class="align_center vline"><?php echo $prods['cquantity'];?>
               <input type="hidden" name="hidid[]" value="<?php echo $prods[guid];?>"></td>
             <td class="align_center vline"><?php echo $price;?></td>
             <td class="align_center vline"><?php echo $prods['cquantity']*$price;?></td>
			   
            </tr>
                 <?php } ?>            
                    </table></td></tr>
               
               <tr> <td>Details</td><td><textarea name="courier" class="form-control"><?php echo $edit['courier'];?></textarea>                                                          
                     
                </td></tr>
               <tr> <td>Status</td><td><input type="radio" name="status" value="Not Delivered" <?php if($edit['status']=='Not Delivered'){?> checked<?php } ?>>Not Delivered
               <input type="radio" name="status" value="Packed" <?php if($edit['status']=='Packed'){?> checked<?php } ?>>Packed
               <input type="radio" name="status" value="Delivering" <?php if($edit['status']=='Delivering'){?> checked<?php } ?>>Delivering
               <input type="radio" name="status" value="Delivered" <?php if($edit['status']=='Delivered'){?> checked<?php } ?>>Delivered                                                          
                     
                </td></tr>
                 <tr> <td colspan="2" align="center">  
               <input type="hidden" name="editid" value="<?php echo $edit['guid'];?>">
               <input type="hidden" name="invoiceid" value="<?php echo $edit['invoiceid'];?>">                                                          
                    <button type="submit" name="Submit" value="Update" class="btn bg-yellow">Update</button>  
                </td></tr></table>
            </form>
				<?php }else{?>
				 <!-- top row -->
                   <table class="table table-responsive table-bordered">

                    	<thead>

                          <tr>

                        	

                            <th>Sno</th>
                            <th>Order Id</th>
                           <th>Customer Details</th>
                           <?php if($_GET['st']=='Food'){?><th colspan="2">Details</th><?php } ?>
                           <th>Ordered On</th>
                           <th>Products</th>
                           <th>Details</th>
                            <th>Total Amount</th>
                            <th>Order Status</th>
                             <th>Print</th>
                           
                           </tr>

                        </thead>

                        <tbody>

                         <?php 
extract($_GET);include 'pageing.php';
						    $gridId = $_GET[guid];
							$limit = 90; 								
$filePath="orders.php";
if($page) 
{
$start = ($page - 1) * $limit; 			
}
else
{
$start = 0;						


$page=1;
}
//echo "select * from cat  Limit $start, $limit";

$query_clients="SELECT * FROM `orders` where gettime='$_GET[st]' and vendor_id='$details[guid]' order by guid desc  Limit $start, $limit ";
$select1="SELECT * FROM `orders` where gettime='$_GET[st]' and vendor_id='$details[guid]'";

$query_clients=mysql_query($query_clients);
$total=mysql_num_rows(mysql_query($select1));

$otherParams="st=$st";

@$divs=$total%$limit;

	if($divs==0)

	{

	@$totals=(int)($total/$limit);

	}else{

	@$totals=(int)($total/$limit) + 1;

	}$m=1;
						    while($client_count = mysql_fetch_assoc($query_clients)){$timing='';
								$check=mysql_fetch_array(mysql_query("select * from register where guid='$client_count[userid]'"));
								$vendor=mysql_fetch_array(mysql_query("select * from vendor where guid='$client_count[vendor_id]'"));
								$area=mysql_fetch_array(mysql_query("select * from cluster where guid='$client_count[refid]'"));
								 
					  ?>

                        	<tr>

                            	<td><?php echo $m; ?></td>
<td>ORD<?php echo $client_count['guid'];?></td>
                                <td><?php echo $check['name'];echo "<br>"; echo $check['mobile']; echo "<br>";echo $check['email']; echo "<br>";?>
								<?php echo $check['address'];echo "<br>";echo $check['city']; echo "<br>";echo $check['state'];  ?></td>
                                <?php if($_GET['st']=='Food'){?><td colspan="2" valign="top"><table width="100%" border="1"><tr><td valign="top" width="50%"><strong>Products</strong></td>
							   <td valign="top" width="50%"><strong>Vendor Details</strong></td></tr><?php 
			  $prd=mysql_query("select distinct(vendor_id) from cart where order_id='$client_count[guid]' and vendor_id>0");
			  
			  while($prods=mysql_fetch_assoc($prd)){$n=0;
			  ?><tr><td valign="top" width="50%"><?php 
			  $cart=mysql_query("select * from cart where vendor_id='$prods[vendor_id]' and order_id='$client_count[guid]'");
			  while($row2=mysql_fetch_assoc($cart))
			  {$n++;
			  $vendor=$row2['vendor_id'];
				  ?><?php $products=mysql_fetch_array(mysql_query("select * from products where guid='$row2[pid]'"));?>
           <?php echo $n; echo ". ";echo $products['name'];?>(<?php echo $row2['cquantity']; ?>)<br><?php }?></td>
            <td valign="top" width="50%"><?php $vendor=mysql_fetch_array(mysql_query("select * from vendor where guid='$vendor'"));
			if($vendor['guid']!=''){?>
<?php echo $vendor['name'];echo "<br>";echo $vendor['mobile'];echo "<br>";echo $vendor['email'];?>
<?php }?></td><?php } ?></tr></table></td><?php } ?>
                               <td><?php echo date('d M Y', strtotime($client_count['date'])); ?></td>
                               <td><?php 
			  $prd=mysql_query("select * from cart where order_id='$client_count[guid]'");
			  $n=0;
			  while($prods=mysql_fetch_assoc($prd)){$n++;
			  if($prods['sid']>0){$products=mysql_fetch_array(mysql_query("select * from storeproducts where guid='$prods[sid]'"));}else{
				  $products=mysql_fetch_array(mysql_query("select * from products where guid='$prods[pid]'"));}?>
           <?php echo $n; echo ". ";echo $products['name'];?>(<?php echo $prods['cquantity']; ?>)<br>
            <?php } ?></td>
            <td><?php if($client_count['getdate']!='' && $client_count['gettime']=='Store'){echo $client_count['getdate'];}?><br>
            Payment Mode : <?php echo $client_count['pmode'];?>
            </td>
            <td><?php echo $client_count['total']; ?></td>
            <td><a href="orders.php?action=edit&st=<?php echo $_GET['st'];?>&gid=<?php echo $client_count['guid']; ?>" class="btn <?php if($client_count['status']=='Delivered'){echo "btn-success";}else{echo "btn-danger";}?>"><?php echo $client_count['status'];?></a></td>
            <td><a href="../../print.php?gid=<?php echo $client_count['guid']; ?>&st=<?php echo $_GET['st'];?>" target="_blank" class="btn btn-warning">Print</a></td>
                                </tr>

                          <?php $m++;} ?>

                        </tbody>

                        <tfoot>

                        	<tr>

                            	<th colspan="12"> Showing <?php echo $page;?> of <?php echo $totals;?> Pages </th>

                            </tr>

                        </tfoot>

                    </table>
                     <ul class="pagination">

                       <?php make_pages($page,$limit,$total,$filePath,$otherParams); ?>
                       

                    </ul><?php } ?></section>
            </aside><!-- /.right-side -->
        </div>
        <!-- ./wrapper -->
        <!-- add new calendar event modal -->
       <?php include "footer-scripts.php" ?>
       <script>
	   function product_price(s,k,n)
	   {
		var cs='cost'+n;
		document.getElementById(cs).value=s*k;
		}
	   </script>
    </body>
</html>