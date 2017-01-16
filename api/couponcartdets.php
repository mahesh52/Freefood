<?php 
header('Access-Control-Allow-Origin: *');
include 'config.php';
include 'functions.php';
$return_arr = array();
$return_arr1 = array();
$return_arr2 = array();
$request = json_decode(file_get_contents('php://input'), true);
$request_string = $request["metaData"];
$user_id = $request_string["user_id"];
$total = 0;
$discount = 0;
$vat_total = 0;
$cart = mysql_num_rows(mysql_query("select * from cart where session_id='".$user_id."' and order_id='' and cid>0"));
$qry = mysql_query("select * from cart where session_id='".$user_id."' and order_id='' and cid>0");
$cartqntynew = mysql_fetch_array(mysql_query("select sum(cquantity) as items from cart where session_id='".$user_id."' and order_id='' and cid>0"));
$cartqntynew1 = mysql_fetch_array(mysql_query("select sum(ctotal) as total from cart where session_id='".$user_id."' and order_id='' and cid>0"));
while($row = mysql_fetch_array($qry))
{
$chk = mysql_fetch_array(mysql_query("select * from coupons where guid='".$row['cid']."'"));
$img = mysql_fetch_array(mysql_query("select * from imagefiles where coupon_id='".$chk['coupon_vendor']."'"));
//$discount = $discount + (($chk['sprice'] - $chk['mprice']) * $row['cquantity']);
$row_array['product_id'] = $chk['guid'];
$row_array['total_price'] = $row['ctotal'];
$row_array['item_price'] = $row['price'];
$row_array['image'] = $images_path.$img['image'];
$row_array['quantity'] = $row['cquantity'];
$row_array['name'] = $chk['name'];
array_push($return_arr, $row_array);
$row_array = array();
}


$wat = 0;
$credit = mysql_fetch_array(mysql_query("select ifnull(sum(points),0) from wallet where userid='".$user_id."' and status='Credit'"));
$debit = mysql_fetch_array(mysql_query("select ifnull(sum(points),0) from wallet where userid='".$user_id."' and status='Debit'"));
$wat = $credit[0] - $debit[0];

$return_arr1["cart_items"] = $cart;
$return_arr1["total_items"] = $cartqntynew["items"];
$return_arr1["total_amount"] = $cartqntynew1["total"];

$return_arr1["amount_pay"] = $cartqntynew1["total"];
$return_arr1["available_points"] = $wat;
$return_arr1["items"] =$return_arr;
 $total = 0;
$discount = 0;
$discount_new =0;
$dis =0;
$qry1 =mysql_query("select a.* from cart  a join coupons b on a.cid = b.guid join storecategory c on b.category = c.guid  where session_id='".$user_id."' and order_id='' and cid>0 order by c.points desc"); 
while ($row1 = mysql_fetch_assoc($qry1)) {
$chk = mysql_fetch_array(mysql_query("select * from coupons where guid='".$row1['cid']."' "));
$total = $total + $row1['ctotal'];

$chk12 = mysql_fetch_array(mysql_query("select * from storecategory where guid='".$chk['category']."'"));
 $discount = $discount + (($chk['sprice'] - $chk['mprice']) * $row1['cquantity']);

 
if($cartqntynew1["total"] > $wat){
if($wat-$discount_new > 0){
	
		if(($wat * $chk12["points"])/100 > $wat-$discount_new){
		$discount_new = $discount_new + ($wat-$discount_new);
		}else{			
		$discount_new = $discount_new + ($chk['sprice'] * $chk12["points"])/100;
		//echo $discount_new;exit;
		}
}
}
else{
if($wat-$discount_new > 0){
	
 $discount_new = $discount_new + ($chk['sprice'] * $chk12["points"])/100;
}
}

}

$discount_new= floor($discount_new);
//echo $discount_new;
if($wat > 0){
	if($cartqntynew1["total"] > $wat){
//  echo $discount;
$minimuamamount = $cartqntynew1["total"]-$discount;
//680
if($discount > $wat){
$dis=$discount_new;
}
else{
$dis=$discount_new;
}

}
else{
$dis=$discount_new;										  
}
}else{
	$dis=0;
}					
	
$return_arr1["discount"] = $dis;

$return_arr1["amount_pay_after_disc"] = $cartqntynew1["total"]-$dis;
    echo json_encode($return_arr1);
?>