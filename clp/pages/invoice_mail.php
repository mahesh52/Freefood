<?php ob_start();
session_start();extract($_GET);
include 'secure.php';include '../../config.php';
mysql_query("update orders set invoice='1' where guid='$id'");
$crd=mysql_fetch_array(mysql_query("select * from orders where guid='$id'"));
$subject ="Invoice from CCTVOZ‏";
$from = "CCTV noreply@cctv.com";
//$from = "myself5b5@gmail.com";
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "From: $from";
$message='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
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
<div>

 <table width="1000" border="1" align="center" cellpadding="0" cellspacing="0" style="border-color:#0076BE;bgcolor:#FFFFFF">
      <tbody>
        <tr>
          <td width="1000" height="50"><table cellspacing="0" cellpadding="0" border="0" width="100%">
            <tbody>
              <tr height="12">
                <td width="208" height="110" bgcolor="#999999"><img src="http://cctvoz.com.au/images/cctv-Logo1.png" /></td>
                <td width="736" align="left" bgcolor="#999999"><span style="font-size: 36px; font-weight: bold; color: #FFFFFF;">Invoice</span><br>
				<span style="font-size: 36px; font-weight: bold; color: #FFFFFF;">#'.$crd['invoiceid'].'</span></td>
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
              <td align="left"><span style="color: #F68428">Following are the Invoice Details:</span></td>
            </tr>
            <tr>
              <td align="left" style="border-bottom:#999999 1px solid">&nbsp;</td>
            </tr>
            <tr>
              <td align="left"><table class="table table-responsive table-bordered">
                    <tr><td>Product</td><td>Name</td><td>Quantity</td><td>Item Price</td><td>Item Total</td>';
             
						  $prd=mysql_query("select * from cart where session_id='$crd[session_id]'");
						 $n=0;$sub=0;$tot=0;
			  while($prods=mysql_fetch_assoc($prd)){$n++;
				  $products=mysql_fetch_array(mysql_query("select * from products where guid='$prods[pid]'"));
				  $message.='<tr>
              <td width="10%">';
			  $qry1=mysql_query("select * from imagefiles where cid='$products[guid]' order by guid asc");$m=0;
			  while($row1=mysql_fetch_assoc($qry1))
			  {
				 $str=substr($row1[image],-3);
				 $tot=$prods['cquantity']*$prods['price'];
				 if($str!='pdf'){if($m==0){$m++;
				 $message.='<img src="http://cctvoz.com.au/uploaded_files/small'.$row1['image'].'"/>';}}}
				 $message.='</td>
              <td class="align_left" width="44%">'.$products['name'].'</td>
              
               <td>'.$prods['cquantity'].'</td>
             <td>$'.$prods['price'].'</td>
             <td>$'.$tot.'</td>
			   
            </tr>
                 ';
				 $sub=$sub+$tot;
				 }$gst=($sub*10)/100;
				 $message.='
				 <tr><td colspan="4" align="right">Total : </td><td>$'.$sub.'</td></tr>
				 <tr><td colspan="4" align="right">GST - 10% : </td><td>$'.$gst.'</td></tr>
				 <tr><td colspan="4" align="right">Total With GST : </td><td>$'.($gst+$sub).'</td></tr>
				 </table></td>
            </tr>
            <tr>
              <td align="left">Thank you for using <span style="color: #0076BE"><strong>CCTVOZ! </strong></span></td>
            </tr>
            <tr>
              <td align="left">Kind regards, <br />
 <strong><a href="http://cctvoz.com.au/">CCTVOZ.COM.AU</a><br>
<a href="http://cctvoz.com.au/terms.php">Terms and Conditions</a></strong><br />
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
      </tbody>
    </table>
</div>
</body>
</html>
';
$to=$crd['email'];//echo $message;exit;
mail( $to,$subject,$message,$headers);
?>