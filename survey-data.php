

utfutyfff<?php
include('config.php');
if(isset($_POST['submit']))

{
      mysql_query("INSERT INTO `survey` (`guid`,`fullname` ,`email` ,`mobile` ,`address` ,`app_true` ,`weeklyorder` ,`date`) VALUES (``,'$fullname',  '$email',  '$mobile',  '$address', '$app_true', '$weeklyorder', 99 )");
		{ 
		echo "ok";

}		

else

{

       
	/*	echo "<script language='javascript'>window.location='managemagazines.php';</script>";*/
	echo "error";
		 

}



}

 ?>


