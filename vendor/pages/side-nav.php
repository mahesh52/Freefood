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
                            <p>Hello, <?php echo $_SESSION['vendorname'];?></p>

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
                            <a href="products.php">
                                <i class="fa fa-th-list"></i> <span>Products</span> 
                            </a>
                        </li>
                       
                       <li>
                            <a href="pending_orders.php">
                                <i class="fa fa-th-list"></i> <span>New Orders</span> 
                            </a>
                        </li>
                       
                                  <li>
                            <a href="orders.php">
                                <i class="glyphicon glyphicon-random"></i> <span>Orders</span> 
                            </a>
                        </li>
                       
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>