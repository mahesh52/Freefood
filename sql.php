<?php

// server info

$server = 'freefooddb.cx78rd1gm7jm.us-west-2.rds.amazonaws.com';
$user = 'freefooddbmaster';
$pass = 'freefooddbmaster';
$db = 'freefood_freefoodnew';

// connect to the database
 mysql_connect($server, $user, $pass);
mysql_select_db($db);
?>