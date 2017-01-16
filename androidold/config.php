<?php
date_default_timezone_set("Asia/Calcutta");
$db_name  = "freefood_freefood";   // The name of the database. 

$db_user  = "freefooddbmaster";   // Your MySQL username. You MUST create the user and pass yourself

$db_password  = "freefooddbmaster";   // ...and password

$db_host  = "freefooddb.cx78rd1gm7jm.us-west-2.rds.amazonaws.com";   // 99% chance you won't need to change this value

$connect = mysql_connect("$db_host","$db_user","$db_password");

$connection = mysql_select_db("$db_name",$connect);

?>