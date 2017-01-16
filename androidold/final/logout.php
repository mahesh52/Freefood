<?php ob_start();
session_start();
unset($_SESSION['user_session']);
setcookie("sessid" ,' ', mktime (0, 0, 0, 12, 31, 2020));
header("location:index.php");



?>