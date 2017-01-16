<?php
ob_start();
include 'config.php';
$date = date('Y-m-d');
$ft = time();
$st = md5($ft);
if (empty($_COOKIE['sessid'])) {
    setcookie("sessid", $st, mktime(0, 0, 0, 12, 31, 2020));
}
?>
<?php include 'header.php'; ?>
<script type="text/javascript" src="assets/js/jquery-2.1.4.js"></script>
<?php
if($_COOKIE["sessid"] == ""){
    $cart = 0;
}else{
   $cart = mysql_num_rows(mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0")); 
}

$addons = mysql_num_rows($qry1 = mysql_query("select * from products where  category='$_GET[pid]' and FIND_IN_SET('$_COOKIE[area]',area) and product_type = '0'  order by name asc"));
?>
<style>
.button.active{
	background: #b30506 none repeat scroll 0 0 !important;
    color: #fff !important;
}
</style>
<?php if($addons > 0){ ?>
 <div class="navbar" style = "margin-top:13% !important;">
  <div class="navbar-inner">
    <div class="center" style = "left:0px !important;">
      <!-- Buttons row as tabs controller in navbar-->
      <div class="buttons-row" style = "width:100% !important;">
        <!-- Link to 1st tab, active -->
        <a class="tab-link active button"  style = "font-size:20px;" href="#tab1">Main Course</a>
        <!-- Link to 2nd tab -->
        <a class="tab-link button"  style = "font-size:20px;" href="#tab2">Addon's</a>
        <!-- Link to 3rd tab -->
       
      </div>
    </div>
  </div>
</div>
<?php } ?>
        <div class="pages">
            <div data-page="food" class="page no-toolbar no-navbar">
                <div class="page-content">

                    <div class="navbarpages whitebg bottomborder">
                        
                        <h2 class="page_title2"><a href="category.php" class="back-btn-all">
                        <i class="fa fa-angle-left" aria-hidden="true"></i>
						<i class="fa fa-angle-left" aria-hidden="true"></i>
                        </a>
                            <span class="page-title-head">&nbsp;&nbsp;Food</span></h2>
                        		
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
					
                   
                     <div class="tabs">
        
        <!-- Tabs, tabs wrapper -->
        <div class="tabs">
          <!-- Tab 1, active by default -->
          <div id="tab1" class="tab active">

                    <div id="pages_maincontent" <?php if($addons > 0){ ?> style = "top:100px !important;" <?php } ?> >

                        

                        <div class="page_single layout_fullwidth_padding no-white-bg">

                            <ul class="shop_items productnew-item">
                                <?php
                                $total = 0;
                                $total_checkout = mysql_fetch_array(mysql_query("select sum(ctotal) from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0"));
                                $total = $total_checkout[0];
                             
                                if ($_GET['search'] != '') {
                                    $pro_total = mysql_num_rows(mysql_query("select * from products where subcategory='$_GET[pid]' and name LIKE '%$_GET[search]%' and FIND_IN_SET('$_COOKIE[area]',area) and product_type = '1'  "));
                                    $qry = mysql_query("select * from products where subcategory='$_GET[pid]' and name LIKE '%$_GET[search]%' and FIND_IN_SET('$_COOKIE[area]',area) and product_type = '1' order by name asc");
                                } else {
                                    
                                     $pro_total = mysql_num_rows(mysql_query("select * from products where category='$_GET[pid]' and FIND_IN_SET('$_COOKIE[area]',area) and product_type = '1' "));
                                     $qry = mysql_query("select * from products where  category='$_GET[pid]' and FIND_IN_SET('$_COOKIE[area]',area) and product_type = '1' order by name asc");
                                }
                               
                                if ($pro_total == 0) { ?>
                                    <br><h1 style = "color:#000 !important; text-align:center;">No Products</h1>
                             <?php    } else {
                                    while ($row = mysql_fetch_assoc($qry)) {
                                        
                                        $chk = mysql_fetch_array(mysql_query("select * from cart where pid='$row[guid]' and session_id='$_COOKIE[sessid]' and order_id=''"));
                                        $img = mysql_fetch_array(mysql_query("select * from imagefiles where cid='$row[guid]'"));
										$sql_erfv = mysql_fetch_array(mysql_query("select * from vendor where FIND_IN_SET('$_COOKIE[area]',area)"));
										$food_vendor_id = $sql_erfv["guid"];
										 $vendor_type = $sql_erfv["vendor_type"];
                                    ?>
                                    <li>
                                        <div class="shop_thumb"><a href="item-single.php?gid=<?php echo $row['guid']; ?>">
                                                <img src="uploaded_files/<?php echo $img['image']; ?>"  alt="" title="" /></a></div>
                                        <div class="shop_item_details">
                                            <h4><a href="item-single.php?gid=<?php echo $row['guid']; ?>"><?php echo $row['name']; ?></a></h4>
                                            <div class="shop_item_price">
                                               <i class="fa fa-inr"></i> <?php echo $row['sprice']; ?> /-
    
                                            </div>
                                            <?php
                                            $fqty = 0;
                                            $chkqty[0] = 0;
                                            $cartqty[0] = 0;
                                            //echo "select sum(cquantity) from cart where pid='$row[guid]' and date='$date' and order_id!=''";
											if($vendor_type == "ERFV"){
											 	$chkqty = mysql_fetch_array(mysql_query("select available_qty from erfvstock where product_id='$row[guid]' and erfv_vendor='$food_vendor_id'"));
											}
											else{
												$chkqty = mysql_fetch_array(mysql_query("select sum(quantity) from vendor_quantity where product_id='$row[guid]' and date='$date'"));
											}
                                            
                                            $cartqty = mysql_fetch_array(mysql_query("select sum(cquantity) from cart where pid='$row[guid]' and date='$date' and order_id!=''"));
                                            //echo $chkqty[0];echo $cartqty[0];
											$fqty = $chkqty[0] - $cartqty[0];
                                            ?>
                                            <div class="item_qnty_shop">
												<?php if(date(H) >=11 && date(H) < 21){ ?>
                                                <?php if ($fqty > 0) { ?>
                                                    <input style = "margin-left:25%;" class="removeproduct qntyminusshop" id="<?php echo $row['guid']; ?>" type="button" value="-"  field="quantity" />
<!--                                                    <input type="text" name="quantity" value="1" class="qntyshop" />-->
                                                    <input class="qntyshop" type="text" id="product<?php echo $row['guid']; ?>" value = "<?php
                                                if (empty($chk['guid'])) {
                                                    echo "0";
                                                } else {
                                                    echo $chk['cquantity'];
                                                }
                                                ?>" name="quantity"  class="qntyshop" />
                                                    
                                                    <input id="<?php echo $row['guid']; ?>" type="button" value="+" class="addproduct qntyplusshop" field="quantity" />
                                                    <?php
                                            } else {
                                                echo "No Stock";
                                            }
												}
												else{
													echo "Kitchen Starts from 11 AM";
												}
                                            ?>
                                               
                                            </div>
                                            <input type="hidden" name="product_<?php echo $row['guid']; ?>" id="product_<?php echo $row['guid']; ?>" value="<?php
                           if (empty($chk['guid'])) {
                               echo "0";
                           } else {
                               echo $chk['cquantity'];
                           }
                           ?>">
                            <input type="hidden" name="price_<?php echo $row['guid']; ?>" id="price_<?php echo $row['guid']; ?>" value="<?php echo $row['sprice']; ?>">
                            <input type="hidden" name="qty_<?php echo $row['guid']; ?>" id="qty_<?php echo $row['guid']; ?>" value="<?php echo $fqty; ?>">
                            <input type="hidden" name="total_price" id="total_price" value="<?php
if ($total == '') {
    echo "0";
} else {
    echo $total;
}
?>">
                           
                                            
                                        </div>
                                    </li> 
                                <?php }
                                }
                                ?>
								
                                     <input type="hidden" name="cart" id="cart" class="cart" value="<?php echo $cart; ?>">


                            </ul>

                                                       <div id="footer" style = "margin:0px !important;<?php if ($total == 0 || $pro_total == 0) { ?>display:none;<?php } ?>background:#fff !important;" class="shop_pagination" >
                                                            <?php if(date(H) >=11 && date(H) < 21){?><a href="checkout.php"  class="prev_shop"> Proceed &nbsp;<i aria-hidden="true" class="fa fa-angle-right"></i> </a><?php } ?>
                                                            
                                                        </div>


                        </div>

                    </div>
					</div>
					<div id="tab2" class="tab">
             <div id="pages_maincontent" style = "top:100px !important;position:relative !important;">

                        

                        <div class="page_single layout_fullwidth_padding no-white-bg">

                            <ul class="shop_items productnew-item">
                                <?php
                                $total1 = 0;
                                $total_checkout1 = mysql_fetch_array(mysql_query("select sum(ctotal) from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0"));
                                $total1 = $total_checkout1[0];
                             
                                if ($_GET['search'] != '') {
                                    $pro_total1 = mysql_num_rows(mysql_query("select * from products where subcategory='$_GET[pid]' and name LIKE '%$_GET[search]%' and FIND_IN_SET('$_COOKIE[area]',area) and product_type = '0' "));
                                    $qry1 = mysql_query("select * from products where subcategory='$_GET[pid]' and name LIKE '%$_GET[search]%' and FIND_IN_SET('$_COOKIE[area]',area) and product_type = '0' order by name asc");
                                } else {
                                    
                                     $pro_total1 = mysql_num_rows(mysql_query("select * from products where category='$_GET[pid]' and FIND_IN_SET('$_COOKIE[area]',area) and product_type = '0'  "));
                                     $qry1 = mysql_query("select * from products where  category='$_GET[pid]' and FIND_IN_SET('$_COOKIE[area]',area) and product_type = '0'  order by name asc");
                                }
                               
                                if ($pro_total1 == 0) { ?>
                                    <br><h1 style = "color:#000 !important; text-align:center;">No Products</h1>
                             <?php    } else {
                                    while ($row1 = mysql_fetch_assoc($qry1)) {
                                        
                                        $chk1 = mysql_fetch_array(mysql_query("select * from cart where pid='$row1[guid]' and session_id='$_COOKIE[sessid]' and order_id=''"));
                                        $img1 = mysql_fetch_array(mysql_query("select * from imagefiles where cid='$row1[guid]'"));
                                    
                                    ?>
                                    <li>
                                        <div class="shop_thumb"><a href="item-single.php?gid=<?php echo $row1['guid']; ?>">
                                                <img src="uploaded_files/<?php echo $img1['image']; ?>"  alt="" title="" /></a></div>
                                        <div class="shop_item_details">
                                            <h4><a href="item-single.php?gid=<?php echo $row1['guid']; ?>"><?php echo $row1["name"]; ?></a></h4>
                                            <div class="shop_item_price">
                                               <i class="fa fa-inr"></i> <?php echo $row1['sprice']; ?> /-
    
                                            </div>
                                            <?php
                                            $fqty1 = 0;
                                            $chkqty1[0] = 0;
                                            $cartqty1[0] = 0;
                                            //echo "select sum(cquantity) from cart where pid='$row[guid]' and date='$date' and order_id!=''";
                                            $chkqty1 = mysql_fetch_array(mysql_query("select sum(quantity) from vendor_quantity where product_id='$row1[guid]' and date='$date'"));
                                            $cartqty1 = mysql_fetch_array(mysql_query("select sum(cquantity) from cart where pid='$row1[guid]' and date='$date' and order_id!=''"));
                                            $fqty1 = $chkqty1[0] - $cartqty1[0];
                                            ?>
                                            <div class="item_qnty_shop">
											<?php if(date(H) >=11 && date(H) < 21){ ?>
                                                <?php if ($fqty1 > 0) { ?>
                                                    <input style = "margin-left:25%;"  class="removeproduct qntyminusshop" id="<?php echo $row1['guid']; ?>" type="button" value="-"  field="quantity" />
<!--                                                    <input type="text" name="quantity" value="1" class="qntyshop" />-->
                                                    <input class="qntyshop" type="text" id="product<?php echo $row1['guid']; ?>" value = "<?php
                                                if (empty($chk1['guid'])) {
                                                    echo "0";
                                                } else {
                                                    echo $chk1['cquantity'];
                                                }
                                                ?>" name="quantity"  class="qntyshop" />
                                                    
                                                    <input id="<?php echo $row1['guid']; ?>" type="button" value="+" class="addproduct qntyplusshop" field="quantity" />
                                                    <?php
                                            } else {
                                                echo "No Stock";
                                            }
											}
											else{
												echo "Kitchen Starts from 11 AM";
											}
                                            ?>
                                               
                                            </div>
                                            <input type="hidden" name="product_<?php echo $row1['guid']; ?>" id="product_<?php echo $row1['guid']; ?>" value="<?php
                           if (empty($chk1['guid'])) {
                               echo "0";
                           } else {
                               echo $chk1['cquantity'];
                           }
                           ?>">
                            <input type="hidden" name="price_<?php echo $row1['guid']; ?>" id="price_<?php echo $row1['guid']; ?>" value="<?php echo $row1['sprice']; ?>">
                            <input type="hidden" name="qty_<?php echo $row1['guid']; ?>" id="qty_<?php echo $row1['guid']; ?>" value="<?php echo $fqty1; ?>">
                            <input type="hidden" name="total_price" id="total_price" value="<?php
if ($total1 == '') {
    echo "0";
} else {
    echo $total1;
}
?>">
                           
                                            
                                        </div>
                                    </li> 
                                <?php }
                                }
                                ?>
								
                                     <input type="hidden" name="cart" id="cart" class="cart" value="<?php echo $cart; ?>">


                            </ul>

                                                       <div id="footer" style = "margin:0px !important;<?php if ($total1 == 0 || $pro_total1 == 0 ) { ?>display:none;<?php } ?>background:#fff !important;" class="shop_pagination" >
                                                        <?php if(date(H) >=11 && date(H) < 21){?>    <a href="checkout.php"  class="prev_shop"> Proceed &nbsp;<i aria-hidden="true" class="fa fa-angle-right"></i> </a><?php }?>
                                                            
                                                        </div>


                        </div>

                    </div>
          </div>
					</div>
					</div>


                </div>
            </div>
        </div>

    
    

    <script>
        $(document).ready(function () {
            $(".search-btn").click(function () {
                $(".search").slideToggle('slow');
            });
        });
        $('body').on('click', '.addproduct', function () {

            var thisID = $(this).attr('id');
            
            var chkqty = 'qty_' + thisID;
            var chkqy = $('#' + chkqty).val();
            var pid = 'product_' + thisID;
            var prd = $('#' + pid).val();
            var crt = $('#cart').val();
          //  alert(crt);
           // alert(prd);
            if (prd == 0) {
                var newcrt = parseInt(crt) + 1;
                $('#cart').val(newcrt);
                $('#cartview').html(newcrt);
            }
            var newprd = parseInt(prd) + 1;
            if (chkqy >= newprd) {
               
                $('#' + pid).val(newprd);
                
                $('#' + 'product' + thisID).val(newprd);
                $('.' + pid).html('<b style="font-size:13px;">' + newprd + '</b>');
                var pic = 'price_' + thisID;
                var prc = $('#' + pic).val();
                var tot = $('#total_price').val();
                var newprice = parseInt(tot) + parseInt(prc);
                $('#total_price').val(newprice);
                $('.total_price').html(newprice);
                var newpic = 'newprice_' + thisID;
                $('.' + newpic).html(newprd * prc);
                if (newprice > 0) {
                    $('#footer').show();
                } else {
                    $('#footer').hide();
                }

                $.ajax({
                    type: "post",
                    dataType: "text",
                    url: "cart.php",
                    data: "guid=" + thisID + "&qty=" + newprd + "&price=" + prc,
                    success: function (response) {
                        var spt = response.split('*');
                        $('.total_shipping').html(spt[0]);
                        $('.shipping').html(spt[1]);
                        $('.shipping_total').html(spt[2]);

                    }
                });
            } else {
                alert("No More Stock Available");
            }
        });
        $('body').on('click', '.removeproduct', function () {

            var thisID = $(this).attr('id');
            var pid = 'product_' + thisID;
            var prd = $('#' + pid).val();
            var crt = $('#cart').val();
           // alert(newcrt);
            if (prd == 1) {
                var newcrt = parseInt(crt) - 1;
                $('#cart').val(newcrt);
                 $('#cartview').html(newcrt);
            }
            if (prd > 0) {
                var newprd = parseInt(prd) - 1;
                $('#' + 'product' + thisID).val(newprd);
                $('#' + pid).val(newprd);
                $('.' + pid).html('<b style="font-size:13px;">' + newprd + '</b>');
                var pic = 'price_' + thisID;
                var prc = $('#' + pic).val();
                var tot = $('#total_price').val();
                var newprice = parseInt(tot) - parseInt(prc);
                $('#total_price').val(newprice);
                $('.total_price').html(newprice);
                var newpic = 'newprice_' + thisID;
                $('.' + newpic).html(newprd * prc);
                if (newprice > 0) {
                    $('#footer').show();
                } else {
                    $('#footer').hide();
                }
                $.ajax({
                    type: "post",
                    dataType: "text",
                    url: "cart.php",
                    data: "guid=" + thisID + "&qty=" + newprd + "&price=" + prc,
                    success: function (response) {
                        var spt = response.split('*');
                        $('.total_shipping').html(spt[0]);
                        $('.shipping').html(spt[1]);
                        $('.shipping_total').html(spt[2]);

                    }
                });
            }
        });</script>
<?php include 'footer.php'; ?>