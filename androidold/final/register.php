<?php ob_start();include 'config.php';
extract($_POST);$date=date('Y-m-d');
$sessid=$_COOKIE['sessid'];
if(isset($_POST) && $_POST['submit']=='SIGN UP' && $_POST['mobile']!='' && $_POST['email']!='' && $_POST['password']!='')
{
$chk=mysql_fetch_array(mysql_query("select * from register where mobile='$mobile'"));
$chk1=mysql_fetch_array(mysql_query("select * from register where email='$email'"));
	if(empty($chk['guid']) &&  empty($chk1['guid']))
	{
mysql_query("INSERT INTO `register` (`name` ,`mobile` ,`email` ,`address` ,`city` ,`state` ,`date`,`password`,`pincode`) VALUES ('$name', '$mobile', '$email', '$address', '$city', '$state', '$date','$password','$pincode')");
$ins=mysql_insert_id();
setcookie("sessid" ,$ins, mktime (0, 0, 0, 12, 31, 2020));
mysql_query("update cart set session_id='$_COOKIE[sessid]' where session_id='$sessid'");
//header('location:welcome.php');
echo "registered";
	}
	else
	{
            echo "1";
	//echo "Mobile / Email Id Already Registered";
	}
}else{
    echo "Mandatory data is missiong";
}
?>
