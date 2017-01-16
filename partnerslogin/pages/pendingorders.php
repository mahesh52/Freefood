<?php ob_start();
session_start();extract($_POST);extract($_GET);
include 'secure.php';include '../../config.php';$date=date('Y-m-d');$date1=date('Y-m-d H:i:s');
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
//echo "select * from cluster where guid='$_SESSION[partner_loginid]'";
$details = mysql_fetch_array(mysql_query("select * from cluster where guid='$_SESSION[partner_loginid]'"));
$details1 = mysql_query("select * from area where clp='$_SESSION[partner_loginid]'");

$areras = '';
while($row1 = mysql_fetch_array($details1)){
	$areras = $areras.$row1['guid'].',';
}
 $areras = rtrim($areras,',');
 $spt1 = split(',', $areras);
  $count = count($spt1);
    for ($j1 = 0; $j1 < count($spt1); $j1++) {
		
        if ($spt1[$j1] != '' && $j1 < count($spt1)-1) {
            $area1.="FIND_IN_SET('" . $spt1[$j1] . "',`area`) AND ";
        }
		else{
			$area1.="FIND_IN_SET('" . $spt1[$j1] . "',`area`)";
		}
    }
	//echo $area1;
	//echo "SELECT * FROM `vendor` where ($area1)";
$select111=mysql_fetch_array(mysql_query("SELECT * FROM `vendor` where ($area1)"));
 $food_vendor = $select111["guid"];
$food_mobile = $select111["mobile"];
$food_name = $select111["name"];
  $vendor_type = $select111["vendor_type"];
if(isset($_GET) && $_GET['action']=='edit')
{
	$det=mysql_fetch_array(mysql_query("select * from cart where guid='$gid'"));
	$order=mysql_fetch_array(mysql_query("select * from orders where guid='$det[order_id]'"));
	$user_id = $order["userid"];
	$user_det = mysql_fetch_array(mysql_query("select * from register where guid = '$user_id' "));
	$name = $user_det["name"];
	$mobile = $user_det["mobile"];
    mysql_query("update cart set order_status='$status',clpid='$_SESSION[partner_loginid]',vendor_id = '$food_vendor'  where guid='$gid'");
   
	if(trim($status)=='Declined'){
		
		if($vendor_type == "ERFV"){
			//echo "update erfvstock set available_qty = available_qty+'$det[cquantity]' where product_id='$det[pid]' and erfv_vendor='$food_vendor' ";exit;
		$chkqty = mysql_query("update erfvstock set available_qty = available_qty+$det[cquantity] where product_id='$det[pid]' and erfv_vendor='$food_vendor' ");
	}
	
		
		  $message = "Dear $name your order FF$det[order_id] cannot be processed at this time,we regret for the inconvenience caused, reach us at support@freefood.co.in";
            $sms = str_replace(" ", "%20", "$message");
            $url = "http://onlinebulksmslogin.com/spanelv2/api.php?username=freefd&password=free123&to=$mobile&from=FREEFD&message=$sms"; 
          
            get_data($url);
	}
	else{
		$message = "Dear $food_name your order no FF$det[order_id] is waiting for your acceptance";
            $sms = str_replace(" ", "%20", "$message");
            $url = "http://onlinebulksmslogin.com/spanelv2/api.php?username=freefd&password=free123&to=$food_mobile&from=FREEFD&message=$sms"; 
          
            get_data($url);
	}
     header('location:pendingorders.php');
    
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
	 function delete2()
{
  if(window.confirm("Confirm Decline"))
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
                                    <th>Customer Details</th>
                                
                                    <th>Ordered On</th>
                                <th>Products</th>
                                    <th>Details</th>
                                    <th>Total Amount</th>
                                    <th>Confirm</th><th>Decline</th>
                                    
                           </tr>

                        </thead>

                        <tbody>

                         <?php 
extract($_GET);include 'pageing.php';
$spt=split(',',$areras);
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

 //$query_clients="SELECT * FROM `cart` where order_status='' and area in ($area) and date(delivery_time) >= date(now())  order by delivery_time asc  Limit $start, $limit ";
 $query_clients = "SELECT a.guid as order_id,a.*,b.*,b.guid as guid FROM `orders` a,cart b where a.guid = b.order_id and gettime='Food' and order_status='' and b.area in ($area) 
     order by datetime desc Limit $start, $limit";
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
						    while($client_count = mysql_fetch_assoc($query_clients)){
								$timing = '';

                                    $check = mysql_fetch_array(mysql_query("select * from register where guid='$client_count[userid]'"));
                                    $vendor = mysql_fetch_array(mysql_query("select * from vendor where guid='$client_count[vendor_id]'"));
                                    $area = mysql_fetch_array(mysql_query("select * from cluster where guid='$client_count[refid]'"));
                                    ?>

                                    <tr>

                                        <td><?php echo $m; ?></td>
                                        <td>ORD<?php echo $client_count['order_id']; ?></td>
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
                                        <?php //if($_SESSION['partner_status']!="Food Vendor"){?>
										<!--td>
										<?php //echo round(($client_count['cquantity']*$client_count['price'])+$client_count['vat']); ?>
										</td-->
										<?php //} ?> 
<td>
<?php 
										$sql_check_delivered11 = mysql_num_rows(mysql_query("select * from freefood_coupons_used where order_id = '$client_count[order_id]' "));
										
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
													
													}
													else{
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
										 
										
										?>
</td>
                                        <td><a href="pendingorders.php?action=edit&gid=<?php echo $client_count['guid']; ?>&status=Confirmed" class="btn btn-danger" onClick="return delete1();">Confirm</a></td>
           <td><a href="pendingorders.php?action=edit&gid=<?php echo $client_count['guid']; ?>&status=Declined" class="btn btn-danger" onClick="return delete2();">Decline</a></td>
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
