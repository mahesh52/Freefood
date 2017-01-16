<!DOCTYPE html>
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
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
 <script src="http://ajax.microsoft.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>
 
<script>jQuery(function ($) {
    $('#form2').validate({
        rules: {
            fullname: {
                required: true,
                minlength: 4,
                lettersonly: true
            },
			  mobile: {
                required: true,
                minlength: 10,
                maxlength: 10,
                digits: true
            },
			 email: {
                required: true,
                minlength: 6,
                email: true
            },
            address: {
                required: true,
				maxlength: 150                
            },
			
            app_true: {
                required: true
            },
			
			weeklyorder: {
                required: true
            }
           
           
        },
        messages: {
            fullname: {
                required: "Please enter Full Name",
                minlength: "Full Name should be more than 4 characters",
                lettersonly: "Name should contain only letters"
            },
		 
		 mobile: {
                required: "Please enter your Mobile Number",
                minlength: "Mobile number should be equal to  10 characters",
                maxlength: "Mobile number should be equal to  10 characters",
                digits: "Mobile number should contain only digits"
            },
	email: {
                required: "Please enter your email address",
                 email: "Please enter a valid email address"
            },
			
            address: {
                required: "Please enter your Address",
              
              
            },
            app_true: {
                required: "Please select your App Download",
            },

            weeklyorder: {
                required: "Please Select Weekly Orders range"
              
            }

        },
    });
});</script>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet">-->

    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/flexslider.css"/>
    <link href="assets/bxslider/jquery.bxslider.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="assets/owlcarousel/owl.carousel.css">
    <link rel="stylesheet" href="assets/owlcarousel/owl.theme.css">

    <link href="css/superfish.css" rel="stylesheet" media="screen">
    <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'> -->


    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="css/component.css">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="css/parallax-slider/parallax-slider.css" />
	
