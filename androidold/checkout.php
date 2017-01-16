<?php ob_start();
include 'config.php';$date=date('Y-m-d');
$details=mysql_fetch_array(mysql_query("select * from register where guid='$_COOKIE[sessid]'"));
if($details['guid']==''){header('location:login.php');}?><!DOCTYPE HTML>
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
            <div class="col-xs-1"><a href="category.php" class="text-white"><i class="fa fa-angle-left"></i></a></div>
            <div class="col-xs-10 text-small" align="center"><?php if($_GET['msg']!=''){echo $_GET['msg'];}else{echo "Checkout";}?></div>
            <div class="col-xs-1"></div>
        </article>
    </section>
    <br />
    <section class="animsition item bg-pink content-part" data-animsition-in-class="fade-in-down-sm" data-animsition-out-class="fade-out-down-sm" data-animsition-in-duration="2000">
        <article>
        <form name="form2" method="post" action="placeorder.php">
            <div class="col-xs-12 no-padd">
            <?php $cart=mysql_num_rows(mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0"));
					if($cart==0){echo "<br><h1>No Products</h1>";}else{
			  $qry=mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0") or die('error');
			  while($row=mysql_fetch_assoc($qry))
			  {
				   $chk=mysql_fetch_array(mysql_query("select * from products where guid='$row[pid]'"));
				   $img=mysql_fetch_array(mysql_query("select * from imagefiles where cid='$chk[guid]'"));?>
                <div class="col-xs-3 padd-sm" align="center">
                    <img src="uploaded_files/<?php echo $img['image'];?>" class="img-responsive img-circle br" />
                </div>
                <?php } }?>
                <div class="col-xs-12 padd-sm text-small" align="center"><br />
                    <ul class="list-group">
                      <?php if($cart>0){$m=0;$total=0;$discount=0;
						   $qry=mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0") or die('error');
			  while($row=mysql_fetch_assoc($qry))
			  {$m++;$total=$total+$row['ctotal'];
				   $chk=mysql_fetch_array(mysql_query("select * from products where guid='$row[pid]'"));
				   $discount=$discount+(($chk['sprice']-$chk['mprice'])*$row['cquantity']);?><li class="list-group-item">
                          <span class="pull-left"><?php echo $m;?>. <?php echo $chk['name'];?> 
                          
                          <span class="removeproduct" id="<?php echo $chk['guid'];?>"><i class="fa fa-minus-square-o"></i></span>&nbsp;<span id="product<?php echo $chk['guid'];?>"><?php if(empty($chk['guid'])){echo "0";}else{echo $row['cquantity'];}?></span>&nbsp;<span class="addproduct" id="<?php echo $chk['guid'];?>"><i class="fa fa-plus-square-o"></i></span>
                          <?php $fqty=0;
         $chkqty[0]=0;$cartqty[0]=0;
         $chkqty=mysql_fetch_array(mysql_query("select sum(quantity) from vendor_quantity where product_id='$chk[guid]' and date='$date'"));
		 $cartqty=mysql_fetch_array(mysql_query("select sum(cquantity) from cart where pid='$chk[guid]' and date='$date' and order_id!=''"));
		 $fqty=$chkqty[0]-$cartqty[0];?>
                          <input type="hidden" name="product_<?php echo $chk['guid'];?>" id="product_<?php echo $chk['guid'];?>" value="<?php if(empty($chk['guid'])){echo "0";}else{echo $row['cquantity'];}?>">
                <input type="hidden" name="price_<?php echo $chk['guid'];?>" id="price_<?php echo $chk['guid'];?>" value="<?php echo $chk['sprice'];?>">
                <input type="hidden" name="qty_<?php echo $row['guid'];?>" id="qty_<?php echo $chk['guid'];?>" value="<?php echo $fqty;?>">
                
                          </span>
                          <span class="pull-right"><i class="fa fa-inr"></i> <span id="ctot<?php echo $chk['guid'];?>"><?php echo $row['ctotal'];?></span></span>
                          
                          <div class="media box"><div class="media-body"> 
                <div class="col-xs-6 pull-right" style="font-size: 16px; text-align: right;"></div></div> </div>
                          
                          <div class="clearfix"></div>
                      </li><?php }} ?>
                      <li class="list-group-item list-group-item-success">
                          <b><span class="pull-left">Total</span>
                          <span class="pull-right"><i class="fa fa-inr"></i> <span class="total_shipping"><?php echo $total;?></span></span>
                          <div class="clearfix"></div></b>
                      </li>
                    </ul>
                </div>
                <div class="col-xs-12 padd-sm text-small" align="center">
					<a class="btn btn-success col-xs-12" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><span class="pull-left">Delivery Address</span> <span class="pull-right"><i class="fa fa-edit"></i></span></a>
					<div class="collapse" id="collapseExample">
					  <div class=""><br><br>
						<ul class="list-group">
						  <li class="list-group-item">
							  <input type="text" class="form-control" placeholder="Full Name" name="name" required value="<?php echo $details['name'];?>"><br>
							  <div class="col-xs-6 no-padd"><input type="email" class="form-control" placeholder="Email" name="email"  readonlyrequired value="<?php echo $details['email'];?>"><br></div>
							  <div class="col-xs-6 no-padd"><input type="number" class="form-control" placeholder="Mobile" name="mobile" readonly required value="<?php echo $details['mobile'];?>"><br></div>
							  <input type="text" class="form-control" placeholder="Address" name="address" required value="<?php echo $details['address'];?>"><br>
                              <input type="text" class="form-control" placeholder="Pincode" name="pincode" required value="<?php echo $details['pincode'];?>"><br>
							  <input type="text" class="form-control" placeholder="City" name="city" required value="<?php echo $details['city'];?>"><br>
							  <input type="text" class="form-control" placeholder="Area" name="state" required value="<?php echo $details['state'];?>"><br>
							  <div class="clearfix"></div>
						  </li>
						  <li class="list-group-item list-group-item-success">
							  <b><span class="pull-left">Set as Delivery Address</span>
							  <span class="pull-right"><input type="checkbox"></span>
							  <div class="clearfix"></div></b>
						  </li>
						</ul>
					  </div>
					</div>
				</div>
                <div class="col-xs-12 padd-sm text-small" align="center">
                    <button type="submit" name="submit" value="proceed" class="btn btn-success col-xs-12">Proceed</button>
                </div>
            </div></form>
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
						   $('#'+ctot).html(spt[4]);
						   
						   
					   }
		});}else{alert("No More Stock Available");}
			});
			$('body').on('click','.removeproduct',function(){
		
		var thisID = $(this).attr('id');
		var pid='product_'+thisID;
		var ctot='ctot'+thisID;
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
						   $('#'+ctot).html(spt[4]);
						  
					   }
					   });
		}
			});
  </script>
  
  
  
</body>
</html>