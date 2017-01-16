<?php
ob_start();
include 'config.php';
$ft = time();
$st = md5($ft);
if (empty($_COOKIE['sessid'])) {
    setcookie("sessid", $st, mktime(0, 0, 0, 12, 31, 2020));
}
?><?php include 'header.php'; ?>
<?php
if($_COOKIE["sessid"] == ""){
    $cart = 0;
}else{
   $cart = mysql_num_rows(mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0")); 
}
$area = $_COOKIE['area'];

?>
<div class="pages">
    <div data-page="food-categories" class="page no-toolbar no-navbar">
        <div class="page-content">

            <div class="navbarpages whitebg bottomborder">
				
				<h2 class="page_title2">
				<a href="welcome.php" class="back-btn-all">
				<i class="fa fa-angle-left" aria-hidden="true"></i>
				<i class="fa fa-angle-left" aria-hidden="true"></i></a>
                    <span class="page-title-head">&nbsp;&nbsp;Food Categories</span></h2>
			
                		
                <a href="#" data-panel="left" class="open-panel">
                    <div class="navbar_right"><img src="images/icons/white/menu.png" alt="" title="" /></div>
                </a>
                <?php if($_COOKIE["sessid"] == ""){ ?>
                    <a href="login.php" class="close-panel" data-view=".view-main">
                    <div class="navbar_right whitebg"><img src="images/icons/white/cart.png" alt="" title="" /><span class='badge' id ="cartview" ><?php echo $cart; ?></span></div>
                </a>
                <?php } else{ ?>
                <a href="checkout.php" class="close-panel" data-view=".view-main">
                    <div class="navbar_right whitebg"><img src="images/icons/white/cart.png" alt="" title="" /><span class='badge' id ="cartview" ><?php echo $cart; ?></span></div>
                </a>
                 <?php }  ?>
                					
            </div>

            <div id="pages_maincontent">

                

                <div class="page_single layout_fullwidth_padding food-cat">

                    <ul class="shop_items sub-cat">
                        <?php
                        $qry = mysql_query("select * from category where  FIND_IN_SET('$_COOKIE[area]',areas) order by name asc") or die('error');
                        while ($row = mysql_fetch_assoc($qry)) {
                            ?>
                            <li>
                                <div class="shop_thumb"><a href="productnew.php?pid=<?php echo $row['guid']; ?>"><img width ="100px" height="100px"  src="uploaded_files/<?php echo $row['image']; ?>" alt="" title="" /></a></div>
                                <div class="shop_item_details">
                                    <h4><a href="productnew.php?pid=<?php echo $row['guid']; ?>"><?php echo $row['name']; ?></a></h4>
                                    <div class="shop_item_price">
                                        <!--div class="sub-category"> 
                                            <?php
                                           // $qry1 = mysql_query("select * from foodcategory where refid='$row[guid]' order by name asc") or die('error');
                                            //while ($row1 = mysql_fetch_assoc($qry1)) {
                                                ?>
                                                <a href="product.php?pid=<?php echo $row1['guid']; ?>" ><?php echo $row1['name']; ?></a> 
                                            <?php //} ?>
                                        </div-->
                                    </div>



                                </div>
                            </li> 

                        <?php }
                        ?>




                    </ul>



                </div>

            </div>


        </div>
    </div>
</div>
<?php include 'footer.php'; ?>