<style>
.error{ color:red !important;  }
label.eror{ color:red !important; }
#myModal2 .input-group { z-index:33333333 !important;}#myModal2 .input-group input{color:#000 !important;}
.modal-header{ border-bottom: 0px !important;}
.margin-bottom-10px{ margin-bottom:10px; width:100%;}
.margin-bottom-15px{ margin-bottom:15px; margin-top:15px;  width:100%;}
.table-alternate-background tr:nth-child(even){ background:#DBF5FB; }
.table-alternate-background tr:nth-child(odd){ background:#fff;}

.table-alternate-background tr td:nth-child(1){ font-weight:bold !important; font-size:12px; text-transform:uppercase;}


.table-alternate-background tr th { background:#4F81BD; color:#fff; text-align:center; }
.table-alternate-background td { vertical-align:middle !important; font-size:12px;}
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
  <!-- SlidesJS Optional: If you'd like to use this design -->
  <style>

    #slides {
      display: none
    }

    #slides .slidesjs-navigation {
      margin-top:5px;
    }

    a.slidesjs-next,
    a.slidesjs-previous,
    a.slidesjs-play,
    a.slidesjs-stop {
      background-image: url(img/btns-next-prev.png);
      background-repeat: no-repeat;
      display:block;
      width:12px;
      height:18px;
      overflow: hidden;
      text-indent: -9999px;
      float: left;
      margin-right:5px;
    }

    a.slidesjs-next {
      margin-right:10px;
      background-position: -12px 0;
    }

    a:hover.slidesjs-next {
      background-position: -12px -18px;
    }

    a.slidesjs-previous {
      background-position: 0 0;
    }

    a:hover.slidesjs-previous {
      background-position: 0 -18px;
    }

    a.slidesjs-play {
      width:15px;
      background-position: -25px 0;
    }

    a:hover.slidesjs-play {
      background-position: -25px -18px;
    }

    a.slidesjs-stop {
      width:18px;
      background-position: -41px 0;
    }

    a:hover.slidesjs-stop {
      background-position: -41px -18px;
    }

    .slidesjs-pagination {
      margin: 7px 0 0;
      float: right;
      list-style: none;
    }

    .slidesjs-pagination li {
      float: left;
      margin: 0 1px;
    }

    .slidesjs-pagination li a {
      display: block;
      width: 13px;
      height: 0;
      padding-top: 13px;
      background-image: url(img/pagination.png);
      background-position: 0 0;
      float: left;
      overflow: hidden;
    }

    .slidesjs-pagination li a.active,
    .slidesjs-pagination li a:hover.active {
      background-position: 0 -13px
    }

    .slidesjs-pagination li a:hover {
      background-position: 0 -26px
    }

    #slides a:link,
    #slides a:visited {
      color: #333
    }

    #slides a:hover,
    #slides a:active {
      color: #9e2020
    }

    .navbar {
      overflow: hidden
    }
	#slides {
      display: none
    }

    .container {
      margin: 0 auto
    }

    /* For tablets & smart phones */
    @media (max-width: 767px) {
      body {
        padding-left: 20px;
        padding-right: 20px;
      }
      .container {
        width: auto
      }
    }

    /* For smartphones */
    @media (max-width: 480px) {
      .container {
        width: auto
      }
    }

    /* For smaller displays like laptops */
    @media (min-width: 768px) and (max-width: 979px) {
      .container {
        width: 724px
      }
    }

    /* For larger displays */
    @media (min-width: 1200px) {
      .container {
        width: 1170px
      }
    }
	.no-padd{
		padding-right:0px;
		padding-left:0px;
	}
  </style>
	
    <script type="text/javascript" src="js/parallax-slider/modernizr.custom.28468.js">
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
              <a class="navbar-brand" href="index.html"><img src="img/logo.png" width="130" class="img-responsive"></a>
          </div>
          <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                 
                  <li><a href="#home">Home</a> </li>
                  <li><a href="#about">About Us</a> </li>
                  <li><a href="partners/index.php">Partner With Us</a> </li>
                  <li><a href="#contact">Contact</a> </li>
              </ul>
          </div>
      </div>
    </header>
    <!--header end-->

    <!-- Sequence Modern Slider -->
    <div id="slides" class="gray-bg">
      <div class="col-sm-12 no-padd">
		<img src="img/example-slide-1.jpg" alt="Photo by: Missy S Link: http://www.flickr.com/photos/listenmissy/5087404401/" style="width:100%;">
		
		<div style="position:absolute; top:100px; left:100px; z-index:99999" class="col-sm-6">
			  <img src="img/caption.png" class="img-responsive" width="400">
			  <h3 style="color:white; font-size:40px; font-weight:bold; text-shadow:1px 1px 10px #333;">
				<i>STILL WONDERING </i>
				<br>
				<i>HOW WE GIVE FOOD</i>
				<br>
				<i>FOR FREE???</i>
			  </h3>
			  <p style="color:white; font-size:16px; font-weight:bold; text-shadow:1px 1px 10px #333;">
				<i>Just download our app & check yourself</i>
			  </p>
		</div>
	  </div>
      <div class="col-sm-12 no-padd">
		<img src="img/example-slide-2.jpg" alt="Photo by: Missy S Link: http://www.flickr.com/photos/listenmissy/5087404401/" style="width:100%;">
		
		<div style="position:absolute; top:100px; left:100px; z-index:99999" class="col-sm-6">
			  <img src="img/caption.png" class="img-responsive" width="400">
			  <h3 style="color:white; font-size:40px; font-weight:bold; text-shadow:1px 1px 10px #333;">
				<i>WE SERVE REGULAR FOOD + </i>
				<br>
				<i>WE CREATE NEW FOOD ITEMS</i>
			  </h3>
			  <p style="color:white; font-size:16px; font-weight:bold; text-shadow:1px 1px 10px #333;">
				<i>Popcorns, Munching, Organic Food</i>
				<br />
				<i>Home Made Food & Many More Coming Soon </i>
			  </p>
		</div>
	  </div>
      <div class="col-sm-12 no-padd">
		<img src="img/example-slide-3.jpg" alt="Photo by: Missy S Link: http://www.flickr.com/photos/listenmissy/5087404401/" style="width:100%;">
		
		<div style="position:absolute; top:100px; left:100px; z-index:99999" class="col-sm-6">
			  <img src="img/caption.png" class="img-responsive" width="400">
			  <h3 style="color:white; font-size:40px; font-weight:bold; text-shadow:1px 1px 10px #333;">
				<i>NO MORE OFFERS / CASHBACKS / DISCOUNTS NEEDED</i>
			  </h3>
			  <p style="color:white; font-size:16px; font-weight:bold; text-shadow:1px 1px 10px #333;">
				<i>As we are giving for FREE….!!!!</i>
			  </p>
		</div>
	  </div>
      <div class="col-sm-12 no-padd">
		<img src="img/example-slide-4.jpg" alt="Photo by: Missy S Link: http://www.flickr.com/photos/listenmissy/5087404401/" style="width:100%;">
		
		<div style="position:absolute; top:100px; left:100px; z-index:99999" class="col-sm-6">
			  <img src="img/caption.png" class="img-responsive" width="400">
			  <h3 style="color:white; font-size:40px; font-weight:bold; text-shadow:1px 1px 10px #333;">
				<i>WEEKLY MENU UPDATES</i>
			  </h3>
			  <p style="color:white; font-size:16px; font-weight:bold; text-shadow:1px 1px 10px #333;">
				<i>Our continuous efforts will never feel you bored of same tastes</i>
			  </p>
		</div>
	  </div>
      <div class="col-sm-12 no-padd">
		<img src="img/example-slide-5.jpg" alt="Photo by: Missy S Link: http://www.flickr.com/photos/listenmissy/5087404401/" style="width:100%;">
		
		<div style="position:absolute; top:100px; left:100px; z-index:99999" class="col-sm-6">
			  <img src="img/caption.png" class="img-responsive" width="400">
			  <h3 style="color:white; font-size:40px; font-weight:bold; text-shadow:1px 1px 10px #333;">
				<i>HURRY UP – LIMITED ORDERS PER DAY</i>
			  </h3>
			  <p style="color:white; font-size:16px; font-weight:bold; text-shadow:1px 1px 10px #333;">
				<i>Available only for First Come First Serve Basis. You know, ITS FREE FOOD</i>
			  </p>
		</div>
	  </div>
    </div>


    <!--property start-->
    <div class="property gray-bg" id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-sm-6 text-center wow fadeInLeft">
            <br><br><img src="img/about2.jpg" class="img-responsive" alt="...">
          </div>
          <div class="col-lg-6 col-sm-6 wow fadeInRight">
            <h1>
              About Us
            </h1>
            <hr>
            <p>
              <i class="fa fa-check fa-lg pr-10">
              </i>
              “Free Food” is an Innovative Concept, which is first of its kind where “WE GIVE FOOD FOR FREE”. Ya….You read it right!!! WE GIVE FOOD FOR FREE. To understand this, please check our SIMPLE THREE STEP PROCESS (on the left). Very soon, we are launching our innovative App in your area"
            </p>
            <hr>
			
          <!--div class="col-md-12">
			<h3 align="center">
			  <br><br>DOWNLOAD APP FROM<br><br>
			</h3>
			<div class="col-md-4">
				<img src="img/w-icon.png" class="img-responsive">
			</div>
			<div class="col-md-4">
				<img src="img/a-icon.png" class="img-responsive">
			</div>
			<div class="col-md-4">
				<img src="img/an-icon.png" class="img-responsive">
			</div>
			<div class="clearfix"></div><br><br>
          </div-->
          </div>
        </div>
      </div>
    </div>
    <!--property end-->



    

    <div id="contact"><form name="form2"  id="form2"  action="" method="post" >
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" role="document">
    <div class="modal-content" >
    <!--   <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>-->
      <div class="modal-body"  >
       
	   
	   <!-- html stracture  started -->
	      <div class="row"  style="margin-bottom:15px;" >
		  	<div class="col-lg-12 col-md-12 col-sm-12" ><img src="img/banner.jpg" alt="" width="100%" height="auto"></div>
		  </div>
		  
		  
	   <div class="row"  >
	   		<div class="col-lg-6 col-md-6 col-sm-12  col-xs-12"><div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
