<?php 
header('Access-Control-Allow-Origin: *');
include 'config.php';
include 'functions.php';
$date=date('Y-m-d');
$request = json_decode(file_get_contents('php://input'), true);
$request_string = $request["metaData"];
$user_id = $request_string["user_id"];
$qty = $request_string["qty"];
$guid = $request_string["product_id"];
$area_code = $request_string["area_code"];
if($user_id == ""){
echo json_encode(array("status"=>"error","message"=>"Please update your app and continue"));exit;
}else{
$pchk=mysql_fetch_array(mysql_query("select * from storeproducts where guid='".$guid."'"));
$price = $pchk['sprice'];
$ctotal=$price*$qty;
$pchk_price=$pchk['mprice']*$qty;
$profit=$ctotal-$pchk_price;
$chk=mysql_fetch_array(mysql_query("select * from cart where sid='".$guid."' and session_id='".$user_id."' and order_id=''"));
$sql_erfv = mysql_fetch_array(mysql_query("select * from storevendor where FIND_IN_SET('".$area_code."',area)"));
$food_vendor_id = $sql_erfv["guid"];
$chkqty = mysql_fetch_array(mysql_query("select sum(quantity) from store_vendor_quantity where product_id='".$guid."' and vendor_id='".$food_vendor_id."' "));
             
 $cartqty = mysql_fetch_array(mysql_query("select sum(cquantity) from cart where sid='".$guid."' and order_id!=''"));
$fqty = $chkqty[0] - $cartqty[0];
if($qty > 0){
	if($chkqty[0] >= $qty)
{
	if(empty($chk['guid']))
	{
mysql_query("INSERT INTO `cart` (`sid` ,`cquantity` ,`price` ,
`ctotal` ,`session_id` ,`date`,area) VALUES 
('".$guid."', '".$qty."', '".$price."', '".$ctotal."', '".$user_id."', '".$date."','".$area_code."')");
	$msg = "Added to cart";
	echo json_encode(array("status"=>"success","message"=>$msg));
	}
	else
	{
	mysql_query("update cart set cquantity='".$qty."',ctotal='".$ctotal."' where guid='".$chk['guid']."'");	
	$msg = "updated in cart";
	echo json_encode(array("status"=>"success","message"=>$msg));
	}
}else{
	echo json_encode(array("status"=>"error","message"=>"Quantity Not available"));	
}
	
}
else{
	if($qty==0)
	{
	mysql_query("delete from cart where guid='$chk[guid]'");
	$msg = "Removed from cart";
	echo json_encode(array("status"=>"success","message"=>$msg));	
	}
}
}
?>