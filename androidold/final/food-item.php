<?php ob_start();
include 'config.php';$date=date('Y-m-d');
?>
<?php include 'menu.php';
	$prod_detail=mysql_fetch_array(mysql_query("select * from products where guid='$_GET[gid]'"));
	$img=mysql_fetch_array(mysql_query("select * from imagefiles where cid='$prod_detail[guid]'"));
	$chk=mysql_fetch_array(mysql_query("select * from cart where pid='$prod_detail[guid]' and session_id='$_COOKIE[sessid]' and order_id=''"));
	 $total=0; 
					$total_checkout=mysql_fetch_array(mysql_query("select sum(ctotal) from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0"));
					$total=$total_checkout[0];
					$cart=mysql_num_rows(mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0"));?>
<div class="pages">
  <div data-page="shopitem" class="page no-toolbar no-navbar">
    <div class="p
	age-content">
    
	<div class="navbarpages whitebg bottomborder">
		<div class="navbar_left">
			<div class="logo_image"><a href="index.php"><img src="images/logo-small.png" alt="" title=""/></a></div>
		</div>			
		<a href="#" data-panel="left" class="open-panel">
			<div class="navbar_right"><img src="images/icons/black/menu.png" alt="" title="" /></div>
		</a>
		<a href="cart.html" class="close-panel" data-view=".view-main">
			<div class="navbar_right whitebg"><img src="images/icons/black/cart.png" alt="" title="" /><span class='badge'>20</span></div>
		</a>					
	</div>
     
     <div id="pages_maincontent">  
      <h2 class="page_title"><a href="food-categories.php"><i class="fa fa-angle-left"></i></a><?php echo $prod_detail['name'];?></h2>
      
	<div class="page_single layout_fullwidth_padding">
      
      <div class="shop_item">

          <div class="shop_thumb">
          <a rel="gallery-3" href="uploaded_files/<?php echo $img['image']; ?>" title="Photo title" class="swipebox">
		  <img  src="uploaded_files/<?php echo $img['image']; ?>" alt="" title="" /></a>
          <div class="shop_item_price">&#8377;100</div>
          <a href="#" data-popup=".popup-social" class="open-popup shopfav"><img src="images/icons/white/love.png" alt="" title="" /></a>
          <a href="#" data-popup=".popup-social" class="open-popup shopfriend"><img src="images/icons/white/users.png" alt="" title="" /></a>
          </div>
          <div class="shop_item_details">
          <h3>Product Description</h3>
          <p><?php echo $prod_detail['description'];?></p>
          <p><strong>Category:</strong> <a href="#">Lunch</a></p>
          <h3>Select Quntity</h3>
            <div class="item_qnty_shopitem">
                <form id="myform" method="POST" action="#">
                    <input type="button" value="-" class="qntyminusshop" field="quantity" />
                    <input type="text" name="quantity" value="1" class="qntyshop" />
                    <input type="button" value="+" class="qntyplusshop" field="quantity" />
                </form>
            </div>
         <!-- <h3>SELECT SIZE</h3>
                <div class="size_selectors">                
                    <input id="size_s" type="radio" name="size" value="s">  
                    <label for="size_s">S</label>
                    <input id="size_m" type="radio" name="size" value="m" checked="checked">
                    <label for="size_m">M</label> 
                    <input id="size_l" type="radio" name="size" value="l">     
                    <label for="size_l">L</label>
                    <input id="size_xl" type="radio" name="size" value="xl">  
                    <label for="size_xl">XL</label>
                    <input id="size_xxl" type="radio" name="size" value="xxl">
                    <label for="size_xxl">XXL</label> 
                </div> 
          <h3>SELECT COLOR</h3>
                <div class="color_selectors">                
                    <input id="color_red" type="radio" name="color" value="red">  
                    <label for="color_red" class="colorred"></label>
                    <input id="color_orange" type="radio" name="color" value="orange">
                    <label for="color_orange" class="colororange"></label> 
                    <input id="color_yellow" type="radio" name="color" value="yellow" checked="checked">
                    <label for="color_yellow" class="coloryellow"></label> 
                    <input id="color_green" type="radio" name="color" value="green">  
                    <label for="color_green" class="colorgreen"></label>
                    <input id="color_blue" type="radio" name="color" value="blue">
                    <label for="color_blue" class="colorblue"></label> 
                    <input id="color_magenta" type="radio" name="color" value="magenta">
                    <label for="color_magenta" class="colormagenta"></label> 
                </div> -->  
          <a href="cart.html" class="button_full btyellow">Add to Cart</a>
          
          </div>

          
      </div>
      
      
      
      </div>
      
      </div>
      
      
    </div>
  </div>
</div>