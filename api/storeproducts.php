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
$term = $request_string["term"];
$sql = "select * from storeproducts where category='".$category_code."' and FIND_IN_SET('".$area_code."',area) order by name asc";
if($term != ""){
	$sql = "select * from storeproducts where category='".$category_code."' and FIND_IN_SET('".$area_code."',area) and name LIKE '%".$term."%' order by name asc";
}
$res = mysql_query($sql);
while($row = mysql_fetch_array($res))
    {
			$row_array['guid'] = $row['guid'];
			$row_array['name'] = $row['name'];
			$row_array['sprice'] = $row['sprice'];
			$sql_erfv = mysql_fetch_array(mysql_query("select * from storevendor where FIND_IN_SET('".$area_code."',area)"));
			$food_vendor_id = $sql_erfv["guid"];
			$img = mysql_fetch_array(mysql_query("select * from imagefiles where sid='".$row['guid']."' "));
			//echo "select sum(quantity) from store_vendor_quantity where product_id='".$row['guid']."' and vendor_id='".$food_vendor_id."' ";
			$chkqty = mysql_fetch_array(mysql_query("select sum(quantity) from store_vendor_quantity where product_id='".$row['guid']."' and vendor_id='".$food_vendor_id."' "));
             
			 $cartqty = mysql_fetch_array(mysql_query("select sum(cquantity) from cart where sid='".$row['guid']."' and order_id!=''"));
			
			$fqty = $chkqty[0] - $cartqty[0];
			if($fqty <0){
				$fqty  =0;
			}
			$row_array['available_qty'] = $fqty;
			$row_array['max_discount_upto'] = $row['sprice']-$row['mprice'];
			$row_array['image'] = $images_path.$img['image'];
            array_push($return_arr, $row_array);
            $row_array = array();
    }
	
    echo json_encode($return_arr);
?>