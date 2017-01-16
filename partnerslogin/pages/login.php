<?php
ob_start();
extract($_POST);
include '../../config.php';
if (isset($_POST) && $_POST['submit'] == 'Submit') {
    if ($logintype == 'state') {
        $login = mysql_query("select * from  statepart where email='$userid' and password='$password'");
    }
    if ($logintype == 'zonal') {
        $login = mysql_query("select * from  zonal where email='$userid' and password='$password'");
    }
    if ($logintype == 'town') {
        $login = mysql_query("select * from  town where email='$userid' and password='$password'");
    }
    if ($logintype == 'cluster') {
        $login = mysql_query("select * from  cluster where email='$userid' and password='$password'");
    }
    if ($logintype == 'food') {
        
        $login = mysql_query("select * from  vendor where email='$userid' and password='$password'");
    }
    if ($logintype == 'store') {
        $login = mysql_query("select * from  storevendor where email='$userid' and password='$password'");
    }
     if ($logintype == 'coupons') {
        $login = mysql_query("select * from  couponsvendor where email='$userid' and password='$password'");
    }
	if ($logintype == 'stock') {
        $login = mysql_query("select * from  stockvendor where email='$userid' and password='$password'");
    }
     $login_count = mysql_num_rows($login);

    if ($login_count != 0) {
        $fetch = mysql_fetch_array($login);
        if ($fetch['status'] == 'Active') {


            session_start();
            $_SESSION['partner_loginid'] = $fetch['guid'];
            if ($logintype == 'state') {
                $_SESSION['partner_status'] = "State Partner";
                 $_SESSION['partner_loginid'] = $fetch['guid'];
            }
            if ($logintype == 'zonal') {
                $_SESSION['partner_status'] = "Zonal Partner";
                 $_SESSION['partner_loginid'] = $fetch['guid'];
            }
            if ($logintype == 'town') {
                $_SESSION['partner_status'] = "Town Partner";
                 $_SESSION['partner_loginid'] = $fetch['guid'];
            }
            if ($logintype == 'cluster') {
                $_SESSION['partner_status'] = "Cluster Partner";
                 $_SESSION['partner_loginid'] = $fetch['guid'];
            }
            if ($logintype == 'food') {
                $_SESSION['partner_status'] = "Food Vendor";
                $_SESSION['vendor_loginid'] = $fetch['guid'];
                  $_SESSION['partner_loginid'] = $fetch['guid'];$_SESSION['vendor_type'] = $fetch['vendor_type'];
            }
            if ($logintype == 'store') {
                $_SESSION['partner_status'] = "Store Vendor";
                $_SESSION['storevendor_loginid'] = $fetch['guid'];
                 $_SESSION['partner_loginid'] = $fetch['guid'];
            }
            if ($logintype == 'coupons') {
                $_SESSION['partner_status'] = "Coupons Vendor";
                $_SESSION['partner_loginid'] = $fetch['guid'];
            }
			if ($logintype == 'stock') {
                $_SESSION['partner_status'] = "Stock Vendor";
                $_SESSION['partner_loginid'] = $fetch['guid'];
            }

            $_SESSION['loginname'] = $fetch['name'];
            header('location:index.php');
        } else {
            header('location:login.php?msg=In Active Account');
        }
    } else {
        header('location:login.php?msg=UserId / Password Wrong');
    }
}
?><!DOCTYPE html>
<html class="bg-black">
<?php include "styles-files.php" ?>
    <body class="bg-black">
        <div class="form-box" id="login-box">
            <div class="header bg-yellow"><?php if ($_GET[msg] != '') {
    echo $_GET[msg];
    echo "<br>";
} ?>Partners Sign In</div>
            <form action="login.php" method="post">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="userid" class="form-control" placeholder="Email ID" required/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" required/>
                    </div>
                    <div class="form-group">
                        <select name="logintype" class="form-control" required>
                            <option value="">Select Status</option>
                            <option value="state">State Partner</option>
                            <option value="zonal">Zonal Partner</option>
                            <option value="town">Town Partner</option>
                            <option value="cluster">Cluster Partner</option>
                            <option value="food">Food Vendor</option>
                            <option value="store">Store Vendor</option>
                            <option value="coupons">Coupons Vendor</option><option value="stock">Stock Vendor</option>
                        </select>
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