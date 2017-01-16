<?php

function get_data($url) {
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

include 'config.php';
$mobile = $_REQUEST["mobile"];
$type = $_REQUEST["type"];
$req = $_REQUEST["req"];
$valid_from = date('Y-m-d H:i:s');
$valid_to = date('Y-m-d H:i:s', strtotime("+30 minutes"));
if ($req == "generate") {
    $chk = mysql_fetch_array(mysql_query("select * from register where mobile='$mobile'"));
    if (empty($chk['guid'])) {
        $otp = mt_rand(100000, 999999);

        $update = mysql_query("update freefood_otp_details set status =0 where otp_for = '$type' and status =1 and mobile_number = '$mobile' ");
        $result = mysql_query("INSERT INTO `freefood_otp_details` (`mobile_number` ,`otp_for` ,`otp` ,`created_date` ,`valid_from` ,`valid_to`,`status`) "
                . "VALUES ('$mobile', '$type', '$otp', '$valid_from', '$valid_from', '$valid_to','1')");
        if ($result) {
             $message = "Dear Customer thanks for downloading Free Food App. $otp is the password to validate your mobile valid for 30Mins. For queries, reach us at support@freefood.co.in";
            $sms = str_replace(" ", "%20", "$message");
            $url = "http://onlinebulksmslogin.com/spanelv2/api.php?username=freefd&password=free123&to=$mobile&from=FREEFD&message=$sms"; 
           // $url = "http://api.smscountry.com/SMSCwebservice_bulk.aspx?User=catchway&passwd=sanju100&mobilenumber=$mobile&message=$sms&sid=FREFUD&mtype=N&DR=Y";
            get_data($url);
            echo 1;
        }
    } else {
        echo 2;
    }
} else if ($req == "validate") {
    $mobile = $_REQUEST["mobile"];
    $otp = $_REQUEST["otp"];
    $chk = mysql_fetch_array(mysql_query("select * from register where mobile='$mobile'"));
    if (empty($chk['guid'])) {
        $get_otp = "select * from freefood_otp_details where otp_for = '$type' and otp = '$otp' and status =1 and mobile_number = '$mobile' and valid_to >= '$valid_from'";
        $result = mysql_query($get_otp);
        $num_rows = mysql_num_rows($result);
        if ($num_rows > 0) {
            $row = mysql_fetch_array($result);
            $id = $row["id"];
            $update = mysql_query("update freefood_otp_details set status =0 where id = '$id' ");
            echo 1;
        } else {
            echo 0;
        }
    } else {
        echo 2;
    }
}
?>

