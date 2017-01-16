<?php
session_start();
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
  <title>All Users |Free Food</title>

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
  <link href="js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.dataTables.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" />

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
  
    <!-- START WRAPPER -->
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
        </aside>
	  	       


      <!-- START CONTENT -->
      <section id="content">
        
        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper">
            <!-- Search for small screen -->
            
          <div class="container">
             <div class="col s12">
              <ul id="task-card" class="collection with-header">
			      <li class="collection-header cyan">
                      <h4 class="task-card-title">Intersted Users</h4>
                     
                  </li></ul>
               <!--              </div>
            </div>
          </div>-->
        </div>
        <!--breadcrumbs end-->
        

        <!--start container-->
        <div class="container">
          <div class="section">
            
               <div class="col s12 ">
                <div id="bordered-table">
             
              <div class="row">
                
                <div class="col s12">
				<div class="table">
                  <table id="example2" class="striped">
                    <thead>
                      <tr>
                        <th>S No</th>
						<th> User Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>	
                        <th>Area</th>	
						<th>Location</th>						
						<th>Intrested In</th>	
<th>Referrer</th>							
						<th>Requested On</th>
						
						<th> Update</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                   
                  <?php 
                      include 'sql.php';
                      $qrf = "SELECT * from intrestedin";
$result = mysql_query($qrf);
while($row=mysql_fetch_array($result)){

$user_id=$row['id'];
$name=$row['name'];
$phone=$row['phone'];
$area=$row['area'];
$email=$row['email'];
$intrest=$row['intrest'];
$location=$row['location'];
$referrer_name=$row['referrer_name'];
$referrer_mobile=$row['referrer_mobile'];
 $created_date=$row['created_date'];
if($created_date == "0000-00-00 00:00:00"){
	$created_date= "N/A";
}
else{
	$created_date= date('d-m-Y H:i:s',strtotime($created_date));
}
if($referrer_name == ""){
	$referrer= "Self";
}
else{
	$referrer=$referrer_name.'-'.$referrer_mobile;
}
if($intrest == ""){
	$intrest= "N/A";
}

?>  


 <tr>
                      <td><?php echo $user_id;?></td>
                <td><?php echo $name;?></td>
               <td> <?php  echo $phone ?></td>
                        <td><?php echo $email?> </td>
						<td> <?php  echo $area ?></td>
												<td> <?php  echo $location ?></td>

						 <td> <?php  echo $intrest ?></td>
						  <td> <?php  echo $referrer ?></td>
						 <td> <?php  echo $created_date; ?></td>
						<td><a href="detailsview.php?id=<?php echo $user_id;?>" class="btn"> View</a></td>
                       
                      </tr>
                      
                     <?php } ?>
                    </tbody>
                    <tfoot>

                    </tfoot>
                  </table>
            </div>
			</div>
              </div>
            </div>

              </div>
				
              </ul>
			            </div>
		  <!-- Modal 1 end -->
          <!-- Floating Action Button -->
           
            <!-- Floating Action Button -->
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
               <span>Copyright © 2016 <a class="grey-text text-lighten-4" href="" target="_blank">Free Food </a> All rights reserved.</span>
 </div>
    </div>
  </footer>
  <!-- END FOOTER -->



    <!-- ================================================
    Scripts
    ================================================ -->
    
    <!-- jQuery Library -->
	<script src="js/jQuery-2.1.4.min.js"></script>
	 
	<script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.print.min.js"></script>
<script>
	$(document).ready(function() {
    $('#example2').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend:    'copyHtml5',
                text:      '<i class="fa fa-files-o"></i>',
                titleAttr: 'Copy'
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o"></i>',
                titleAttr: 'Excel'
            },
            {
                extend:    'csvHtml5',
                text:      '<i class="fa fa-file-text-o"></i>',
                titleAttr: 'CSV'
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-pdf-o"></i>',
                titleAttr: 'PDF'
            },
			{
                extend:    'print',
                text:      '<i class="fa fa-print"></i>',
                titleAttr: 'Print'
            }
        ]
    } );
} );
</script>
    <!--materialize js-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <!--prism-->
    <script type="text/javascript" src="js/plugins/prism/prism.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <!-- chartist -->
    <script type="text/javascript" src="js/plugins/chartist-js/chartist.min.js"></script>   
    
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="js/custom-script.js"></script>
    
</body>

</html>