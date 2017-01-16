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
    $prod_detail=mysql_fetch_array(mysql_query("select * from products where guid='$_GET[gid]'"));
	$img=mysql_fetch_array(mysql_query("select * from imagefiles where cid='$prod_detail[guid]'"));
        $category=mysql_fetch_array(mysql_query("select * from category where guid='$prod_detail[category]'"));
	$chk=mysql_fetch_array(mysql_query("select * from cart where pid='$prod_detail[guid]' and session_id='$_COOKIE[sessid]' and order_id=''"));
	 $total=0; 
					$total_checkout=mysql_fetch_array(mysql_query("select sum(ctotal) from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0"));
					$total=$total_checkout[0];
					$cart=mysql_num_rows(mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0"));?>
<div class="pages">
  <div data-page="storeitem" class="page no-toolbar no-navbar">
    <div class="page-content">
    
	<div class="navbarpages whitebg bottomborder">
    
    	<h2 class="page_title2"><a href="product.php?pid=<?php echo $prod_detail['subcategory'];?>" class="back-btn-all">
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
     
     <div id="pages_maincontent">  
          
      <h2 class="page_title"><a href="#"><i class="fa fa-angle-left"></i></a><?php echo $prod_detail['name'];?></h2>
      
	<div class="page_single layout_fullwidth_padding no-white-bg">
      
      <div class="shop_item item-single">

          <div class="shop_thumb">
          <a rel="gallery-3" href="images/photos/photo1.jpg" title="Photo title" class="swipebox">
              <img  src="uploaded_files/<?php echo $img['image']; ?>" with="250px" height="250px"  alt="" title="" /></a>
          <div class="shop_item_price"><i class="fa fa-inr"></i> <?php echo $prod_detail['sprice']; ?> /-</div>
          <a href="#" data-popup=".popup-social" class="open-popup shopfav"><img src="images/icons/white/love.png" alt="" title="" /></a>
          <a href="#" data-popup=".popup-social" class="open-popup shopfriend"><img src="images/icons/white/users.png" alt="" title="" /></a>
          </div>
          <div class="shop_item_details">
          <h3>Product Description</h3>
          <p><?php echo $prod_detail['description']; ?> </p>
          <?php 
		  $sql_erfv = mysql_fetch_array(mysql_query("select * from vendor where FIND_IN_SET('$_COOKIE[area]',area)"));
										$food_vendor_id = $sql_erfv["guid"];
										$vendor_type = $sql_erfv["vendor_type"];
		  $fqty=0;
         $chkqty[0]=0;$cartqty[0]=0;
		 if($vendor_type == "ERFV"){
												$chkqty = mysql_fetch_array(mysql_query("select available_qty from erfvstock where product_id='$prod_detail[guid]' and erfv_vendor='$food_vendor_id'"));
											}
											else{
												$chkqty=mysql_fetch_array(mysql_query("select sum(quantity) from vendor_quantity where product_id='$prod_detail[guid]' and date='$date'"));
											}
         
		 $cartqty=mysql_fetch_array(mysql_query("select sum(cquantity) from cart where pid='$prod_detail[guid]' and date='$date' and order_id!=''"));
		 $fqty=$chkqty[0]-$cartqty[0];?>
          <input type="hidden" name="product_<?php echo $prod_detail['guid'];?>" id="product_<?php echo $prod_detail['guid'];?>" value="<?php if(empty($chk['guid'])){echo "0";}else{echo $chk['cquantity'];}?>">
                <input type="hidden" name="price_<?php echo $prod_detail['guid'];?>" id="price_<?php echo $prod_detail['guid'];?>" value="<?php echo $prod_detail['sprice'];?>">
                <input type="hidden" name="total_price" id="total_price" value="<?php if($total==''){echo "0";}else{echo $total;}?>">
                <input type="hidden" name="qty_<?php echo $prod_detail['guid'];?>" id="qty_<?php echo $prod_detail['guid'];?>" value="<?php echo $fqty;?>">
		<input type="hidden" name="cart" id="cart" class="cart" value="<?php echo $cart;?>">
                
          <p class="item_qnty_shop">Price: <a href="#"><i class="fa fa-inr" ></i> </small><?php echo $prod_detail['sprice'];?> /-</a></p>
		     
			    <p class="item_qnty_shop">Category: <a href="#"><?php echo $category["name"]; ?></a></p>
          <h3>Select Quantity</h3>
		  <?php if(date(H) >=11 && date(H) < 21){ ?>
		  <?php if ($fqty > 0) { ?>
            <div class="item_qnty_shopitem">
               
                    <input id="<?php echo $prod_detail['guid'];?>" type="button" value="-" class="qntyminusshop removeproduct" field="quantity" />
                    <input type="text" id="product<?php echo $prod_detail['guid'];?>" name="quantity" value="<?php if(empty($chk['guid'])){echo "0";}else{echo $chk['cquantity'];}?>" class="qntyshop" />
                    <input id="<?php echo $prod_detail['guid'];?>" type="button" value="+" class="qntyplusshop addproduct" field="quantity" />
               
            </div>
           <?php
                                            } else {
                                                echo "<div class='item_qnty_shop'>No Stock</div>";
                                            }
											}
											else{
												echo "<div class='item_qnty_shop'>Kitchen Starts from 11 AM</div>";
											}
                                            ?>
	
				
				 
          <a <?php if ($total == 0) { ?>style="display:none;"<?php } ?> id="footer" href="checkout.php" class="button_full btyellow"  >Check Out</a>
          
          </div>

          
      </div>
      
      
      
      </div>
      
      </div>
      
      
    </div>
  </div>
</div>


    
    <script>
          
            $('body').on('click', '.addproduct', function () {

                var thisID = $(this).attr('id');
                var chkqty = 'qty_' + thisID;
                var chkqy = $('#' + chkqty).val();
                var pid = 'product_' + thisID;
                var prd = $('#' + pid).val();
                var crt = $('#cart').val();
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
            });
        </script>
<?php include 'footer.php'; ?>