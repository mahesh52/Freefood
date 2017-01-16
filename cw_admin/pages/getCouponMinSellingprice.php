<?php
include '../../config.php';
$val = $_REQUEST["val"];
$price = $_REQUEST["price"];
$coupon_type = $_REQUEST["coupon_type"];
if(isset($_REQUEST["coupon_type"]) && $_REQUEST["coupon_type"] == "Food"){
	$points = 0;
	$category = mysql_fetch_array(mysql_query("select * from storecategory where points = '$points' "));
$category_name = $category["name"];
$category_id = $category["guid"];
$selling_price_min = $price;
?>
<script>
$("#category_name").html('<?php echo $category_name;  ?>');
$("#category").val('<?php echo $category_id;  ?>');
$("#mprice").val("<?php echo $selling_price_min;  ?>");
</script>
<?php 
}else{
 $sellprice = mysql_fetch_array(mysql_query("select * from commissions order by guid desc limit 0,1"));
 $company = ($price * $sellprice['company']) / 100;
 $state = ($price * $sellprice['state']) / 100;
 $zonal = ($price * $sellprice['zonal']) / 100;
 $city = ($price * $sellprice['city']) / 100;
 //$clp = ($price * $sellprice['clp']) / 100;
 $clp =0;
 $misc = ($price * $sellprice['misc']) / 100;
 
 $burnbudget = ($price * $sellprice['burnbudget']) / 100;
 $selling_price_min = $val + $company + $state + $zonal + $city + $clp + $misc;
$selling_price_min = round($selling_price_min - $burnbudget);
if($selling_price_min < 0){
	 $selling_price_min =0;
 }
 $pointsavalaile = $price - $selling_price_min;
$cashavailable = $price - $pointsavalaile;
 $points = floor(($pointsavalaile * 100) / $price);
 $points = floor($points / 10) * 10;
if($points < 0){
	 $points =0;
 }
$category = mysql_fetch_array(mysql_query("select * from storecategory where points = '$points' "));
$category_name = $category["name"];
$category_id = $category["guid"];
?>
<script>
$("#category_name").html('<?php echo $category_name;  ?>');
$("#category").val('<?php echo $category_id;  ?>');
$("#mprice").val("<?php echo $selling_price_min;  ?>");
</script>
<?php 
}
?>
