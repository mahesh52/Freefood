

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <title>Free Food - Grab food for free</title>
        <meta name="description" content="Free Food - You can grab food for free with Free Food">
        <meta name="author" content="MSK-Netpix">
        <meta name="keywords" content="Free Food,Business Opportunity, Investment, Food Business,Zero Risk">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Stylesheets -->
        <link rel="stylesheet" href="bootstrap/bootstrap.min.css"/><!-- bootstrap grid -->
        <link rel="stylesheet" href="bootstrap/bootstrap-theme.min.css"/><!-- bootstrap theme -->
        <link rel="stylesheet" href="css/style.css"/><!-- template styles -->
        <link rel="stylesheet" href="css/color-default.css"/><!-- default template color styles -->
        <link rel="stylesheet" href="css/retina.css"/><!-- retina ready styles -->
        <link rel="stylesheet" href="css/responsive.css"/><!-- responsive styles -->
        <link rel="stylesheet" href="css/animate.css"/><!-- animation for content -->

        <!-- Google Web fonts -->
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Suranna' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Montez' rel='stylesheet' type='text/css'>

        <!-- Font icons -->
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css"/><!-- Font awesome icons -->
    
	<style>
	body{
		overflow:;
	}
	</style>
	<style>
.right-arrow {
	display: inline-block;
	position: relative;
	background: #008000;
	padding: 10px;
}
.right-arrow:after {
	content: '';
	display: block;  
	position: absolute;
	left: 100%;
	
	margin-top: -28px;
	width: 0;
	height: 0;
	border-top: 18px solid transparent;
	border-right: 10px solid transparent;
	border-bottom: 15px solid transparent;
	border-left: 30px solid #008000;
}
</style>

	</head>

    <body style="background-image: url('img/slider/slide01.jpg');">
	<div id="myModal" class="modal fade in" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-body">
			
			<h4 style="color: rgb(255, 255, 255);
font-size: 22px; letter-spacing:3px; text-align:center; margin-bottom:0px;     padding-top: 1.3%;

background-color: rgb(179, 5, 5);     font-family: inherit;

text-shadow: rgb(3, 3, 3) 0px 0px 23px;  padding-bottom: 1.1%; font-weight:bolder;">Please fill in your details to explore the different Business Opportunities with Free Food</h4>



				

<div class="container" style="width:100%;">
<form class="form-inline" role="form"  action="facebookform.php" method="post" name="f1" onsubmit="return myFunction()">

<div class="row" style="margin-bottom:0px;">
     <div class="col-md-12" style="margin-bottom:10px;padding-top:10px;">
  <div class="col-md-6">
  <div class="form-group">
	 <label for="name">Name</label>
      <input type="name" class="form-control" id="name" placeholder="Enter Name" name="name" />
	  	  <span id="fname1err" style=" color:red;"></span>

	  </div>
    
	</div>
	<div class="col-md-6">
  <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" >
	  	  <span id="emailerr" style=" color:red;"></span>

</div>
	</div>
	</div>
  <div class="col-md-12" style="margin-bottom:10px;" >
	<div class="col-md-6"> 
	<div class="form-group">
	 <label for="tel">Phone</label>
      <input type="tel" class="form-control" id="tel" placeholder="Enter phone number" name="phone" >
	  	  <span id="phoneerr" style=" color:red;"></span>

	  </div>
    </div>
	<div class="col-md-6">
	
    <div class="form-group">
    <label for="pwd">Area: </label>
	<?php 
	include 'sql.php';

	$result1 = mysql_query( "select * from area ORDER BY area");?>
                      <select class="form-control" id="area" name="area">
                       <?php   while($row1 = mysql_fetch_array($result1))
               {
$id = $row1['id'];
$area= $row1['area']; ?> <option value="<?php echo $area;?>" checked><?php echo $area;?></option>
<?php } ?>
                       
                      </select>		
<span id="areaerr" style=" color:red;"></span> 
</div>

	</div>
