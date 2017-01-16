<?php ob_start();$date=date('Y-m-d');
session_start();extract($_POST);

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
include 'secure.php';include '../../config.php'; 
if(isset($_GET) && $_GET['action']=='send')
{
//include 'invoice_mail.php';
header('location:orders.php');	
}

if(isset($_POST) && $_POST['Submit']=='Update')
{
	
	 if(strtoupper($_POST["sthidden"]) == "STORE"){
		 
		 $det=mysql_fetch_array(mysql_query("select * from orders where guid='$editid'"));
	$user_id = $det["userid"];
	$user_det = mysql_fetch_array(mysql_query("select * from register where guid = '$user_id' "));
	$name = $user_det["name"];
	$mobile = $user_det["mobile"];
	$gettime = $det['gettime'];
	mysql_query("update orders set courier='$courier',status='$status' where guid='$editid'");
	if($status=='Delivered' && $gettime=='Food')
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
	 else{
        $det = mysql_fetch_array(mysql_query("select * from cart where guid='$editid'"));
		
		
    $detorder = mysql_fetch_array(mysql_query("select * from orders where guid='$det[order_id]]'"));
	$user_id = $detorder["userid"];
	$user_det = mysql_fetch_array(mysql_query("select * from register where guid = '$user_id' "));
	$name = $user_det["name"];
	$mobile = $user_det["mobile"];
	$gettime = $detorder['gettime'];
    mysql_query("update cart set courier='$courier',order_status='$status' where guid='$editid'");
    if ($status == 'Delivered' && $detorder['gettime'] == 'Food') {
		$sql_couponsupdate = mysql_query("select * from freefood_coupons_used where order_id = '$det[order_id]' and product_id = '$det[pid]' ");
		$coupon_rowsupdate = mysql_num_rows($sql_couponsupdate);
		if($coupon_rowsupdate == 0){
			$discount_pts =0;
		}
		else{
			$sql_ordersupdate = mysql_fetch_array(mysql_query("select * from orders where guid = '$det[order_id]' "));
			$discount_pts = $sql_ordersupdate["discount"];
			//$discount_pts = 
		}
		 $ctotal_pts = $det['ctotal']-$discount_pts;
        $chk = mysql_fetch_array(mysql_query("select * from wallet where userid='$detorder[userid]' and cart_id='$editid'"));
        if (empty($chk['guid'])) {
			if($ctotal_pts > 0){
				mysql_query("INSERT INTO  `wallet` (`userid` ,`points` ,`refid` ,`date`,`status`,cart_id) VALUES ('$detorder[userid]', '$ctotal_pts',  '$det[order_id]',  '$date',  'Credit','$editid')");
			}
            
            $profit = mysql_fetch_array(mysql_query("select sum(profit) from cart where guid='$editid'"));
            if ($profit[0] > 0) {
                mysql_query("INSERT INTO  `virtualwallet` (`userid` ,`points` ,`refid` ,`date`,`status`,cart_id) VALUES ('$detorder[userid]', '$profit[0]',  '$det[order_id]',  '$date',  'Credit','$editid')");
            }
        }
    }
	if(trim($status)=='Declined'){
		
		  $message = "Dear $name your order FF$det[order_id] cannot be processed at this time,we regret for the inconvenience caused, reach us at support@freefood.co.in";
            $sms = str_replace(" ", "%20", "$message");
            $url = "http://onlinebulksmslogin.com/spanelv2/api.php?username=freefd&password=free123&to=$mobile&from=FREEFD&message=$sms"; 
          
            get_data($url);
	}
    header('location:orders.php?st=' . $detorder['gettime']);
    }
	
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
	if(strtoupper($_GET["st"]) == "STORE"){ 
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
              <td class="align_left" width="44%"><?php echo $products['name'];?>  </td>
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
			    <input type="radio" name="status" value="Declined" <?php if($edit['status']=='Declined'){?> checked<?php } ?>>Declined                                                          
                     
                </td></tr>
                 <tr> <td colspan="2" align="center">  
               <input type="hidden" name="editid" value="<?php echo $edit['guid'];?>">
               <input type="hidden" name="invoiceid" value="<?php echo $edit['invoiceid'];?>">                                                          
<input type ="hidden" name ="sthidden" value ="<?php echo $_GET["st"]; ?>" />              
			  <button type="submit" name="Submit" value="Update" class="btn bg-yellow">Update</button>  
                </td></tr></table>
            </form>
	<?php }else{
                            
                       
                        
                        $edit = mysql_fetch_array(mysql_query("select * from cart where guid='$_GET[gid]'"));
                        $order = mysql_fetch_array(mysql_query("select * from orders where guid='$edit[order_id]'"));
                        $check = mysql_fetch_array(mysql_query("select * from register where guid='$order[userid]'"));
						?>

                        <form action="orders.php" method="post" name="form1" onSubmit="return valid()">
                            <table class="table table-responsive table-bordered">
                                <tr><td>Name</td><td>
                                        <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $check['name']; ?>" readonly/>
                                    </td></tr>
                                <tr><td>Email</td><td>
                                        <input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo $check['email']; ?>" readonly/>
                                    </td></tr>
                                <tr><td>Mobile</td><td>
                                        <input type="text" name="mobile" class="form-control" placeholder="Mobile" value="<?php echo $check['mobile']; ?>" readonly/>
                                    </td></tr>
                                <tr><td>Door No</td><td>
                                        <input type="text" name="address" class="form-control" placeholder="Doorno" value="<?php echo $check['doorno']; ?>" readonly/>
                                    </td></tr>
                                <tr><td>LandMark</td><td>
                                        <input type="text" name="address" class="form-control" placeholder="Landmark" value="<?php echo $check['landmark']; ?>" readonly/>
                                    </td></tr>
                                <tr><td>City</td><td>
                                        <input type="text" name="address" class="form-control" placeholder="City" value="<?php echo $check['city']; ?>" readonly/>
                                    </td></tr>
                                <tr><td>State</td><td>
                                        <input type="text" name="address" class="form-control" placeholder="State" value="<?php echo $check['state']; ?>" readonly/>
                                    </td></tr>
                                <tr><td colspan="2"><table class="table table-responsive table-bordered">
                                            <tr><td>Product</td><td>Name</td><td>Packs</td><td>Price</td><td>VAT</td><td>Total Price</td><td>Discount</td><td>Payable</td>
                                                <?php
                                                $prd = mysql_query("select * from cart where guid='$_GET[gid]'");
                                                $n = 0;
                                                while ($prods = mysql_fetch_assoc($prd)) {
                                                    $n++;
                                                    if ($prods['sid'] > 0) {
                                                        $products = mysql_fetch_array(mysql_query("select * from storeproducts where guid='$prods[sid]'"));
                                                        $qry1 = mysql_query("select * from imagefiles where sid='$products[guid]' order by guid asc");
                                                    } else {
                                                        $products = mysql_fetch_array(mysql_query("select * from products where guid='$prods[pid]'"));
                                                        $qry1 = mysql_query("select * from imagefiles where cid='$products[guid]' order by guid asc");
                                                    }
                                                    ?><tr>
                                                    <td width="10%"><?php
                                                    $m = 0;
                                                    while ($row1 = mysql_fetch_assoc($qry1)) {
                                                        $str = substr($row1[image], -3);
                                                        if ($str != 'pdf') {
                                                            if ($m == 0) {
                                                                $m++;
                                                                ?><img src="../../android/uploaded_files/<?php echo $row1['image']; ?>" width="100" height="100"/><?php }
                                                        }
                                                    } ?></td>
                                                    <td class="align_left" width="44%"><?php echo $products['name']; ?>  </td>
        <?php if ($prods['price'] == '') {
            $price = $products['price'];
        } else {
            $price = $prods['price'];
        } ?>
                                                    <td class="align_center vline"><?php echo $prods['cquantity']; ?>
                                                        <input type="hidden" name="hidid[]" value="<?php echo $prods[guid]; ?>"></td>
                                                    <td class="align_center vline"><?php echo $price; ?></td> <td class="align_center vline"><?php echo $prods['vat']; ?></td>
													<?php 
													//echo "select * from freefood_coupons_used where order_id = '$edit[order_id]' and product_id = '$prods[pid]' ";
													$sql_couponsupdate1 = mysql_query("select * from freefood_coupons_used where order_id = '$edit[order_id]'  ");
		$coupon_rowsupdate1 = mysql_num_rows($sql_couponsupdate1);
		if($coupon_rowsupdate1 == 0){
			$discount_pts1 =0;
		}
		else{
			$sql_ordersupdate1 = mysql_fetch_array(mysql_query("select * from orders where guid = '$edit[order_id]' "));
			$discount_pts1 = $sql_ordersupdate1["discount"];
			//$discount_pts = 
		}
		
													?>
													<td class="align_center vline"><?php echo $discount_pts1; ?></td>
													<?php if ($prods['pid'] > 0) { 
													$sql_check_delivered11 = mysql_num_rows(mysql_query("select * from freefood_coupons_used where order_id = '$edit[order_id]' and product_id = '$edit[pid]' "));
												if($sql_check_delivered11 > 0 ){
													
													$final_price = ($prods['cquantity'] * $price)+$prods['vat'];
												}
												else{
													
													$sql_check_surcharge = mysql_fetch_array(mysql_query("select sum(cquantity*price) as total_price from cart where order_id = '$edit[order_id]'"));
													//echo "select discount  from orders where guid = '$client_count[order_id]'";
$sql_check_surcharge11 = mysql_fetch_array(mysql_query("select discount  from orders where guid = '$edit[order_id]'"));
										if($sql_check_surcharge['total_price'] - $sql_check_surcharge11["discount"] >= 250){
											 $final_price =  ($prods['cquantity']*$prods['price'])+$prods['vat'];
										}
										else{
											
											     $sql_check_delivered = mysql_num_rows(mysql_query("select * from cart where order_id = '$edit[order_id]' and order_status = 'Delivered' and pid  in (select product_id from freefood_coupons_used where order_id = '$edit[order_id]' and product_id = '$edit[pid]') "));
											if($sql_check_delivered == 0){
												$final_price =   ($prods['cquantity']*$prods['price'])+20+$prods['vat'];
											}
											else{
												$final_price =   $prods['cquantity']*$prods['price']+$prods['vat'];
											}
										}
												}		}
													else{
														$final_price = ($prods['cquantity'] * $price)+$prods['vat'];
													}
										?>
                                                    <td class="align_center vline"><?php echo $final_price; ?></td>
<td class="align_center vline"><?php echo $final_price-$discount_pts1; ?></td>
                                                </tr>
    <?php } ?>            
                                        </table></td></tr>

                                <tr> <td>Details</td><td><textarea name="courier" class="form-control"><?php echo $order['courier']; ?></textarea>                                                          

                                    </td></tr>
                                <tr> <td>Status</td><td><input type="radio" name="status" value="Not Delivered" <?php if ($edit['order_status'] == 'Accepted') { ?> checked<?php } ?>>Not Delivered
                                        <input type="radio" name="status" value="Packed" <?php if ($edit['order_status'] == 'Packed') { ?> checked<?php } ?>>Packed
                                        <input type="radio" name="status" value="Delivering" <?php if ($edit['order_status'] == 'Delivering') { ?> checked<?php } ?>>Delivering
                                        <input type="radio" name="status" value="Delivered" <?php if ($edit['order_status'] == 'Delivered') { ?> checked<?php } ?>>Delivered                                                          
<input type="radio" name="status" value="Declined" <?php if ($edit['order_status'] == 'Declined') { ?> checked<?php } ?>>Declined 
<input type="radio" name="status" value="Accepted" <?php if ($edit['order_status'] == 'Accepted') { ?> checked<?php } ?>>Accepted 
                                    </td></tr>
                                <tr> <td colspan="2" align="center">  
                                        <input type="hidden" name="editid" value="<?php echo $edit['guid']; ?>">
                                        <input type="hidden" name="invoiceid" value="<?php echo $edit['invoiceid']; ?>">                                                          
                                        <button type="submit" name="Submit" value="Update" class="btn bg-yellow">Update</button>  
                                    </td></tr></table>
                            <input type ="hidden" name ="sthidden" value ="<?php echo $_GET["st"]; ?>" />
                        </form>
						<?php }					
						}else{?>
				 <!-- top row -->
                   <table class="table table-responsive table-bordered">

                    	<thead>

                          <tr>

                        	

                            <th>Sno</th>
                            <th>Order Id</th>
                           <th>Customer Details</th>
                           <?php if($_GET['st']=='Food'){?><th colspan="2">Details</th><?php } ?>
                           <th>Ordered On</th>
                           <?php if ($_GET['st'] != 'Food') { ?><th>Products</th><?php } ?>
                           <th>Details</th>
                            <th>Total Amount</th>
							<?php if($_GET['st']=='Food'){?> <th>Discount</th><?php } ?>
						
                            <th>Order Status</th>
                           <?php if($_GET['st']=='Food' || $_GET['st']=='Store'){ ?>
						   <th>Print</th><?php } ?>
                           
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
if($_GET["st"] == "Food"){
	$query_clients = "SELECT a.guid as order_id,a.*,b.*,b.guid as guid FROM `orders` a,cart b where a.guid = b.order_id and gettime='$_GET[st]'  and b.order_id != ''
     order by a.guid desc Limit $start, $limit";
	 $select1 = "SELECT * FROM `orders` a,cart b where a.guid = b.order_id and gettime='$_GET[st]' and b.order_id != '' ";
}
else if($_GET["st"] == "Coupons"){
	$query_clients="SELECT * FROM `orders` where gettime='$_GET[st]' and status = 'Delivered' order by guid desc  Limit $start, $limit ";



$select1="SELECT * FROM `orders` where gettime='$_GET[st]' and status = 'Delivered'";
}
else{
	$query_clients="SELECT * FROM `orders` where gettime='$_GET[st]'  order by guid desc  Limit $start, $limit ";



$select1="SELECT * FROM `orders` where gettime='$_GET[st]'";


}
//echo $query_clients;
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
	if($_GET["st"] == "Food"){
		while($client_count = mysql_fetch_assoc($query_clients)){$timing='';
		
		$check=mysql_fetch_array(mysql_query("select * from register where guid='$client_count[userid]'"));
								$vendor=mysql_fetch_array(mysql_query("select * from vendor where guid='$client_count[vendor_id]'"));
								$area=mysql_fetch_array(mysql_query("select * from cluster where guid='$client_count[refid]'"));
								 
					  ?>
					  <td><?php echo $m; ?></td>
                                        <td>ORD<?php echo $client_count['order_id']; ?>
										<?php if($client_count['referral_code'] != ""){ ?>
										<br>(Referral : 
										<?php echo $client_count['referral_code']; ?>) <?php } ?></td>
										<td><?php echo $check['name'];
                                        echo "<br>";
                                        echo $check['mobile'];
                                        echo "<br>";
                                        echo $check['email'];
                                        echo "<br>"; ?>
                                                            <?php echo $check['address'];
                                                            echo "<br>";
                                                            echo $check['city'];
                                                            echo "<br>";
                                                            echo $check['state']; ?></td>
															  <?php if ($_GET['st'] == 'Food') { ?><td colspan="2" valign="top"><table width="100%" border="1"><tr><td valign="top" width="50%"><strong>Products</strong></td>
                                                        <td valign="top" width="50%"><strong>Vendor Details</strong></td></tr><?php
                                                            //  $prd=mysql_query("select distinct(vendor_id) from cart where order_id='$client_count[order_id]' and vendor_id>0");
                                                            // while($prods=mysql_fetch_assoc($prd)){
                                                            //  $n=0;
                                                            ?><tr><td valign="top" width="50%"><?php
                                                //  echo "select * from cart where vendor_id='$client_count[vendor_id]' and id='$client_count[guid]'";
                                                //  $cart=mysql_query("select * from cart where vendor_id='$client_count[vendor_id]' and guid='$client_count[guid]'");
                                                // while($row2=mysql_fetch_assoc($cart))
                                                // {$n++;
                                                // $vendor=$row2['vendor_id'];
                                                ?><?php $products = mysql_fetch_array(mysql_query("select * from products where guid='$client_count[pid]'")); ?>
            <?php echo $products['name']; ?>(<?php echo $client_count['cquantity']; ?>)<br><?php //} ?></td>
                                                        <td valign="top" width="50%"><?php $vendor = mysql_fetch_array(mysql_query("select * from vendor where guid='$client_count[vendor_id]'"));
            if ($vendor['guid'] != '') {
                ?>
                                                        <?php echo $vendor['name'];
                                                        echo "<br>";
                                                        echo $vendor['mobile'];
                                                        echo "<br>";
                                                        echo $vendor['email']; ?>
            <?php } ?></td><?php //}  ?></tr></table></td><?php } ?>
			 <td><?php echo date('d M Y', strtotime($client_count['date'])); ?></td>
			 <?php if ($_GET['st'] != 'Food') { ?>    <td><?php
                            $prd = mysql_query("select * from cart where order_id='$client_count[order_id]'");
                            $n = 0;
                            while ($prods = mysql_fetch_assoc($prd)) {
                                $n++;
                                if ($prods['sid'] > 0) {
                                    $products = mysql_fetch_array(mysql_query("select * from storeproducts where guid='$prods[sid]'"));
                                } else {
                                    $products = mysql_fetch_array(mysql_query("select * from products where guid='$prods[pid]'"));
                                }
                                ?>
                <?php echo $n;
                echo ". ";
                echo $products['name']; ?>(<?php echo $prods['cquantity']; ?>)<br>
            <?php } ?></td><?php } ?>
			 <td><?php if ($client_count['getdate'] != '' && $client_count['gettime'] == 'Store') {
            echo $client_count['getdate'];
        } ?><br>
                                          <?php if($_SESSION['partner_status']!="Food Vendor"){?>
										  Payment Mode : <?php echo $client_count['pmode']; ?>
										  <?php } ?>
										  <br> 
										  <?php if($client_count['gettime'] == 'Food'){ ?>
                                            Delivery Slot:<br>
        <?php echo date('d-M-Y G:i A', strtotime($client_count['delivery_time'])); ?>- <b><?php echo
        date('G:i A', strtotime("+150 minutes", strtotime($client_count['delivery_time'])));
                                             } ?>
       
                                        </td>
										 
										<td>
										<?php 
										$sql_check_delivered11 = mysql_num_rows(mysql_query("select * from freefood_coupons_used where order_id = '$client_count[order_id]' "));
										//and product_id = '$client_count[pid]'
										if($sql_check_delivered11 > 0 ){
											$sql_check_delivered111 = mysql_fetch_array(mysql_query("select * from freefood_coupons_used where order_id = '$client_count[order_id]' "));
													if($sql_check_delivered111['product_id'] == 0){
															$sql_check_surcharge = mysql_fetch_array(mysql_query("select sum(cquantity*price) as total_price from cart where order_id = '$client_count[order_id]'"));
										$sql_check_surcharge11 = mysql_fetch_array(mysql_query("select discount  from orders where guid = '$client_count[order_id]'"));
										if($sql_check_surcharge['total_price'] - $sql_check_surcharge11["discount"] >= 250){
											$final_price =  ($client_count['cquantity']*$client_count['price'])+$client_count['vat'];
										}
										else{
											
											   $sql_check_delivered = mysql_num_rows(mysql_query("select * from cart where order_id = '$client_count[order_id]' and order_status = 'Delivered' "));
											if($sql_check_delivered == 0){
												$final_price =   ($client_count['cquantity']*$client_count['price'])+20+$client_count['vat']-$sql_check_surcharge11["discount"];
											}
											else{
												$final_price =   $client_count['cquantity']*$client_count['price']+$client_count['vat'];
											}
										}
													}else{
														$final_price =  ($client_count['cquantity']*$client_count['price'])+$client_count['vat'];
													}
													
												}
												else{
													$sql_check_surcharge = mysql_fetch_array(mysql_query("select sum(cquantity*price) as total_price from cart where order_id = '$client_count[order_id]'"));
										$sql_check_surcharge11 = mysql_fetch_array(mysql_query("select discount  from orders where guid = '$client_count[order_id]'"));
										if($sql_check_surcharge['total_price'] - $sql_check_surcharge11["discount"] >= 250){
											$final_price =  ($client_count['cquantity']*$client_count['price'])+$client_count['vat'];
										}
										else{
											   $sql_check_delivered = mysql_num_rows(mysql_query("select * from cart where order_id = '$client_count[order_id]' and order_status = 'Delivered' and pid  in (select product_id from freefood_coupons_used where order_id = '$client_count[order_id]' and product_id = '$client_count[pid]') "));
											if($sql_check_delivered == 0){
												$final_price =   ($client_count['cquantity']*$client_count['price'])+20+$client_count['vat'];
											}
											else{
												$final_price =   $client_count['cquantity']*$client_count['price']+$client_count['vat'];
											}
										}
												}
										
										echo $final_price;
										 
										
										?></td>
										
										<?php if($client_count['gettime'] == 'Food'){ ?>
										<td>
											<?php
											//echo "select * from freefood_coupons_used where order_id = '$client_count[order_id]' and product_id = '$client_count[pid]' ";
											$sql_coupons = mysql_query("select * from freefood_coupons_used where order_id = '$client_count[order_id]' and product_id = '$client_count[pid]' ");
											$coupon_rows = mysql_num_rows($sql_coupons);
											if($coupon_rows == 0){
												$discount = 0;
											}
											else{
												$sql_orders = mysql_fetch_array(mysql_query("select * from orders where guid = '$client_count[order_id]' "));
												$discount = $sql_orders["discount"];
											}
											echo $discount;
											?>
										</td>
										<?php } ?>
										<td>
										
										<a href="orders.php?action=edit&st=<?php echo $_GET['st']; ?>&gid=<?php echo $client_count['guid']; ?>" class="btn <?php if ($client_count['order_status'] == 'Delivered') {
            echo "btn-success";
        } else {
            echo "btn-danger";
        } ?>"><?php if ($client_count['order_status'] == "Delivered") {
            echo "Delivered";
        } else {
			if($client_count['order_status'] == ""){
				echo "Not Accepted";
			}else{
				echo $client_count['order_status'];
			}
            
        } ?></a>
										 
		</td><td>
                                            <a href="../../print.php?gid=<?php echo $client_count['guid']; ?>&st=<?php echo $_GET['st']; ?>" target="_blank" class="btn btn-warning">Print</a>
                                        </td>
										</tr>
					  <?php $m++;
		}
	}else{
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
							//   echo "select * from cart where order_id='$client_count[guid]'";
			  $prd=mysql_query("select * from cart where order_id='$client_count[guid]'");
			  $n=0;
			  while($prods=mysql_fetch_assoc($prd)){$n++;
			  if($prods['sid']>0){
				 // echo "select * from storeproducts where guid='$prods[sid]'";
				  $products=mysql_fetch_array(mysql_query("select * from storeproducts where guid='$prods[sid]'"));}
			  else if($prods['cid']>0){
				  
				  $products=mysql_fetch_array(mysql_query("select * from coupons where guid='$prods[cid]'"));
			  }
			  else{
				  $products=mysql_fetch_array(mysql_query("select * from products where guid='$prods[pid]'"));
				  }?>
           <?php echo $n; echo ". ";
		   echo $products['name'];
		   
		   ?>(<?php echo $prods['cquantity']; ?>)<br>
		 <?php   
		 if($prods['cid']>0){
			   $cvendor=mysql_fetch_array(mysql_query("select * from couponsvendor where guid='$products[coupon_vendor]'"));
		   } ?>
		  <?php if($prods['cid']>0){ ?>
		   (<?php echo $cvendor['name']; ?>)<br><?php  } ?>
            <?php  } ?>
			 
			</td>
            <td><?php if($client_count['getdate']!='' && $client_count['gettime']=='Store'){echo $client_count['getdate'];}?><br>
            Payment Mode : <?php echo $client_count['pmode'];?>
            </td>
            <td><?php echo $client_count['total']; ?></td>
            <td>
			<?php if($_GET['st']=='Food' || $_GET['st']=='Store'){ ?>
			<a href="orders.php?action=edit&st=<?php echo $_GET['st'];?>&gid=<?php echo $client_count['guid']; ?>" class="btn <?php if($client_count['status']=='Delivered'){echo "btn-success";}else{echo "btn-danger";}?>">
			<?php echo $client_count['status'];?></a>
			<?php }else{ echo "Success";} ?>
			</td>
			<?php if($_GET['st']=='Food' || $_GET['st']=='Store'){ ?>
            <td><a href="../../print.php?gid=<?php echo $client_count['guid']; ?>&st=<?php echo $_GET['st'];?>" target="_blank" class="btn btn-warning">Print</a></td>
			<?php } ?>       </tr>

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