<?php ob_start();
session_start();extract($_POST);
include 'secure.php';include '../../config.php'; 
if($_SESSION['partner_status']=="State Partner")
{
$login=mysql_fetch_array(mysql_query("select * from  statepart where `guid`='$_SESSION[partner_loginid]'"));
$table="statepart";
}
if($_SESSION['partner_status']=="Zonal Partner")
{
$login=mysql_fetch_array(mysql_query("select * from  zonal where `guid`='$_SESSION[partner_loginid]'"));
$table="zonal";
}
if($_SESSION['partner_status']=="Town Partner")
{
$login=mysql_fetch_array(mysql_query("select * from  town where `guid`='$_SESSION[partner_loginid]'"));
$table="town";
}
if($_SESSION['partner_status']=="Cluster Partner")
{
$login=mysql_fetch_array(mysql_query("select * from  cluster where `guid`='$_SESSION[partner_loginid]'"));
$table="cluster";
}
if($_SESSION['partner_status']=="Food Vendor")
{
$login=mysql_fetch_array(mysql_query("select * from  vendor where `guid`='$_SESSION[partner_loginid]'"));
$table="vendor";
}
if($_SESSION['partner_status']=="Store Vendor")
{
$login=mysql_fetch_array(mysql_query("select * from  storevendor where `guid`='$_SESSION[partner_loginid]'"));
$table="storevendor";
}

if(isset($_POST) && $_POST['Submit']=="Update")
{
	
	if($login['password']==$oldpassword)
{
		
		
			mysql_query("UPDATE `$table` set `password`='$password' where `guid`='$_SESSION[partner_loginid]'");
		
		
		?>
        <script type="text/javascript">
		alert("Password Updated");
		window.location="change.php";
		</script>
        <?php
}
else
{
	?>
    <script type="text/javascript">
	alert("Old Password Wrong");
	window.location="change.php";
	</script>
    <?php
}
}?><!DOCTYPE html>
<html>
         <?php include "styles-files.php";
		 ?>
         <script type="text/javascript">
 function valid()
 {
	if(document.form1.password.value!=document.form1.conpassword.value) 
	{
		alert("New Password and Repeat Passwords Mismatch");
		document.form1.password.focus();
		return false;
	}
	 return true;
	 
	 
 }
 
 </script>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
       	 <?php include "header.php"; ?>
		 <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
         	<?php include "side-nav.php"; ?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Change  Password
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active"><?php echo $_SESSION['partner_status'];?></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

				 <!-- top row -->
                  
                                <div>
                                     <form action="change.php" method="post" name="form1" onSubmit="return valid()">
                <div >
                    <div class="form-group">
                        <input type="password" name="oldpassword" class="form-control" placeholder="Old Password" required/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="New Password" required/>
                    </div> 
                    <div class="form-group">
                        <input type="password" name="conpassword" class="form-control" placeholder="Confirm Password" required/>
                    </div>          
                    
                </div>
                <div class="footer">                                                               
                    <button type="submit" name="Submit" value="Update" class="btn bg-yellow btn-block">Update</button>  
                </div>
            </form>
                                   
                                   <!-- <h4>
                                       Active Users : <?php// echo $active;?>
                                    </h4>
                                    <h4>
                                       In Active Users :  <?php// echo $inactive;?>
                                    </h4>-->
                               <!-- /.col -->
                       
                    <!-- /.row -->
</div></section>
            </aside><!-- /.right-side -->
        </div>
        <!-- ./wrapper -->
        <!-- add new calendar event modal -->
       <?php include "footer-scripts.php" ?>
    </body>
</html>