<?php 
header('Access-Control-Allow-Origin: *');
include 'config.php';
include 'functions.php';
$date = date('Y-m-d');
$return_arr = array();
$return_arr1 = array();
$return_arr2 = array();
$request = json_decode(file_get_contents('php://input'), true);
$request_string = $request["metaData"];
$area_code = $request_string["area_code"];
$category_code = $request_string["category_code"];
$term = $request_string["term"];

$sql = "select * from products where  category='".$category_code."' and FIND_IN_SET('".$area_code."',area) and product_type = '1' order by name asc";
if($term != ""){
	$sql = "select * from products where  category='".$category_code."' and name LIKE '%".$term."%' and FIND_IN_SET('".$area_code."',area) and product_type = '1' order by name asc";
}
$res = mysql_query($sql);
while($row = mysql_fetch_array($res))
    {
			$row_array1['guid'] = $row['guid'];
			$row_array1['name'] = $row['name'];
			$row_array1['sprice'] = $row['sprice'];
			$sql_erfv = mysql_fetch_array(mysql_query("select * from vendor where FIND_IN_SET('".$area_code."',area)"));
			//echo "select * from vendor where FIND_IN_SET('".$area_code."',area)";
			 $food_vendor_id = $sql_erfv["guid"];
			$vendor_type = $sql_erfv["vendor_type"];
			$img = mysql_fetch_array(mysql_query("select * from imagefiles where cid='".$row['guid']."' "));
			if($vendor_type == "ERFV"){
			$chkqty = mysql_fetch_array(mysql_query("select available_qty from erfvstock where product_id='".$row['guid']."' and erfv_vendor='".$food_vendor_id."'"));
			}
			else{
				//echo "select sum(quantity) from vendor_quantity where product_id='".$row['guid']."' and date='".$date."'";
			$chkqty = mysql_fetch_array(mysql_query("select ifnull(sum(quantity),0) from vendor_quantity where product_id='".$row['guid']."' and date='".$date."' and vendor_id='".$food_vendor_id."' "));
			}
			//echo "select ifnull(sum(quantity),0) from vendor_quantity where product_id='".$row['guid']."' and date='".$date."' and vendor_id='".$food_vendor_id."' ";
			
			if(date(H) >=11 && date(H) < 21){
				$fqty = $chkqty[0];
			}else{
				$fqty = 0;
			}
			$row_array1['available_qty'] = $fqty;
			$row_array1['image'] = $images_path.$img['image'];
            array_push($return_arr1, $row_array1);
            $row_array1 = array();
    }
	$sql1 = "select * from products where  category='".$category_code."' and FIND_IN_SET('".$area_code."',area) and product_type = '0' order by name asc";
if($term != ""){
	$sql1 = "select * from products where  category='".$category_code."' and name LIKE '%".$term."%' and FIND_IN_SET('".$area_code."',area) and product_type = '0' order by name asc";
}
	$res1 = mysql_query($sql1);
while($row1 = mysql_fetch_array($res1))
    {
		
			$row_array2['guid'] = $row1['guid'];
			$row_array2['name'] = $row1['name'];
			$row_array2['sprice'] = $row1['sprice'];
			$sql_erfv = mysql_fetch_array(mysql_query("select * from vendor where FIND_IN_SET('".$area_code."',area)"));
			$food_vendor_id = $sql_erfv["guid"];
			$vendor_type = $sql_erfv["vendor_type"];
			$img = mysql_fetch_array(mysql_query("select * from imagefiles where cid='".$row1['guid']."' "));
			if($vendor_type == "ERFV"){
			$chkqty = mysql_fetch_array(mysql_query("select available_qty from erfvstock where product_id='".$row1['guid']."' and erfv_vendor='".$food_vendor_id."'"));
			}
			else{
			$chkqty = mysql_fetch_array(mysql_query("select ifnull(sum(quantity),0) from vendor_quantity where product_id='".$row1['guid']."' and date='".$date."' and vendor_id='".$food_vendor_id."' "));
			}
			//$fqty = $chkqty[0];
			if(date(H) >=11 && date(H) < 21){
				$fqty = $chkqty[0];
			}else{
				$fqty = 0;
			}
			$row_array2['available_qty'] = $fqty;
			$row_array2['image'] = $images_path.$img['image'];
            array_push($return_arr2, $row_array2);
            $row_array2 = array();
    }
	$return_arr["current_time"] = date('H');
	$return_arr["start_time"] = $food_start_time;
	$return_arr["end_time"] = $food_end_time;
	$return_arr["products"] = $return_arr1;
	$return_arr["addons"] = $return_arr2;
    echo json_encode($return_arr);
?>