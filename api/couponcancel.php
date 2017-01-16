<?php 
header('Access-Control-Allow-Origin: *');
include 'config.php';
include 'functions.php';
	$returnarr["status"] = "error";
	$returnarr["message"] = "Payment Cancelled";
	echo json_encode($returnarr);


?>