<!--  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>-->

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="img/1.jpg" alt="..." width="100%">
      <div class="carousel-caption">
        ...      </div>
    </div>
    <div class="item">
   <img src="img/2.jpg" width="100%">
      <div class="carousel-caption">
        ...      </div>
    </div>
	
	
    <div class="item">
   <img src="img/3.jpg" width="100%">
      <div class="carousel-caption">
        ...      </div>
    </div>
	
	    <div class="item">
   <img src="img/4.jpg" width="100%">
      <div class="carousel-caption">
        ...      </div>
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>  </a>
</div></div>
			<div class="col-lg-6 col-md-6 col-sm-12  col-xs-12"><iframe width="100%" height="170" src="https://www.youtube.com/embed/uRHGVX_sKTs" frameborder="0" allowfullscreen></iframe></div>
	   </div>
	   
	   
	     
	   
	   
	   <!-- hmtl stracture closed -->
      </div>
      <div class="modal-footer">
       <div class="row"  >
		  	<div style="text-align:center; font-size:16px; font-weight:normal;">
			Know more about <strong>FREE FOOD</strong> ?&nbsp;&nbsp; <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal2" data-dismiss='modal'>Click here</a><br>
 </div>
	    </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal 2-->
<div class="modal fade" id="myModal2" tabindex="-2" role="dialog" aria-labelledby="myModalLabel"   data-keyboard="false" data-backdrop="static" >

 
  <div class="modal-dialog" role="document">
    <div class="modal-content" >
      
      <div class="modal-body"  ><br>

       <?php
