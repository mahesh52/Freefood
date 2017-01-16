<?php ob_start();
include 'config.php';
?><?php include 'header.php'; ?>
<script type="text/javascript" src="assets/js/jquery-2.1.4.js"></script>
<?php

if($_COOKIE["sessid"] == ""){
    $cart = 0;
}else{
   $cart = mysql_num_rows(mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and sid>0"));
}
$prod_detail=mysql_fetch_array(mysql_query("select * from storeproducts where guid='$_GET[gid]'"));
?>
  <div class="pages">
  <div data-page="storeitem" class="page no-toolbar no-navbar">
    <div class="page-content">
    
	<div class="navbarpages whitebg bottomborder">
    
    	<h2 class="page_title2"><a href="home-store.php" class="back-btn-all"><i class="fa fa-angle-left" aria-hidden="true"></i>
        <i class="fa fa-angle-left" aria-hidden="true"></i></a>
                            <span class="page-title-head">&nbsp;&nbsp;Store</span></h2>
				
		<a href="#" data-panel="left" class="open-panel">
			<div class="navbar_right"><img src="images/icons/white/menu.png" alt="" title="" /></div>
		</a>
		<?php if($_COOKIE["sessid"] == ""){ ?>
                    <a href="login.php" class="close-panel" data-view=".view-main">
                    <div class="navbar_right whitebg"><img src="images/icons/white/cart.png" alt="" title="" /><span class='badge' id ="cartview" ><?php echo $cart; ?></span></div>
                </a>
                <?php } else{ ?>
                <a href="store-checkout.php" class="close-panel" data-view=".view-main">
                    <div class="navbar_right whitebg"><img src="images/icons/white/cart.png" alt="" title="" /><span class='badge' id ="cartview" ><?php echo $cart; ?></span></div>
                </a>
                 <?php }  ?>					
	</div>
     
     <div id="pages_maincontent">  
          
      
      
	<div class="page_single layout_fullwidth_padding product-description-title">
    
    	<h2 class="page_title"><a href="#"><i class="fa fa-angle-left"></i></a><?php echo $prod_detail['name'];?></h2>
      
      <div class="shop_item">
<?php $prod_detail=mysql_fetch_array(mysql_query("select * from storeproducts where guid='$_GET[gid]'"));
	$img=mysql_fetch_array(mysql_query("select * from imagefiles where sid='$prod_detail[guid]'"));
	$chk=mysql_fetch_array(mysql_query("select * from cart where sid='$prod_detail[guid]' and session_id='$_COOKIE[sessid]' and order_id=''"));
	 $total=0; 
					$total_checkout=mysql_fetch_array(mysql_query("select sum(ctotal) from cart where session_id='$_COOKIE[sessid]' and order_id='' and sid>0"));
					$total=$total_checkout[0];
					$fqty = 0;
                                $chkqty[0] = 0;
                                $cartqty[0] = 0;
                                $chkqty = mysql_fetch_array(mysql_query("select sum(quantity) from store_vendor_quantity where product_id='$_GET[gid]'"));
                                $cartqty = mysql_fetch_array(mysql_query("select sum(cquantity) from cart where sid='$_GET[gid]' and order_id!=''"));
                                $fqty = $chkqty[0] - $cartqty[0];
					$cart=mysql_num_rows(mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and sid>0"));?>
          <div class="shop_thumb">
          <a rel="gallery-3" href="images/photos/photo1.jpg" title="Photo title" class="swipebox">
              <img  src="uploaded_files/<?php echo $img['image']; ?>" with="250px" height="250px"  alt="" title="" /></a>
          <div class="shop_item_price"><i class="fa fa-inr"></i> <?php echo $prod_detail['sprice']; ?> /-</div>
          <a href="#" data-popup=".popup-social" class="open-popup shopfav"><img src="images/icons/black/love.png" alt="" title="" /></a>
          <a href="#" data-popup=".popup-social" class="open-popup shopfriend"><img src="images/icons/black/users.png" alt="" title="" /></a>
          </div>
          <div class="shop_item_details">
          <h3>Product Description</h3>
          <p><?php echo $prod_detail['description']; ?> </p>
        
          <input type="hidden" name="product_<?php echo $prod_detail['guid'];?>" id="product_<?php echo $prod_detail['guid'];?>" value="<?php if(empty($chk['guid'])){echo "0";}else{echo $chk['cquantity'];}?>">
                <input type="hidden" name="price_<?php echo $prod_detail['guid'];?>" id="price_<?php echo $prod_detail['guid'];?>" value="<?php echo $prod_detail['sprice'];?>">
                <input type="hidden" name="qty_<?php echo $prod_detail['guid'];?>" id="qty_<?php echo $prod_detail['guid'];?>" value="<?php echo $fqty;?>">
                <input type="hidden" name="total_price" id="total_price" value="<?php if($total==''){echo "0";}else{echo $total;}?>">
		<input type="hidden" name="cart" id="cart" class="cart" value="<?php echo $cart;?>">
                
          <p><strong>Price:</strong> <a href="#"><i class="fa fa-inr" style="color: #333;"></i> </small><?php echo $prod_detail['sprice'];?> /-</a></p>
		     <p><strong>With points:</strong> <a href="#"><i class="fa fa-inr" style="color: #333;"></i> </small><?php echo $prod_detail['mprice'];?> /-</a></p>
			    
          <h3>Select Quantity</h3>
		  <?php if ($fqty > 0) { ?>
            <div class="item_qnty_shopitem">
               
                    <input id="<?php echo $prod_detail['guid'];?>" type="button" value="-" class="qntyminusshop removeproduct" field="quantity" />
                    <input type="text" id="product<?php echo $prod_detail['guid'];?>" name="quantity" value="<?php if(empty($chk['guid'])){echo "0";}else{echo $chk['cquantity'];}?>" class="qntyshop" />
                    <input id="<?php echo $prod_detail['guid'];?>" type="button" value="+" class="qntyplusshop addproduct" field="quantity" />
               
            </div>
			<?php
                                            } else {
                                                echo "No Stock";
                                            }
                                            ?> 
           
	
				
				 
          <a <?php if ($total == 0) { ?>style="display:none;"<?php } ?> id="footer" href="store-checkout.php" class="button_full btyellow"  >Check Out</a>
          
          </div>

          
      </div>
      
      
      
      </div>
      
      </div>
      
      
    </div>
  </div>
</div>  
  

  <script>
 
  $('body').on('click','.addproduct',function(){
		
		var thisID = $(this).attr('id');
		var chkqty='qty_'+thisID;
		var chkqy=$('#'+chkqty).val();
		var pid='product_'+thisID;
		var prd=$('#'+pid).val();
		var crt=$('#cart').val();
		if(prd==0){var newcrt=parseInt(crt)+1;
		$('#cart').val(newcrt);
		$('#cartview').html(newcrt);}
		var newprd=parseInt(prd)+1;
		if(chkqy>=newprd){
		$('#'+pid).val(newprd);
		$('#'+'product'+thisID).val(newprd);
		$('.'+pid).html('<b style="font-size:13px;">'+newprd+'</b>'); 
		var pic='price_'+thisID;
		var prc=$('#'+pic).val();
		var tot=$('#total_price').val();
		var newprice=parseInt(tot)+parseInt(prc);
		$('#total_price').val(newprice);
		$('.total_price').html(newprice);
		var newpic='newprice_'+thisID;
		$('.'+newpic).html(newprd*prc);
		if(newprice>0){$('#footer').show();
		}else{
			$('#footer').hide();}
		$.ajax({
					   type:"post",
					   dataType:"text",
					   url:"storecart.php",
					   data:  "guid="+thisID+"&qty="+newprd+"&price="+prc,
					   success: function(response){
						    var spt=response.split('*');
						   $('.total_shipping').html(spt[0]);
						   $('.shipping').html(spt[1]);
						   $('.shipping_total').html(spt[2]);
						   
					   }
		});}else{alert("No More Stock Available");}
			});
			$('body').on('click','.removeproduct',function(){
		
		var thisID = $(this).attr('id');
		var pid='product_'+thisID;
		var prd=$('#'+pid).val();
		var crt=$('#cart').val();
		if(prd==1){var newcrt=parseInt(crt)-1;
		$('#cart').val(newcrt);
		$('#cartview').html(newcrt);}
		if(prd>0){
		var newprd=parseInt(prd)-1;
		$('#'+'product'+thisID).val(newprd);
		$('#'+pid).val(newprd);
		$('.'+pid).html('<b style="font-size:13px;">'+newprd+'</b>'); 
		var pic='price_'+thisID;
		var prc=$('#'+pic).val();
		var tot=$('#total_price').val();
		var newprice=parseInt(tot)-parseInt(prc);
		$('#total_price').val(newprice);
		$('.total_price').html(newprice);
		var newpic='newprice_'+thisID;
		$('.'+newpic).html(newprd*prc);
		if(newprice>0){$('#footer').show();
		}else{
			$('#footer').hide();}
		$.ajax({
					   type:"post",
					   dataType:"text",
					   url:"storecart.php",
					   data:  "guid="+thisID+"&qty="+newprd+"&price="+prc,
					   success: function(response){
						    var spt=response.split('*');
						   $('.total_shipping').html(spt[0]);
						   $('.shipping').html(spt[1]);
						   $('.shipping_total').html(spt[2]);
						  
					   }
					   });
		}
			});
  </script>
 <?php include 'footer.php'; ?>