</div>
<div class="col-md-12" style="margin-bottom:10px;">
<div class="col-md-6" style="padding-top:5px;display:none;" id="loc" >
	  <label for="location">Location:</label>
      <?php 
	include 'sql.php';

	$result = mysql_query( "select * from location ORDER BY location");?>
                      <select class="form-control" id="location" name="location">
					   <option value=""></option>
                       <?php   while($row = mysql_fetch_array($result))
               {

$location= $row['location']; ?> <option value="<?php echo $location;?>" ><?php echo $location;?></option>
<?php } ?>
                       
                      </select>		

	  <span id="locerr" style=" color:red;"></span>
    </div>
	
</div>
<div  class="col-md-12" style="margin-bottom:20px;" >
<center>  <div class="form-group">
<input type="submit" class="btn btn-danger active" value="Explore Now">
</div></center>
</div>

    
	

</div>

           
<div class="row" style="margin-bottom:0px;">
<div class="col-md-6">
       <a href="partner-with-us-page.php"> <input type="image" border="0" alt="Submit" src="img/test.jpg" alt=""  style="width:100%; height:250px;"></a>


</div>
<div class="col-md-6">
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
         <li data-target="#myCarousel" data-slide-to="3"></li>
      <li data-target="#myCarousel" data-slide-to="4"></li>
   
   </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">

      <div class="item active">
       <a href="partner-with-us-page.php"> <input type="image" border="0" alt="Submit" src="img/201.png" alt=""  style="width:100%; "/></a>
        <div class="carousel-caption">
        </div>
      </div>

      <div class="item">
       <a href="partner-with-us-page.php"> <input type="image" border="0" alt="Submit"img src="img/202.png" alt=""  style="width:100%;"/></a>
        <div class="carousel-caption">
        </div>
      </div>
    
      <div class="item">
       <a href="partner-with-us-page.php"> <input type="image" border="0" alt="Submit" src="img/203.png" alt=""   style="width:100%;" /></a>
        <div class="carousel-caption">
        </div>
      </div>
	        <div class="item">
       <a href="partner-with-us-page.php"> <input type="image" border="0" alt="Submit" src="img/204.png" alt=""   style="width:100%;" /></a>
        <div class="carousel-caption">
        </div>
      </div>
	        <div class="item">
       <a href="partner-with-us-page.php"> <input type="image" border="0" alt="Submit" src="img/205.png" alt=""   style="width:100%;" /></a>
        <div class="carousel-caption">
        </div>
      </div>

  
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

</div>
</div>
		 
		 
		 </form>
</div>
		 </div>
        </div>
    </div>
	</div>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-82212726-1', 'auto');
  ga('send', 'pageview');

</script>

    <!-- .header-wrapper start -->
        <div id="header-wrapper">
            <!-- #header start -->
           <header id="header">

                <!-- Main navigation and logo container -->
                <div class="header-inner">
                    <!-- .container start -->
                    <div class="container">
                        <!-- .main-nav start -->
                       <div class="main-nav">
                            <!-- .row start -->
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- .navbar start -->
                                    <nav class="navbar navbar-default nav-left" style="margin-top: 20px; ">									

                                        <!-- .navbar-header start -->
                                        <div class="navbar-header">
                                            <!-- .logo start -->
                                            <div class="logo" style="margin:0px;">
                                                <a href="index.php">
                                                    <img src="img/logo.png" alt="Free Food">
                                                </a>
												
                                            </div><!-- logo end -->
                                         </div> 
                                            
                                        <div class="navbar-header">
											
                                            <!-- .logo start -->
                                            <div class="logo" style="margin:0px;">
                                                <a href="index.php"></a>
                                                    <img src="img/patent.png" title="Free Food Concept is Copy Right Protected and Patents Applied." alt="Patent">
                                                
                                            </div><!-- logo end -->
                                        </div><!-- .navbar-header end -->

                                        <!-- Collect the nav links, forms, and other content for toggling -->
                                        <div class="collapse navbar-collapse" style="float:right;">
                                            <ul class="nav navbar-nav pi-nav">
                                               <li class="current-menu-item">                                                
												<a href="index.php">Home</a> 
                                                    
                                                </li>

                                                <li><a href="about.php">About Us</a>
                                                    
                                                </li>

                                               

                                                
                                                <li>
                                                    <a href="partner-with-us-page.php">Partner With Us</a>                                          
                                                </li>
                                                  <li><a href="faq.php">FAQs</a></li>
							<li><a href="privacy.php">Privacy Policy</a></li>
							
												<li>
                                                    <a href="contact.php">Contact Us</a>                                          
                                                </li>
																									               
                                            </ul><!-- .nav.navbar-nav.pi-nav end -->

                                            <!-- Responsive menu start -->
                                            <div id="dl-menu" class="dl-menuwrapper">
                                                <button class="dl-trigger">Open Menu</button>

                                                <ul class="dl-menu">
                                                    <li>
                                                        <a href="index.php">Home</a>                                                   
                                                    </li><!-- Home li end -->

                                                    <li>
                                                        <a href="about.php">About Us</a>
                                                        
                                                    </li><!-- About li end -->                                                  
                                                    <li>
                                                        <a href="partner-with-us-page.php">Partner With Us</a>
                                                    </li><!-- Blog li end -->

												<li>
                                                    <a href="faq.php">FAQs</a>                                          
                                                </li>
												<li>
                                                    <a href="privacy.php">Privacy Policy</a>                                          
                                                </li>
                                                    <li>
                                                        <a href="contact.php">Contact us</a>
                                                    </li><!-- Contact li end -->
													     <!-- Contact li end -->

                                                </ul><!-- .dl-menu end -->
                                            </div><!-- (Responsive menu) #dl-menu end -->
                                        </div><!-- .navbar.navbar-collapse end --> 
                                                                           
	
								   </nav><!-- .navbar end -->
                                </div><!-- .col-md-12 end -->
                            </div><!-- .row end -->            
                        </div><!-- .main-nav end -->
                   </div><!-- .container end -->
                </div><!-- .header-inner end -->
            </header><!-- #header end -->
        </div>
