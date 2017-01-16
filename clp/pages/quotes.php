<?php ob_start();
session_start();extract($_POST);
include 'secure.php';include '../../config.php'; 
if(isset($_GET) && $_GET['action']=='send')
{
include 'invoice_mail.php';
header('location:quotes.php');	
}
if(isset($_POST) && $_POST['Submit']=='Update')
{
	mysql_query("update orders set name='$name',email='$email',mobile='$mobile',address='$address',status='$status' where guid='$editid'");
	for($i=0;$i<count($hidid);$i++)
	{	
mysql_query("update cart set price='$price[$i]',ctotal='$cost[$i]' where guid='$hidid[$i]'");
	}
	if($status=='Send')
	{
		if($invoiceid=='')
		{
			
		function randmgrt($rtid) {
global $rndmid; //echo $rootid;
    if ($rtid != "") {
		//echo "SELECT * FROM customdetails where userid='$rootid'";
		$rndid = mysql_fetch_array(mysql_query("SELECT * FROM orders where invoiceid='$rtid'"));
		if(empty($rndid['invoiceid']))
		{
		 $rndmid=$rtid;
		}
		else
		{
			 $prd=rand(999999,9999999);
			 $rndm=$prd;
		randmgrt($rndm);
		}
    }
}
$dftid="8554199";
randmgrt($dftid);
	$val= $rndmid;	
	mysql_query("update orders set invoiceid='$val' where guid='$editid'");
		}
		
	include 'quote_mail.php';	
	}
header('location:quotes.php');	
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
                        Quotes
                        
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
	?>
				
				<form action="quotes.php" method="post" name="form1" onSubmit="return valid()">
               <table class="table table-responsive table-bordered">
 <tr><td>Name</td><td>
                        <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $edit[name];?>"/>
                    </td></tr>
                     <tr><td>Email</td><td>
                        <input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo $edit[email];?>"/>
                    </td></tr>
                     <tr><td>Mobile</td><td>
                        <input type="text" name="mobile" class="form-control" placeholder="Mobile" value="<?php echo $edit[mobile];?>"/>
                    </td></tr>
                     <tr><td>Address</td><td>
                        <input type="text" name="address" class="form-control" placeholder="Address" value="<?php echo $edit[address];?>"/>
                    </td></tr>
                    <tr><td colspan="2"><table class="table table-responsive table-bordered">
                    <tr><td>Product</td><td>Name</td><td>Quantity</td><td>Price</td><td>Total Price</td>
                         <?php $prd=mysql_query("select * from cart where session_id='$edit[session_id]'");
						 $n=0;
			  while($prods=mysql_fetch_assoc($prd)){$n++;
				  $products=mysql_fetch_array(mysql_query("select * from products where guid='$prods[pid]'"));?><tr>
              <td width="10%"><?php $qry1=mysql_query("select * from imagefiles where cid='$products[guid]' order by guid asc");$m=0;
			  while($row1=mysql_fetch_assoc($qry1))
			  {
				 $str=substr($row1[image],-3);
				 if($str!='pdf'){if($m==0){$m++;?><img src="../../uploaded_files/small<?php echo $row1['image'];?>"/><?php }}}?></td>
              <td class="align_left" width="44%"><?php echo $products['name'];?></td>
              <?php if($prods['price']==''){$price=$products['price'];}else{$price=$prods['price'];}?>
               <td class="align_center vline"><?php echo $prods['cquantity'];?>
               <input type="hidden" name="hidid[]" value="<?php echo $prods[guid];?>"></td>
             <td class="align_center vline"><input name="price[]" id="price<?php echo $n;?>" type="text" value="<?php echo $price;?>" onBlur="product_price('<?php echo $prods['cquantity'];?>',this.value,'<?php echo $n;?>');"></td>
             <td class="align_center vline"><input  name="cost[]" id="cost<?php echo $n;?>" readonly type="text" value="<?php echo $prods['cquantity']*$price;?>"></td>
			   
            </tr>
                 <?php } ?>            
                    </table></td></tr>
               <tr> <td>Status</td><td><input type="radio" name="status" value="Pending" <?php if($edit['status']=='Pending'){?> checked<?php } ?>>Pending
               <input type="radio" name="status" value="Send" <?php if($edit['status']=='Send'){?> checked<?php } ?>>Send                                                          
                     
                </td></tr>
                 <tr> <td colspan="2" align="center">  
               <input type="hidden" name="editid" value="<?php echo $edit['guid'];?>">
               <input type="hidden" name="invoiceid" value="<?php echo $edit['invoiceid'];?>">                                                          
                    <button type="submit" name="Submit" value="Update" class="btn bg-yellow">Send Quote</button>  
                </td></tr></table>
            </form>
				<?php }else{?>
				 <!-- top row -->
                   <table class="table table-responsive table-bordered">

                    	<thead>

                          <tr>

                        	

                            <th>Sno</th>
                            <th>Name</th>

                           <th>Contact Details</th>
                           <th>Address</th>
                           <th>Requested On</th>
                           <th>Products</th>
                            <th>Edit Quote</th>
                            <th>Send Invoice</th>
                           
                           </tr>

                        </thead>

                        <tbody>

                         <?php 
extract($_GET);include 'pageing.php';
						    $gridId = $_GET[guid];
							$limit = 90; 								
$filePath="quotes.php";
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

$query_clients="SELECT * FROM `orders`  order by guid desc  Limit $start, $limit ";

$query_clients=mysql_query($query_clients);

$select1="SELECT * FROM `orders`";

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
								//$check=mysql_fetch_array(mysql_query("select * from register where guid='$client_count[referral]'"));
								 
					  ?>

                        	<tr>

                            	<td><?php echo $m; ?></td>

                                <td><?php echo $client_count['name'];?></td>

                               <td><?php echo $client_count['email']; ?><br>
                               <?php echo $client_count['mobile']; ?></td>
                               <td><?php echo $client_count['address']; ?></td>
                               <td><?php echo date('d M Y', strtotime($client_count['date'])); ?></td>
                               <td><?php 
			  $prd=mysql_query("select * from cart where session_id='$client_count[session_id]'");
			  while($prods=mysql_fetch_assoc($prd)){$n++;
				  $products=mysql_fetch_array(mysql_query("select * from products where guid='$prods[pid]'"));?>
           <?php echo $n; echo ". ";echo $products['name'];?><br>
            <?php } ?></td>
            <td><a href="quotes.php?action=edit&gid=<?php echo $client_count['guid']; ?>" class="btn <?php if($client_count['status']=='Send'){echo "btn-success";}else{echo "btn-danger";}?>"><?php echo $client_count['status']; ?></a></td>
            <td><a href="quotes.php?action=send&id=<?php echo $client_count['guid']; ?>" class="btn <?php if($client_count['invoice']=='1'){echo "btn-success";}else{echo "btn-danger";}?>">Send Invoice</a></td>
                                </tr>

                          <?php $m++;} ?>

                        </tbody>

                        <tfoot>

                        	<tr>

                            	<th colspan="6"> Showing <?php echo $page;?> of <?php echo $totals;?> Pages </th>

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