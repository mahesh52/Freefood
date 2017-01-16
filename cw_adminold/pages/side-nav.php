<?php include "path/page-url.php" ;
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
                            <a href="coms.php">
                                <i class="fa fa-dashboard"></i> <span>Commissions</span>
                            </a>
                        </li>
                         <li>
                            <a href="withdrawls.php">
                                <i class="fa fa-dashboard"></i> <span>Withdrawls</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="javascript:void(0);">
                                <i class="glyphicon glyphicon-refresh"></i>
                                <span>Locations</span>
                            </a>
                            <ul class="treeview-menu">
                                  <li>
                            <a href="state.php">
                                <i class="fa fa-th"></i> <span>State</span> 
                            </a>
                        </li>
                        <li>
                            <a href="zone.php">
                                <i class="fa fa-th"></i> <span>Zones</span> 
                            </a>
                        </li>
                        <li>
                            <a href="city.php">
                                <i class="fa fa-th"></i> <span>City</span> 
                            </a>
                        </li>
                        <li>
                            <a href="area.php">
                                <i class="fa fa-th"></i> <span>Area</span> 
                            </a>
                        </li>
                            </ul>
                            </li>
                            <li class="treeview">
                            <a href="javascript:void(0);">
                                <i class="glyphicon glyphicon-refresh"></i>
                                <span>Partners</span>
                            </a>
                            <ul class="treeview-menu">
                                  <li>
                            <a href="spartners.php">
                                <i class="fa fa-th"></i> <span>State Partners</span> 
                            </a>
                        </li>
                        <li>
                            <a href="zonal.php">
                                <i class="fa fa-th"></i> <span>Zonal Partners</span> 
                            </a>
                        </li>
                        <li>
                            <a href="town.php">
                                <i class="fa fa-th"></i> <span>Town Partners</span> 
                            </a>
                        </li>
                        <li>
                            <a href="cluster.php">
                                <i class="fa fa-th"></i> <span>Cluster Partners</span> 
                            </a>
                        </li>
                            </ul>
                            </li>
                        
                        <li class="treeview">
                            <a href="javascript:void(0);">
                                <i class="glyphicon glyphicon-refresh"></i>
                                <span>Wallet</span>
                            </a>
                            <ul class="treeview-menu">
                                   <li>
                            <a href="clp.php">
                                <i class="fa fa-th"></i> <span>CLP Wallet</span> 
                            </a>
                        </li> <li>
                            <a href="wallet.php">
                                <i class="fa fa-th"></i> <span>CLP Wallet Requests</span> 
                            </a>
                        </li>
                       
                            </ul>
                            </li>
                       
                        <li class="treeview">
                            <a href="javascript:void(0);">
                                <i class="glyphicon glyphicon-refresh"></i>
                                <span>Food</span>
                            </a>
                            <ul class="treeview-menu">
                                  <li>
                            <a href="category.php">
                                <i class="glyphicon glyphicon-random"></i> <span>Categories</span> 
                            </a>
                        </li>
                        <li>
                            <a href="foodcategory.php">
                                <i class="glyphicon glyphicon-random"></i> <span>Sub Categories</span> 
                            </a>
                        </li>
                       
                       <li>
                            <a href="products.php">
                                <i class="fa fa-th-list"></i> <span>Products</span> 
                            </a>
                        </li>
                        <li>
                            <a href="vendors.php">
                                <i class="fa fa-th"></i> <span>Vendors</span> 
                            </a>
                        </li>
                            </ul>
                            </li>
                            <li class="treeview">
                            <a href="javascript:void(0);">
                                <i class="glyphicon glyphicon-refresh"></i>
                                <span>Store</span>
                            </a>
                            <ul class="treeview-menu">
                                  <li>
                            <a href="storecategory.php">
                                <i class="glyphicon glyphicon-random"></i> <span>Categories</span> 
                            </a>
                        </li>
                        <li>
                            <a href="subcategory.php">
                                <i class="glyphicon glyphicon-random"></i> <span>Sub Categories</span> 
                            </a>
                        </li>
                       <li>
                            <a href="storeproducts.php">
                                <i class="fa fa-th-list"></i> <span>Products</span> 
                            </a>
                        </li>
                        <li>
                            <a href="storevendors.php">
                                <i class="fa fa-th"></i> <span>Vendors</span> 
                            </a>
                        </li>
                            </ul>
                            </li>
                            <li class="treeview">
                            <a href="javascript:void(0);">
                                <i class="glyphicon glyphicon-refresh"></i>
                                <span>Orders</span>
                            </a>
                            <ul class="treeview-menu">
                                  <li>
                            <a href="orders.php?st=Food">
                                <i class="glyphicon glyphicon-random"></i> <span>Food Orders</span> 
                            </a>
                        </li>
                        <li>
                            <a href="orders.php?st=store">
                                <i class="glyphicon glyphicon-random"></i> <span>Store Orders</span> 
                            </a>
                        </li>
                       
                            </ul>
                            </li>
                        
                        <li>
                            <a href="users.php">
                                <i class="fa fa-user"></i> <span>Registered Users</span> 
                            </a>
                        </li>
                         <li>
                            <a href="partners.php">
                                <i class="fa fa-user"></i> <span>Partner Requests</span> 
                            </a>
                        </li>
                        
                       <li class="treeview">
                            <a href="javascript:void(0);">
                                <i class="glyphicon glyphicon-refresh"></i>
                                <span>Settings</span>
                            </a>
                            <ul class="treeview-menu">
                                  <li>
                            <a href="commissions.php">
                                <i class="glyphicon glyphicon-random"></i> <span>Commission Structure</span> 
                            </a>
                        </li>
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