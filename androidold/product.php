<?php ob_start();
include 'config.php';$date=date('Y-m-d');
$ft=time(); $st=md5($ft);
if(empty($_COOKIE['sessid']))
{
setcookie("sessid" ,$st, mktime (0, 0, 0, 12, 31, 2020));
}?><!DOCTYPE HTML>
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
    
    <div class="header1">
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		  <!-- Indicators -->
		  <ol class="carousel-indicators">
			<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			<li data-target="#carousel-example-generic" data-slide-to="1"></li>
		  </ol>

		  <!-- Wrapper for slides -->
		  <div class="carousel-inner" role="listbox">
			<div class="item active">
			  <img src="assets/images/pbg.jpg" style="height: 180px;"/>
			</div>
			<div class="item">
			  <img src="assets/images/pbg.jpg" style="height: 180px;"/>
			</div>
		  </div>
		</div>
    </div>
    
    <?php $det=mysql_fetch_array(mysql_query("select * from foodcategory where guid='$_GET[pid]'"));?>
    <section class="status-bar1">
        <article>
            <div class="col-xs-1"><a href="food-category.php?gid=<?php echo $det['refid'];?>"><i class="fa fa-angle-left"></i></a></div>
            <div class="col-xs-9 text-small"><?php echo $det['name'];?></div>
            <div class="col-xs-1 no-apdd" align="right"><a href="javascript:void(0)" class="text-small text-white search-btn"><i class="fa fa-search text-white"></i></a>
            </div>
        </article>
    </section>
    <div class="search" style="margin-top:-131px; display:none; position:absolute; z-index: 10003;">
	  <div class="col-sm-12 col-md-8 col-md-offset-2 no-padd">
		<div class="input-group">
        <form name="form1" method="get" action="product.php">
          
          <span class="input-group-btn">
          <input type="text" name="search" class="form-control" placeholder="Find Food..." style="border-radius:0px;">
          <input type="hidden" name="pid" value="<?php echo $_GET['pid'];?>">
            <button style="height: 34px; border-radius:0px;" class="btn btn-default home-btn" type="submit"><i class="fa fa-map-marker"></i></button>
          </span>
          </form>
        </div><!-- /input-group -->
      </div>
    </div>
    <section class="animsition item bg-pink" data-animsition-in-class="fade-in-down-sm" data-animsition-out-class="fade-out-down-sm" data-animsition-in-duration="2000">
        <article class="content-part1">
            <div class="col-xs-12 no-padd" style="margin-bottom:50px;">
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
					if($pro_total==0){echo "<br><h1>No Products</h1>";}else{
			  
			  while($row=mysql_fetch_assoc($qry))
			  {
				   $chk=mysql_fetch_array(mysql_query("select * from cart where pid='$row[guid]' and session_id='$_COOKIE[sessid]' and order_id=''"));
				   $img=mysql_fetch_array(mysql_query("select * from imagefiles where cid='$row[guid]'"));
				?>
                <div class="media box"> <div class="media-left"> <a href="item-single.php?gid=<?php echo $row['guid'];?>">
                <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="uploaded_files/<?php echo $img['image']; ?>" style="width: 64px; height: 64px;"></a> </div> <div class="media-body"><a href="item-single.php?gid=<?php echo $row['guid'];?>"> <h4 class="media-heading"><b><?php echo $row['name'];?></b><br /><small><?php echo $row['quantity'];?></small></h4><div class="clearfix"></div>
				<div class="col-xs-4 no-padd" align="left"> <i class="fa fa-inr"></i> <?php echo $row['sprice'];?>&nbsp;&nbsp;&nbsp;&nbsp;</div></a>
                <?php 
				$fqty=0;
         $chkqty[0]=0;$cartqty[0]=0;
         $chkqty=mysql_fetch_array(mysql_query("select sum(quantity) from vendor_quantity where product_id='$row[guid]' and date='$date'"));
		 $cartqty=mysql_fetch_array(mysql_query("select sum(cquantity) from cart where pid='$row[guid]' and date='$date' and order_id!=''"));
		 $fqty=$chkqty[0]-$cartqty[0];
		 ?>
                <div class="col-xs-6 pull-right" style="font-size: 16px; text-align: right;"><?php if($fqty>0){?><span class="removeproduct" id="<?php echo $row['guid'];?>"><i class="fa fa-minus-square-o"></i></span>&nbsp;<span id="product<?php echo $row['guid'];?>"><?php if(empty($chk['guid'])){echo "0";}else{echo $chk['cquantity'];}?></span>&nbsp;<span class="addproduct" id="<?php echo $row['guid'];?>"><i class="fa fa-plus-square-o"></i></span><?php }else{echo "No Stock";}?></div></div> </div>
                <input type="hidden" name="product_<?php echo $row['guid'];?>" id="product_<?php echo $row['guid'];?>" value="<?php if(empty($chk['guid'])){echo "0";}else{echo $chk['cquantity'];}?>">
                <input type="hidden" name="price_<?php echo $row['guid'];?>" id="price_<?php echo $row['guid'];?>" value="<?php echo $row['sprice'];?>">
                <input type="hidden" name="qty_<?php echo $row['guid'];?>" id="qty_<?php echo $row['guid'];?>" value="<?php echo $fqty;?>">
        <?php }} ?>
				
            </div>
            
        </article>
    </section>
    <input type="hidden" name="total_price" id="total_price" value="<?php if($total==''){echo "0";}else{echo $total;}?>">
		<input type="hidden" name="cart" id="cart" class="cart" value="<?php echo $cart;?>">
		<section id="footer" <?php if($total==0){?>style="display:none;"<?php } ?>>
		<article>
			<div class="cart-value1">
				<div class="col-xs-2 foot-l gap-top" align="center"><i class="fa fa-shopping-cart gap-top"></i></div>
				<div class="col-xs-6 foot-c gap-top"> <i class="fa fa-inr gap-top"></i> <span class="total_price"><?php echo $total;?></span> </div>
				<div class="col-xs-2 foot-r gap-top pull-right" align="center"><a href="checkout.php" class=" gap-top text-white"><i class="fa fa-sign-in gap-top"></i></a></div>
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
		$(document).ready(function(){
			$(".search-btn").click(function(){
				$(".search").slideToggle('slow');
			});
		});
	$('body').on('click','.addproduct',function(){
		
		var thisID = $(this).attr('id');
		var chkqty='qty_'+thisID;
		var chkqy=$('#'+chkqty).val();
		var pid='product_'+thisID;
		var prd=$('#'+pid).val();
		var crt=$('#cart').val();
		if(prd==0){var newcrt=parseInt(crt)+1;
		$('#cart').val(newcrt);
		$('.cart').html(newcrt);}
		var newprd=parseInt(prd)+1;
		if(chkqy>=newprd){
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
					   url:"cart.php",
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
					   url:"cart.php",
					   data:  "guid="+thisID+"&qty="+newprd+"&price="+prc,
					   success: function(response){
						    var spt=response.split('*');
						   $('.total_shipping').html(spt[0]);
						   $('.shipping').html(spt[1]);
						   $('.shipping_total').html(spt[2]);
						  
					   }
					   });
		}
			});</script>
  
  
</body>
</html>