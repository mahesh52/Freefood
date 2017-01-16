<?php 
header('Access-Control-Allow-Origin: *');
include 'config.php';
include 'functions.php';
$date = date('Y-m-d');
$return_arr = array();$return_arr1 = array();
$request = json_decode(file_get_contents('php://input'), true);
$request_string = $request["metaData"];
$user_id = $request_string["user_id"];
$sql = "select * from wallet where userid='".$user_id."' and status in ('Credit','Debit') ";
$res = mysql_query($sql);
while($row = mysql_fetch_array($res))
    {
			$row_array['order_id'] = "FF".$row['refid'];
			$row_array['date'] = date('d-m-y', strtotime($row['date']));;
			$row_array['points'] = $row['points'];
			$row_array['type'] = $row['status'];
            array_push($return_arr, $row_array);
            $row_array = array();
    }
	$sql1 = "select sum(points) as crd from wallet where userid='".$user_id."' and status in ('Credit') ";
$res1 = mysql_fetch_array(mysql_query($sql1));
$sql11 = "select sum(points) as dbt from wallet where userid='".$user_id."' and status in ('Debit') ";
$res11 = mysql_fetch_array(mysql_query($sql11));
$return_arr1["data"] = $return_arr;
$return_arr1["available_points"] = $res1["crd"]-$res11["dbt"];
    echo json_encode($return_arr1);
?>