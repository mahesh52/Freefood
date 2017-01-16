<header class="header">
            <a href="index.php" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <?php echo $_SESSION['partner_status'];?>
            </a>
			<?php if($_SESSION['partner_status']=="Cluster Partner")
{$details=mysql_fetch_array(mysql_query("select * from cluster where guid='$_SESSION[partner_loginid]'"));
	$credit=mysql_fetch_array(mysql_query("SELECT sum(points) FROM `clpwallet` where userid='$_SESSION[partner_loginid]' and status='Credit'"));
					 $debit=mysql_fetch_array(mysql_query("SELECT sum(points) FROM `clpwallet` where userid='$_SESSION[partner_loginid]' and status='Debit'"));
					 $bal=$credit[0]-$debit[0];
					 if($bal<$details['minbal']){?><a href="wallet.php"><P align="center"><font color="#FF0000"><strong><?php echo "Running Out Of Balance";?></strong></font></P></a><?php }	}?>
			<?php if($_GET['msg']!=''){?><P align="center"><font color="#FF0000"><strong><?php echo $_GET['msg'];?></strong></font></p><?php } ?>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                       
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $_SESSION[loginname];?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="../img/avatar3.png" class="img-circle" alt="User Image" />
                                    <p>
                                       <?php echo $_SESSION[loginname];?>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                               
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                   
                                    <div class="pull-left">
                                        <a href="change.php" class="btn btn-default btn-flat">Change Password</a>
                                    </div>
                                     <div class="pull-right">
                                        <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>