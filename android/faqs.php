<?php
ob_start();
include 'config.php';
?>
<?php

if (trim($_COOKIE["sessid"]) == "") {
    $cart = 0;
   
} else {
    $cart = mysql_num_rows(mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0"));
}
?>
<?php include 'header.php'; ?>
<div class="pages">
  <div data-page="toggle" class="page no-toolbar no-navbar">
    <div class="page-content">
    
	<div class="navbarpages whitebg bottomborder">
				
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
      
          
	<div class="page_single layout_fullwidth_padding product-description-title">

                        <div class="custom-accordion">
                        
                          <div class="accordion-item">
                            <div class="accordion-item-toggle">
                            	<span class="acrodian-icon">
                              <i class="icon icon-plus">+</i>
                              <i class="icon icon-minus">-</i>
                              </span>
                              <span class="acordian-title"><strong>WHAT IS “FREE FOOD” ?</strong></span>
                            </div>
                            <div class="accordion-item-content">
                                            <p>
              FREE FOOD is a Food App where customers can download our App free of cost and order food. Best part is, whatever food is ordered in our
App, we will add equivalent points to the customer’s account after successful transaction.
              </p>
                            </div>
                          </div>
                          
                          <div class="accordion-item">
                            <div class="accordion-item-toggle">
                            	<span class="acrodian-icon">
                              <i class="icon icon-plus">+</i>
                              <i class="icon icon-minus">-</i>
                              </span>
                              <span class="acordian-title"><strong>WHAT IS THE COST OF FOOD IN FREE FOOD?</strong></span>
                            </div>
                            <div class="accordion-item-content">
                                            <p>
              Food cost in our App is almost the same as in various other Food Apps or regular hotels. Our intention is not to increase the price because the more we increase the price, the more we have give back to Customer.
              </p>
                            </div>
                          </div>
                          
                         
                            
                              <div class="accordion-item">
                            <div class="accordion-item-toggle">
                            	<span class="acrodian-icon">
                              <i class="icon icon-plus">+</i>
                              <i class="icon icon-minus">-</i>
                              </span>
                               <span class="acordian-title"><strong>IS FOOD REALLY PROVIDED FREE?</strong></span>
                            </div>
                            <div class="accordion-item-content">
                                            <p>
              Absolutely Yes.
              </p>
                            </div>
                          </div> 
                           
                            <div class="accordion-item">
                            <div class="accordion-item-toggle">
                            	<span class="acrodian-icon">
                              <i class="icon icon-plus">+</i>
                              <i class="icon icon-minus">-</i>
                              </span>
                               <span class="acordian-title"><strong>HOW DIFFERENT FROM OTHER APPs?</strong></span>
                            </div>
                            <div class="accordion-item-content">
                                            <p>
              FREE FOOD is same as other Apps where Customer orders food and we will deliver. Primary difference is WE GIVE FOOD FOR FREE. Also, FREE FOOD is PATENTED and COPY RIGHT protected worldwide.
              </p>
                            </div>
                          </div> 
                            <div class="accordion-item">
                            <div class="accordion-item-toggle">
                            	<span class="acrodian-icon">
                              <i class="icon icon-plus">+</i>
                              <i class="icon icon-minus">-</i>
                              </span>
                               <span class="acordian-title"><strong>HOW FOOD IS PROVIDED FOR FREE?</strong></span>
                            </div>
                            <div class="accordion-item-content">
                                            <p>
              By paying amount for food, Customer will get Food + Equivalent Value of Points which can be redeemed at our store. So, technically, food is free in our App.
              </p>
                            </div>
                          </div> 
                              <div class="accordion-item">
                            <div class="accordion-item-toggle">
                            <span class="acrodian-icon">
                              <i class="icon icon-plus">+</i>
                              <i class="icon icon-minus">-</i>
                              </span>
                               <span class="acordian-title"><strong>WHAT IS 3 STEP PROCESS?</strong></span>
                            </div>
                            <div class="accordion-item-content">
                                            <p>
              Step 1 – BUY FOOD (First Step is buying food in our App)<br> Step 2 – GET POINTS (Whatever Customer purchases, we give equivalent points.) <br> Step 3 – REDEEM (Customer can redeem the points in our store for purchasing items of their choice).
              </p>
                            </div>
                          </div>
                            <div class="accordion-item">
                            <div class="accordion-item-toggle">
                            <span class="acrodian-icon">
                              <i class="icon icon-plus">+</i>
                              <i class="icon icon-minus">-</i>
                              </span>
                               <span class="acordian-title"><strong>PROVIDED FREE ONLY DURING FIRST TIME?</strong></span>
                            </div>
                            <div class="accordion-item-content">
                                            <p>
              No. Every time, we give  equivalent points. No limit on ordering.
              </p>
                            </div>
                          </div>
                              <div class="accordion-item">
                            <div class="accordion-item-toggle">
                            <span class="acrodian-icon">
                              <i class="icon icon-plus">+</i>
                              <i class="icon icon-minus">-</i>
                              </span>
                               <span class="acordian-title"><strong>IS FREE FOOD AVAILABLE  EVERYWHERE?</strong></span>
                            </div>
                            <div class="accordion-item-content">
                                            <p>
              We are launching everywhere. As of now, wherever we are available, only those locations are visible in our App.
              </p>
                            </div>
                          </div>
                            
                            <div class="accordion-item">
                            <div class="accordion-item-toggle">
                            <span class="acrodian-icon">
                              <i class="icon icon-plus">+</i>
                              <i class="icon icon-minus">-</i>
                              </span>
                               <span class="acordian-title"><strong>WHERE FREE FOOD APP CAN BE DOWNLOADED?</strong></span>
                            </div>
                            <div class="accordion-item-content">
                                            <p>
              As of now, our App is in Android Play Store. Very soon, we are launching in Apple Store as well
              </p>
                            </div>
                          </div>
                            
                            <div class="accordion-item">
                            <div class="accordion-item-toggle">
                            <span class="acrodian-icon">
                              <i class="icon icon-plus">+</i>
                              <i class="icon icon-minus">-</i>
                              </span>
                               <span class="acordian-title"><strong>ANY HIDDEN COSTS FOR FOOD PURCHASE?</strong></span>
                            </div>
                            <div class="accordion-item-content">
                                            <p>
              No hidden charges. Whatever we bill, will be charged. Customer need not pay anything extra during delivery
              </p>
                            </div>
                          </div>
                            <div class="accordion-item">
                            <div class="accordion-item-toggle">
                            	<span class="acrodian-icon">
                              <i class="icon icon-plus">+</i>
                              <i class="icon icon-minus">-</i>
                              </span>
                               <span class="acordian-title"><strong>IS THERE ANY MINIMUM ORDER?</strong></span>
                            </div>
                            <div class="accordion-item-content">
                                            <p>
             Minimum Order is Rs 250. If anything ordered less than that, extra Rs 20 will be charged for Customer. </p>
                            </div>
                          </div>
     <div class="accordion-item">
                            <div class="accordion-item-toggle">
                            <span class="acrodian-icon">
                              <i class="icon icon-plus">+</i>
                              <i class="icon icon-minus">-</i>
                              </span>
                               <span class="acordian-title"><strong>INTIMATED WHEN FOOD WILL BE DELIVERED?</strong></span>
                            </div>
                            <div class="accordion-item-content">
                                            <p>
              Yes. As soon as the transaction is processed, as SMS will be delivered to Customer when the food will be delivered tentatively.
              </p>
                            </div>
                          </div>
                          <div class="accordion-item">
                            <div class="accordion-item-toggle">
                            <span class="acrodian-icon">
                              <i class="icon icon-plus">+</i>
                              <i class="icon icon-minus">-</i>
                              </span>
                               <span class="acordian-title"><strong>I GOT POINTS. HOW TO REDEEM?</strong></span>
                            </div>
                            <div class="accordion-item-content">
                                            <p>
              In our App, there is an option called STORE. Just visit our store and browse for items interested to purchase.
              </p>
                            </div>
                          </div>
<div class="accordion-item">
                            <div class="accordion-item-toggle">
                            <span class="acrodian-icon">
                              <i class="icon icon-plus">+</i>
                              <i class="icon icon-minus">-</i>
                              </span>
                               <span class="acordian-title"><strong>IS THERE ANY VALIDITY FOR POINTS USAGE?</strong></span>
                            </div>
                            <div class="accordion-item-content">
                                            <p>
              No validity. Unlimited time
              </p>
                            </div>
                          </div>
                            <div class="accordion-item">
                            <div class="accordion-item-toggle">
                            <span class="acrodian-icon">
                              <i class="icon icon-plus">+</i>
                              <i class="icon icon-minus">-</i>
                              </span>
                               <span class="acordian-title"><strong>I GOT POINTS. HOW TO REDEEM?</strong></span>
                            </div>
                            <div class="accordion-item-content">
                                            <p>
              In our App, there is an option called STORE. Just visit our store and browse for items interested to purchase
              </p>
                            </div>
                          </div>
                              <div class="accordion-item">
                            <div class="accordion-item-toggle">
                            <span class="acrodian-icon">
                              <i class="icon icon-plus">+</i>
                              <i class="icon icon-minus">-</i>
                              </span>
                               <span class="acordian-title"><strong>WHAT IS “100:0” IN STORE?</strong></span>
                            </div>
                            <div class="accordion-item-content">
                                            <p>
              This is the category where 100% of Customer points can be redeemed. No need to pay cash for purchasing items in this category if Customer has enough Points to buy items. Please observe the following table for more clarity
              </p>
                            </div>
                          </div>
						    <div class="accordion-item">
                            <div class="accordion-item-toggle">
                            <span class="acrodian-icon">
                              <i class="icon icon-plus">+</i>
                              <i class="icon icon-minus">-</i>
                              </span>
                               <span class="acordian-title"><strong>About Privacy and Data Usage?</strong></span>
                            </div>
                            <div class="accordion-item-content">
                                            <p>
              Please check our privacy policy listed in our website <a href = "http://freefood.co.in/privacy.php">Click Here </a>.By Downloading and Ordering food with us ,you are agrreing to our Terms and Conditions mentioned in our PRIVACY POLICY.
              </p>
                            </div>
                          </div>
                        </div>  


              </div> <!--end of page single-->
              
              
         
          
	
              
              
              
              
      
      </div>
      
      
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>