<?php 
header('Access-Control-Allow-Origin: *');
include 'config.php';
include 'functions.php';
$return_arr = array();
$request = json_decode(file_get_contents('php://input'), true);
$request_string = $request["metaData"];
$area_code = $request_string["area_code"];
$sql = "select * from storecategory where guid in (select category from storeproducts where status = 'Active') and FIND_IN_SET('".$area_code."',areas) order by points desc";
$res = mysql_query($sql);
while($row = mysql_fetch_array($res))
    {
			$row_array['guid'] = $row['guid'];
			$row_array['name'] = $row['name'];
			$row_array['desc'] = $row['desc'];
			$row_array['image'] = $images_path.$row['image'];
            array_push($return_arr, $row_array);
            $row_array = array();
    }
    echo json_encode($return_arr);
?>