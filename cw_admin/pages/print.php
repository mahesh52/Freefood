<?php ob_start();
session_start();extract($_POST);
include 'secure.php';include '../../config.php'; 
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
                <td width="208" height="110" bgcolor="#3bb7b5"><img src="../../assets/images/logo-food.png" width="150" height="100"/></td>
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
           
            <tr>
              <td align="left"><span style="color: #F68428">Following are the Order Details:</span></td>
            </tr>
            <tr>
              <td align="left" style="border-bottom:#999999 1px solid">&nbsp;</td>
            </tr>
            <tr>
              <td align="left"><table width="100%" class="table table-responsive table-bordered">
                    <tr><td width="20%">Product</td><td width="48%">Name</td><td width="10%">Quantity</td><td width="11%">Item Price</td><td width="11%">Item Total</td>
             <?php $client_count=mysql_fetch_array(mysql_query("select * from orders where guid='$_GET[gid]'"));
			 $check=mysql_fetch_array(mysql_query("select * from register where guid='$client_count[userid]'"));
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
                  
          <tr><td><img src="../../android/uploaded_files/small<?php echo $image['image'];?>" class="img-responsive pull-left" style="width:40px; margin-bottom:6px;"></td>
          <td><?php echo $products['name'];?></td>
          <td><?php echo $prods['cquantity'];?></td>
          <td><?php echo $prods['price'];?></td>
          <td><?php echo $prods['ctotal'];?></td>
            <?php } ?>
</tr>
<tr><td colspan="4" align="right">Total : </td><td><?php echo $total;?>/-</td></tr>
</table>
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
