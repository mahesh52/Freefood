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
$cart = mysql_num_rows(mysql_query("select * from cart where session_id='".$user_id."' and order_id='' and sid>0"));
$qry = mysql_query("select * from cart where session_id='".$user_id."' and order_id='' and sid>0");
$cartqntynew = mysql_fetch_array(mysql_query("select sum(cquantity) as items from cart where session_id='".$user_id."' and order_id='' and sid>0"));
$cartqntynew1 = mysql_fetch_array(mysql_query("select sum(ctotal) as total from cart where session_id='".$user_id."' and order_id='' and sid>0"));
while($row = mysql_fetch_array($qry))
{
$chk = mysql_fetch_array(mysql_query("select * from storeproducts where guid='".$row['sid']."'"));
$img = mysql_fetch_array(mysql_query("select * from imagefiles where sid='".$chk['guid']."'"));
//$discount = $discount + (($chk['sprice'] - $chk['mprice']) * $row['cquantity']);
$row_array['product_id'] = $chk['guid'];
$row_array['total_price'] = $row['ctotal'];
$row_array['item_price'] = $row['price'];
$row_array['image'] = $images_path.$img['image'];
$row_array['quantity'] = $row['cquantity'];
$row_array['name'] = $chk['name'];
$vat =  ((($chk['sprice']*$chk['vat'])/100)*$row['cquantity']);
$vat_total = $vat_total +$vat;
array_push($return_arr, $row_array);
$row_array = array();
}

$details = mysql_fetch_array(mysql_query("select * from register where guid='".$user_id."'"));

$return_arr2["name"] = $details["name"];
$return_arr2["email"] = $details["email"];
$return_arr2["address"] = $details["address"];
$return_arr2["city"] = $details["city"];
$return_arr2["area"] = $details["state"];
$return_arr2["pincode"] = $details["pincode"];
$return_arr2["mobile"] = $details["mobile"];
$wat = 0;
$credit = mysql_fetch_array(mysql_query("select ifnull(sum(points),0) from wallet where userid='".$user_id."' and status='Credit'"));
$debit = mysql_fetch_array(mysql_query("select ifnull(sum(points),0) from wallet where userid='".$user_id."' and status='Debit'"));
$wat = $credit[0] - $debit[0];
//$wat =1000;
//$return_arr1["vat_total"] = round($vat_total);
$return_arr1["vat_total"] =0;
$return_arr1["cart_items"] = $cart;
$return_arr1["total_items"] = $cartqntynew["items"];
if($cartqntynew1["total"] < 250){
	$charges1 = 20;
}else{
	$charges1 = 0;
}
$return_arr1["total_amount"] = $cartqntynew1["total"]+$charges1;
$return_arr1["amount_pay"] = $cartqntynew1["total"];
$return_arr1["charges"] = $charges1;
$return_arr1["available_points"] = $wat;
$return_arr1["items"] =$return_arr;
$return_arr1["delivery_address"] =$return_arr2;
 $total = 0;
$discount = 0;
$discount_new =0;
$dis =0;
$qry1 =mysql_query("select a.* from cart  a join storeproducts b on a.sid = b.guid join storecategory c on b.category = c.guid  where session_id='".$user_id."' and order_id='' and sid>0 order by c.points desc"); 
while ($row1 = mysql_fetch_assoc($qry1)) {
$chk = mysql_fetch_array(mysql_query("select * from storeproducts where guid='".$row1['sid']."' "));
 $total = $total + $row1['ctotal'];

$chk12 = mysql_fetch_array(mysql_query("select * from storecategory where guid='".$chk['category']."'"));
$discount = $discount + (($chk['sprice'] - $chk['mprice']) * $row1['cquantity']);

if($cartqntynew1["total"] > $wat){
if($wat-$discount_new > 0){
		if(($chk['sprice'] * $chk12["points"])/100 > $wat-$discount_new){
		$discount_new = $discount_new + ($wat-$discount_new);
		$discount_new = $discount_new*$row1['cquantity'];
		}else{
		$discount_new = $discount_new + ($chk['sprice'] * $chk12["points"])/100;
		$discount_new = $discount_new*$row1['cquantity'];
		}
}
}
else{
if($wat-$discount_new > 0){
	
$discount_new = $discount_new + ($chk['sprice'] * $chk12["points"])/100;
$discount_new = $discount_new*$row1['cquantity'];
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
if($cartqntynew1["total"]-$dis <250){
	$charges = 20;
}else{
	$charges = 0;
}
$return_arr1["amount_pay_after_disc"] = $cartqntynew1["total"]-$dis+$charges;
$return_arr1["charges_after_disc"] = $charges;			
    echo json_encode($return_arr1);
?>