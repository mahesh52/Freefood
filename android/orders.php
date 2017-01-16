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
?>
<?php include 'header.php'; ?>
<div class="pages">
    <div data-page="food-categories" class="page no-toolbar no-navbar">
        <div class="page-content">

            <div class="navbarpages whitebg bottomborder">
            
            	<h2 class="page_title2">
				<a href="index.php" class="back-btn-all"><i class="fa fa-angle-left" aria-hidden="true"></i>
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
                <div class="page_single layout_fullwidth_padding">

                    <ul class="shop_items sub-cat">
                        <?php
                        
                        $total = mysql_num_rows(mysql_query("select * from orders where userid='$_COOKIE[sessid]'"));
                        if ($total == 0) {
                            echo "<br><h1 style = 'color:#000 !important; text-align:center;'>No Orders</h1>";
                        } else {
                          
                            $qry=mysql_query("select * from orders where userid='$_COOKIE[sessid]' order by guid desc") or die('error');
                            while ($row = mysql_fetch_assoc($qry)) {
                                if($row["gettime"] == "Food"){
                                  
                                    $qry2=   mysql_query("select * from cart where order_id='$row[guid]' and pid>0") or die('error');
                                    ?>
                                    <li>

                                    <div class="shop_item_details">
                                        <b> Order Id :</b> FF<?php echo $row['guid']; ?><br>
                                      <b>  Ordered On:</b> <?php echo date('d-m-y', strtotime($row['date'])); ?> <br>
                                      <b>  Discount : </b><i class="fa fa-inr"></i> <?php echo $row['discount']; ?><br>
                                      <b>  Amount : </b><i class="fa fa-inr"></i> <?php echo $row['total']; ?><br>
                                          <b>  Payment Type : </b> <?php echo $row['pmode']; ?><br>
                                          <b>  Ordered Items : </b><br>
                                          <b> ------------------------</b><br>
                                           <?php 
                                           while($row2 = mysql_fetch_array($qry2)){
                                               
                                               $products = mysql_fetch_array(mysql_query("select * from products where guid='$row2[pid]'"));
                                               ?>
                                             <b>  Name : </b><?php echo $products['name']; ?><br>
                                               <b>  Price : </b><i class="fa fa-inr"></i> <?php echo $row2['price']; ?><br>
											   <b>  Vat : </b><i class="fa fa-inr"></i> <?php echo $row2['vat']; ?><br>
                                               <b>  Quantity : </b> <?php echo $row2['cquantity']; ?><br>
                                               <b>  Delivered By : </b><?php echo date('d-M-Y G:i A', strtotime($row2['delivery_time']));   ?>- <?php echo 
            date('G:i A', strtotime("+150 minutes", strtotime($row2['delivery_time']))); ?><br>
            <b>  Status : </b><?php echo $row2['order_status']; ?><br>
                                                ------------------<br>
                                          <?php  }
                                           ?>
                                        
                                    </div>
                                </li>
                              <?php   }
                                else{ ?>
                                    <li>

                                    <div class="shop_item_details">
                                        <b> Order Id :</b> FF<?php echo $row['guid']; ?><br>
                                      <b>  Ordered On:</b> <?php echo date('d-m-y', strtotime($row['date'])); ?> <br>
                                      <b>  Amount : </b><i class="fa fa-inr"></i> <?php echo $row['total']; ?><br>
                                     
                                          <b>  Payment Type : </b> <?php echo $row['pmode']; ?><br>
                                         
                                          
                                        <b>  Status : </b><?php echo $row['status']; ?>
                                      
                                        
                                       
                                    </div>
                                </li>
                               <?php  }
                             
                                ?>
                                
    <?php
    }
}
?>
                    </ul>



                </div>

            </div>


        </div>
    </div>
</div>

<?php include 'footer.php'; ?>