<?php ob_start();
session_start();extract($_POST);extract($_GET);
include 'secure.php';include '../../config.php';$date=date('Y-m-d');
function get_data($url) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
} 
$details=mysql_fetch_array(mysql_query("select * from vendor where guid='$_SESSION[vendor_loginid]'"));

if(isset($_GET) && $_GET['action']=='edit')
{$wat=0;


	
	$det=mysql_fetch_array(mysql_query("select * from cart where guid='$gid'"));
	$reg=mysql_fetch_array(mysql_query("select * from area where guid='$det[area]'"));
		$credit=mysql_fetch_array(mysql_query("select sum(points) from clpwallet where userid='$reg[clp]' and status='Credit'"));
				$debit=mysql_fetch_array(mysql_query("select sum(points) from clpwallet where userid='$reg[clp]' and status='Debit'"));
				$wat=$credit[0]-$debit[0];
		
		if($wat>=$det['ctotal'])
		{
	
	if($det['order_status']=='')
	{
		
		$cluster=mysql_fetch_array(mysql_query("select * from cluster where guid='$reg[clp]'"));//echo "select * from order where guid='$det[order_id]'";exit;
		$order=mysql_fetch_array(mysql_query("select * from orders where guid='$det[order_id]'"));
		$vid=$_SESSION['vendor_loginid'];
		mysql_query("update cart set order_status='Accepted',clpid='$reg[clp]',vendor_id='$_SESSION[vendor_loginid]' where guid='$gid'");
		mysql_query("update orders set vendor_id='$vid' where guid='$order[guid]'");
		$chk=mysql_fetch_array(mysql_query("select * from clpwallet where userid='$reg[clp]' and refid='$gid'"));
		if(empty($chk['guid']) && $reg['clp']!='')
		{
	mysql_query("INSERT INTO  `clpwallet` (`userid` ,`points` ,`refid` ,`date`,`status`) VALUES ('$reg[clp]', '$det[ctotal]',  '$gid',  '$date',  'Debit')");
	$ins=mysql_insert_id();
	if($ins>0)
	{
	$com=mysql_fetch_array(mysql_query("select * from commissions order by guid desc limit 0,1"));
	$town=mysql_fetch_array(mysql_query("select * from town where guid='$cluster[town]'"));
	$zonal=mysql_fetch_array(mysql_query("select * from zonal where guid='$town[zonal]'"));
		$town_cmn=($com['city']*$det['ctotal'])/100;
		$zonal_cmn=($com['zonal']*$det['ctotal'])/100;
		$state_cmn=($com['state']*$det['ctotal'])/100;
		$misc_cmn=($com['misc']*$det['ctotal'])/100;
		$city_cmn=($com['city']*$det['ctotal'])/100;
		$clp_cmn=($com['clp']*$det['ctotal'])/100;
		$burn_cmn=($com['burnbudget']*$det['ctotal'])/100;
		$company_cmn=($com['company']*$det['ctotal'])/100;
		if($town_cmn>0){
mysql_query("INSERT INTO  `comwallet` (`userid` ,`points` ,`refid` ,`date`,`status`,`description`) VALUES ('$cluster[town]', '$town_cmn',  '$ins',  '$date',  'Credit','Town Partner')");
		}
if($zonal_cmn>0){
mysql_query("INSERT INTO  `comwallet` (`userid` ,`points` ,`refid` ,`date`,`status`,`description`) VALUES ('$town[zonal]', '$zonal_cmn',  '$ins',  '$date',  'Credit','Zonal Partner')");
}
if($state_cmn>0)
{
mysql_query("INSERT INTO  `comwallet` (`userid` ,`points` ,`refid` ,`date`,`status`,`description`) VALUES ('$zonal[state]', '$state_cmn',  '$ins',  '$date',  'Credit','State Partner')");
}
if($misc_cmn>0)
{
mysql_query("INSERT INTO  `comwallet` (`userid` ,`points` ,`refid` ,`date`,`status`,`description`) VALUES ('0', '$misc_cmn',  '$ins',  '$date',  'Credit','Misc')");
}
if($burn_cmn>0){
mysql_query("INSERT INTO  `comwallet` (`userid` ,`points` ,`refid` ,`date`,`status`,`description`) VALUES ('0', '$burn_cmn',  '$ins',  '$date',  'Credit','Burn Budget')");}
if($company_cmn>0){
mysql_query("INSERT INTO  `comwallet` (`userid` ,`points` ,`refid` ,`date`,`status`,`description`) VALUES ('0', '$company_cmn',  '$ins',  '$date',  'Credit','Company')");}
if($city_cmn>0){
mysql_query("INSERT INTO  `comwallet` (`userid` ,`points` ,`refid` ,`date`,`status`,`description`) VALUES ('0', '$city_cmn',  '$ins',  '$date',  'Credit','Town Partner')");}
if($clp_cmn>0){
mysql_query("INSERT INTO  `comwallet` (`userid` ,`points` ,`refid` ,`date`,`status`,`description`) VALUES ('0', '$clp_cmn',  '$ins',  '$date',  'Credit','Cluster Partner')");}
    }
	
	
		}
	}
	
	$message="Dear $cluster[name] your order no. FF$order[guid] for Rs.$det[ctotal] is ready with packing"; 
$sms=str_replace(" ","%20","$message"); 
$url = "http://api.smscountry.com/SMSCwebservice_bulk.aspx?User=catchway&passwd=sanju100&mobilenumber=$cluster[mobile]&message=$sms&sid=FREFUD&mtype=N&DR=Y"; 
get_data($url);
header('location:pending_orders.php?msg=Order Accepted');	
}
else
{
header('location:pending_orders.php?msg=Insufficient Balance');		
}

}
?><!DOCTYPE html>
<html>
         <?php include "styles-files.php";
		 ?>
         <script type="text/javascript">
		 function delete1()
{
  if(window.confirm("Confirm Accept"))
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
                       <?php echo ucfirst($_GET['st']);?>Pending Orders
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active"><?php echo $_SESSION['partner_status'];?></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
<?php if(isset($_GET) && $_GET[action]=='edit'){
	$edit=mysql_fetch_array(mysql_query("select * from orders where guid='$_GET[gid]'"));
	$check=mysql_fetch_array(mysql_query("select * from register where guid='$edit[userid]'"));
	?>
				
				<form action="pending_orders.php" method="post" name="form1" onSubmit="return valid()">
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
               
               <tr> <td>Courier Details</td><td><textarea name="courier" class="form-control"><?php echo $edit['courier'];?></textarea>                                                          
                     
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
                           <th>Products</th>
                            <th>Order Status</th>
                           
                           </tr>

                        </thead>

                        <tbody>

                         <?php 
extract($_GET);include 'pageing.php';
$spt=split(',',$details['area']);
for($j=0;$j<count($spt);$j++){if($spt[$j]!=''){
	$area.="'".$spt[$j]."',";
}}
$area=substr($area,0,-1);
						    $gridId = $_GET[guid];
							$limit = 90; 								
$filePath="pending_orders.php";
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

$query_clients="SELECT * FROM `cart` where order_status='' and area in ($area)  order by guid desc  Limit $start, $limit ";

$query_clients=mysql_query($query_clients);

$select1="SELECT * FROM `cart` where order_status='' and area in ($area)";

$total=mysql_num_rows(mysql_query($select1));

$otherParams="";

@$divs=$total%$limit;

	if($divs==0)

	{

	@$totals=(int)($total/$limit);

	}else{

	@$totals=(int)($total/$limit) + 1;

	}$m=1;
						    while($client_count = mysql_fetch_assoc($query_clients)){$timing='';
							$vcheck=mysql_fetch_array(mysql_query("select * from vendor_products where product_id='$client_count[pid]' and vendor_id='$_SESSION[vendor_loginid]'"));
							$vqty=mysql_fetch_array(mysql_query("select * from vendor_quantity where product_id='$client_count[pid]' and vendor_id='$_SESSION[vendor_loginid]'"));
							
							 $fqty=0;
         $chkqty[0]=0;$cartqty[0]=0;
         $chkqty=mysql_fetch_array(mysql_query("select sum(quantity) from vendor_quantity where product_id='$client_count[pid]'  and vendor_id='$_SESSION[vendor_loginid]' and date='$date'"));
		 $cartqty=mysql_fetch_array(mysql_query("select sum(cquantity) from cart where pid='$client_count[pid]' and date='$date' and order_id!=''"));
		 $fqty=$chkqty[0]-$cartqty[0];
		 
						 if($client_count['pid']>0 && $vcheck['guid']!='' && $fqty>=0){	
					  ?>

                        	<tr>

                            	<td><?php echo $m; ?></td>
<td>ORD<?php echo $client_count['order_id']; //echo "---";echo $fqty;?></td>
                               <td><?php 
			 
				   
			  
				  $products=mysql_fetch_array(mysql_query("select * from products where guid='$client_count[pid]'"));?>
           <?php echo $products['name'];?>(<?php echo $client_count['cquantity']; ?>)<br>
            </td>
            <td><a href="pending_orders.php?action=edit&gid=<?php echo $client_count['guid']; ?>" class="btn btn-danger" onClick="return delete1();">Accept</a></td>
           
                                </tr>

                          <?php $m++;} }?>

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