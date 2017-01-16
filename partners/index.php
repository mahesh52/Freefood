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
	<style>
.modal-header{ border-bottom: 0px !important;}
.margin-bottom-10px{ margin-bottom:10px; width:100%;}
.margin-bottom-15px{ margin-bottom:15px; margin-top:15px;  width:100%;}
.table-alternate-background tr:nth-child(even){ background:#DBF5FB; }
.table-alternate-background tr:nth-child(odd){ background:#fff;}

.table-alternate-background tr td:nth-child(1){ font-weight:bold !important; font-size:12px; text-transform:uppercase;}


.table-alternate-background tr th { background:#4F81BD; color:#fff; text-align:center; }
.table-alternate-background td { vertical-align:middle !important; font-size:13px;}
.table-alternate-background th { vertical-align:middle !important;  }
 
ul.spllist{    background: #10A6F4 none repeat scroll 0 0;
    color: #fff;
    margin-bottom: 5px;
    margin-right: 0;
    margin-top: -16px;
    padding: 10px 42px;
}
ul.spllist li{  line-height:24px; font-size:14px; font-weight:bold;  letter-spacing:0;}
.input-group{ font-size:12px !important;}
.table-alternate-background{ max-width:800px !important; margin-left:auto; margin-right:auto;  }
 
 </style>
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
              <a class="navbar-brand" href="../index.html"><img src="../img/logo.png" width="130" class="img-responsive"></a>
          </div>
          <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                 
                  <li><a href="../index.html">Home</a> </li>
                  <li><a href="../index.html#about">About Us</a> </li>
                  <li><a href="index.php">Partner With Us</a> </li>
                  <li><a href="../index.html#contact">Contact</a> </li>
              </ul>
          </div>
      </div>
    </header>
    <!--header end-->

<div class="col-lg-12  col-md-12">
 <section class="content">

<div style="text-align:center; margin-left:auto; margin-right:auto"><img src="../img/diagram.jpg"  width="100%" border="0" usemap="#Map" style="max-width:850px; height:auto" >
<map name="Map">
  <area shape="rect" coords="10,198,183,254" href="#tp">
<area shape="rect" coords="12,289,182,343" href="#clp">
<area shape="rect" coords="209,193,414,252" href="#rfv">
<area shape="rect" coords="453,287,660,343" href="#sev">
<area shape="rect" coords="688,281,893,340" href="#hmv">
</map></div>
				 <!-- top row -->
				<div class="table-responsive">
                   <table class="table table-bordered table-alternate-background"  >

                    	<thead>

                          <tr>

                        	

                            <th width="28%">Partner Name</th>
                            <th width="34%">Tasks</th>
                           <th width="18%">Investment (&#8377) </th>
                           <th width="20%">Monthly Earnings (Approximately)</th>
                           
                            
                           
                          </tr>

                        </thead>

                        <tbody>

                         
                        	<tr> 
								<td>Town Partner(TP)</td>
								 <td>1. Appoint & Manage CLPs<br> 2. Make sure CLP delivers every order</td>
								 <td>4,40,000</td>
								 <td>2,00,000</td>
                          </tr>
							 <tr> 
								<td>REGULAR FOOD VENDOR (RFV)
</td>
								 <td>1. Prepare food as per the orders generated<br>
2. Maintain Quality Standards
</td>
								 <td>1,10,000 (Or) 10,000</td>
								 <td>1,50,000</td>
                             </tr>
									 <tr> 
								<td>Cluster Partner (CLP)</td>
								 <td>1. Deliver Items On TIME<br>2. Be Professional</td>
								 <td>2,20,000</td>
								 <td>80,000</td>
                             </tr>
							 <tr> 
								<td>Self Employed Vendor (SEV)</td>
								 <td>1. Prepare food as per the orders generated<br> 2. Maintain Quality Standards</td>
								 <td>1,00,000 </td>
								 <td>25,000 </td>
                             </tr>
							 <tr> 
								<td>Home Maker Vendor (HMV)</td>
								 <td>1. Prepare food as per the orders generated<br>2. Maintain Quality Standards</td>
								 <td>5,000</td>
								 <td>5,000</td>
                             </tr>

                          
                        	 
                          
                        	 

                          
                        </tbody>

                        

                  </table><br>
<br>

	</div>
					<table class="table table-responsive table-bordered table-alternate-background" id="tp">

                    	<thead>

                          <tr>

                        	

                            <th  colspan="2">TOWN PARTNER(TP) BUSINESS OPPORTUNITY DETAILS</th>
 
                           
                            
                           
                          </tr>

                        </thead>

                        <tbody>

                         
                        	 
							 <tr> 
								<td width="26%">Highlights</td>
								 <td width="74%">1. No Sales Target<br>

2. Small Office Set Up Needed (Or) Can be operated from Home
</td>
								 
                             </tr>
							 <tr> 
								<td>Compamy Support</td>
								<td>1. Marketing & Sales By Company<br>2. Software Support<br>3. Call Center Support</td>
								 
                             </tr>
							 
							 							 <tr> 
								<td>Investment
</td>
								<td>INR (&#8377) 4,40,000
</td>
								 
                             </tr>
							 
							 
							 							 <tr> 
								<td>Earnings
</td>
								<td>INR (&#8377) 2,00,000 Per Month (Tentative Projections)

</td>
								 
                             </tr>
                          
                        	 
                          
       		 
							 							 <tr> 
								<td>Tasks
</td>
								<td>1. Appoint & Train CLPs<br>

2. Make sure all 5 CLPs are Active & Delivering Orders On Time<br>

3. Work as CLP (During Emergency)


</td>
								 
                             </tr> 
							 
							 
			  <tr> 
								<td>Break Time </td>
								<td>Around 6 to 8 Months</td>
								 
                          </tr>                 	 

                          
                        </tbody>

                        

                    </table><br>
<br>

					<table class="table table-responsive table-bordered table-alternate-background" id="clp">

                    	<thead>

                          <tr>

                        	

                            <th  colspan="2">CLUSTER PARTNER(CLP) BUSINESS OPPORTUNITY DETAILS</th>

 
                           
                            
                           
                          </tr>

                        </thead>

                        <tbody>

                         
                        	 
							 <tr> 
								<td width="26%">Highlights</td>
								 <td width="74%">1. No Sales Target<br>

2. Small Office Set Up Needed (Or) Can be operated from Home

</td>
								 
                             </tr>
							 <tr> 
								<td>Compamy Support</td>
								<td>1. Marketing  & Sales By Company<br>

2. Software Support<br>

3. Call Center Support
</td>
								 
                             </tr>
							 
							 							 <tr> 
								<td>Investment
</td>
								<td>INR(&#8377)  2,20,000
</td>
								 
                             </tr>
							 
							 
							 							 <tr> 
								<td>Earnings
</td>
								<td>INR(&#8377) 80,000 Per Month (Tentative Projections)


</td>
								 
                             </tr>
                          
                        	 
                          
       		 
							 							 <tr> 
								<td>Tasks
</td>
								<td>1. Deliver Food/Items On Time<br>

2. Be Professional



</td>
								 
                             </tr> 
							 
							 
			  <tr> 
								<td>Break Time </td>
								<td>Around 4 to 6 Months
</td>
								 
                          </tr>                 	 

                          
                        </tbody>

                        

                    </table><br>
<br>

					<table class="table table-responsive table-bordered table-alternate-background" id="rfv">

                    	<thead>

                          <tr>

                        	

                            <th  colspan="2">REGULAR FOOD VENDOR(RFV) BUSINESS OPPORTUNITY DETAILS</th>


 
                           
                            
                           
                          </tr>

                        </thead>

                        <tbody>

                         
                        	 
							 <tr> 
								<td width="26%">Highlights</td>
								 <td width="74%">1. No Sales Target<br>

2. Can be operated from Home


</td>
								 
                             </tr>
							 <tr> 
								<td>Compamy Support</td>
								<td>1. Assured Business of &#8377 25,00,000 Per Month from Company (T&C Apply)<br>

2. Software Support<br>

3. Call Center Support

</td>
								 
                             </tr>
							 
							 							 <tr> 
								<td>Investment
</td>
								<td>1. Kitchen Set Up<br>

2. INR(&#8377) 1,10,000 / 10,000

</td>
								 
                             </tr>
							 
							 
							 							 <tr> 
								<td>Earnings
</td>
								<td>INR(&#8377) 1,50,000 Per Month (Tentative Projections)



</td>
								 
                             </tr>
                          
                        	 
                          
       		 
							 							 <tr> 
								<td>Tasks
</td>
								<td>1. Prepare Food On Time<br> 2. Maintain Quality Standards



</td>
								 
                             </tr> 
							 
							 
			  <tr> 
								<td>Break Time </td>
								<td>Around 2 to 4 Months </td>
								 
                          </tr>                 	 

                          
                        </tbody>

                        

                    </table>
					<table class="table table-responsive table-bordered table-alternate-background" id="sev">

                    	<thead>

                          <tr>

                        	

                            <th  colspan="2">SELF EMPLOYED VENDOR(SEV) BUSINESS OPPORTUNITY DETAILS</th>


 
                           
                            
                           
                          </tr>

                        </thead>

                        <tbody>

                         
                        	 
							 <tr> 
								<td>Highlights</td>
								 <td>1. No Sales Target<br>

2. Can be operated from Home

</td>
								 
                             </tr>
							 <tr> 
								<td width="26%">Compamy Support</td>
								<td width="74%">1. Assured Business From Company (Exclusive Area Rights)<br>

2. Software Support<br>

3. Call Center Support


</td>
								 
                             </tr>
							 
							 							 <tr> 
								<td>Investment
</td>
								<td>Small Kitchen Set Up (Around INR(&#8377) 1,00,000)


</td>
								 
                             </tr>
							 
							 
							 							 <tr> 
								<td>Earnings
</td>
								<td>INR(&#8377)  25,000 Per Month (Tentative Projections)



</td>
								 
                             </tr>
                          
                        	 
                          
       		 
							 							 <tr> 
								<td>Tasks
</td>
								<td>1. Prepare Food On Time<br>

2. Maintain Quality Standards




</td>
								 
                             </tr> 
							 
							 
			  <tr> 
								<td>Break Time </td>
								<td>Around 2 to 4 Months
</td>
								 
                          </tr>                 	 

                          
                        </tbody>

                        

                    </table><br>
<br>
<table class="table table-responsive table-bordered table-alternate-background" id="hmv">

                    	<thead>

                          <tr>

                        	

                            <th  colspan="2">HOME MAKER VENDOR(HMV) BUSINESS OPPORTUNITY DETAILS
</th>


 
                           
                            
                           
                          </tr>

                        </thead>

                        <tbody>

                         
                        	 
							 <tr> 
								<td>Highlights</td>
								 <td>1. No Sales Target<br>
2. Can be operated from Home


</td>
								 
                             </tr>
							 <tr> 
								<td width="26%">Compamy Support</td>
								<td width="74%">1. Assured Business From Company (Exclusive Area Rights)<br>

2. Software Support<br>

3. Call Center Support



</td>
								 
                             </tr>
							 
							 							 <tr> 
								<td>Investment
</td>
								<td>INR(&#8377) 5,000
 


</td>
								 
                             </tr>
							 
							 
							 							 <tr> 
								<td>Earnings
</td>
								<td> 
								INR(&#8377) 25,000 Per Month (Tentative Projections)




</td>
								 
                             </tr>
                          
                        	 
                          
       		 
							 							 <tr> 
								<td>Tasks
</td>
								<td>1. Prepare Food On Time as per the Orders generated<br>

2. Maintain Quality Standards





</td>
								 
                             </tr> 
							 
							 
			  <tr> 
								<td>Break Time </td>
								<td>Around 1 Month

</td>
								 
                          </tr>                 	 

                          
                        </tbody>

                        

    </table>
      </section>
					</div>

    <!--property start-->
    <div class="property gray-bg" id="services" style="padding: 0px 0; margin-bottom:0px;">
      <div class="">
        <div >
          <div class="col-md-6 text-center wow fadeInLeft" style="padding-bottom:6px; border-right: 1px dashed #E2E2E2;" align="center">
			<img src="email.jpg" class="img-responsive" alt=""/>

          </div>
          <div class="col-md-6">
          <form name="form1" method="post" action="index.php">
          <h1>
              CHOOSE HOW YOU WANT TO WORK WITH US
            </h1>
          <div class="col-md-12 wow fadeInRight">
           <p align="center" style="color:#F00"><?php echo $msg;?></p>
            <hr>
			<div class="clearfix"></div>
			<div class="col-sm-6">
				<input type="text" placeholder="Full Name" class="form-control" name="name" required><br>
				<input type="email" placeholder="Email" class="form-control" name="email" required><br>
				<input type="text" placeholder="Mobile" class="form-control" name="mobile" required onKeyPress="return checkIt(event)"><br>
                <input type="text" placeholder="Address" name="address" class="form-control"><br>
			</div>
			<div class="col-sm-6">
				<select class="form-control" name="role" required>
					<option value="">Partner Type</option>
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
				<br>
               <span id="city"> <select class="form-control" name="city" required onChange="return areaval(this.value);">
                      <option value="">Select City</option>
						</select>
				</select></span>
                <br><!-- span id="area">
                <select class="form-control" name="area" required>
                      <option value="">Select Area</option>
				</select>
				</span--><br>
				
			</div>
			<div class="clearfix"></div>
			<div class="col-sm-12">
				<textarea placeholder="Enter your message" name="message" class="form-control" rows="4"></textarea><br>
				<button type="submit" name="submit" value="Submit" class="btn btn-success">Apply</button><br><br>
			</div>
				
            <hr>
			
          <!--div class="col-md-12">
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
          </div-->
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
                <div class="col-lg-5 col-sm-5 pull-right">
                    <ul class="social-link-footer list-unstyled">
                        <li class="wow flipInX" data-wow-duration="2s" data-wow-delay=".1s"><a href="https://www.facebook.com/Freefoodindia" target="blank"><i class="fa fa-facebook"></i></a></li>
                        <li class="wow flipInX" data-wow-duration="2s" data-wow-delay=".2s"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li class="wow flipInX" data-wow-duration="2s" data-wow-delay=".4s"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li class="wow flipInX" data-wow-duration="2s" data-wow-delay=".5s"><a href="https://twitter.com/freefoodindia" target="blank"><i class="fa fa-twitter"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-7">
                  <div class="copyright">
                    <p>&copy; Copyright - FreeFood @ 2016. Powered by “MSK NETPIX PRIVATE LIMITED” | <a href="" style="color:white;">Site Map</a> | <a href="../privacy.html" style="color:white;">Privacy Policy</a></p>
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