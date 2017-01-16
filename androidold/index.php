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
			border: 1px solid #D63F51;
		}
		.table-bordered {
			border: 1px solid #D63F51;
		}
		.table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
			border: 1px solid #D63F51;
		}
        .home-btn {
			height: 34px;
			background: #00AEED;
			border: 1px solid #00AEED;
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
            <div><img src="assets/images/logo.png" class="img-responsive logo" width="150"/></div><br /><br /><br />
            <!--div><img src="assets/images/map-marker.ico" class="img-responsive logo" width="100"/></div-->
        </article>
    </section>
    <br />
    <section class="animsition item" data-animsition-in-class="fade-in-down-sm" data-animsition-out-class="fade-out-down-sm" data-animsition-in-duration="2000">
        <article>
            <form name="form1" method="post" action="welcome.php">
            <div class="col-xs-12 no-padd bg-home-form">
				<div class="col-xs-12">
                    <div class="input-group">
                      <select class="form-control" name="city" required onChange="return subcategories(this.value);">
                      <option value="">Select City</option>
						<?php 
			  $qry=mysql_query("select * from city order by name asc") or die('error');
			  while($row=mysql_fetch_assoc($qry))
			  {
				echo "<option value='$row[guid]'>$row[name]</option>";  
			  }?>
					  </select>
                      <span class="input-group-btn">
                        <button class="btn btn-default home-btn" type="button"><i class="fa fa-map-marker"></i></button>
                      </span>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 --><br><br>
				<div class="col-xs-12">
                    <div class="input-group">
                      <span id="subcagtegory"><select class="form-control" name="area" required>
						<option value="">Select Area</option>
						 </select></span>
                      <span class="input-group-btn">
                        <button class="btn btn-default home-btn" type="button"><i class="fa fa-map-marker"></i></button>
                      </span>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 --><br><br>
				<div class="col-xs-12">
					<button type="submit" class="btn btn-default col-xs-12"><i class="fa fa-map-marker"></i> Find Now</button>
                </div><!-- /.col-lg-6 -->
            </div>
            
            </form>
        </article>
    </section>

    <section>
        <article>
            <footer>Copyrights @ Msk Netpix Pvt Ltd</footer>
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
  <script>
function subcategories(s)
{//alert(s);
 $.ajax({
  type:"get",
  dataType:"text",
  url:"sub.php",
  data:  "val="+s,
  success: function(response){
	  $('#subcagtegory').html(response);
  }
 });
}
</script>  
</body>
</html>