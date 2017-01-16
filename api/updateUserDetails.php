<?php 
header('Access-Control-Allow-Origin: *');
include 'config.php';
include 'functions.php';
$date = date('Y-m-d');
$return_arr = array();
$request = json_decode(file_get_contents('php://input'), true);
$request_string = $request["metaData"];
$user_id = $request_string["user_id"];
$name = $request_string["name"];
$email = $request_string["email"];
$address = $request_string["address"];
$city = $request_string["city"];
$area = $request_string["area"];
$pincode = $request_string["pincode"];
 $sql = "update register set name='".$name."',email='".$email."',
address='".$address."',city='".$city."',state='".$area."',pincode='".$pincode."'
  where guid='".$user_id."' ";
$res = mysql_query($sql);
echo json_encode(array("status"=>"success"));
?>