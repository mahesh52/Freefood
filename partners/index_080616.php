<?php ob_start();
include '../config.php';
$date=date('Y-m-d');extract($_POST);
if(isset($_POST) && $_POST['mobile']!='')
{
mysql_query("INSERT INTO `partners` (`name` ,`email` ,`mobile` ,`role` ,`state` ,`city` ,`area` ,`address` ,`message` ,`date`) VALUES ('$name',  '$email',  '$mobile',  '$role', '$state', '$city',  '$area',  '$address',  '$message',  '$date')");
if(mysql_affected_rows()>0)
{
	
	$msg="Registered Successfully";	

}
else
{
	$msg="Sorry Email Id/ Mobile Number Existed";
}
	
}?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Developed Catchway Web Solutions">
    <meta name="author" content="Free Food">
    <meta name="keywords" content="Free Food">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>
      FreeFood
    </title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/theme.css" rel="stylesheet">
    <link href="../css/bootstrap-reset.css" rel="stylesheet">
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet">-->

    <!--external css-->
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/flexslider.css"/>
    <link href="../assets/bxslider/jquery.bxslider.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../assets/owlcarousel/owl.carousel.css">
    <link rel="stylesheet" href="../assets/owlcarousel/owl.theme.css">

    <link href="../css/superfish.css" rel="stylesheet" media="screen">
    <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'> -->


    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="../css/component.css">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/style-responsive.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="../css/parallax-slider/parallax-slider.css" />
    <script type="text/javascript" src="../js/parallax-slider/modernizr.custom.28468.js">
    </script>
<script>
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "This field accepts numbers only."
        return false
    }
    status = ""
    return true
}
</script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js">
    </script>
    <script src="js/respond.min.js">
    </script>
    <![endif]-->
  </head>

  <body id="home">
    <!--header start-->
    <header class="head-section">
      <div class="navbar navbar-default navbar-static-top container">
          <div class="navbar-header">
              <button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse" type="button">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="../index.html"><img src="../img/logo.png" width="150" class="img-responsive"></a>
          </div>
          <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                 
                  <li><a href="../index.html">Home</a> </li>
                  <li><a href="../index.html#services">Services</a> </li>
                  <li><a href="index.php">Partners</a> </li>
                  <li><a href="../index.html#contact">Contact</a> </li>
              </ul>
          </div>
      </div>
    </header>
    <!--header end-->



    <!--property start-->
    <div class="property gray-bg" id="services" style="padding: 0px 0; margin-bottom:0px;">
      <div class="">
        <div class="row">
          <div class="col-md-6 text-center wow fadeInLeft" style="padding-bottom:6px; border-right: 1px dashed #E2E2E2;" align="center">
			<img src="email.jpg" class="img-responsive" alt=""/>

          </div>
          <div class="col-md-6">
          <div class="col-sm-12 table-responsive">
				<h1>
				  PARTNER WITH US
				</h1><hr>
				<b>In the process of establishing our concept, in each CITY/TOWN, we are appointing the following </b><br><br><br><br>
				
				<div class="clearfix"></div>
				<table border="1" cellspacing="0" cellpadding="0" class="table">
				  <tr style="background: #059ED6; color: white;">
					<td> <strong>S.NO.</strong> </td>
					<td> <strong>NAME</strong> </td>
					<td> <strong>INVESTMENT</strong> </td>
					<td> <strong>CATEGORY</strong> </td>
					<td> <strong>TASK</strong> </td>
					<td> <strong>COMMENTS</strong> </td>
				  </tr>
				  <tr>
					<td> 1 </td>
					<td>   
					   REGULAR FOOD VENDORS (RFV) </td>
					<td  >   
					   Kitchen    Set Up + (1,00,000 Deposit) </td>
					<td>   
					   Vendor </td>
					<td>   
					   Preparing    Food Items </td>
					<td>   
					   Prepare    food and we take care of Sales &amp; Marketing. We give you a guaranteed    sale, EVERY MONTH </td>
				  </tr>
				  <tr>
					<td> 2 </td>
					<td>   
					   TOWN    PARTNERS (TP) </td>
					<td  >   
					   10,30,000 </td>
					<td>   
					   Partner </td>
					<td>   
					   Managing    5 Cluster Partners </td>
					<td>   
					   Appoint    and manage Cluster Partners with the help of Company. Rest all we take care </td>
				  </tr>
				  <tr>
					<td> 3 </td>
					<td>   
					   CLUSTER PARTNERS    (CLP) </td>
					<td  >   
					   2,20,000 </td>
					<td>   
					   Partner </td>
					<td>   
					   Delivering    Items within Cluster </td>
					<td>   
					   Deliver    the items ON TIME. Company will take care of Marketing &amp; Sales and ORDERS </td>
				  </tr>
				</table>
			</div>
          <form name="form1" method="post" action="index.php">
          
          <div class="col-md-12 wow fadeInRight">
           <p align="center" style="color:#F00"><?php echo $msg;?></p>
            <hr>
			<div class="clearfix"></div>
			<div class="col-sm-6">
				<input type="text" placeholder="Full Name" class="form-control" name="name" required><br>
				<input type="email" placeholder="Email" class="form-control" name="email" required><br>
				<input type="text" placeholder="Mobile" class="form-control" name="mobile" required onkeypress="return checkIt(event)"><br>
                <input type="text" placeholder="Address" name="address" class="form-control"><br>
			</div>
			<div class="col-sm-6">
				<select class="form-control" name="role" required>
					<option value="">Select Role</option>
					<option>Regular Food Vendors</option>
					<option>Town Partners</option>
					<option>Cluster Partners</option>
				</select><br>
				<select class="form-control" name="state" required onChange="return cityval(this.value);">
                      <option value="">Select State</option>
						<?php 
			  $qry=mysql_query("select * from state order by name asc") or die('error');
			  while($row=mysql_fetch_assoc($qry))
			  {
				echo "<option value='$row[guid]'>$row[name]</option>";  
			  }?>
			  </select>
				</select><br>
               <span id="city"> <select class="form-control" name="city" required onChange="return areaval(this.value);">
                      <option value="">Select City</option>
						</select>
				</select></span>
                <br><span id="area">
                <select class="form-control" name="area" required>
                      <option value="">Select Area</option>
				</select>
				</select></span><br>
				
			</div>
			<div class="clearfix"></div>
			<div class="col-sm-12">
				<textarea placeholder="Enter your message" name="message" class="form-control" rows="4"></textarea><br>
				<button type="submit" name="submit" value="Submit" class="btn btn-success">Join as Partner</button><br><br>
			</div>
				
            <hr>
			
          <div class="col-md-12">
			<h3 align="center">
			  DOWNLOAD APP FROM<br><br>
			</h3>
			<div class="col-md-4">
				<img src="../img/w-icon.png" class="img-responsive">
			</div>
			<div class="col-md-4">
				<img src="../img/a-icon.png" class="img-responsive">
			</div>
			<div class="col-md-4">
				<img src="../img/an-icon.png" class="img-responsive">
			</div>
			<div class="clearfix"></div><br><br>
          </div>
          </div>
          </form>
        </div>
        
      </div>
    </div>
        <!--property end-->


	<div class="clearfix"></div>


    <!--container end-->

	
    <!--small footer start -->
    <footer class="footer-small">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-6 pull-right">
                    <ul class="social-link-footer list-unstyled">
                        <li class="wow flipInX" data-wow-duration="2s" data-wow-delay=".1s"><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li class="wow flipInX" data-wow-duration="2s" data-wow-delay=".2s"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li class="wow flipInX" data-wow-duration="2s" data-wow-delay=".4s"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li class="wow flipInX" data-wow-duration="2s" data-wow-delay=".5s"><a href="#"><i class="fa fa-twitter"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                  <div class="copyright">
                    <p>&copy; Copyright - FreeFood @ 2016. 
                  </div>
                </div>
            </div>
        </div>
    </footer>
    <!--small footer end-->

    <!-- js placed at the end of the document so the pages load faster
