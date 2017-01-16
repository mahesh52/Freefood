<?php include "path/page-url.php" ;
echo $_SESSION['partner_status'];
?>
<aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="../img/avatar3.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, <?php echo $_SESSION['loginname'];?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                   
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li>
                            <a href="index.php">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <?php if($_SESSION['partner_status']=="Coupons Vendor")
                            { 
                                echo "<a href='redeemcoupons.php'><i class='fa fa-th'></i> <span>Redeem Coupons</span></a>";
                                echo "<a href='withdrawls.php'><i class='fa fa-th'></i> <span>Withdrawls</span></a>";
                            }
                            ?>
                        </li>
						<li>
                            <?php if($_SESSION['partner_status']=="Stock Vendor")
                            { 
                                echo "<a href='topups.php'><i class='fa fa-th'></i> <span>Topups</span></a>";
                                echo "<a href='rawmaterials.php'><i class='fa fa-th'></i> <span>Rawmaterials</span></a>";
								echo "<a href='maprawmaterialtoprod.php'><i class='fa fa-th'></i> <span>Products</span></a>";
								
                            }
                            ?>
                        </li>
                        <li>
                            <?php if($_SESSION['partner_status']=="State Partner")
{
echo "<a href='zonal.php'><i class='fa fa-th'></i> <span>Zonal Partners</span></a>";
echo "<a href='coms.php'><i class='fa fa-th'></i> <span>Commissions</span></a>";
echo "<a href='withdrawls.php'><i class='fa fa-th'></i> <span>Withdrawls</span></a>";
}
if($_SESSION['partner_status']=="Zonal Partner")
{
echo "<a href='town.php'><i class='fa fa-th'></i> <span>Town Partners</span></a>";
echo "<a href='coms.php'><i class='fa fa-th'></i> <span>Commissions</span></a>";
echo "<a href='withdrawls.php'><i class='fa fa-th'></i> <span>Withdrawls</span></a>";
}
if($_SESSION['partner_status']=="Town Partner")
{
echo "<a href='cluster.php'><i class='fa fa-th'></i> <span>Cluster Partners</span></a>";
echo "<a href='coms.php'><i class='fa fa-th'></i> <span>Commissions</span></a>";
echo "<a href='withdrawls.php'><i class='fa fa-th'></i> <span>Withdrawls</span></a>";

}
if($_SESSION['partner_status']=="Cluster Partner")
{
	echo "<a href='pendingorders.php'><i class='fa fa-th'></i> <span>New Orders</span></a>";
echo "<a href='area.php'><i class='fa fa-th'></i> <span>Area's</span></a>";
echo "<a href='orders.php?st=Food'>
                                <i class='glyphicon glyphicon-random'></i> <span>Food Orders</span> 
                            </a>";
echo "<a href='orders.php?st=store'>
	<i class='glyphicon glyphicon-random'></i> <span>Store Orders</span> 
</a>";
echo "<a href='coms.php'><i class='fa fa-th'></i> <span>Commissions</span></a>";
echo "<a href='withdrawls.php'><i class='fa fa-th'></i> <span>Withdrawls</span></a>";
echo "<a href='wallet.php'><i class='fa fa-th'></i> <span>Wallet</span></a>";

}
if($_SESSION['partner_status']=="Food Vendor")
{
echo "<a href='products.php'><i class='fa fa-th'></i> <span>Products</span></a>";
}
if($_SESSION['partner_status']=="Store Vendor")
{
echo "<a href='sproducts.php'><i class='fa fa-th'></i> <span>Products</span></a>";
}?>
                                
                            
                        </li>
                        
                          <?php if($_SESSION['partner_status']=="Food Vendor")
{
	if($_SESSION['vendor_type'] == "Food"){
		echo "<li><a href='quantity.php'><i class='fa fa-th'></i> <span>Quantity</span></a></li>";
	}
	else{
		echo "<li><a href='maprawmaterialtoprod.php'><i class='fa fa-th'></i> <span>Materials</span></a></li>";
		echo "<li><a href='quantitynew.php'><i class='fa fa-th'></i> <span>Topups</span></a></li>";
		echo "<li><a href='coms.php'><i class='fa fa-th'></i> <span>Commissions</span></a></li>";
	}

echo "<li><a href='pending_orders.php'><i class='fa fa-th'></i> <span>New Orders</span></a></li>";
}?>  
 <?php if($_SESSION['partner_status']=="Store Vendor")
{
	echo "<li><a href='squantity.php'><i class='fa fa-th'></i> <span>Quantity</span></a></li>";
echo "<li><a href='spending_orders.php'><i class='fa fa-th'></i> <span>New Orders</span></a></li>";
}?>  
                        
                        
                         <li>    
                                   <?php if($_SESSION['partner_status']=="Food Vendor")
{
echo "<a href='orders.php?st=Food'>
                                <i class='glyphicon glyphicon-random'></i> <span>Food Orders</span> 
                            </a>";
}?>  
 <?php if($_SESSION['partner_status']=="Store Vendor")
{
echo "<a href='orders.php?st=store'>
                                <i class='glyphicon glyphicon-random'></i> <span>Store Orders</span> 
                            </a>";
}?>  
                            
                        </li>
                        
                         
                           
                        
                       <li class="treeview">
                            <a href="javascript:void(0);">
                                <i class="glyphicon glyphicon-refresh"></i>
                                <span>Settings</span>
                            </a>
                            <ul class="treeview-menu">
                                  
                        <li>
                            <a href="change.php">
                                <i class="glyphicon glyphicon-random"></i> <span>Change Password</span> 
                            </a>
                        </li>
                        <li>
                            <a href="logout.php">
                                <i class="glyphicon glyphicon-random"></i> <span>Logout</span> 
                            </a>
                        </li>
                       
                            </ul>
                            </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>