<?php 
header('Access-Control-Allow-Origin: *');
include 'config.php';
include 'functions.php';
$date = date('Y-m-d');
$return_arr = array();
$request = json_decode(file_get_contents('php://input'), true);
$request_string = $request["metaData"];
$user_id = $request_string["user_id"];
$sql = "select * from orders where userid='".$user_id."' ";
$res = mysql_query($sql);
while($row = mysql_fetch_array($res))
    {
			$row_array['order_id'] = "FF".$row['guid'];
			$row_array['ordered_on'] = date('d-m-y', strtotime($row['date']));;
			$row_array['discount'] = $row['discount'];
			$row_array['total'] = $row['total'];
			$row_array['payment_mode'] = $row['pmode'];
			$row_array['order_type'] = $row['gettime'];
			$row_array['order_status'] = $row['status'];
			$return_arr1 = array();
			if($row['gettime'] == "Food"){
				$qry2=   mysql_query("select * from cart where order_id='".$row['guid']."' and pid>0");
			}
			else if($row['gettime'] == "Store"){
				$qry2=   mysql_query("select * from cart where order_id='".$row['guid']."' and sid>0");
			}
			while($row2 = mysql_fetch_array($qry2)){
				//echo "select * from products where guid='".$row2['pid']."'";
				if($row['gettime'] == "Food"){
				$products = mysql_fetch_array(mysql_query("select * from products where guid='".$row2['pid']."' "));
				$rows = mysql_num_rows(mysql_query("select * from products where guid='".$row2['pid']."'  "));
				}else if($row['gettime'] == "Store"){
					$products = mysql_fetch_array(mysql_query("select * from storeproducts where guid='".$row2['sid']."'  "));
					$rows = mysql_num_rows(mysql_query("select * from storeproducts where guid='".$row2['sid']."' "));
				}
				if($rows > 0){
				
				$row_array1['name'] = $products['name'];
				$row_array1['price'] = $row2['price'];
				$row_array1['vat'] = $row2['vat'];
				$row_array1['cquantity'] = $row2['cquantity'];
				$row_array1['order_status'] = $row2['order_status'];
				$row_array1['delivered_by'] = date('d-M-Y G:i A', strtotime($row2['delivery_time']))." - ".date('G:i A', strtotime("+150 minutes", strtotime($row2['delivery_time'])));
				
				            array_push($return_arr1, $row_array1);
					$row_array1 = array();
					}
			}
			
			
			$row_array['ordered_items'] = 	$return_arr1;
            array_push($return_arr, $row_array);
            $row_array = array();
    }
	
    echo json_encode($return_arr);
?>