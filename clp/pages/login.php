<?php ob_start();extract($_POST);include '../../config.php';
if(isset($_POST) && $_POST[submit]=='Submit')
{

		  
		  $login=mysql_query("select * from `cluster` where `email`='$userid' and `password`='$password'");

		  $login_count=mysql_num_rows($login);

		  if($login_count!=0)

		  {

			  $fetch=mysql_fetch_array($login);
			 
	session_start();
	$_SESSION['clp_loginid']=$fetch['guid'];
	$_SESSION['clpname']=$fetch['name'];
	header('location:index.php');	
	}
	else
	{
	header('location:login.php?msg=Email Id / Password Wrong');	
	}
}?><!DOCTYPE html>
<html class="bg-black">
    <?php include "styles-files.php" ?>
    <body class="bg-black">
        <div class="form-box" id="login-box">
            <div class="header bg-yellow"><?php if($_GET['msg']!=''){echo $_GET['msg'];echo "<br>";}?>CLP Panel Sign In</div>
            <form action="login.php" method="post">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="userid" class="form-control" placeholder="Email ID"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                    </div>          
                    <div class="form-group">
                        <input type="checkbox" name="remember_me"/> Remember me
                    </div>
                </div>
                <div class="footer">                                                               
                    <button type="submit" name="submit" value="Submit" class="btn bg-yellow btn-block">Sign me in</button>  
                </div>
            </form>
        </div>
       <?php include "footer-scripts.php" ?>
    </body>
</html>