<?php
session_start();
include 'sql.php';
?>
<?php
$msg="";
$tpcount="";
$cpcount="";
$sevcount="";
$hmvcount="";
$rfvcount="";
if(count($_POST)){
 include 'sql.php';


if($_POST["submitarea"]=="submitarea"){
	$area=$_POST["area"];
$result = mysql_query("SELECT COUNT(*) as AreaCount from details where area='$area' ");
$row=mysql_fetch_array($result);
$areacount=$row["AreaCount"];
$msg="Total No.of Users in $area : $areacount  !!";

$tpusersa=mysql_query("select COUNT(*)  As NoOFUsersTPa from intrestedin where intrest='Town Partner' and area='$area' ");
$NoOFUsersTPa=mysql_fetch_array($tpusersa); 
  $tpcount=$NoOFUsersTPa['NoOFUsersTPa'];   

$cpusersa=mysql_query("select COUNT(*)  As NoOFUsersCPa from intrestedin where intrest='Cluster Partner' and area='$area' ");
				$NoOFUsersCPa=mysql_fetch_array($cpusersa); 
  
 $cpcount=$NoOFUsersCPa['NoOFUsersCPa']; 
 
$sevusersa=mysql_query("select COUNT(*)  As NoOFUsersSEVa from intrestedin where intrest='Self Employeed Vendor' and area='$area' ");
$NoOFUsersSEVa=mysql_fetch_array($sevusersa);
$sevcount=$NoOFUsersSEVa['NoOFUsersSEVa'];

$hmvusersa=mysql_query("select COUNT(*)  As NoOFUsersHMVa from intrestedin where intrest='Home Maker Vendor' and area='$area' ");
				$NoOFUsersHMVa=mysql_fetch_array($hmvusersa);
				$hmvcount=$NoOFUsersHMVa['NoOFUsersHMVa'];
				
	$rfvusersa=mysql_query("select COUNT(*)  As NoOFUsersRFVa from intrestedin where intrest='Regular Food Vendor' and area='$area' ");
				$NoOFUsersRFVa=mysql_fetch_array($rfvusersa); 			
				$rfvcount=$NoOFUsersRFVa['NoOFUsersRFVa'];
				

}

elseif($_POST["submitarea"]=="submitlocation"){
	$location=$_POST["location"];
$result1 = mysql_query("SELECT COUNT(*) as LocationCount from details where location='$location' ");
$row1=mysql_fetch_array($result1);
$locationcount=$row1["LocationCount"];
$msg="Total No.of Users in $location : $locationcount  !!";

$tpusersl=mysql_query("select COUNT(*)  As NoOFUsersTPl from intrestedin where intrest='Town Partner' and location='$location' ");
$NoOFUsersTPl=mysql_fetch_array($tpusersl); 
  $tpcount=$NoOFUsersTPl['NoOFUsersTPl'];   

$cpusersl=mysql_query("select COUNT(*)  As NoOFUsersCPl from intrestedin where intrest='Cluster Partner' and location='$location' ");
				$NoOFUsersCPl=mysql_fetch_array($cpusersl); 
  
 $cpcount=$NoOFUsersCPl['NoOFUsersCPl']; 
 
$sevusersl=mysql_query("select COUNT(*)  As NoOFUsersSEVl from intrestedin where intrest='Self Employeed Vendor' and location='$location'");
$NoOFUsersSEVl=mysql_fetch_array($sevusersl);
$sevcount=$NoOFUsersSEVl['NoOFUsersSEVl'];

$hmvusersl=mysql_query("select COUNT(*)  As NoOFUsersHMVl from intrestedin where intrest='Home Maker Vendor' and location='$location' ");
				$NoOFUsersHMVl=mysql_fetch_array($hmvusersl);
				$hmvcount=$NoOFUsersHMVl['NoOFUsersHMVl'];
				
	$rfvusersl=mysql_query("select COUNT(*)  As NoOFUsersRFVl from intrestedin where intrest='Regular Food Vendor' and location='$location' ");
				$NoOFUsersRFVl=mysql_fetch_array($rfvusersl); 			
				$rfvcount=$NoOFUsersRFVl['NoOFUsersRFVl'];
				


}
else
{
	$msg="";
}

}
?>
<!DOCTYPE html>
<html lang="en">

<!--================================================================================
	Item Name: Materialize - Material Design Admin Template
	Version: 3.1
	Author: GeeksLabs
	Author URL: http://www.themeforest.net/user/geekslabs