include('config.php');
if(isset($_POST['submit2'])) 
{

$fullname=$_POST['fullname'];
		$email=$_POST['email'];
		$mobile=$_POST['mobile'];
		$address=$_POST['address'];
		$app_true=$_POST['app_true'];
			$weeklyorder=$_POST['weeklyorder'];
		 

$sql2="insert into survey values('','$fullname','$email','$mobile','$address','$app_true','$weeklyorder',now())";
if($sql=mysql_query($sql2))
{
echo "<script language='javascript'>window.location='http://freefood.co.in/partners/index.php';</script>";

}		
else
{ 
	echo "<h3><span style='color:red'>Error</span></h3>";
 
}

}

 ?>
	   
	   <!-- html stracture  started -->
	      <div class="row"  style="margin-bottom:15px;" >
		  	<div class="col-lg-12 col-md-12 col-sm-12" ><ul class="spllist">
<li>We provide<strong> ALL VARIETIES</strong> of food Items (Veg / Non Veg / Fast Food / Snacks / Etc)</li>

<li>You Also Could get FREE FOOD</li>

<li>Very Soon, We are launching our FREE FOOD APP in your area</li>

<li>Please fill the following SURVEY to help you serve faster with our App </li>
</ul><br>
<br>
<div class="col-sm-12 col-md-12">
<div class="col-sm-6 col-md-6">
    <div class="input-group margin-bottom-10px  ">
		 
	     <input type="text" required="" name="fullname" class="form-control" placeholder="Full Name">
		 <label for="fullname" class="error"></label>
    </div> </div><div class="col-sm-6 col-md-6">
		    <div class="input-group  margin-bottom-10px ">
			
				<input type="text" onKeyPress="return checkIt(event)" required="" name="mobile" class="form-control" placeholder="Mobile">
					 <label for="mobile" class="error"></label>
		</div>
		</div>
