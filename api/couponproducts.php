<?php 
header('Access-Control-Allow-Origin: *');
include 'config.php';
include 'functions.php';
$date = date('Y-m-d');
$return_arr = array();
$request = json_decode(file_get_contents('php://input'), true);
$request_string = $request["metaData"];
$area_code = $request_string["area_code"];
$category_code = $request_string["category_code"];
$res = mysql_query("select * from coupons where category='".$category_code."' and FIND_IN_SET('".$area_code."',area) and quantity > 0 GROUP BY coupon_value,coupon_vendor  order by name asc");

while($row = mysql_fetch_array($res))
    {
			$row_array['guid'] = $row['guid'];
			$row_array['name'] = $row['name'];
			$row_array['sprice'] = $row['sprice'];
			$img = mysql_fetch_array(mysql_query("select * from imagefiles where coupon_id='".$row['coupon_vendor']."' "));
			$row_array['coupon_value'] = $row['coupon_value'];
			$row_array['available_qty'] = $row['quantity'];
			$row_array['image'] = $images_path.$img['image'];
			$couponvendor = mysql_fetch_array(mysql_query("select * from couponsvendor where guid='".$row['coupon_vendor']."' "));
            $row_array['vendor_name'] = $couponvendor['name'];
			$row_array['max_discount_upto'] = $row['sprice']-$row['mprice'];
			array_push($return_arr, $row_array);
            $row_array = array();
    }
	
    echo json_encode($return_arr);
?>