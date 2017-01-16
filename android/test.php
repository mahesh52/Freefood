<?php ob_start();extract($_POST);
include 'config.php';
	$chk=mysql_query("select * from orders where gettime='Food'");
	while($row=mysql_fetch_assoc($chk)){

		
mysql_query("update cart set area='$row[area]' where order_id='$row[guid]'");

}