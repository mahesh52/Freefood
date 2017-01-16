<?php 
header('Access-Control-Allow-Origin: *');
include 'config.php';
include 'functions.php';
$return_arr = array();
$sql = 'select  * from city order by name asc ';
$res = mysql_query($sql);
while($row = mysql_fetch_array($res))
    {
			$row_array['guid'] = $row['guid'];
			$row_array['name'] = $row['name'];
			
            array_push($return_arr, $row_array);
            $row_array = array();
    }
    echo json_encode($return_arr);
?>