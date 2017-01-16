<?php 
		  $login=mysql_query("select * from `vendor` where `date`='$date' and status='Active'");

		  while($vendor=mysql_fetch_assoc($login))
		  {

			$spt=split(',',$vendor['area']);
				for($j=0;$j<count($spt);$j++)
				{
					if($spt[$j]!='')
					{
					$area.="'".$spt[$j]."',";
					}
				}
$area=substr($area,0,-1);
				//echo "SELECT * FROM `cart` where order_status='' and area in ($area) and order_id='$ins'";
				$select=mysql_num_rows(mysql_query("SELECT * FROM `cart` where order_status='' and area in ($area) and order_id='$ins'")); 
				if($select>0){
					
					$message="Dear Vendor, your order no. FF$ins is waiting for your confirmation"; 
$sms=str_replace(" ","%20","$message"); 
$url = "http://api.smscountry.com/SMSCwebservice_bulk.aspx?User=catchway&passwd=sanju100&mobilenumber=$vendor[mobile]&message=$sms&sid=FREFUD&mtype=N&DR=Y"; 
get_data($url);

					
					}
	      }
	
?>