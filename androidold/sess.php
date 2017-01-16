<?php ob_start(); include 'config.php';
setcookie("sessid" ,'', mktime (0, 0, 0, 12, 31, 2020));
echo $_COOKIE['sessid'];
?>