</div>
	<div class="col-sm-12 col-md-12">
			<div class="col-sm-6 col-md-6">
     <div class="input-group  margin-bottom-10px ">

 	        <input type="email" required="" name="email" class="form-control" placeholder="Email">
				 <label for="email" class="error"></label>
	  </div>
		</div><div class="col-sm-6 col-md-6">
		 <div class="input-group  margin-bottom-10px ">	
		 	
                <input type="text" class="form-control" name="address" placeholder="Address">
				 <label for="address" class="error"></label>
		  </div>
		  </div>		
	 </div>
</div>

    <div class="col-sm-12">
	    <div class="input-group  margin-bottom-15px" style="text-align:center">
				<strong>If we give food for free, you will buy in  our APP ?</strong><br>	 


			 <input type="radio" name="app_true" value="yes" > Yes&nbsp;&nbsp;&nbsp;&nbsp; 
			 <input type="radio" name="app_true" value="no" > No	<br>
<label for="app_true" class="error"></label> 	</div>	
	 </div>
	 <div class="col-sm-12">
	    <div class="input-group  margin-bottom-15px" style="text-align:center">
				<strong>How much you might buy from Our APP per week ?</strong><br>
<img src="img/smiely.png" width="26px" height="auto" > <i>Remember, we are giving food for FREE…!!!</i><br>
	 


				 <input type="radio" name="weeklyorder" value="250-500" > 250 - 500&nbsp;&nbsp;&nbsp;&nbsp; 
				 <input type="radio" name="weeklyorder" value="500-1000" > 500 - 1000&nbsp;&nbsp;&nbsp;&nbsp; 
				 <input type="radio" name="weeklyorder" value="Above 1000" >&nbsp;Above 1000		<br>
<label for="weeklyorder" class="error">&nbsp;</label> </div>	
	 </div>
	 <div class="col-sm-12">
	    <div class="input-group  margin-bottom-15px" style="text-align:center">
				<strong>If you want to partner with us in this innovative busienss opportunity ? <br><br>
 
<button  class="btn btn-primary"   type="submit" name="submit2" >Submit</button> &nbsp;&nbsp;  or &nbsp;&nbsp;<a     class="btn  btn-default" href="http://freefood.co.in" target="_blank"><strong style="font-size:12px;">Go to Home Page</strong></a></strong>		</div>	
	 </div>
		  </div>
		  
		  
	     
	   
	   
	     
	   
	   
	   <!-- hmtl stracture closed -->
      </div>
    </div>
  </div>
