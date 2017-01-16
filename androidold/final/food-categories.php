  <?php ob_start();
include '../config.php';?>
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
		<a href="cart.php" class="close-panel" data-view=".view-main">
			<div class="navbar_right whitebg"><img src="images/icons/black/cart.png" alt="" title="" /><span class='badge'>20</span></div>
		</a>					
	</div>
     
     <div id="pages_maincontent">
  <h2 class="page_title2"><a href="welcome.php"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
<span class="page-title-head">&nbsp;&nbsp;Shop Categories</span></h2>
    
	<div class="page_single layout_fullwidth_padding">
      
      <ul class="shop_items sub-cat">
      <?php 
			  $qry=mysql_query("select * from category order by name asc") or die('error');
			  while($row=mysql_fetch_assoc($qry))
			  {
				?>
				<li>
          <div class="shop_thumb"><a href="food-items.php?pid=<?php echo $row['guid'];?>"><img src="../uploaded_files/<?php echo $row['image']; ?>" alt="" title="" /></a></div>
          <div class="shop_item_details">
          <h4><a href="food-items.php?pid=<?php echo $row['guid'];?>"><?php echo $row['name']; ?></a></h4>
         <div class="shop_item_price">
		   <div class="sub-category"> 
		    <?php 
			  $qry_sub=mysql_query("select * from foodcategory where refid=".$row['guid']."  order by name asc") or die('error');
			  while($row_sub=mysql_fetch_assoc($qry_sub))
			  {
				?>
				<a href="food-items.php?pid=<?php echo $row_sub['guid'];?>"><?php echo $row_sub['name']; ?></a>
				
			  <?php }	?>
		   
		  
			 
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