<?php ob_start(); error_reporting(0);
include 'config.php';//print_r($_POST);exit;
if(isset($_POST) && !empty($_POST['city']) && !empty($_POST['area']))
{
setcookie("city" ,$_POST['city'], mktime (0, 0, 0, 12, 31, 2020));
setcookie("area" ,$_POST['area'], mktime (0, 0, 0, 12, 31, 2020));
}//echo $_COOKIE[area];
if(!empty($_POST['area'])){$chk=mysql_fetch_array(mysql_query("select * from area where guid='$_POST[area]'"));}else{
$chk=mysql_fetch_array(mysql_query("select * from area where guid='$_COOKIE[area]'"));}?><!DOCTYPE HTML>
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

<body class="body-home">
    <section class="animsition item bg-cyan" data-animsition-in-class="fade-in-up-sm" data-animsition-out-class="fade-out-up-sm" data-animsition-in-duration="1000">
        <article>
            <div><img onclick="window.location='index.php'" src="assets/images/logo.png" class="img-responsive logo" width="150"/></div><br />
        </article>
    </section>
    <section class="animsition item" data-animsition-in-class="fade-in-down-sm" data-animsition-out-class="fade-out-down-sm" data-animsition-in-duration="2000">
        <article>
            <div class="col-xs-12 no-padd">
				<?php if($chk['food']=='yes'){?><div class="col-xs-10 col-xs-offset-1 welcome-icon" align="center"><br><br>
                    <a href="category.php"><img src="assets/images/icon-food.png" class="img-responsive"/></a>
                </div><?php } ?><!-- /.col-lg-6 -->
				<?php if($chk['store']=='yes'){?><div class="col-xs-6 col-xs-offset-3 welcome-icon" align="center"><br><br>
                    <a href="home-store.php"><img src="assets/images/icon-store.png" class="img-responsive" width="150"/></a>
                </div><?php } ?><!-- /.col-lg-6 -->
            </div>
        </article>
    </section>

    <section>
        <article>
            <footer>Copyrights @ Msk Netpix Pvt Ltd.</footer>
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
</html>