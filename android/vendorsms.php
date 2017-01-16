<?php


$select = mysql_query("SELECT * FROM `cart` where order_status='' and  order_id='$ins'");
if ($select > 0) {
    while ($cart = mysql_fetch_assoc($select)) {
        $vendordets = mysql_fetch_array(mysql_query("select * from `orders` where guid = '$ins'"));
        $vendor_id =$vendordets["vendor_id"];
        $sql_vendor = "select * from vendor where guid = '$vendor_id'";
        $vendor =  mysql_fetch_array(mysql_query($sql_vendor));
        $message = "Dear Vendor, your order no. FF$ins is waiting for your confirmation";
        $sms = str_replace(" ", "%20", "$message");
         $url = "http://onlinebulksmslogin.com/spanelv2/api.php?username=freefd&password=free123&to=$mobile&from=FREEFD&message=$sms"; 
      // $url = "http://api.smscountry.com/SMSCwebservice_bulk.aspx?User=catchway&passwd=sanju100&mobilenumber=$vendor[mobile]&message=$sms&sid=FREFUD&mtype=N&DR=Y";
        get_data($url);
        
      
    }
}
//while ($vendor = mysql_fetch_assoc($login)) {
//
//    $spt = split(',', $vendor['area']);
//    for ($j = 0; $j < count($spt); $j++) {
//        if ($spt[$j] != '') {
//            $area.="'" . $spt[$j] . "',";
//        }
//    }
//    $area = substr($area, 0, -1);
//    //echo "SELECT * FROM `cart` where order_status='' and area in ($area) and order_id='$ins'";
//    $select = mysql_num_rows(mysql_query("SELECT * FROM `cart` where order_status='' and area in ($area) and order_id='$ins'"));
//    if ($select > 0) {
//
//        $message = "Dear Vendor, your order no. FF$ins is waiting for your confirmation";
//        $sms = str_replace(" ", "%20", "$message");
//        $url = "http://api.smscountry.com/SMSCwebservice_bulk.aspx?User=catchway&passwd=sanju100&mobilenumber=$vendor[mobile]&message=$sms&sid=FREFUD&mtype=N&DR=Y";
//        get_data($url);
//    }
//}
?>