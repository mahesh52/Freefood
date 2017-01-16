<?php

include 'config.php';
$mobile = $_REQUEST["mobile"];
 
    $mobile = $_REQUEST["mobile"];
    //echo "select * from register where mobile='$mobile'";
    $chk = mysql_fetch_array(mysql_query("select * from register where mobile='$mobile'"));
	
    if (empty($chk['guid'])) {
       echo 0;
     } else {
        echo 1;
    }

?>

