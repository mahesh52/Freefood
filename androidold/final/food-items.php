<?php ob_start();
include 'config.php';$date=date('Y-m-d');
$ft=time(); $st=md5($ft);
if(empty($_COOKIE['sessid']))
{
setcookie("sessid" ,$st, mktime (0, 0, 0, 12, 31, 2020));
}?>
  <?php $det=mysql_fetch_array(mysql_query("select * from foodcategory where guid='$_GET[pid]'"));?>
<div class="pages">
  <div data-page="food" class="page no-toolbar no-navbar">
    <div class="page-content">
    
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
  
     <h2 class="page_title2"><a href="food-categories.php"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
<span class="page-title-head">&nbsp;&nbsp;Food</span></h2>
      
	<div class="page_single layout_fullwidth_padding">
      
      <ul class="shop_items">
       <?php 
			 $total=0; 
					$total_checkout=mysql_fetch_array(mysql_query("select sum(ctotal) from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0"));
					$total=$total_checkout[0];
					$cart=mysql_num_rows(mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0"));
					if($_GET['search']!=''){
						$pro_total=mysql_num_rows(mysql_query("select * from products where subcategory='$_GET[pid]' and name LIKE '%$_GET[search]%'"));
				$qry=mysql_query("select * from products where subcategory='$_GET[pid]' and name LIKE '%$_GET[search]%' order by name asc");
						}else{
				 $pro_total=mysql_num_rows(mysql_query("select * from products where subcategory='$_GET[pid]'"));
				$qry=mysql_query("select * from products where subcategory='$_GET[pid]' order by name asc");
					}
					if($pro_total==0){echo "<li>No Products Avaible</li>";}else{
			  
			  while($row=mysql_fetch_assoc($qry))
			  {
				   $chk=mysql_fetch_array(mysql_query("select * from cart where pid='$row[guid]' and session_id='$_COOKIE[sessid]' and order_id=''"));
				   $img=mysql_fetch_array(mysql_query("select * from imagefiles where cid='$row[guid]'"));
				?>
				
				<li>
          <div class="shop_thumb"><a href="food-item.php?gid=<?php echo $row['guid'];?>"><img src="uploaded_files/<?php echo $img['image']; ?>" alt="" title="" /></a></div>
          <div class="shop_item_details">
          <h4><a href="food-item.php?gid=<?php echo $row['guid'];?>"><?php echo $row['name'];?>/<?php echo $row['quantity'];?></a></h4>
          <div class="shop_item_price">&#8377;<?php echo $row['sprice'];?> <span class="tax-small-gray">(Tax 10%)</span></div>
		  <?php 
				$fqty=0;
         $chkqty[0]=0;$cartqty[0]=0;
         $chkqty=mysql_fetch_array(mysql_query("select sum(quantity) from vendor_quantity where product_id='$row[guid]' and date='$date'"));
		 $cartqty=mysql_fetch_array(mysql_query("select sum(cquantity) from cart where pid='$row[guid]' and date='$date' and order_id!=''"));
		 $fqty=$chkqty[0]-$cartqty[0];
		 ?>
		 <div class="item_qnty_shop">
                <form id="myform" method="POST" action="#">
                    <input type="button" value="-" class="qntyminusshop" field="quantity" />
                    <input type="text" name="quantity2" value="1" class="qntyshop" />
                    <input type="button" value="+" class="qntyplusshop" field="quantity" />
                </form>
            </div>
          <a href="cart.html" id="addtocart">Add to Cart</a>
          <a href="#" data-popup=".popup-social" class="open-popup shopfav"><img src="images/icons/black/love.png" alt="" title="" /></a>
          
              <!-- <div class="col-xs-6 pull-right" style="font-size: 16px; text-align: right;"><?php if($fqty>0){?>
				<span class="removeproduct" id="<?php echo $row['guid'];?>"><i class="fa fa-minus-square-o"></i>
				</span>&nbsp;
				<span id="product<?php echo $row['guid'];?>"><?php if(empty($chk['guid'])){echo "0";}else{echo $chk['cquantity'];}?>
				</span>&nbsp;
				<span class="addproduct" id="<?php echo $row['guid'];?>">
				<i class="fa fa-plus-square-o"></i></span><?php }else{echo "No Stock";}?></div>-->
				<input type="hidden" name="product_<?php echo $row['guid'];?>" id="product_<?php echo $row['guid'];?>" value="<?php if(empty($chk['guid'])){echo "0";}else{echo $chk['cquantity'];}?>">
                <input type="hidden" name="price_<?php echo $row['guid'];?>" id="price_<?php echo $row['guid'];?>" value="<?php echo $row['sprice'];?>">
                <input type="hidden" name="qty_<?php echo $row['guid'];?>" id="qty_<?php echo $row['guid'];?>" value="<?php echo $fqty;?>">

				</div>
                </li>       
	   <?php }} ?>
				
          
          
      </ul>
      
          <div class="shop_pagination">
          <a href="shop.html" class="prev_shop"><i aria-hidden="true" class="fa fa-angle-left"></i> Prev </a>
          <span class="shop_pagenr">1/37</span>
          <a href="shop-page2.html" class="next_shop"> Next <i aria-hidden="true" class="fa fa-angle-right "></i></a>
          </div>
      
      
      </div>
      
      </div>
      
      
    </div>
  </div>
</div>