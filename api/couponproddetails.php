<?php 
header('Access-Control-Allow-Origin: *');
include 'config.php';
include 'functions.php';
$date = date('Y-m-d');
$return_arr = array();
$request = json_decode(file_get_contents('php://input'), true);
$request_string = $request["metaData"];
$product_code = $request_string["product_code"];
$area_code = $request_string["area_code"];
$row=mysql_fetch_array(mysql_query("select * from coupons where guid='".$product_code."'"));
$return_arr['guid'] = $row['guid'];
$img = mysql_fetch_array(mysql_query("select * from imagefiles where coupon_id='".$row['coupon_vendor']."' "));
			//$return_arr['name'] = $row['name'];
			$couponvendor = mysql_fetch_array(mysql_query("select * from couponsvendor where guid='".$row['coupon_vendor']."' "));
            $return_arr['vendor_name'] = $couponvendor['name'];
			$return_arr['sprice'] = $row['sprice'];
			$return_arr['with_discount'] = $row['mprice'];
			$return_arr['description'] = strip_tags($row['description']);
			$row_array['max_discount_upto'] = $row['sprice']-$row['mprice'];
			$return_arr['available_qty'] = $row['quantity'];
			$return_arr['image'] = $images_path.$img['image'];
            
		echo json_encode($return_arr);	
?>