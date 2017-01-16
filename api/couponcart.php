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
$pchk=mysql_fetch_array(mysql_query("select * from coupons where guid='".$guid."'"));
$price = $pchk['sprice'];
$ctotal=$price*$qty;
$pchk_price=$pchk['mprice']*$qty;
$profit=$ctotal-$pchk_price;
$quantity = $pchk['quantity'];
$chk=mysql_fetch_array(mysql_query("select * from cart where cid='".$guid."' and session_id='".$user_id."' and order_id=''"));
if($qty > 0){
	if($quantity >= $qty){
			if(empty($chk['guid']))
	{
mysql_query("INSERT INTO `cart` (`cid` ,`cquantity` ,`price` ,
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
		$msg = "Quantity not available";
	echo json_encode(array("status"=>"error","message"=>$msg));
	}

}
else{
	if($qty==0)
	{
	mysql_query("delete from cart where guid='".$chk['guid']."'");
	$msg = "Removed from cart";
	echo json_encode(array("status"=>"success","message"=>$msg));	
	}
}
?>