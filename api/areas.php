<?php 
header('Access-Control-Allow-Origin: *');
include 'config.php';
include 'functions.php';
$return_arr = array();
$date = date('Y-m-d');
$date1 = date('Y-m-d H:i:s');
$request = json_decode(file_get_contents('php://input'), true);
$request_string = $request["metaData"];
$val = $request_string["city_code"];
$user_id = $request_string["user_id"];
$sql = 'select * from area where refid="'.$val.'" order by name asc ';
$res = mysql_query($sql);
while($row = mysql_fetch_array($res))
    {
			$row_array['guid'] = $row['guid'];
			$row_array['name'] = $row['name'];
			$row_array['food'] = $row['food'];
			$row_array['store'] = $row['store'];
			$row_array['coupons'] = $row['coupons'];
            array_push($return_arr, $row_array);
            $row_array = array();
    }
	$login_info = mysql_num_rows(mysql_query("select * from login_details where user_id='".$user_id."' and date(dateandtime)='".$date."'"));
	if($login_info == 0 && $user_id != ""){
	   mysql_query("insert into login_details (userid,dateandtime)values('".$user_id."','".$date1."')");
   }
    echo json_encode($return_arr);
?>