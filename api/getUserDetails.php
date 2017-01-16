<?php 
header('Access-Control-Allow-Origin: *');
include 'config.php';
include 'functions.php';
$date = date('Y-m-d');
$return_arr = array();
$request = json_decode(file_get_contents('php://input'), true);
$request_string = $request["metaData"];
$user_id = $request_string["user_id"];
$sql = "select * from register where guid='".$user_id."' ";
$res = mysql_query($sql);
while($row = mysql_fetch_array($res))
    {
			$row_array['guid'] = $row['guid'];
			$row_array['name'] = $row['name'];
			$row_array['email'] = $row['email'];
			$row_array['address'] = $row['address'];
			$row_array['city'] = $row['city'];
			$row_array['area'] = $row['state'];
			$row_array['pincode'] = $row['pincode'];
			$row_array['mobile'] = $row['mobile'];
            array_push($return_arr, $row_array);
            $row_array = array();
    }
	
    echo json_encode($return_arr);
?>