</div>
 </form>

      <div class="container">
        <div class="row">
          <div class="col-md-12" align="center">
            <h2>
              Get in touch with us..!<br><br>
            </h2><br>
          </div>

          <div class="col-md-3 col-md-offset-2">
            <div class="h-service">
              <div class="icon-wrap ico-bg round-fifty wow fadeInDown">
                <i class="fa fa-envelope">
                </i>
              </div>
              <div class="h-service-content wow fadeInUp">
				   <div class="col-sm-12" style="line-height:3;">
					    <h3 align="center">
						 <br> Contact Details
						</h3>
						<div class="col-sm-12"><b>Free Food</b><br>Manjeera Majestic Commercial,<br> # 403, JNTU Rd, Kukatpally,<br> Hyderabad, Telangana 500072.<br></div>
						<div class="col-sm-12"><i class="fa fa-phone"></i> +919580666888<br></div>
						<div class="col-sm-12"><i class="fa fa-envelope"></i> info@freefood.co.in<br></div>
				   </div>
              </div>
            </div>
          </div>
		  
		  <form  id="form3">

          <div class="col-md-5">
            <div class="h-service">
              <div class="icon-wrap ico-bg round-fifty wow fadeInDown">
                <i class="fa fa-thumbs-up">
                </i>
              </div>
              <div class="h-service-content wow fadeInUp">
				   <div class="col-sm-12">
					    <h3 align="center">
						 <br> Enter Your Details
						</h3>
						<div class="col-sm-6"><input type="text" class="form-control" placeholder="Full Name"><br></div>
						<div class="col-sm-6"><input type="text" class="form-control" placeholder="Subject"><br></div>
						<div class="col-sm-6"><input type="text" class="form-control" placeholder="Email"><br></div>
						<div class="col-sm-6"><input type="text" class="form-control" placeholder="Mobile"><br></div>
						<div class="col-sm-12"><textarea type="text" class="form-control" placeholder="Message" rows="5"></textarea><br></div>
					    <div class="col-sm-12"><a href="#" class="btn btn-warning btn-lg da-link col-sm-6 col-sm-offset-3">Submit</a><br></div>
				   </div>
              </div>
            </div>
          </div>
		  </form>
          <!--div class="col-md-6">
            <div class="h-service">
              <div class="icon-wrap ico-bg round-fifty wow fadeInDown">
                <i class="fa fa-download">
                </i>
              </div>
              <div class="h-service-content wow fadeInUp">
                <h3>
                  DOWNLOAD APP FROM<br><br>
                </h3>
                <div class="col-md-4">
					<img src="img/w-icon.png" class="img-responsive">
				</div>
                <div class="col-md-4">
					<img src="img/a-icon.png" class="img-responsive">
				</div>
                <div class="col-md-4">
					<img src="img/an-icon.png" class="img-responsive">
				</div>
				<div class="clearfix"></div><br><br>
              </div>
            </div>
          </div-->
        </div>
        <!-- /row -->

      </div>
      <!-- /container -->

    </div>


				<div class="clearfix"></div><br><br>


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
					<a href="" target="_blank">
<img src="http://hitwebcounter.com/counter/counter.php?page=6419160&style=0006&nbdigits=5&type=page&initCount=0" title="web page hit counters codes Free" Alt="web page hit counters codes Free"   border="0" >
</a>                                        <br/>
                                        <!-- hitwebcounter.com --><a href="" title="Measure Website Visitors" 
                                        target="_blank" style="font-family: Arial, Helvetica, sans-serif; 
                                        font-size: 11px; color: #758087; text-decoration: none ;"><strong>Visit Counter                                        </strong>
                                        </a>   
                </div>
                <div class="col-md-7">
                  <div class="copyright">
                    <p>&copy; Copyright - FreeFood @ 2016. Powered by “MSK NETPIX PRIVATE LIMITED” | <a href="" style="color:white;">Site Map</a> | <a href="privacy.html" style="color:white;">Privacy Policy</a></p>
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
    <script src="js/jquery-1.8.3.min.js">
    </script>
    <script src="js/bootstrap.min.js">
    </script>
    <script type="text/javascript" src="js/hover-dropdown.js">
    </script>
    <script defer src="js/jquery.flexslider.js">
    </script>
    <script type="text/javascript" src="assets/bxslider/jquery.bxslider.js">
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
	<!-- SlidesJS Required: Link to jquery.slides.js -->
  <script src="js/jquery.slides.min.js"></script>
  <!-- End SlidesJS Required -->

  <!-- SlidesJS Required: Initialize SlidesJS with a jQuery doc ready -->
  <script>
    $(function() {
      $('#slides').slidesjs({
        width: 1400,
        height: 528,
        play: {
          active: true,
          auto: true,
          interval: 4000,
          swap: true
        }
      });
    });
  </script>
  <!-- End SlidesJS Required -->
  
  
   <script>
 $(document).ready(function()
{
$("#myModal").modal({
 backdrop: 'static',
    keyboard: false
})
});
 
</script>
  </body>
</html>