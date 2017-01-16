<?php ob_start();extract($_POST);
include 'config.php';$date=date('Y-m-d');
function get_data($url) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}
$details=mysql_fetch_array(mysql_query("select * from register where guid='$_COOKIE[sessid]'"));
if($details['guid']==''){header('location:login.php');}
	$chk=mysql_fetch_array(mysql_query("select * from register where guid='$_COOKIE[sessid]'"));
	$tot=mysql_fetch_array(mysql_query("select sum(ctotal) from cart where session_id='$_COOKIE[sessid]' and order_id='' and sid>0"));
	if($tot[0]>0)
	{
	$chk_product=mysql_fetch_array(mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and sid>0"));
	if($payable>0){
	$tot_price=$payable;}else{$tot_price=$tot[0];}
mysql_query("INSERT INTO `orders` (`userid` ,`total` ,`date`,`status`,`time`,`getdate`,`gettime`,`pmode`,`area`) VALUES ('$_COOKIE[sessid]', '$tot_price', '$date','Not Delivered','$time','$deliverytime','Store','$pmode','$_COOKIE[area]')");
$ins=mysql_insert_id();
$message="Dear $details[name] thanks for shopping at Free food. Your order no. FF$ins for Rs.$tot_price will be delivered shortly For queries, reach us at support@freefood.co.in"; 
$sms=str_replace(" ","%20","$message"); 
$url = "http://api.smscountry.com/SMSCwebservice_bulk.aspx?User=catchway&passwd=sanju100&mobilenumber=$details[mobile]&message=$sms&sid=FREFUD&mtype=N&DR=Y"; 

get_data($url);
		if($points>0){
			if($dis_points=='yes')
			{
			$chk1=mysql_fetch_array(mysql_query("select * from wallet where userid='$chk[userid]' and refid='$ins'"));
			if(empty($chk1['guid']))
		{
	mysql_query("INSERT INTO  `wallet` (`userid` ,`points` ,`refid` ,`date`,`status`) VALUES ('$chk[guid]', '$points',  '$ins',  '$date',  'Debit')");
		}
			}
			if($dis_points=='special')
			{
			$chk1=mysql_fetch_array(mysql_query("select * from virtualwallet where userid='$chk[userid]' and refid='$ins'"));
			if(empty($chk1['guid']))
		{
	mysql_query("INSERT INTO  `virtualwallet` (`userid` ,`points` ,`refid` ,`date`,`status`) VALUES ('$chk[guid]', '$points',  '$ins',  '$date',  'Debit')");
		}
			}
			}
mysql_query("update cart set order_id='$ins',area='$_COOKIE[area]' where session_id='$_COOKIE[sessid]' and order_id='' and sid>0");

}if($ins==''){header('location:index.php');}else{
?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
	<!-- For IE -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- For Resposive Device -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
	<link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon.png">
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="Free Food" />
	<title>Free Food</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="assets/css/animsition.min.css" rel="stylesheet">
    <script type="text/javascript" src="assets/js/jquery-2.1.4.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<style>
		.table-bordered>thead>tr>th {
			border: 1px solid #ED492B;
		}
		.table-bordered {
			border: 1px solid #ED492B;
		}
		.table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
			border: 1px solid #ED492B;
		}
        .home-btn{
            height: 34px;
            background: #BF1358;
            border:1px solid #BF1358;
            color: #fff;
        }
		@media screen and (max-width: 767px){
		.table-responsive {
			width: 100%;
			margin-bottom: 15px;
			overflow-y: hidden;
			-ms-overflow-style: -ms-autohiding-scrollbar;
			border: 1px solid transparent;
		}
		}
        
	</style>
</head>

<body class="" style="background: #FFEB3B;">
    <section class="animsition item bg-cyan" data-animsition-in-class="fade-in-up-sm" data-animsition-out-class="fade-out-up-sm" data-animsition-in-duration="1000">
        <article>
            <div><img onclick="window.location='index.php'" src="assets/images/logo-food.png" class="img-responsive logo" width="150"/></div>
        </article>
    </section>
    <section class="animsition item" data-animsition-in-class="fade-in-down-sm" data-animsition-out-class="fade-out-down-sm" data-animsition-in-duration="2000">
        <article>
            <div class="col-xs-12 no-padd">
				<div class="col-xs-12 welcome-icon" align="center">
                    <img onclick="window.location='index.php'" src="assets/images/thankyou.png" class="img-responsive logo"/>
                </div><!-- /.col-lg-6 -->
				<div class="col-xs-12 welcome-icon" align="center">
                    <ul class="list-group text-small">
                      <li class="list-group-item list-group-item-success">
                          Your order has been placed
                      </li>
                      <li class="list-group-item">
                          <span class="pull-left">Order ID</span>
                          <span class="pull-right">FF<?php echo $ins;?></span>
                          <div class="clearfix"></div>
                      </li>
                      <li class="list-group-item">
                          <span class="pull-left">Delivery Time</span>
                          <span class="pull-right"><?php echo $deliverytime;?></span>
                          <div class="clearfix"></div>
                      </li>
                    </ul>
                    <h4>Want to add more products...?</h4><br />
                    <a href="welcome.php" class="btn btn-success"><i class="fa fa-angle-right"></i> Continue <i class="fa fa-angle-right"></i></a>
                </div><!-- /.col-lg-6 -->
            </div>
        </article>
    </section>

    
  <script src="assets/js/animsition.min.js" charset="utf-8"></script>
  <script>
  $( document ).ready(function() {
    var $animsition = $('.animsition');
    $animsition
      .animsition()
      .one('animsition.inStart',function(){
        $(this).append('');
        console.log('event -> inStart');
      })
      .one('animsition.inEnd',function(){
        $('.target', this).html('');
        console.log('event -> inEnd');
      })
      .one('animsition.outStart',function(){
        console.log('event -> outStart');
      })
      .one('animsition.outEnd',function(){
        console.log('event -> outEnd');
      });
  });
  </script>
  <script>
	$("#my_select").change(function() {
	  var id = $(this).children(":selected").attr("id");
	  if( id == 'food-delivery'){
	    $("#choose_restaurant").slideDown("slow");
	  } else {
	    $("#choose_restaurant").slideUp("slow");
	  }
	});
  </script>   
</body>
</html><?php } ?>