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
$spicy_level = $request_string["spicy_level"];
$profit=0;
if($user_id == ""){
echo json_encode(array("status"=>"error","message"=>"Please update your app and continue"));
}else{
$pchk=mysql_fetch_array(mysql_query("select * from products where guid='".$guid."'"));
$price = $pchk['sprice'];
$ctotal=$price*$qty;
$pchk_price=$pchk['mprice']*$qty;
$profit=$ctotal-$pchk_price;
$chk=mysql_fetch_array(mysql_query("select * from cart where pid='".$guid."' and session_id='".$user_id."' and order_id=''"));

$sql_erfv = mysql_fetch_array(mysql_query("select * from vendor where FIND_IN_SET('".$area_code."',area)"));
$food_vendor_id = $sql_erfv["guid"];
$vendor_type = $sql_erfv["vendor_type"];
if($vendor_type == "ERFV"){
$chkqty = mysql_fetch_array(mysql_query("select available_qty from erfvstock where product_id='".$guid."' and erfv_vendor='".$food_vendor_id."'"));
}
else{
$chkqty=mysql_fetch_array(mysql_query("select sum(quantity) from vendor_quantity where product_id='".$guid."' and date='".$date."' and vendor_id = '".$food_vendor_id."' "));
}
//echo "select sum(quantity) from vendor_quantity where product_id='".$guid."' and date='".$date."'";
if($qty > 0){

if($chkqty[0] >= $qty)
{
	
if(empty($chk['guid']))
{
mysql_query("INSERT INTO `cart` 
(`pid` ,`cquantity` ,`price` ,`ctotal` ,`session_id` ,
`date`,`sprice`,`stotal`,`profit`,spicy_level) VALUES ('$guid', '$qty', '$price', '$ctotal', '$user_id', '$date', '$pchk[mprice]', '$pchk_price','$profit','$spicy_level')");
$msg = "Added to cart";
echo json_encode(array("status"=>"success","message"=>$msg));
}
else
{
mysql_query("update cart set cquantity='$qty',ctotal='$ctotal',sprice='$pchk[mprice]',stotal='$pchk_price',profit='$profit',spicy_level= '$spicy_level' where guid='$chk[guid]'");	
$msg = "updated in cart";
echo json_encode(array("status"=>"success","message"=>$msg));
}
}
else{
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

	
