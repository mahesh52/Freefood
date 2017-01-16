
<?php
$name=$_POST["name"];
$email=$_POST["email"];
$phone=$_POST["phone"];
$area=$_POST["area"];
$location=$_POST["location"];
$title=$_POST["title"];
if(isset($_POST["name_refer"])){
	$referrer_name = $_POST["name_refer"];
}
else{
	$referrer_name= '';
}
if(isset($_POST["phone_refer"])){
	$phone_refer = $_POST["phone_refer"];
}
else{
	$phone_refer ='';
}

include 'sql.php';
mysql_query("insert into intrestedin(name,email,phone,area,location,intrest,created_date,referrer_name,referrer_mobile)  values('$name','$email','$phone','$area','$location','$title',now(),'$referrer_name','$phone_refer')");
?>
<!-- Google Code for Kitchen Partners Conversions Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 991082738;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "sfVVCLOthmkQ8vHK2AM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/991082738/?label=sfVVCLOthmkQ8vHK2AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<?php header('location:partnerdetailsubmitted.php');
		?>