<script src="js/jquery.js">
</script>
-->
    <script src="../js/jquery-1.8.3.min.js">
    </script>
    <script src="../js/bootstrap.min.js">
    </script>
    <script type="text/javascript" src="../js/hover-dropdown.js">
    </script>
    <script defer src="../js/jquery.flexslider.js">
    </script>
    <script type="text/javascript" src="../assets/bxslider/jquery.bxslider.js">
    </script>

    <script type="text/javascript" src="js/jquery.parallax-1.1.3.js">
    </script>
    <script src="js/wow.min.js">
    </script>
    <script src="assets/owlcarousel/owl.carousel.js">
    </script>

    <script src="js/jquery.easing.min.js">
    </script>
    <script src="js/link-hover.js">
    </script>
    <script src="js/superfish.js">
    </script>
    <script type="text/javascript" src="js/parallax-slider/jquery.cslider.js">
    </script>
    <script type="text/javascript">
      $(function() {

        $('#da-slider').cslider({
          autoplay    : true,
          bgincrement : 100
        });

      });
    </script>



    <!--common script for all pages-->
    <script src="js/common-scripts.js">
    </script>

    <script type="text/javascript">
      jQuery(document).ready(function() {


        $('.bxslider1').bxSlider({
          minSlides: 5,
          maxSlides: 6,
          slideWidth: 360,
          slideMargin: 2,
          moveSlides: 1,
          responsive: true,
          nextSelector: '#slider-next',
          prevSelector: '#slider-prev',
          nextText: 'Onward →',
          prevText: '← Go back'
        });

      });


    </script>


    <script>
      $('a.info').tooltip();

      $(window).load(function() {
        $('.flexslider').flexslider({
          animation: "slide",
          start: function(slider) {
            $('body').removeClass('loading');
          }
        });
      });

      $(document).ready(function() {

        $("#owl-demo").owlCarousel({

          items : 4

        });

      });

      jQuery(document).ready(function(){
        jQuery('ul.superfish').superfish();
      });

      new WOW().init();


    </script>
    <script>
function cityval(s)
{//alert(s);
 $.ajax({
  type:"get",
  dataType:"text",
  url:"city.php",
  data:  "val="+s,
  success: function(response){
	  $('#city').html(response);
  }
 });
}
function areaval(s)
{//alert(s);
 $.ajax({
  type:"get",
  dataType:"text",
  url:"area.php",
  data:  "val="+s,
  success: function(response){
	  $('#area').html(response);
  }
 });
}
</script>
  </body>
</html>