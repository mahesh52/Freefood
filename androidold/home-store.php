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

<body class="body-home1">
    <section class="animsition item bg-cyan" data-animsition-in-class="fade-in-up-sm" data-animsition-out-class="fade-out-up-sm" data-animsition-in-duration="1000">
        <article>
			<div class="col-xs-12"><br><a href="javascript:void(0)" class="text-small text-white search-btn pull-right"><i class="fa fa-search text-white"></i></a></div>
            <div><img onclick="window.location='welcome.php'" src="assets/images/logo-store.png" class="img-responsive logo" width="150"/></div><br />
        </article>
    </section>
	
    <div class="search" style="margin-top:-20px; display:none; position:absolute; z-index: 10003;">
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
    <section class="animsition item" data-animsition-in-class="fade-in-down-sm" data-animsition-out-class="fade-out-down-sm" data-animsition-in-duration="2000">
        <article>
            <div class="col-xs-12 no-padd">
            <?php 
			  $qry=mysql_query("select * from storecategory order by name asc") or die('error');
			  while($row=mysql_fetch_assoc($qry))
			  {
				?>
				<div class="col-xs-3 padd-sm ibg" align="center">
                    <a href="store-category.php?gid=<?php echo $row['guid'];?>"><img src="uploaded_files/<?php echo $row['image'];?>" class="img-responsive" width="150"/>
                    <span class="text-small-xs"><?php echo $row['name'];?></span></a>
                </div>
                <?php } ?><!-- /.col-lg-6 -->
            </div>
			<div class="clearfix"></div><br>
			<!--div class="col-xs-12">
				  <ul class="nav nav-tabs" role="tablist" style="background:#BF1358; color:#fff !important;">
					<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Prepaid</a></li>
					<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Postpaid</a></li>
					<li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">DTH</a></li>
					<li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Datacard</a></li>
				  </ul>

				  <div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="home"><br>
						<input type="text" class="form-control" placeholder="Enter Mobile Number" style="border:0px; border-bottom:1px solid #ccc; border-radius:0px;"><br>
						<div class="col-xs-2 price text-small-xs"><i class="fa fa-inr"></i> 350</div>
						<div class="col-xs-2 price text-small-xs"><i class="fa fa-inr"></i> 250</div>
						<div class="col-xs-2 price text-small-xs"><i class="fa fa-inr"></i> 150</div>
						<div class="col-xs-2 price text-small-xs"><i class="fa fa-inr"></i> 50</div>
						<div class="col-xs-3"> <a href="home-food.htm"><img onclick="window.location='index.htm'" src="assets/images/go.png" width="50" height="50" class="img-responsive"/></div>
						<div class="clearfix"></div><br>
					</div>
					<div role="tabpanel" class="tab-pane" id="profile"><br>
						<input type="text" class="form-control" placeholder="Enter Mobile Number" style="border:0px; border-bottom:1px solid #ccc; border-radius:0px;"><br>
						<div class="col-xs-2 price text-small-xs"><i class="fa fa-inr"></i> 350</div>
						<div class="col-xs-2 price text-small-xs"><i class="fa fa-inr"></i> 250</div>
						<div class="col-xs-2 price text-small-xs"><i class="fa fa-inr"></i> 150</div>
						<div class="col-xs-2 price text-small-xs"><i class="fa fa-inr"></i> 50</div>
						<div class="col-xs-3"> <a href="home-food.htm"><img onclick="window.location='index.htm'" src="assets/images/go.png" width="50" height="50" class="img-responsive"/></div>
						<div class="clearfix"></div><br>
					</div>
					<div role="tabpanel" class="tab-pane" id="messages"><br>
						<input type="text" class="form-control" placeholder="Enter Mobile Number" style="border:0px; border-bottom:1px solid #ccc; border-radius:0px;"><br>
						<div class="col-xs-2 price text-small-xs"><i class="fa fa-inr"></i> 350</div>
						<div class="col-xs-2 price text-small-xs"><i class="fa fa-inr"></i> 250</div>
						<div class="col-xs-2 price text-small-xs"><i class="fa fa-inr"></i> 150</div>
						<div class="col-xs-2 price text-small-xs"><i class="fa fa-inr"></i> 50</div>
						<div class="col-xs-3"> <a href="home-food.htm"><img onclick="window.location='index.htm'" src="assets/images/go.png" width="50" height="50" class="img-responsive"/></div>
						<div class="clearfix"></div><br>
					</div>
					<div role="tabpanel" class="tab-pane" id="settings"><br>
						<input type="text" class="form-control" placeholder="Enter Mobile Number" style="border:0px; border-bottom:1px solid #ccc; border-radius:0px;"><br>
						<div class="col-xs-2 price text-small-xs"><i class="fa fa-inr"></i> 350</div>
						<div class="col-xs-2 price text-small-xs"><i class="fa fa-inr"></i> 250</div>
						<div class="col-xs-2 price text-small-xs"><i class="fa fa-inr"></i> 150</div>
						<div class="col-xs-2 price text-small-xs"><i class="fa fa-inr"></i> 50</div>
						<div class="col-xs-3"> <a href="home-food.htm"><img onclick="window.location='index.htm'" src="assets/images/go.png" width="50" height="50" class="img-responsive"/></div>
						<div class="clearfix"></div><br>
					</div>
				  </div>
            </div-->
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