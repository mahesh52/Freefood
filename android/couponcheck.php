<?php
include 'config.php';
$date = date('Y-m-d');
$coupon_code = $_REQUEST["coupon_code"];
$returnarr = array();
$sql1 = mysql_num_rows(mysql_query("select * from freefood_coupons where coupon_code = '".$coupon_code."' "));
//and valid_date = '".$date."'
if($sql1 > 0){
	$sql100 = mysql_fetch_array(mysql_query("select * from freefood_coupons where coupon_code = '".$coupon_code."' "));
	if($sql100["valid_upto"] != "" && $sql100["assigned_to"] != "" && $sql100["products"] == "0"){
		$sql101 = mysql_fetch_array(mysql_query("select * from freefood_coupons where coupon_code = '".$coupon_code."' and assigned_to = '".$_COOKIE['sessid']."' and coupon_value > 0 order by guid asc limit 1 "));
		if(!empty($sql101["guid"])){			 
			  $valid_upto =  date('Y-m-d', strtotime('+'.$sql101["valid_upto"].' months', strtotime($sql101["valid_date"])));
			 $total_price = mysql_fetch_array(mysql_query("select sum(ctotal) from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0")); 
			  $total_price = $total_price[0];
			 if($valid_upto > $date){				
			 if($total_price > $sql101["coupon_value"]){
				 $price = $sql101["coupon_value"];
			}else{
				  $price = $total_price;	
			 }
			 $total_price = $total_price-$price;	
			 if($total_price <=250){
				  $charges = 20;
			 }
			 else{
				 $charges = 0;
			 }
			 $returnarr["code"] = 1;
	$returnarr["message"] = $price;
	$returnarr["charges"] = $charges;
			 echo json_encode($returnarr);
			 }else{
			$returnarr["code"] = 0;
	$returnarr["message"] = "Coupon Expired";
	echo json_encode($returnarr);
		}
		}
		else{
			$returnarr["code"] = 0;
	$returnarr["message"] = "Invalid coupon";
	echo json_encode($returnarr);
		}
	}else{
		if($sql100["valid_date"] == $date){
		//$total = mysql_num_rows(mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0"));
	$sql2 = mysql_num_rows(mysql_query("select * from freefood_coupons_used where coupon_code= '".$coupon_code."' 
	and user_id = '".$_COOKIE[sessid]."' "));
	if($sql2 == 0){
		$sql3 = mysql_fetch_array(mysql_query("select * from freefood_coupons where coupon_code = '".$coupon_code."' "));
		$sql4 = mysql_num_rows(mysql_query("select * from freefood_coupons_used where coupon_code= '".$coupon_code."' "));
		 $products = $sql3["products"];
		 $total_coupons = $sql3["total_coupons"];
		 $chknew_new=mysql_num_rows(mysql_query("select * from cart where pid in ($products) and session_id='$_COOKIE[sessid]' and order_id='' and pid >0 "));
		 if($chknew_new > 0){
			 if($sql4 < $total_coupons){
			//echo "select * from cart where pid in ($products) and session_id='$_COOKIE[sessid]' and order_id=''  and pid >0 order by price desc limit 1 ";
			$chknew=mysql_query("select * from cart where pid in ($products) and session_id='$_COOKIE[sessid]' and order_id='' and pid >0 order by price desc limit 1 ");
			$chk_rowsnew = mysql_fetch_array($chknew);
			 $price = $chk_rowsnew["price"];
			$chk=mysql_query("select * from cart where pid in ($products) and session_id='$_COOKIE[sessid]' and order_id='$ins' and pid >0 order by price desc limit 1 ");
		 $chk_prodss=mysql_num_rows(mysql_query("select * from cart where  session_id='$_COOKIE[sessid]' and order_id='$ins' and pid>0 "));
		 $chk_rows = mysql_num_rows($chk);
		 if($chk_prodss == 1 && $chk_rows ==1){
			 $charges = 0;
		 }else{
			 $total_price = mysql_fetch_array(mysql_query("select sum(ctotal) from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0"));
			 $total_price = $total_price[0]-$price;
			if($total_price <=250){
				  $charges = 20;
			 }
			 else{
				 $charges = 0;
			 }
		 }
			$returnarr["code"] = 1;
	$returnarr["message"] = $price;
	$returnarr["charges"] = $charges;
	echo json_encode($returnarr);
		}
		else{
			$returnarr["code"] = 0;
	$returnarr["message"] = "Valid only for first ".$total_coupons." users";
	echo json_encode($returnarr);
		}
		 }
		 else{
			 $returnarr["code"] = 0;
	$returnarr["message"] = "Coupon not applicable on your cart items";
	echo json_encode($returnarr);
		 }
		
		
		
	}
	else{
		$returnarr["code"] = 0;
	$returnarr["message"] = "Coupon alredy used";
	echo json_encode($returnarr);
	}
	}else{
		$returnarr["code"] = 0;
	$returnarr["message"] = "Invalid coupon";
	echo json_encode($returnarr);
	}
	}
	
	
}
else{
	$returnarr["code"] = 0;
	$returnarr["message"] = "Invalid coupon";
	echo json_encode($returnarr);
}

?>