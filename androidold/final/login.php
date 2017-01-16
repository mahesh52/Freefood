<?php ob_start();include 'config.php';

extract($_POST);$date=date('Y-m-d');
$sessid=$_COOKIE['sessid'];
if(isset($_POST) && $_POST['submit']=='SIGNIN')
{
$chk=mysql_fetch_array(mysql_query("select * from register where (mobile='$Username' || email='$Username' ) and  password='$Password'"));
	if(!empty($chk['guid']))
	{
            $_SESSION['user_session'] = $chk['guid'];
 setcookie("sessid" ,$chk['guid'], mktime (0, 0, 0, 12, 31, 2020));
mysql_query("update cart set session_id='$_COOKIE[sessid]' where session_id='$sessid'");
//header('location:welcome.php');
 echo "ok";
	}
	else
	{
	echo "Wrong Mobile Number / Email Id / Password";
	}
}
?>