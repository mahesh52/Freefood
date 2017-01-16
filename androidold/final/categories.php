  <?php ob_start();
include '../config.php';?>
			  <div class="pages">
  <div data-page="food-categories" class="page no-toolbar no-navbar">
    <div class="page-content">
    
	<div class="navbarpages whitebg bottomborder">
		<div class="navbar_left">
			<div class="logo_image"><a href="index.html"><img src="images/logo-small.png" alt="" title=""/></a></div>
		</div>			
		<a href="#" data-panel="left" class="open-panel">
			<div class="navbar_right"><img src="images/icons/black/menu.png" alt="" title="" /></div>
		</a>
		<a href="cart.html" class="close-panel" data-view=".view-main">
			<div class="navbar_right whitebg"><img src="images/icons/black/cart.png" alt="" title="" /><span class='badge'>20</span></div>
		</a>					
	</div>
     
     <div id="pages_maincontent">
  
     <h2 class="page_title2">&nbsp;
<span class="page-title-head">&nbsp;&nbsp;Shop Categories</span></h2>
      
	<div class="page_single layout_fullwidth_padding">
      
      <ul class="shop_items sub-cat">
      <?php 
			  $qry=mysql_query("select * from category order by name asc") or die('error');
			  while($row=mysql_fetch_assoc($qry))
			  {
				?>
				<li>
          <div class="shop_thumb"><a href="food-category.php?gid=<?php echo $row['guid'];?>"><img src="../uploaded_files/<?php echo $row['image']; ?>" alt="" title="" /></a></div>
          <div class="shop_item_details">
          <h4><a href="shop.html"><?php echo $row['name']; ?></a></h4>
         <div class="shop_item_price">
		   <div class="sub-category"> <a href="shop.html">Sub Category Name</a><a href="shop.html">Sub Category Name</a>
		   <a href="shop.html">Sub Category Name</a><a href="shop.html">Sub Category Name</a><a href="shop.html">Sub Category Name</a><a href="shop.html">Sub Category Name</a> </div>
		    
			 
		  </div>
            
			
          
          </div>
          </li> 
				
                <?php  
			  }?>
          
          
                    
          
      </ul>
 
      
      
      </div>
      
      </div>
      
      
    </div>
  </div>
</div>