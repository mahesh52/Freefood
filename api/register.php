<?phpheader('Access-Control-Allow-Origin: *');include 'config.php';include 'functions.php';$date = date('Y-m-d');$request = json_decode(file_get_contents('php://input'), true);$request_string = $request["metaData"];$mobile = $request_string["mobile"];$username = $request_string["username"];$referral_code = $request_string["referral_code"];$valid_from = date('Y-m-d H:i:s');$valid_to = date('Y-m-d H:i:s', strtotime("+30 minutes"));$chk = mysql_num_rows(mysql_query("select * from register where mobile='$mobile'"));$get_otp = mysql_num_rows(mysql_query("select * from freefood_otp_details where otp_for = 'registration' and status = 0 and mobile_number = '$mobile' "));if($chk == 0){		mysql_query("INSERT INTO `register` (`name` ,`mobile` ,`email` ,`address` ,		`city` ,`state` ,`date`,`password`,`pincode`,		status,referred_by) 	VALUES ('$username', '$mobile', '', '', '', 	'', '$date','$mobile','',1,'$referral_code')");	//$chk1 = mysql_fetch_array(mysql_query("select * from register where mobile='$mobile'"));	$otp = mt_rand(100000, 999999);        $update = mysql_query("update freefood_otp_details set status =0 where otp_for = 'registration' and status =1 and mobile_number = '$mobile' ");        $result = mysql_query("INSERT INTO `freefood_otp_details` (`mobile_number` ,`otp_for` ,`otp` ,`created_date` ,`valid_from` ,`valid_to`,`status`) "                . "VALUES ('$mobile', 'registration', '$otp', '$valid_from', '$valid_from', '$valid_to','1')");				 $message = "Thanks for downloading FREE FOOD App.$otp is password to validate your mobile valid for 30 Mins. Email info@freefood.co.in or call 9580666888";            $sms = str_replace(" ", "%20", $message);			$url = str_replace("<SMS>", $sms, $url);			$url = str_replace("<MOBILE>", $mobile, $url);			get_data($url);			echo json_encode(array("status"=>"success","mobile"=>$mobile,"message"=>"OTP Sent to mobile number","type"=>"newuser"));	}else{	if($get_otp == 0){		mysql_query("INSERT INTO `register` (`name` ,`mobile` ,`email` ,`address` ,		`city` ,`state` ,`date`,`password`,`pincode`,		status,referred_by) 	VALUES ('$username', '$mobile', '', '', '', 	'', '$date','$mobile','',1,'$referral_code')");		$otp = mt_rand(100000, 999999);        $update = mysql_query("update freefood_otp_details set status =0 where otp_for = 'registration' and status =1 and mobile_number = '$mobile' ");        $result = mysql_query("INSERT INTO `freefood_otp_details` (`mobile_number` ,`otp_for` ,`otp` ,`created_date` ,`valid_from` ,`valid_to`,`status`) "                . "VALUES ('$mobile', 'registration', '$otp', '$valid_from', '$valid_from', '$valid_to','1')");				 $message = "Dear Customer thanks for downloading Free Food App. $otp is the password to validate your mobile valid for 30Mins. For queries, reach us at support@freefood.co.in";            $sms = str_replace(" ", "%20", $message);			$url = str_replace("<SMS>", $sms, $url);			$url = str_replace("<MOBILE>", $mobile, $url);			get_data($url);			echo json_encode(array("status"=>"success","mobile"=>$mobile,"message"=>"OTP Sent to mobile number","type"=>"newuser"));	}	else{		$chk1 = mysql_fetch_array(mysql_query("select * from register where mobile='$mobile'"));		echo json_encode(array("status"=>"success","mobile"=>$mobile,"userid"=>$chk1["guid"],"type"=>"registereduser"));	}}?>