================================================================================ -->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
  <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
  <title>Dashboard |Free Food</title>

  <!-- Favicons-->
  <link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">
  <!-- Favicons-->
  <link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">
  <!-- For iPhone -->
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
  <!-- For Windows Phone -->


  <!-- CORE CSS-->
  
  <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- Custome CSS-->    
    <link href="css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">


  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="js/plugins/prism/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">

  </head>

<body>
  <!-- Start Page Loading -->
  
  <!-- End Page Loading -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START HEADER -->
  <header id="header" class="page-topbar">
        <!-- start header nav-->
        <div class="navbar-fixed">
            <nav class="navbar-color">
                <div class="nav-wrapper">
                    <ul class="left">                      
                      <li><h1 class="logo-wrapper"><a href="dashboard.php" class="brand-logo darken-1"><img src="images/logo-r.png" alt="Free Food"></a> <span class="logo-text">Free Food</span></h1></li>
                    </ul>
                    
                    
                    <!-- translation-button -->
                  
                    <!-- notifications-dropdown -->
                    
                </div>
            </nav>
        </div>
        <!-- end header nav-->
  </header>
  <!-- END HEADER -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START MAIN -->
  <div id="main">
    <!-- START WRAPPER -->
    <div class="wrapper">
      <aside id="left-sidebar-nav">
        <ul id="slide-out" class="side-nav fixed leftside-navigation">
            <li class="user-details cyan darken-2">
            <div class="row">
              
                <div class="col col s8 m8 l8">
                    <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown"><?php echo $_SESSION["admin_name"] ?></a>
                    <p class="user-roal">Administrator</p>
                </div>
            </div>
            </li>
            <li class="bold"><a href="dashboard.php" class="waves-effect waves-cyan">
		     <i class="mdi-action-dashboard"></i>My Dashboard</a>
            </li>
		    <li class="bold"><a href="intrestedusers.php" class="waves-effect waves-cyan">
			<i class="mdi-social-group"></i>Intrested Users </a>
            </li>
			<li><a href="index.php"><i class="mdi-action-lock-outline"></i> Logout</a>
            </li>
        </ul>
        <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu"></i></a>
        </aside><!-- END LEFT SIDEBAR NAV-->

      <!-- //////////////////////////////////////////////////////////////////////////// -->

	  	        <!-- START CONTENT -->
      <section id="content">
        
        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper">
            <!-- Search for small screen -->
            <div class="header-search-wrapper grey hide-on-large-only">
                
            </div>
          
        </div>
        <!--breadcrumbs end-->
        

        <!--start container-->
        <div class="container">
          <div class="section">
            <div class="col s12">
              
			  
        <!--breadcrumbs end-->


        <!--start container-->
        <div class="container">
        
            
			
           
            
            
            <!--card stats start-->
         
						
            
            
            <!--card stats end-->

            <!-- //////////////////////////////////////////////////////////////////////////// -->
           
            <!--chart dashboard end-->

            <!-- //////////////////////////////////////////////////////////////////////////// -->
           
            <!--card widgets start-->
			

            <!-- //////////////////////////////////////////////////////////////////////////// -->
            
			
			
			
			
			

