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
            <div class="col-xs-9 text-small" align="center">Choose Food</div>
            <div class="col-xs-1 no-apdd" align="right"><a href="javascript:void(0)" class="text-small text-white search-btn"><i class="fa fa-search text-white"></i></a></div>
        </article>
    </section>
	
    <div class="search" style="margin-top:30px; display:none; position:absolute; z-index: 999999;">
	  <div class="col-sm-12 col-md-8 col-md-offset-2 no-padd">
		<div class="input-group">
        <form name="form1" method="get" action="product.php">
          
          <span class="input-group-btn">
          <input type="text" name="search" class="form-control" placeholder="Find Food..." style="border-radius:0px;">
          <input type="hidden" name="pid" value="<?php echo $_GET['pid'];?>">
            <button style="height: 34px; border-radius:0px;" class="btn btn-default home-btn" type="submit"><i class="fa fa-map-marker"></i></button>
          </span>
          </form>
        </div><!-- /input-group -->
      </div>
    </div>
    <br />
    <section class="animsition item bg-pink content-part" data-animsition-in-class="fade-in-down-sm" data-animsition-out-class="fade-out-down-sm" data-animsition-in-duration="2000">
        <article>
            <div class="col-xs-12 no-padd">
                <?php 
			  $qry=mysql_query("select * from category order by name asc") or die('error');
			  while($row=mysql_fetch_assoc($qry))
			  {
				?><div class="col-xs-6" align="center">
                    <a href="food-category.php?gid=<?php echo $row['guid'];?>">
                    <img src="uploaded_files/<?php echo $row['image']; ?>"class="img-responsive img-circle br" />
                    <h5 class="category-title"><?php echo $row['name']; ?></h5>
                    </a>
                </div>
                <?php  
			  }?>
            </div>
        </article>
    </section>
    
  <script src="assets/js/animsition.min.js" charset="utf-8"></script>
  <script>
	
  $(document).ready(function(){
		$(".search-btn").click(function(){
			$(".search").slideToggle('slow');
		});
	});
  </script>
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
  
  
  
</body>
</html>