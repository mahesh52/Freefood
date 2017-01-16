
<?php
$name=$_POST["name"];
$email=$_POST["email"];
$phone=$_POST["phone"];
$area=$_POST["area"];
$location=$_POST["location"];

include 'sql.php';

mysql_query("insert into facebookusers(name,email,phone,area,location)  values('$name','$email','$phone','$area','$location')");
?>
<?php header('location:index.php');
		?>