<?php 
					
					$users=mysql_query("select COUNT(*)  As NoOFUsers from details ");
				$nousers=mysql_fetch_array($users); ?>   
		  
	<p class="caption">Partners Count</p>
 <div class="row" >
                            <div class="col s12 m6 l2">
                                <div class="card">
                                    <div class="card-content  green white-text" style="height:120px;">
									<?php 
					
					$tpusers=mysql_query("select COUNT(*)  As NoOFUsersTP from intrestedin where intrest='Town Partner' ");
				$NoOFUsersTP=mysql_fetch_array($tpusers); ?>
                                        <p class="card-stats-title" style="font-size:1.25rem;"><i class="mdi-editor-insert-drive-file"></i> Town Partner</p>
                                        <h4 class="card-stats-number" style="text-align:center;"><?php echo $NoOFUsersTP['NoOFUsersTP']?></h4>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col s12 m6 l2">
                                <div class="card">
                                    <div class="card-content purple white-text" style="height:120px;">
									<?php 
					
					$cpusers=mysql_query("select COUNT(*)  As NoOFUsersCP from intrestedin where intrest='Cluster Partner' ");
				$NoOFUsersCP=mysql_fetch_array($cpusers); ?>
                                        <p class="card-stats-title" style="font-size:1.25rem;"><i class="mdi-editor-insert-drive-file"></i> Cluster Partner</p>
                                        <h4 class="card-stats-number" style="text-align:center;"><?php echo $NoOFUsersCP['NoOFUsersCP']?></h4>
                                        
                                    </div>
                                   
                                </div>
                            </div>                            
                            <div class="col s12 m6 l2" >
                                <div class="card">
                                    <div class="card-content blue-grey white-text" style="height:120px;">
									<?php 
					
					$sevusers=mysql_query("select COUNT(*)  As NoOFUsersSEV from intrestedin where intrest='Self Employeed Vendor' ");
				$NoOFUsersSEV=mysql_fetch_array($sevusers); ?>
                                        <p class="card-stats-title" style="font-size:1.25rem;"><i class="mdi-editor-insert-drive-file"></i>Self Employeed Vendor </p>
                                        <h4 class="card-stats-number" style="text-align:center;"><?php echo $NoOFUsersSEV['NoOFUsersSEV']?></h4>
                                        
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="col s12 m6 l2">
                                <div class="card">
                                    <div class="card-content deep-purple white-text" style="height:120px;">
									<?php 
					
					$hmvusers=mysql_query("select COUNT(*)  As NoOFUsersHMV from intrestedin where intrest='Home Maker Vendor' ");
				$NoOFUsersHMV=mysql_fetch_array($hmvusers); ?>
                                        <p class="card-stats-title" style="font-size:1.25rem;"><i class="mdi-editor-insert-drive-file"></i> Home Maker Vendor</p>
                                        <h4 class="card-stats-number" style="text-align:center;"><?php echo $NoOFUsersHMV['NoOFUsersHMV']?></h4>
                                        
                                    </div>
                                  
                                </div>
                            </div> 
							<div class="col s12 m6 l2">
                                <div class="card">
                                    <div class="card-content pink lighten-1 white-text" style="height:120px;">
									<?php 
					
					$rfvusers=mysql_query("select COUNT(*)  As NoOFUsersRFV from intrestedin where intrest='Regular Food Vendor' ");
				$NoOFUsersRFV=mysql_fetch_array($rfvusers); ?>
                                        <p class="card-stats-title" style="font-size:1.25rem;"><i class="mdi-editor-insert-drive-file"></i> Regular Food Vendor </p>
                                        <h4 class="card-stats-number" style="text-align:center;"><?php echo $NoOFUsersRFV['NoOFUsersRFV']?></h4>
                                       
                                    </div>
                                    
									
                                </div>
                            </div> 
                        </div>



	
 <div class="divider"></div> 		    
<br>			
            <!--card widgets end-->
<div class="row">	
	
	<div class="row" >  
