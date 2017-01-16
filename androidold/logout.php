<?php ob_start();
session_start();
setcookie("sessid" ,' ', mktime (0, 0, 0, 12, 31, 2020));
header("location:index.php");



?>