<!-- #header-wrapper end -->


   
        <!-- .page-content start -->


        <!-- .page-content start -->
        <div class="page-content " style="margin-top:15%;">
            <div class="container" style="">
			
			<div class = "row">
			<div class="col-md-6" >
			
			<center><h3 style="color:white;     font-family: 'Montserrat', Arial, sans-serif;
     font-size: 36px;    line-height: 36px;"> WELCOME TO FREE FOOD</h3></center>
			<center><h4 style="color:white;     font-family: 'Montserrat', Arial, sans-serif;
  font-size: 36px;    line-height: 36px;">First time in History</h4></center>
			<center><h4 style="color:white;color:#b20505;     font-family: 'Montserrat', Arial, sans-serif;
  font-size: 36px;    line-height: 36px;">"GRAB FOOD FOR FREE!"</h4></center>
			<p style="color:white; font-size:20px; font-weight:bold;     font-family: 'Montserrat', Arial, sans-serif; font-size: 36px;  float:left; line-height: 36px;  ">UNBELIEVABLE? ISN'T IT? &nbsp &nbsp
			<div class="right-arrow" style="  float:left;  color:white; font-family: 'Montserrat', Arial, sans-serif; font-size: 18px; margin-bottom:5%;">Watch   this "1 min" video for more info</div></p>
	

			<center>
			<div class="col-md-5"> 
			<a href="customerdetails.php"><button class="btn btn-danger" >END CUSTOMER</button></a>
			</div>
			<div class="col-md-5">			
			
			
			<a href="partner-with-us-page.php"><button class="btn btn-danger" >BUSINESS CUSTOMER</button></a>
			
			</div>
			</center>

			</div>
			<div class="col-md-6">

