<?php ob_start();
include 'config.php';?><!DOCTYPE HTML>
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
    
    
    <script>

   	  	$(function(){

			$('#left-nav').click(function(){

				$('.side-tabs-mobile').animate({left: '0px'});

			});

			$('#close-btn').click(function(){

				$('.side-tabs-mobile').animate({left: '-210px'});
    
			});

		});
		
		
		
	
   </script>
    
</head>

<body>
    <?php include 'menu.php';?>
    <!--header>
        <div class="col-xs-1 padd-sm" id="left-nav"><a href="javascript:void0;" class="pull-right menu-icon button-1"><i class="fa fa-align-center"></i></a></div>
        <div class="col-xs-6 no-padd"><a href="index.php"><img src="assets/images/logo1.png" class="img-responsive" width="110"/></a></div>
    </header-->
    
    
    <section class="status-bar">
        <article>
            <div class="col-xs-1"><a href="welcome.php" class="text-white"><i class="fa fa-angle-left"></i></a></div>
            <div class="col-xs-10 text-small" align="center">Order History</div>
            <div class="col-xs-1"></div>
        </article>
    </section>
    <section class="animsition item bg-pink" data-animsition-in-class="fade-in-down-sm" data-animsition-out-class="fade-out-down-sm" data-animsition-in-duration="2000">
        <article class="content-part">
            <div class="col-xs-12 no-padd">
                <?php 
			  $total=mysql_num_rows(mysql_query("select * from orders where userid='$_COOKIE[sessid]'"));
			  if($total==0){echo "No Orders";}else{
			  $qry=mysql_query("select * from orders where userid='$_COOKIE[sessid]' order by guid desc") or die('error');
			  while($row=mysql_fetch_assoc($qry))
			  {
				?> <div class="media box text-small-xs1" align="center">
					<div class="col-xs-4"><br>
						ORDER ID<br> FF<?php echo $row['guid'];?>
					</div>
					<div class="col-xs-4"><br>
						ORDER DATE<br> <?php echo date('d-m-y',strtotime($row['date']));?>
					</div>
					<div class="col-xs-4"><br>
						AMOUNT<br><i class="fa fa-inr"></i> <?php echo $row['total'];?><br><small>Mode  <?php echo $row['pmode'];?></small>
					</div>
					<div class="clearfix"></div><hr>
					
					<div class="col-xs-4 padd1"><br>
						Packed
						<div class="<?php if($row['status']=='Packed' || $row['status']=='Delivering' || $row['status']=='Delivered'){echo "delivery-status1";}else{echo "delivery-status4";}?>"></div>
					</div>
					<div class="col-xs-4 padd1"><br>
						Delivering
						<div class="<?php if($row['status']=='Delivered' || $row['status']=='Delivering'){echo "delivery-status1";}else{echo "delivery-status4";}?>"></div>
					</div>
					<div class="col-xs-4 padd1"><br>
						Delivered
						<div class="<?php if($row['status']=='Delivered'){echo "delivery-status1";}else{echo "delivery-status4";}?>"></div>
					</div>
					<div class="clearfix"></div><br>
				</div>
				<?php }}?>
                
				
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
		$(document).ready(function(){
			$(".search-btn").click(function(){
				$(".search").slideToggle('slow');
			});
		});
	</script>
  
  
</body>
</html>