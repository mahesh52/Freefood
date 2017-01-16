<?php 
header('Access-Control-Allow-Origin: *');
include 'config.php';
$valid_from = date('Y-m-d H:i:s');
$valid_to = date('Y-m-d H:i:s', strtotime("+30 minutes"));
$request = json_decode(file_get_contents('php://input'), true);
$request_string = $request["metaData"];
$otp = $request_string["otp"];
$mobile = $request_string["mobile"];
        $get_otp = "select * from freefood_otp_details where otp_for = 'registration' and otp = '$otp' and status =1 and mobile_number = '$mobile' and valid_to >= '$valid_from'";
        $result = mysql_query($get_otp);
        $num_rows = mysql_num_rows($result);
        if ($num_rows > 0) {
            $row = mysql_fetch_array($result);
            $id = $row["id"];
            $update = mysql_query("update freefood_otp_details set status =0 where id = '$id' ");
            echo json_encode(array("status"=>"success","message"=>"OTP verified"));
        } else {
            echo json_encode(array("status"=>"failed","message"=>"Invalid OTP"));
        }
    
?>