<iframe  src="https://www.youtube.com/embed/JF7LNP4Eqt4" frameborder="0" allowfullscreen style="width:100%; height:300px;"></iframe>
  </div>

 </div>
 
 <div class="row" style="color:white; margin-bottom:4%;"><center> <h3 style="color:white;     font-family: 'Montserrat', Arial, sans-serif;  font-size: 36px;    line-height: 36px;">LAUNCHING SOON IN YOUR AREA</h3><h6 style="color:white;     font-family: 'Montserrat', Arial, sans-serif;  font-size: 28px;    line-height: 30px;" >(Click <u><a href="customerdetails.php" style="color:white;     font-family: 'Montserrat', Arial, sans-serif;  font-size: 28px;    line-height: 36px;">here</a></u>   to get informed about launch in your area)<h6>
 </center> 
 
 </div>
 
 
                
				</div><!-- .container end -->
				
        </div><!-- .page-content end -->

        <!-- #footer-wrapper start -->
   <div id="footer-wrapper" style="padding-top:0px;">
            <!-- #footer start -->
        <!-- #copyright-container start -->
        <div id="copyright-container" >
            <!-- .container start -->
            <div class="container">
                <!-- .row start -->
               <div class="row">
                    <!-- .col-md-6 start -->
                    <div class="col-md-6">
                        <p>© Free Food 2016. All rights reserved.</p>
                    </div><!-- .col-md-6 end -->
                    <!-- .col-md-6 start -->
                    <div class="col-md-6">
                        <ul class="breadcrumb">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="about.php">About Us</a></li>
                            <li><a href="partner-with-us-page.php">Partner With Us</a></li>
                              <li><a href="faq.php">FAQ</a></li>
							<li><a href="privacy.php">Privacy Policy</a></li>
							
							<li><a href="contact.php">Contact Us</a></li>

                        </ul>
                    </div><!-- .col-md-6 end -->
                </div><!-- .row end -->
             </div><!-- .container end -->

            <a href="#" class="scroll-up"><i class="fa fa-angle-double-up"></i></a>

        </div><!-- .copyright-container end -->
</div>
   
        </div><!-- .copyright-container end -->

		
        <script src="bootstrap/jquery.min.js"></script><!-- jQuery library -->
        <script src="bootstrap/bootstrap.min.js"></script><!-- .bootstrap script -->
		    <script type="text/javascript">
	$(document).ready(function(){
		$("#myModal").modal('show');

	});
</script>


 <script type="text/javascript">

$(function() {
   
	$("#area").change(function () {
            if ($(this).val() == "Hyderabad") {
                $("#loc").show();
            } else {
                $("#loc").hide();
            }
        });
	
});

</script>

<script>
function myFunction()
{
var FirstName1=document.forms["f1"]["name"].value;
if(FirstName1 == "")
{
document.getElementById('fname1err').innerHTML="Enter 'Your Name'";
		
return false;

}

else if(!FirstName1.match(/^[a-zA-Z ]*$/)){
document.getElementById('fname1err').innerHTML="Name is not valid(only alphabets)";
return false;

}
if(FirstName1 !== "" && FirstName1.match(/^[a-zA-Z ]*$/))
{
document.getElementById('fname1err').innerHTML="";
		


}
var email=document.forms["f1"]["email"].value;
if(email == "")
{
document.getElementById('emailerr').innerHTML="Enter 'Your Email'";
		
return false;

}
else if(!email.match(/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/)){
document.getElementById('emailerr').innerHTML="EmailId is not valid";
return false;

}
if(email !== "" && email.match(/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/))
{
document.getElementById('emailerr').innerHTML="";
		


}

var phone=document.forms["f1"]["phone"].value;
if(phone == "")
{
document.getElementById('phoneerr').innerHTML="Enter 'Your Phone Number'";
		
return false;

}
else if(!phone.match(/^\d{10}$/)){
document.getElementById('phoneerr').innerHTML="Phone Number is not valid";
return false;

}

if(phone!== "" && phone.match(/^\d{10}$/))
{
document.getElementById('phoneerr').innerHTML="";
		


}

var area=document.forms["f1"]["area"].value;
if(area == "")
{
document.getElementById('areaerr').innerHTML="Select 'Your Area'";
		
return false;

}
var location=document.forms["f1"]["location"].value;
if(area == "Hyderabad" && location=="")
{
document.getElementById('locerr').innerHTML="Enter 'Your Location'";
		
return false;

}

}
</script>
		
		
	
        <script src="js/jquery.scripts.min.js"></script><!-- modernizr, retina, stellar for parallax -->  
        <script src="js/jquery.dlmenu.min.js"></script><!-- for responsive menu -->
        <script src="js/include.js"></script><!-- custom js functions -->
        <script src="sharrre/jquery.sharrre-1.3.4.min.js"></script><!-- Sharrre post plugin -->
        <script src="js/TweenMax.min.js"></script> <!-- Plugin for smooth scrolling-->
        <script src="js/ScrollToPlugin.min.js"></script> <!-- Plugin for smooth scrolling-->

    

    </body>
</html>