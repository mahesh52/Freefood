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
$cart = mysql_num_rows(mysql_query("select * from cart where session_id='".$user_id."' and order_id='' and pid>0"));
$qry = mysql_query("select * from cart where session_id='".$user_id."' and order_id='' and pid>0");
$cartqntynew = mysql_fetch_array(mysql_query("select sum(cquantity) as items from cart where session_id='".$user_id."' and order_id='' and pid>0"));
$cartqntynew1 = mysql_fetch_array(mysql_query("select sum(ctotal) as total from cart where session_id='".$user_id."' and order_id='' and pid>0"));
while($row = mysql_fetch_array($qry))
    {
		$chk = mysql_fetch_array(mysql_query("select * from products where guid='".$row['pid']."'"));
    $img = mysql_fetch_array(mysql_query("select * from imagefiles where cid='".$chk['guid']."'"));
     //$discount = $discount + (($chk['sprice'] - $chk['mprice']) * $row['cquantity']);
			$row_array['product_id'] = $chk['guid'];
			$row_array['total_price'] = $row['ctotal'];
			$row_array['item_price'] = $row['price'];
			$row_array['image'] = $images_path.$img['image'];
			$row_array['quantity'] = $row['cquantity'];
			$row_array['spicy_level'] = $row['spicy_level'];
			$row_array['name'] = $chk['name'];
			$vat =  ((($chk['sprice']*$chk['vat'])/100)*$row['cquantity']);
			$vat_total = $vat_total +$vat;
            array_push($return_arr, $row_array);
            $row_array = array();
    }
	if($cartqntynew1["total"]+$vat_total < 250){
		$total_price = $cartqntynew1["total"] +20;
		$charges=20;
	}else{
			$total_price = $cartqntynew1["total"];
			$charges=0;
		}
		$details = mysql_fetch_array(mysql_query("select * from register where guid='".$user_id."'"));

		$return_arr2["name"] = $details["name"];
		$return_arr2["email"] = $details["email"];
		$return_arr2["address"] = $details["address"];
		$return_arr2["city"] = $details["city"];
		$return_arr2["area"] = $details["state"];
		$return_arr2["pincode"] = $details["pincode"];
		$return_arr2["mobile"] = $details["mobile"];
		
	$return_arr1["vat_total"] = round($vat_total);
	$return_arr1["cart_items"] = $cart;
	$return_arr1["total_items"] = $cartqntynew["items"];
	$return_arr1["total_amount"] = $cartqntynew1["total"]+round($vat_total)+$charges; 
	$return_arr1["amount_pay"] = $cartqntynew1["total"]+round($vat_total);
	$return_arr1["charges"] = $charges;
	$return_arr1["items"] =$return_arr;
	$return_arr1["delivery_address"] =$return_arr2;
    echo json_encode($return_arr1);
?>