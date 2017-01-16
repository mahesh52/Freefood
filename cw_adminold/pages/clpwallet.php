<?php ob_start();
session_start();$date=date('Y-m-d');extract($_POST);extract($_GET);
include 'secure.php';include '../../config.php'; 

if(isset($_POST) && $_POST['hidid']!='')
{
mysql_query("INSERT INTO `clpwallet` (`userid` ,`points` ,`date` ,`status`) VALUES ('$hidid',  '$amount',  '$date',  'Credit')");
header('location:clpwallet.php');	
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
                        CLP Wallet
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Admin</li>
                    </ol>
                </section>

                <!-- Main content -->
               
				<?php if(isset($_GET) && $_GET[action]=='edit'){
					$det=mysql_fetch_array(mysql_query("select * from cluster where guid='$guid'"));?>
				
				<form action="clpwallet.php" method="post" name="form1" onSubmit="return valid()">
               <table class="table table-responsive table-bordered">

                         
                             
                     <tr><td>CLP Name</td><td>
                        <input type="text" name="clp" class="form-control" placeholder="CLP Name" value="<?php echo $det['name'];?>" readonly/>
                    </td></tr>
                    <tr><td>Mobile</td><td>
                        <input type="text" name="mobile" class="form-control" placeholder="Mobile" value="<?php echo $det['mobile'];?>" readonly/>
                    </td></tr>
                    <tr><td>Email Id</td><td>
                        <input type="email" name="email" class="form-control" placeholder="Email ID" value="<?php echo $det['email'];?>" readonly/>
                    </td></tr>
                    <tr><td>Amount</td><td>
                        <input type="text" name="amount" class="form-control" placeholder="Amount" value=""/>
                    </td></tr>
                   <tr><td colspan="2">  
               <input type="hidden" name="hidid" value="<?php echo $det['guid'];?>">                                                          
                    <button type="submit" name="Submit" value="Update" class="btn bg-yellow btn-block">Submit</button>  
                </td></tr></table>
            </form><?php }elseif(isset($_GET) && $_GET['action']=='view'){?>
			<table class="table table-responsive table-bordered">

                    	<thead>

                          <tr>

                        	

                            <th>Sno</th>
                            <th>Order Id</th>
                             <th>Name</th>

                           <th>Contact Details</th>
                           <th>Address</th>
                           <th>Ordered On</th>
                           <th>Products</th>
                           <th>Delivery Time</th>
                            <th>Total Amount</th>
                            <th>Order Status</th>
                             <th>Print</th>
                           
                           </tr>

                        </thead>

                        <tbody>

                         <?php 

$query_clients="SELECT * FROM `orders` where gettime='Food' and refid='$_GET[guid]'  order by guid desc ";

$query_clients=mysql_query($query_clients);

$select1="SELECT * FROM `orders` where gettime='Food' and refid='$_GET[guid]'";

$total=mysql_num_rows(mysql_query($select1));

$m=1;
						    while($client_count = mysql_fetch_assoc($query_clients)){$timing='';
								$check=mysql_fetch_array(mysql_query("select * from register where guid='$client_count[userid]'"));
								 
					  ?>

                        	<tr>

                            	<td><?php echo $m; ?></td>
<td>ORD<?php echo $client_count['guid'];?></td>
                                <td><?php echo $check['name'];?></td>

                               <td><?php echo $check['email']; echo "<br>";echo $check['mobile']; ?></td>
                               <td><?php echo $check['address'];echo "<br>";echo $check['city']; echo "<br>";echo $check['state'];  ?></td>
                               <td><?php echo date('d M Y', strtotime($client_count['date'])); ?></td>
                               <td><?php 
			  $prd=mysql_query("select * from cart where order_id='$client_count[guid]'");
			  $n=0;
			  while($prods=mysql_fetch_assoc($prd)){$n++;
			  if($prods['sid']>0){$products=mysql_fetch_array(mysql_query("select * from storeproducts where guid='$prods[sid]'"));}else{
				  $products=mysql_fetch_array(mysql_query("select * from products where guid='$prods[pid]'"));}?>
           <?php echo $n; echo ". ";echo $products['name'];?>(<?php echo $prods['cquantity']; ?>)<br>
            <?php } ?></td>
            <td><?php if($client_count['getdate']!=''){echo $client_count['getdate'];}?><br>
            Payment Mode : <?php echo $client_count['pmode'];?>
            </td>
            <td><?php echo $client_count['total']; ?></td>
            <td><a href="orders.php?action=edit&st=<?php echo $_GET['st'];?>&gid=<?php echo $client_count['guid']; ?>" class="btn <?php if($client_count['status']=='Delivered'){echo "btn-success";}else{echo "btn-danger";}?>"><?php echo $client_count['status'];?></a></td>
            <td><a href="print.php?gid=<?php echo $client_count['guid']; ?>&st=<?php echo $_GET['st'];?>" target="_blank" class="btn btn-warning">Print</a></td>
                                </tr>

                          <?php $m++;} ?>

                        </tbody>

                        <tfoot>

                        	<tr>

                            	<th colspan="12"> Showing <?php echo $page;?> of <?php echo $totals;?> Pages </th>

                            </tr>

                        </tfoot>

                    </table>
			<?php }else{?>
                <section class="content">
<form method="get" action="clpwallet.php"><table class="table table-responsive table-bordered">
                   <tr><td><input type="text" class="form-control" name="area" placeholder="Name / Email / Mobile" required  value="<?php echo $area;?>"> 
			 </td>
            <td><button type="submit" name="Search" value="Search" class="btn btn-warning">Search</button></td></tr></table></form>
				 <!-- top row -->
                   <table class="table table-responsive table-bordered">

                    	<thead>

                          <tr>

                        	

                            <th>Sno</th>
                            <th>Area</th>
                            <th>CLP Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Deposit Amount</th>
                            <th>Orders</th>
                           </tr>

                        </thead>

                        <tbody>

                         <?php 
include 'pageing.php';
						    $gridId = $_GET[guid];
							$limit = 90; 								

$filePath="clpwallet.php";

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
$query_clients="SELECT * FROM `cluster` where (name LIKE '%$area%' || email LIKE '%$area%' || mobile LIKE '%$area%')  order by guid desc  Limit $start, $limit ";
$select1="SELECT * FROM `cluster` where (name LIKE '%$area%' || email LIKE '%$area%' || mobile LIKE '%$area%')";	
}
else{
$query_clients="SELECT * FROM `cluster` order by guid desc  Limit $start, $limit ";
$select1="SELECT * FROM `cluster`";
}

$query_clients=mysql_query($query_clients);

$total=mysql_num_rows(mysql_query($select1));

$otherParams="area=$area&Search=$Search";

@$divs=$total%$limit;

	if($divs==0)

	{

	@$totals=(int)($total/$limit);

	}else{

	@$totals=(int)($total/$limit) + 1;

	}$m=1;
						    while($client_count = mysql_fetch_assoc($query_clients)){
								$orders=mysql_num_rows(mysql_query("select * from orders where refid='$client_count[guid]'"));
				$credit=mysql_fetch_array(mysql_query("select sum(points) from clpwallet where userid='$client_count[guid]' and status='Credit'"));
				$debit=mysql_fetch_array(mysql_query("select sum(points) from clpwallet where userid='$client_count[guid]' and status='Debit'"));
				$wat=$credit[0]-$debit[0];?>

                        	<tr>

                            	<td><?php echo $m; ?></td>
                               <td><?php echo $client_count['name'];?></td>
                               <td><?php echo $client_count['name'];?></td>
                               <td><?php echo $client_count['email'];?></td>
                               <td><?php echo $client_count['mobile'];?></td>
                               <td><a href="clpwallet.php?action=edit&guid=<?php echo $client_count['guid']; ?>"><button type="button" class="btn btn-default">Balance : <?php echo $wat;?></button></a></td>
                                <td><a href="clpwallet.php?action=view&guid=<?php echo $client_count['guid']; ?>"><button type="button" class="btn btn-danger">Total : <?php echo $orders;?></button></a></td>

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
       <?php include "footer-scripts.php" ?>
    </body>
</html>