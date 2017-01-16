<?php
ob_start();
include 'config.php';
?>
<?php

if (trim($_COOKIE["sessid"]) == "") {
    $cart = 0;
    header('location:login.php');
} else {
    $cart = mysql_num_rows(mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0"));
}

$credit = mysql_fetch_array(mysql_query("select ifnull(sum(points),0) from wallet where userid='$_COOKIE[sessid]' and status='Credit'"));
            $debit = mysql_fetch_array(mysql_query("select ifnull(sum(points),0) from wallet where userid='$_COOKIE[sessid]' and status='Debit'"));
            $wat = $credit[0] - $debit[0];
$wat = $credit[0] - $debit[0];
?>
<?php include 'header.php'; ?>
<div class="pages">
    <div data-page="food-categories" class="page no-toolbar no-navbar">
        <div class="page-content">

            <div class="navbarpages whitebg bottomborder">
            
            	<h2 class="page_title2"><a href="index.php" class="back-btn-all"><i class="fa fa-angle-left" aria-hidden="true"></i>
                <i class="fa fa-angle-left" aria-hidden="true"></i></a>
                    <span class="page-title-head">&nbsp;&nbsp;Home</span></h2>
                		
                <a href="#" data-panel="left" class="open-panel">
                    <div class="navbar_right"><img src="images/icons/white/menu.png" alt="" title="" /></div>
                </a>
<?php if ($_COOKIE["sessid"] == "") { ?>
                    <a href="login.php" class="close-panel" data-view=".view-main">
                        <div class="navbar_right whitebg"><img src="images/icons/white/cart.png" alt="" title="" /><span class='badge' id ="cartview" ><?php echo $cart; ?></span></div>
                    </a>
<?php } else { ?>
                    <a href="checkout.php" class="close-panel" data-view=".view-main">
                        <div class="navbar_right whitebg"><img src="images/icons/white/cart.png" alt="" title="" /><span class='badge' id ="cartview" ><?php echo $cart; ?></span></div>
                    </a>
<?php } ?>					
            </div>

            <div id="pages_maincontent">

                <div class="page_single layout_fullwidth_padding  product-description-title">
                	<br>
                    <h2 style = " color: #000 !important; padding:0px !important;">Available Points : <?php echo $wat;?></h2>
                    <ul class="shop_items sub-cat">
                        <?php
                        
                        $total = mysql_num_rows(mysql_query("select * from wallet where userid='$_COOKIE[sessid]' and status in ('Credit','Debit')"));
                        if ($total == 0) {
                            echo "No Points";
                        } else {
                          
                            $qry=mysql_query("select * from wallet where userid='$_COOKIE[sessid]' and status in ('Credit','Debit')") or die('error');
                            while ($row = mysql_fetch_assoc($qry)) {
                                
                                    ?>
                                    <li>

                                    <div class="shop_item_details">
                                        <b> Order Id :</b> FF<?php echo $row['refid']; ?><br>
                                      <b>  Date:</b> <?php echo date('d-m-y', strtotime($row['date'])); ?> <br>
                                       <b>  Points : </b><i class="fa fa-inr"></i> <?php echo $row['points']; ?><br>
                                      <b>  Type : </b> <?php echo $row['status']; ?><br>
                                        
                                        
                                    </div>
                                </li>
                              
                                
    <?php
    }
}
?>
                    </ul>
<br><br>

                </div>

            </div>


        </div>
    </div>
</div>

<?php include 'footer.php'; ?>