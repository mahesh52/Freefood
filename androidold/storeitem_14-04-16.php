<?php ob_start();
include 'config.php';
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
	<meta name="author" content="Vizag's Dabbawala" />
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

				$('.side-tabs-mobile').animate({right: '210px'});

			});

			$('#close-btn').click(function(){

				$('.side-tabs-mobile').animate({right: '-210px'});
    
			});

		});
		
		
		
	
   </script>
    
</head>

<body>
    <?php include 'menu.php';
	$prod_detail=mysql_fetch_array(mysql_query("select * from storeproducts where guid='$_GET[gid]'"));
	$img=mysql_fetch_array(mysql_query("select * from imagefiles where sid='$prod_detail[guid]'"));
	$chk=mysql_fetch_array(mysql_query("select * from cart where sid='$prod_detail[guid]' and session_id='$_COOKIE[sessid]' and order_id=''"));
	 $total=0; 
					$total_checkout=mysql_fetch_array(mysql_query("select sum(ctotal) from cart where session_id='$_COOKIE[sessid]' and order_id='' and sid>0"));
					$total=$total_checkout[0];
					$cart=mysql_num_rows(mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and sid>0"));?>
    <header>
        <div class="col-xs-6"><a href="index.php"><img src="assets/images/logo1.png" class="img-responsive" width="110"/></a></div>
        <div class="col-xs-1 pull-right " id="left-nav">
			<a href="javascript:void0;" class="menu-icon button-1 pull-right"><i class="fa fa-align-center"></i></a>
		</div>
        <!--<div class="col-xs-1 pull-right btn-group">
			<a href="javascript:void0;" class="menu-icon button-1 pull-right dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-filter"></i></a>
			<ul class="dropdown-menu">
				<li><a href="#">Vegetarian</a></li>
				<li><a href="#">Non-Vegetarian</a></li>
				<li role="separator" class="divider"></li>
				<li><a href="#">Both</a></li>
			</ul>
		</div>-->
    </header>
    
    
    <section class="status-bar">
        <article>
            <div class="col-xs-1"><a href="store-items.php?gid=<?php echo $prod_detail['subcategory'];?>" class="text-white"><i class="fa fa-angle-left"></i></a></div>
            <div class="col-xs-10 text-small no-padd">Back to Items List</div>
            <div class="col-xs-1"></div>
        </article>
    </section>
    
    
    <section class="content-part animsition item bg-cyan" data-animsition-in-class="fade-in-up-sm" data-animsition-out-class="fade-out-up-sm" data-animsition-in-duration="1000">
        <article>
            <div class="col-xs-12 restaurant-head no-padd"><br>
				<img src="android/uploaded_files/<?php echo $img['image']; ?>" width="150" class="img-responsive img-circle" />
				<h4><?php echo $prod_detail['name'];?></h4>
                <p><?php echo $prod_detail['description'];?>
                <input type="hidden" name="product_<?php echo $prod_detail['guid'];?>" id="product_<?php echo $prod_detail['guid'];?>" value="<?php if(empty($chk['guid'])){echo "0";}else{echo $chk['cquantity'];}?>">
                <input type="hidden" name="price_<?php echo $prod_detail['guid'];?>" id="price_<?php echo $prod_detail['guid'];?>" value="<?php echo $prod_detail['sprice'];?>">
                <input type="hidden" name="total_price" id="total_price" value="<?php if($total==''){echo "0";}else{echo $total;}?>">
		<input type="hidden" name="cart" id="cart" class="cart" value="<?php echo $cart;?>"></p>
				<div class="clearfix"></div><br>
			</div>
        </article>
    </section>
    <section class="animsition item bg-pink content-part" data-animsition-in-class="fade-in-down-sm" data-animsition-out-class="fade-out-down-sm" data-animsition-in-duration="2000">
        <article>
			<div class="col-xs-12 text-small">
				<div class="col-xs-6 no-padd" align="left"><h4><br> <?php echo $prod_detail['quantity'];?></h4> </div>
				<div class="col-xs-6 no-padd" align="right"><h1><small> <i class="fa fa-inr" style="color: #333;"></i> </small><?php echo $prod_detail['sprice'];?></h1> </div>
				<div class="clearfix"></div>
                
               
				<hr style="height:0px; border-bottom:1px dashed #999;"><br>
				<div class="col-xs-12 pull-right" style="font-size: 16px; text-align: right;">
					<div class="col-xs-4"><span class="removeproduct" id="<?php echo $prod_detail['guid'];?>"><i class="fa fa-minus-square-o pull-left"></i></span></div>
					<div class="col-xs-4">&nbsp;<span id="product<?php echo $prod_detail['guid'];?>"><?php if(empty($chk['guid'])){echo "0";}else{echo $chk['cquantity'];}?></span>&nbsp;</div>
					<div class="col-xs-4"><span class="addproduct" id="<?php echo $prod_detail['guid'];?>"><i class="fa fa-plus-square-o pull-right"></i></span></div>
				</div>
				<div class="clearfix"></div><br>
				<div class="col-xs-12 no-padd pull-right" style="font-size: 16px; text-align: right;">
					<a href="store-checkout.php" class="btn btn-success col-xs-12"><i class="fa fa-cart-plus"></i> Checkout</a>
				</div>
				
			  </div>
            </div>
        </article>
    </section>

    
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
  </script>
  <script>
  $(document).ready(function() {
    $('.animsition').animsition({
      inClass:'zoom-in-sm',
      outClass:'zoom-out-sm'
    })
    .one('animsition.inStart',function(){
      $(this).append('');
      console.log('event -> inStart');
    })
    .one('animsition.inEnd',function(){
      $('.target', this).html('');
      console.log('event -> inEnd');
    });
  });
  $('body').on('click','.addproduct',function(){
		
		var thisID = $(this).attr('id');
		var pid='product_'+thisID;
		var prd=$('#'+pid).val();
		var crt=$('#cart').val();
		if(prd==0){var newcrt=parseInt(crt)+1;
		$('#cart').val(newcrt);
		$('.cart').html(newcrt);}
		var newprd=parseInt(prd)+1;
		$('#'+pid).val(newprd);
		$('#'+'product'+thisID).html(newprd);
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
		});
			});
			$('body').on('click','.removeproduct',function(){
		
		var thisID = $(this).attr('id');
		var pid='product_'+thisID;
		var prd=$('#'+pid).val();
		var crt=$('#cart').val();
		if(prd==1){var newcrt=parseInt(crt)-1;
		$('#cart').val(newcrt);
		$('.cart').html(newcrt);}
		if(prd>0){
		var newprd=parseInt(prd)-1;
		$('#'+'product'+thisID).html(newprd);
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
  
  
  
</body>
</html>