<?php 
include '../../config.php';
$product_id = $_POST["product_id"];
 $type = $_POST["type"];
$qty = $_POST["qty"];
$vendor = $_POST["vendor"];

	if($qty != ""){
		$sql_raw = mysql_query("select a.quantity,b.item_name,b.units,b.measures_in,b.item_price
				from products_mapping a,rawmaterials b  where a.rawmaterial_id = b.guid 
				and  product_id = '$product_id' and b.vendor = '$vendor' ");
				while($row = mysql_fetch_array($sql_raw)){
					$price = $qty*$row['item_price'];
					echo $qty.' X '. $row['item_name'].' '. $row['units'].' '.$row['measures_in']." "."=".$price." /-" ;
					echo "<br>";
				}
	}
	

?>