<div class="col s6">	
                  <div id="basic-form" class="section">
              
                
                <!-- Form with placeholder -->
               
                  
				   <div class="col s12">
				   <div class="card-panel">
                    <h4 class="header2">No.of Users Based On Area</h4>
                    <div class="row">
                      <form class="col s12" method="POST" action="">
                        <div class="row">
                          <div class="input-field col s12">
                  <?php 
					include 'sql.php';
					$result=mysql_query("select * from area ORDER BY area");?>            
                    <select name="area">
                      <option value="" disabled selected>Choose Area</option>
					  <?php while($row=mysql_fetch_array($result)){
					  $area=$row["area"];?>
                      <option value="<?php echo $area?>"><?php echo $area?> </option>
                    <?php }?>     
                    </select>
				
                          </div>
                        </div>
						 <div class="row">
                            <div class="input-field col s12">
                              <button class="btn cyan waves-effect waves-light right" type="submit" name="submitarea" value="submitarea">Submit
                                <i class="mdi-content-send right"></i>
                              </button>
                            </div>
                          </div>
						  </form>
						  </div>
						   </div>
						   </div>
						   </div>
						   </div>
				<div class="col s6">	     
					<div id="basic-form" class="section">	  
						  <div class="row"> 
						    <div class="col s12">
                  <div class="card-panel">
                    <h4 class="header2">No.of Users Based On Location</h4>
                    <div class="row">
                      <form class="col s12" method="POST" action="">
                
                        <div class="row">
                          <div class="input-field col s12">
                <?php 
					include 'sql.php';
					$result1=mysql_query("select * from location ORDER BY location ");?>            
                    <select name="location">
					
                      <option value="" disabled selected>Choose Location</option>
					  <?php while($row1=mysql_fetch_array($result1)){
					  $location=$row1["location"];?>
					  
                      <option value="<?php echo $location?>"><?php echo $location?> </option>
                 <?php }?>    
                    </select>
					   </div>
                        </div>
                        
                        
                          
                          <div class="row">
                            <div class="input-field col s12">
                              <button class="btn cyan waves-effect waves-light right" type="submit" name="submitarea" value="submitlocation">Submit
                                <i class="mdi-content-send right"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>





	</div>		
  
	
	
	 <div class="row" >
	 	<center>	<span style="font-weight:bold;color:red"><?php echo $msg;?></span></center> 

     <p class="caption">Intrested Partners Count based on Area/Location</p>
	 <div class="col s12 m6 l2" style="width:20%">
                                <div class="card">
                                    <div class="card-content  green white-text" style="height:120px;">
                                        <p class="card-stats-title" style="font-size:1.25rem;"><i class="mdi-editor-insert-drive-file"></i>Town Partner</p>
                                        <h4 class="card-stats-number" style="text-align:center;"><?php echo $tpcount;?></h4>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col s12 m6 l2"  style="width:20%">
                                <div class="card">
                                    <div class="card-content purple white-text" style="height:120px;">
                                        <p class="card-stats-title" style="font-size:1.25rem;"><i class="mdi-editor-insert-drive-file"></i> Cluster Partner</p>
                                        <h4 class="card-stats-number" style="text-align:center;"><?php echo $cpcount;?></h4>
                                        
                                    </div>
                                   
                                </div>
                            </div>                            
                            <div class="col s12 m6 l2"  style="width:20%">
                                <div class="card">
                                    <div class="card-content blue-grey white-text" style="height:120px;">
                                        <p class="card-stats-title" style="font-size:1.25rem;"><i class="mdi-editor-insert-drive-file"></i>Self Employeed Vendor  </p>
                                        <h4 class="card-stats-number" style="text-align:center;"><?php echo $sevcount;?></h4>
                                        
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="col s12 m6 l2"  style="width:20%">
                                <div class="card">
                                    <div class="card-content deep-purple white-text" style="height:120px;">
                                        <p class="card-stats-title" style="font-size:1.25rem;"><i class="mdi-editor-insert-drive-file"></i> Home Maker Vendor</p>
                                        <h4 class="card-stats-number" style="text-align:center;"><?php echo $hmvcount;?></h4>
                                        
                                    </div>
                                  
                                </div>
                            </div> 
							<div class="col s12 m6 l2"  style="width:20%;" >
                                <div class="card">
                                    <div class="card-content pink lighten-1 white-text" style="height:120px;">
                                        <p class="card-stats-title" style="font-size:1.25rem;"><i class="mdi-editor-insert-drive-file"></i> Regular Food Vendor  </p>
                                        <h4 class="card-stats-number" style="text-align:center;"><?php echo $rfvcount;?></h4>
                                       
                                    </div>
                                    
									
                                </div>
                            </div> 
                        </div>

		
					
					
 
            <!--work collections start-->
           
            <!--work collections end-->

         </div></div>
        <!--end container-->

      </section>
      <!-- END CONTENT -->

      <!-- //////////////////////////////////////////////////////////////////////////// -->
      <!-- START RIGHT SIDEBAR NAV-->
     
      <!-- LEFT RIGHT SIDEBAR NAV-->

    </div>
    <!-- END WRAPPER -->

  </div>
  <!-- END MAIN -->



  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START FOOTER -->
  <footer class="page-footer">
    <div class="footer-copyright">
      <div class="container">
        <span>Copyright © 2016 <a class="grey-text text-lighten-4"  target="_blank">Free Food</a> All rights reserved.</span>
       
        </div>
    </div>
  </footer>
  <!-- END FOOTER -->



    <!-- ================================================
    Scripts
    ================================================ -->
    
    <!-- jQuery Library -->
    <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>    
    <!--materialize js-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <!--prism-->
    <script type="text/javascript" src="js/plugins/prism/prism.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    
    <!-- chartjs -->
    <script type="text/javascript" src="js/plugins/chartjs/chart.min.js"></script>
    <script type="text/javascript" src="js/plugins/chartjs/chart-script.js"></script>

    <!-- sparkline -->
    <script type="text/javascript" src="js/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script type="text/javascript" src="js/plugins/sparkline/sparkline-script.js"></script>

    <!-- chartist -->
    <script type="text/javascript" src="js/plugins/chartist-js/chartist.min.js"></script>   
    
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="js/custom-script.js"></script>
    
</body>
</html>