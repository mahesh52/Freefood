<?php ob_start();
session_start();extract($_POST);
include 'config.php'; 
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Order Print</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 14px;
}
body {
	background-color: #FFFFFF;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style1 {
	font-size: 18px;
	font-weight: bold;
	color: #FFFFFF;
}
.style2 {
	color: #9FCC3C;
	font-weight: bold;
	font-size: 16px;
}
.style3 {color: #F68428}
.style4 {color: #0076BE}
.style6 {font-size: 36px; font-weight: bold; color: #FFFFFF; }
-->
</style>






</head>

<body>

 <table width="1000" border="1" align="center" cellpadding="0" cellspacing="0" style="border-color:#0076BE;bgcolor:#FFFFFF">
        <tr>
          <td width="1000" height="50"><table cellspacing="0" cellpadding="0" border="0" width="100%">
            <tbody>
              <tr height="12">
                <td width="208" height="110" bgcolor="#3bb7b5"><img src="assets/images/logo-food.png" width="150" height="100"/></td>
                <td width="736" align="left" bgcolor="#3bb7b5"><span style="font-size: 36px; font-weight: bold; color: #FFFFFF;">Order No :FF<?php echo $_GET['gid'];?></span></td>
              </tr>
            </tbody>
          </table></td>
        </tr>
        <tr>
          <td height="50"><table width="95%" border="0" align="center" cellpadding="5" cellspacing="2">
            <tr>
              <td align="left">&nbsp;</td>
            </tr>
           <?php $client_count=mysql_fetch_array(mysql_query("select * from orders where guid='$_GET[gid]'"));?>
            <tr>
              <td align="left"><span style="color: #F68428">Following are the Order Details:</span></td>
            </tr>
            <tr><td>Payment Mode : <?php echo $client_count['pmode'];?></td></tr>
            <tr>
              <td align="left" style="border-bottom:#999999 1px solid">&nbsp;</td>
            </tr>
            <tr>
              <td align="left"><table width="100%" class="table table-responsive table-bordered">
                    <tr><td width="20%"><strong>Product</strong></td><td width="48%"><strong>Name</strong></td><td width="10%"><strong>Quantity</strong></td><td width="11%"><strong>Item Price</strong></td><td width="11%"><strong>Item Total</strong></td>
             <?php 
			  $prd=mysql_query("select * from cart where order_id='$client_count[guid]'");
			  $n=0;$total=0;
			  while($prods=mysql_fetch_assoc($prd)){$n++;
			  $total=$total+($prods['cquantity']*$prods['price']);
			  if($prods['sid']>0){
				  $products=mysql_fetch_array(mysql_query("select * from storeproducts where guid='$prods[sid]'"));
				  $image=mysql_fetch_array(mysql_query("select * from imagefiles where sid='$products[guid]'"));
				  }else{
				  $products=mysql_fetch_array(mysql_query("select * from products where guid='$prods[pid]'"));
				  $image=mysql_fetch_array(mysql_query("select * from imagefiles where cid='$products[guid]'"));}?>
                  
          <tr><td><img src="android/uploaded_files/small<?php echo $image['image'];?>" class="img-responsive pull-left" style="width:40px; margin-bottom:6px;"></td>
          <td><?php echo $products['name'];?></td>
          <td><?php echo $prods['cquantity'];?></td>
          <td><?php echo $prods['price'];?></td>
          <td><?php echo $prods['ctotal'];?></td>
            <?php } ?>
</tr>
<tr><td colspan="4" align="right">Total : </td><td><?php echo $total;?>/-</td></tr>
</table>
<?php  $check=mysql_fetch_array(mysql_query("select * from register where guid='$client_count[userid]'"));
			 $vendor=mysql_fetch_array(mysql_query("select * from vendor where guid='$client_count[vendor_id]'"));
			 $area=mysql_fetch_array(mysql_query("select * from cluster where guid='$client_count[refid]'"));?>
<tr><td colspan="4"><table border="0" width="100%"><tr><td valign="top"><strong>Customer Details : </strong>
<?php echo "<br>";echo $check['name'];echo "<br>";echo $check['mobile'];echo "<br>";echo $check['email'];echo "<br>";echo $check['address'];echo "<br>";echo $check['city'];echo "<br>";echo $check['state'];echo "<br>";?></td>
<?php if($client_count['gettime']=='Food'){?>
<td valign="top"><table width="100%" border="0"><tr><td valign="top" width="50%"><strong>Products</strong></td>
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
<?php }?></td><?php } ?></tr></table></td>
<?php }?>
</tr></table></td></tr>
            <tr>
              <td align="left">Thank you for using <span style="color: #0076BE"><strong>Free Food! </strong></span></td>
            </tr>
            <tr>
              <td align="left">Kind regards, <br />
 <strong>Free Food</strong>
</td>
            </tr>
            
            <tr>
              <td align="left" style="border-bottom:#999999 1px solid">&nbsp;</td>
            </tr>
            <tr>
              <td align="left">Have a question? <strong>Contact us</strong>. Do not reply to this email.</td>
            </tr>
          </table></td>
        </tr>
    </table>
</body>
</html>
