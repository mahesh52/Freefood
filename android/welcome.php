<?php ob_start(); error_reporting(0);
include 'config.php';//print_r($_POST);exit;
if(isset($_POST) && !empty($_POST['city']) && !empty($_POST['area']))
{
setcookie("city" ,$_POST['city'], mktime (0, 0, 0, 12, 31, 2020));
setcookie("area" ,$_POST['area'], mktime (0, 0, 0, 12, 31, 2020));
}//echo $_COOKIE[area];

if(!empty($_POST['area'])){$chk=mysql_fetch_array(mysql_query("select * from area where guid='$_POST[area]'"));}else{
$chk=mysql_fetch_array(mysql_query("select * from area where guid='$_COOKIE[area]'"));}

?><!DOCTYPE html>
<style>
.stepspan{
	width: 5%;
   
    font-weight: bold;
    font-size: 25px;
    text-align: center;
   color: green;
}
</style>
<?php
if($_COOKIE["sessid"] == ""){
    $cart = 0;
}else{
   $cart = mysql_num_rows(mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0")); 
}
?>
<?php include 'header.php'; ?>
<div class="views" >

            <div class="view view-main">
<div class="pages">
  <div data-page="food-categories" class="page no-toolbar no-navbar">
    <div class="page-content">
    
	<div class="navbarpages whitebg bottomborder">
	
		 <h2 class="page_title2">
			
			<a href="index.php" class="back-btn-all"><i class="fa fa-angle-left" aria-hidden="true"></i>
				<i class="fa fa-angle-left" aria-hidden="true"></i></a>
			
			<span class="page-title-head">&nbsp;&nbsp;Select Food or Store</span></h2>
	
				
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
           
<div class="demo-progressbar-inline">

        
        <p class="buttons-row" style = "width:100%;">
          <a href="#" data-progress="30" style = "border-radius:21px 20px 20px 20px;font-weight: bold;font-size: 15px;width:25%;background-color:#25B7D3;color:#fff;" class="button button-raised">Buy Food</a>
		  <span class = "stepspan" ><span ><img style = "width:90% !important;margin-top:45%;" src = "images/step.png"/></span></span>
          <a href="#" data-progress="30" style = "border-radius:21px 20px 20px 20px;font-weight: bold;background-color:#25B7D3;font-size: 15px;width:25%;color:#fff;" class="button button-raised">Get Points</a>
		  <span class = "stepspan" ><span ><img style = "width:90% !important;margin-top:45%;" src = "images/step.png"/></span></span>
          <a href="#" data-progress="40"  style = "border-radius:21px 20px 20px 20px;font-weight: bold;background-color:#25B7D3;font-size: 13px;width:40%;color:#fff;" class="button button-raised">Redeem at Store</a>
          
        </p>
      </div>

<div class="page_single layout_fullwidth_padding layout_fullwidth_welcome">
    <ul class="shop_items sub-cat welcome-cate">
        <?php if($chk['food']=='yes' ){?>
       <li>
           
          
          <div class="shop_item_details">
          <h4><a href="category.php">
		  <img src="images/food-icon.png" alt="" title="" /> 
		  <span>FOOD</span></a>
		  </h4>
          <div class="shop_item_price">
		  <a href="category.php"> <div class="sub-category">
		  </div>
		    </a>
			 
		  </div>
            
			
          
          </div>
           </li> 
        <?php } ?>
                   <li>
          <?php if($chk['store']=='yes'){?>
          <div class="shop_item_details" <?php if($chk['store']=='yes' && $chk['coupons']=='yes'){?> style = "width:50%;float:left;" <?php } ?> >
          <h4><a href="home-store.php">
		  <img src="images/store-icon.png" alt="" title="" /> 
		  <span>STORE</span></a></h4>
          <div class="shop_item_price">
		   <div class="sub-category"><span>
		   </span></div>
		    
			 
		  </div>
            
			
          
          </div><?php } ?>
		  <?php if($chk['coupons']=='yes'  ){?>
                   
          
          <div class="shop_item_details" <?php if($chk['store']=='yes' && $chk['coupons']=='yes'){?> style = "width:50%;" <?php } ?> >
          <h4><a href="home-coupons.php">
		  <img src="images/store-icon.png" alt="" title="" /> 
		  <span>COUPONS</span></a></h4>
          <div class="shop_item_price">
		   <div class="sub-category"><span>
		   </span></div>
		    
			 
		  </div>
            
			
          
          </div>
           <?php } ?>
          </li> 
          
          
    </ul>
</div>
        </div>
      
      
    </div>
  </div>
</div>
            </div></div>
    <?php include 'footer.php'; ?>