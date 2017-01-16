<?php ob_start();session_start();
include 'config.php';extract($_POST);$date=date('Y-m-d');
$ctotal=$price*$qty;
if(isset($_POST) && $_POST['guid']!='')
{$profit=0;
	$pchk=mysql_fetch_array(mysql_query("select * from products where guid='$guid'"));
	$pchk_price=$pchk['mprice']*$qty;
	$profit=$ctotal-$pchk_price;
	$chk=mysql_fetch_array(mysql_query("select * from cart where pid='$guid' and session_id='$_COOKIE[sessid]' and order_id=''"));
	$chkqty=mysql_fetch_array(mysql_query("select sum(quantity) from vendor_quantity where product_id='$guid' and date='$date'"));
	if($chkqty[0]>=$qty)
	{
	if(empty($chk['guid']))
	{
mysql_query("INSERT INTO `cart` (`pid` ,`cquantity` ,`price` ,`ctotal` ,`session_id` ,`date`,`sprice`,`stotal`,`profit`) VALUES ('$guid', '$qty', '$price', '$ctotal', '$_COOKIE[sessid]', '$date', '$pchk[mprice]', '$pchk_price','$profit')");
	}
	else
	{
	mysql_query("update cart set cquantity='$qty',ctotal='$ctotal',sprice='$pchk[mprice]',stotal='$pchk_price',profit='$profit' where guid='$chk[guid]'");	
	}
	}
	if($qty==0)
	{
	mysql_query("delete from cart where guid='$chk[guid]'");	
	}
	$cart_total=mysql_fetch_array(mysql_query("select sum(ctotal) from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0"));
	if($cart_total[0]<250){$ship='20';$total_pay=$cart_total[0]+20;$bal=250-$cart_total[0];}else{$ship=0;$total_pay=$cart_total[0];$bal=0;}
	echo $cart_total[0].'*'.$ship.'*'.$total_pay.'*'.$bal.'*'.$ctotal;
}
?>