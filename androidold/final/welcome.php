<?php include 'header.php';?>
   <?php 
if(isset($_POST) && !empty($_POST['city']) && !empty($_POST['area']))
{
setcookie("city" ,$_POST['city'], mktime (0, 0, 0, 12, 31, 2020));
setcookie("area" ,$_POST['area'], mktime (0, 0, 0, 12, 31, 2020));
}//echo $_COOKIE[area];
if(!empty($_POST['area'])){$chk=mysql_fetch_array(mysql_query("select * from area where guid='$_POST[area]'"));}else{
$chk=mysql_fetch_array(mysql_query("select * from area where guid='$_COOKIE[area]'"));}?>
     
<div class="pages">
  <div data-page="food-categories" class="page no-toolbar no-navbar">
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
  
     <h2 class="page_title2"><a href="index.html"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
<span class="page-title-head">&nbsp;&nbsp;Select Food or Store</span></h2>
      
	<div class="page_single layout_fullwidth_padding">
      
      <ul class="shop_items sub-cat">
      <?php if($chk['food']=='yes'){?>
	   <li>
          <div class="shop_thumb" style="float:right"><a href="food-categories.php"><img src="images/food.jpg" alt="" title="" /></a></div>
          <div class="shop_item_details">
          <h4><a href="food-categories.php">Food</a></h4>
          <div class="shop_item_price">
		   <div class="sub-category">Here will go small information regarding food, it is not links or sub categories but only description</div>
		    
			 
		  </div>
            
			
          
          </div>
          </li> 
	 <?php } ?><!-- /.col-lg-6 -->
				<?php if($chk['store']=='yes'){?>
				
				<li>
          <div class="shop_thumb"  style="float:right"><a href="store-categories.php"><img src="images/store.jpg" alt="" title="" /></a></div>
          <div class="shop_item_details">
          <h4><a href="store-categories.php">Store</a></h4>
          <div class="shop_item_price">
		   <div class="sub-category"><span>Here will go small information regarding store, it is not links or sub categories but only description</span></div>
		    
			 
		  </div>
            
			
          
          </div>
          </li> 
				
				<?php } ?>
         
          
                        
		  
		  
		    
          
      </ul>
 
      
      
      </div>
      
      </div>
      
      
    </div>
  </div>
</div>

 <?php include 'footer.php';?>