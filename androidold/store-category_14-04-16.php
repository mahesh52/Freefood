<?php ob_start();
include 'config.php';
$ft=time(); $st=md5($ft);
if(empty($_COOKIE['sessid']))
{
setcookie("sessid" ,$st, mktime (0, 0, 0, 12, 31, 2020));
}?><!DOCTYPE HTML>
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
    <header>
        <div class="col-xs-1 padd-sm" id="left-nav"><a href="javascript:void0;" class="pull-right menu-icon button-1"><i class="fa fa-align-center"></i></a></div>
        <div class="col-xs-6 no-padd"><a href="index.php"><img src="assets/images/logo1.png" class="img-responsive" width="110"/></a></div>
    </header>
    <?php $det=mysql_fetch_array(mysql_query("select * from storecategory where guid='$_GET[gid]'"));?>
    
    <section class="status-bar">
        <article>
            <div class="col-xs-1"><a href="home-store.php" class="text-white"><i class="fa fa-angle-left"></i></a></div>
            <div class="col-xs-10 text-small" align="center"><?php echo $det['name'];?></div>
            <div class="col-xs-1"></div>
        </article>
    </section>
    <section class="animsition item bg-pink" data-animsition-in-class="fade-in-down-sm" data-animsition-out-class="fade-out-down-sm" data-animsition-in-duration="2000">
        <article class="content-part">
            <div class="col-xs-12 no-padd">
             <?php 
			  $qry=mysql_query("select * from subcategory where refid='$_GET[gid]' order by name asc") or die('error');
			  while($row=mysql_fetch_assoc($qry))
			  {
				?>
                <div class="media box">
					<div class="col-xs-6"><br> <a href="store-items.php?gid=<?php echo $row['guid'];?>" class="gap-top"> <h5 class="media-heading"><span class="gap-top"><b><?php echo $row['name'];?></b></span></h5></a></div>
					<div class="col-xs-6"> <a href="store-items.php?gid=<?php echo $row['guid'];?>"> <img class="img-responsive" alt="64x64" src="android/uploaded_files/<?php echo $row['image'];?>"> </a> </div> 
				</div>
				<?php } ?>
                
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