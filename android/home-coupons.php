<?php ob_start();
include 'config.php';
?><!DOCTYPE HTML>
<?php include 'header.php'; ?>
<?php

if($_COOKIE["sessid"] == ""){
    $cart = 0;
}else{
  $cart = mysql_num_rows(mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and cid>0"));
}
?>
<div class="pages">
    <div data-page="food-categories" class="page no-toolbar no-navbar">
        <div class="page-content">

            <div class="navbarpages whitebg bottomborder">
                
                <h2 class="page_title2"><a href="welcome.php" class="back-btn-all"><i class="fa fa-angle-left" aria-hidden="true"></i>
                <i class="fa fa-angle-left" aria-hidden="true"></i></a>
                    <span class="page-title-head">&nbsp;&nbsp;Coupon Categories</span></h2>
                			
                <a href="#" data-panel="left" class="open-panel">
                    <div class="navbar_right"><img src="images/icons/white/menu.png" alt="" title="" /></div>
                </a>
             <?php if($_COOKIE["sessid"] == ""){ ?>
                    <a href="login.php" class="close-panel" data-view=".view-main">
                    <div class="navbar_right whitebg"><img src="images/icons/white/cart.png" alt="" title="" /><span class='badge' id ="cartview" ><?php echo $cart; ?></span></div>
                </a>
                <?php } else{ ?>
                <a href="coupon-checkout.php" class="close-panel" data-view=".view-main">
                    <div class="navbar_right whitebg"><img src="images/icons/white/cart.png" alt="" title="" /><span class='badge' id ="cartview" ><?php echo $cart; ?></span></div>
                </a>
                 <?php }  ?>					
            </div>

            <div id="pages_maincontent">

                

                <div class="page_single layout_fullwidth_padding no-white-bg">

                    <ul class="shop_items sub-cat home-store-lists">
                        <?php
                         $qry1 = mysql_num_rows(mysql_query("select * from storecategory where guid in (select category from coupons where status = 'Active' and quantity > 0) order by name asc"));
                         if($qry1 >0 ){

//echo $d="select * from storecategory where guid in (select category from coupons where status = 'Active' and quantity > 0) order by points desc";exit;
                        $qry = mysql_query("select * from storecategory where guid in (select category from coupons where status = 'Active' and quantity > 0) order by points desc") or die('error');
                        while ($row = mysql_fetch_assoc($qry)) { ?>
                              <li>
                            <div style = "width:100%;" class="shop_thumb"><a href="coupon-items.php?gid=<?php echo $row['guid'];?>">
                                    <img height ="120px" width = "100%" src="uploaded_files/<?php echo $row['image'];?>"  alt="" title="" /></a></div>
                            <!--div class="shop_item_details">
                                <h4><a href="store-items.php?gid=<?php echo $row['guid'];?>"><?php echo $row['name'];?></a></h4>
                               
                            </div-->
                        </li>
                         <?php      }}else{ //echo "No Categories Found"; ?>
                             <p style ="color:#fff;font-size:30px;text-align:center;margin-top: 50%;">Coming Soon</p>
							 
							 
                        <?php  }
                        ?>

                       


                    </ul>



                </div>

            </div>


        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
