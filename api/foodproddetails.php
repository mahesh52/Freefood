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
$row=mysql_fetch_array(mysql_query("select * from products where guid='".$product_code."'"));
$return_arr['guid'] = $row['guid'];
			$return_arr['name'] = $row['name'];
			$return_arr['sprice'] = $row['sprice'];
			$return_arr['description'] = strip_tags($row['description']);
			$sql_erfv = mysql_fetch_array(mysql_query("select * from vendor where FIND_IN_SET('".$area_code."',area)"));
			$food_vendor_id = $sql_erfv["guid"];
			$vendor_type = $sql_erfv["vendor_type"];
			$img = mysql_fetch_array(mysql_query("select * from imagefiles where cid='".$row['guid']."' "));
			if($vendor_type == "ERFV"){
			$chkqty = mysql_fetch_array(mysql_query("select available_qty from erfvstock where product_id='".$row['guid']."' and erfv_vendor='".$food_vendor_id."'"));
			}
			else{
			$chkqty = mysql_fetch_array(mysql_query("select ifnull(sum(quantity),0) from vendor_quantity where product_id='".$row['guid']."' and date='".$date."' and vendor_id='".$food_vendor_id."' "));
			}
			$fqty = $chkqty[0] - $cartqty[0];
			$return_arr['available_qty'] = $fqty;
			$return_arr['image'] = $images_path.$img['image'];
            
		echo json_encode($return_arr);	
?>