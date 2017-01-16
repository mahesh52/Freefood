<?php ob_start();
include 'config.php';
extract($_POST);$date=date('Y-m-d');
$details=mysql_fetch_array(mysql_query("select * from register where guid='$_COOKIE[sessid]'"));
if($details['guid']==''){header('location:login.php');}
$wat=0;
				$credit=mysql_fetch_array(mysql_query("select sum(points) from wallet where userid='$_COOKIE[sessid]' and status='Credit'"));
				$debit=mysql_fetch_array(mysql_query("select sum(points) from wallet where userid='$_COOKIE[sessid]' and status='Debit'"));
				$wat=$credit[0]-$debit[0];
?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
	<!-- For IE -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- For Resposive Device -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
	<link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon.png">
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="Free Food" />
	<title>Free Food</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="assets/css/animsition.min.css" rel="stylesheet">
    <script type="text/javascript" src="assets/js/jquery-2.1.4.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    
    
    <script>

   	  	$(function(){

			$('#left-nav').click(function(){

				$('.side-tabs-mobile').animate({left: '0px'});

			});

			$('#close-btn').click(function(){

				$('.side-tabs-mobile').animate({left: '-210px'});
    
			});

		});
		
		
		
	
   </script>
    
</head>

<body>
    <?php include 'menu.php';?>
    <header>
        <div class="col-xs-1 padd-sm" id="left-nav"><a href="javascript:void0;" class="pull-right menu-icon button-1"><i class="fa fa-align-center"></i></a></div>
        <div class="col-xs-6 no-padd"><a href="index.php"><img src="assets/images/logo1.png" class="img-responsive" width="110"/></a></div>
    </header>
    
    
    <section class="status-bar">
        <article>
            <div class="col-xs-1"><a href="store-checkout.php" class="text-white"><i class="fa fa-angle-left"></i></a></div>
            <div class="col-xs-10 text-small" align="center">Place Order</div>
            <div class="col-xs-1"></div>
        </article>
    </section>
    <br /><form name="form2" method="post" action="storethankyou.php">
    <section class="animsition item bg-pink content-part" data-animsition-in-class="fade-in-down-sm" data-animsition-out-class="fade-out-down-sm" data-animsition-in-duration="2000">
        <article>
            <div class="col-xs-12" align="center">
                <div class="glyphprogress">
                    <!--div class="connecting-line"></div-->
                    <ul>
                        <li>
                            <span class="glyphstep">
                                <i class="fa fa-map-marker"></i>
                            </span>
                        </li>
                        <li>
                            <span class="glyphstep">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </li>
                        <li>
                            <span class="glyphstep">
                                <i class="fa fa-check"></i>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="clearfix"></div><br />
            <div class="col-xs-12 no-padd">
                <div class="col-xs-12 padd-sm text-small" align="center">
                    <ul class="list-group">
                      <li class="list-group-item">
                          <span class="pull-left"><input type="radio" checked name="pmode" value="COD"/> Cash on Delivery</span>
                          <div class="clearfix"></div>
                      </li>
                      <li class="list-group-item">
                          <span class="pull-left"><input type="radio" name="pmode" value="Card" /> Swipe Card</span>
                          <div class="clearfix"></div>
                      </li>
                      <!--<li class="list-group-item">
                          <span class="pull-left"><input type="radio" disabled/> Pay using PayUMoney</span>
                          <div class="clearfix"></div>
                      </li>-->
                    </ul>
                </div>
                <div class="col-xs-12 padd-sm text-small" align="center">
                    
         <?php $total=mysql_num_rows(mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and sid>0"));
		 $total_checkout=mysql_fetch_array(mysql_query("select sum(ctotal) from cart where session_id='$_COOKIE[sessid]' and order_id='' and sid>0"));?>  
                    <ul class="list-group">
                      <li class="list-group-item">
                          <span class="pull-left">Delivery Time</span>
                          <span class="pull-right"><?php echo $delivery;?></span>
                          <div class="clearfix"></div>
                      </li> <li class="list-group-item">
                          <span class="pull-left">Order Items</span>
                          <span class="pull-right"><?php echo $total;?></span>
                          <div class="clearfix"></div>
                      </li>
                      <li class="list-group-item list-group-item-success">
                          <span class="pull-left">Total</span>
                          <span class="pull-right"><i calss="fa fa-int"></i> <?php echo $total_checkout[0];?></span>
                          <div class="clearfix"></div>
                      </li>
                       <li class="list-group-item list-group-item">
                          <span class="pull-left">Discount</span>
                          <span class="pull-right"><i calss="fa fa-int"></i> <?php
						  if($points=='yes'){echo $dis=$wat;}else{echo $dis=0;}
						   ?></span>
                          <div class="clearfix"></div>
                      </li>
                      <li class="list-group-item list-group-item-success">
                          <span class="pull-left">Sub Total</span>
                          <span class="pull-right"><i calss="fa fa-int"></i> <?php if($points=='yes'){echo $pay=$total_checkout[0]-$dis;}else{echo $pay=$total_checkout[0];}?></span>
                          <div class="clearfix"></div>
                      </li>
                    </ul>
                </div>
                <div class="clearfix"></div><br /><br />
            </div>
        </article>
    </section>
   
    <section>
		<article>
			<div class="cart-value">
				<span class="">Cart Value: <i class="fa fa-inr gap-top"></i> <?php echo $pay;?></span>
				<span class="pull-right">
                <input type="hidden" name="points" value="<?php echo $dis;?>">
                <input type="hidden" name="payable" value="<?php echo $pay;?>">
                <input type="hidden" class="form-control" placeholder="deliverytime" name="deliverytime" id="deliverytime" value="<?php echo $deliverytime;?>">
                <button name="submit" type="submit" class="btn btn-success"><i class="fa fa-shopping-cart"></i> Place Order</button>
                </span>
			</div>
		</article>
	</section>
    </form>
  <script src="assets/js/animsition.min.js" charset="utf-8"></script>
  <script>
  $( document ).ready(function() {
    var $animsition = $('.animsition');
    $animsition
      .animsition()
      .one('animsition.inStart',function(){
        $(this).append('');
        console.log('event -> inStart');
      })
      .one('animsition.inEnd',function(){
        $('.target', this).html('');
        console.log('event -> inEnd');
      })
      .one('animsition.outStart',function(){
        console.log('event -> outStart');
      })
      .one('animsition.outEnd',function(){
        console.log('event -> outEnd');
      });
  });
  
  
  
  function SetActiveGlyphStep(stepNumber) {
    $steps = $('.glyphstep');
        if (stepNumber !== parseInt(stepNumber) || stepNumber < $steps.length || stepNumber > $steps.length) {
            stepNumber = 1;
        }
        $('.glyphstep').each(function(index){
            if (index < stepNumber) {
                $(this).removeClass('glyphactive');
                $(this).removeClass('glyphcomplete');
                $(this).addClass('glyphcomplete');
            } else if (index == stepNumber) {
                $(this).removeClass('glyphactive');
                $(this).removeClass('glyphcomplete');
                $(this).addClass('glyphactive');
            } else {
                $(this).removeClass('glyphactive');
                $(this).removeClass('glyphcomplete');
            }
        });
    }
    $(document).ready(function(){
    SetActiveGlyphStep(3);
    });
  </script>
  
  
  
</body>
</html>