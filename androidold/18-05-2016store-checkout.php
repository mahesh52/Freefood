<?php ob_start();
include 'config.php';
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

<body onload="myFunction()">
    <?php include 'menu.php';?>
    <header>
        <div class="col-xs-1 padd-sm" id="left-nav"><a href="javascript:void0;" class="pull-right menu-icon button-1"><i class="fa fa-align-center"></i></a></div>
        <div class="col-xs-6 no-padd"><a href="index.php"><img src="assets/images/logo1.png" class="img-responsive" width="110"/></a></div>
    </header>
    
    
    <section class="status-bar">
        <article>
            <div class="col-xs-1"><a href="home-store.php" class="text-white"><i class="fa fa-angle-left"></i></a></div>
            <div class="col-xs-10 text-small" align="center">Checkout</div>
            <div class="col-xs-1"></div>
        </article>
    </section>
    <form name="form2" method="post" action="storeorder.php">
	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" id="myModal" aria-labelledby="mySmallModalLabel" style="z-index:999948; margin-top:60px;">
	  <div class="modal-dialog modal-sm">
		
        <div class="modal-content">
		  <div class="modal-body">
			<span><?php $date = date("Y-m-d");
$date = strtotime(date("Y-m-d", strtotime($date)) . " +1 day");
echo date('D',$date);echo ","; echo date('d-m-y',$date);
$date2=date('Y-m-d H:i:s');$date1=date('Y-m-d ');
 $str=new DateTime($date2);
$str1=new DateTime($date1.'9:30:00');
$str2=new DateTime($date1.'12:00:00');
$str3=new DateTime($date1.'19:30:00');
$str4=new DateTime($date1.'22:00:00');?></span>
			<ul class="list-group text-small">
			  <li class="list-group-item">
				  <span class="pull-left"><i class="fa fa-clock-o"></i> 7.30AM-9.30AM</span>
				  <span class="pull-right">
                  <input type="radio" name="delivery" value="<?php echo date('D',$date);echo ","; echo date('d-m-y',$date);?> 7.30AM-9.30AM" class="pull-right" <?php if($str1<$str){echo "disabled";}?>/></span>
				  <div class="clearfix"></div>
			  </li>
			  <li class="list-group-item">
				  <span class="pull-left"><i class="fa fa-clock-o"></i> 9.30AM-12.00PM</span>
				  <span class="pull-right">
                  <input type="radio" value="<?php echo date('D',$date);echo ","; echo date('d-m-y',$date);?> 9.30AM-12.00PM" name="delivery" class="pull-right" <?php if($str2<$str){echo "disabled";}?>/></span>
				  <div class="clearfix"></div>
			  </li>
			  <li class="list-group-item">
				  <span class="pull-left"><i class="fa fa-clock-o"></i> 5.00PM-7.30PM</span>
				  <span class="pull-right">
                  <input type="radio" name="delivery" value="<?php echo date('D',$date);echo ","; echo date('d-m-y',$date);?> 5.00PM-7.30PM" class="pull-right" <?php if($str3<$str){echo "disabled";}?>/></span>
				  <div class="clearfix"></div>
			  </li>
			  <li class="list-group-item">
				  <span class="pull-left"><i class="fa fa-clock-o"></i> 7.30PM-10.00PM</span>
				  <span class="pull-right">
                  <input type="radio" name="delivery" value="<?php echo date('D',$date);echo ","; echo date('d-m-y',$date);?> 7.30PM-10.00PM" class="pull-right" <?php if($str4<$str){echo "disabled";}?>/></span>
				  <div class="clearfix"></div>
			  </li>
			</ul>
			
			<span><?php
$todate = strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . " +2 day");
echo date('D',$todate);echo ","; echo date('d-m-y',$todate);

?></span>
			<ul class="list-group text-small">
			  <li class="list-group-item">
				  <span class="pull-left"><i class="fa fa-clock-o"></i> 7.30AM-9.30AM</span>
				  <span class="pull-right">
                  <input type="radio" name="delivery" value="<?php echo date('D',$todate);echo ","; echo date('d-m-y',$todate);?> 7.30AM-9.30AM" class="pull-right" /></span>
				  <div class="clearfix"></div>
			  </li>
			  <li class="list-group-item">
				  <span class="pull-left"><i class="fa fa-clock-o"></i> 9.30AM-12.00PM</span>
				  <span class="pull-right">
                  <input type="radio" name="delivery" value="<?php echo date('D',$todate);echo ","; echo date('d-m-y',$todate);?> 9.30AM-12.00PM" class="pull-right"/></span>
				  <div class="clearfix"></div>
			  </li>
			  <li class="list-group-item">
				  <span class="pull-left"><i class="fa fa-clock-o"></i> 5.00PM-7.30PM</span>
				  <span class="pull-right">
                  <input type="radio" name="delivery" value="<?php echo date('D',$todate);echo ","; echo date('d-m-y',$todate);?> 5.00PM-7.30PM" class="pull-right"/></span>
				  <div class="clearfix"></div>
			  </li>
			  <li class="list-group-item">
				  <span class="pull-left"><i class="fa fa-clock-o"></i> 7.30PM-10.00PM</span>
				  <span class="pull-right">
                  <input type="radio" checked name="delivery" value="<?php echo date('D',$todate);echo ","; echo date('d-m-y',$todate);?> 7.30PM-10.00PM" class="pull-right"/></span>
				  <div class="clearfix"></div>
			  </li>
			</ul>
			
			<a href="" data-dismiss="modal" class="btn btn-success btn-sm pull-right deliverytime">Choose</a>
			<div class="clearfix"></div>
		  </div>
		</div>
	  </div>
	</div>
    <section class="animsition item bg-pink content-part" data-animsition-in-class="fade-in-down-sm" data-animsition-out-class="fade-out-down-sm" data-animsition-in-duration="2000">
        <article>
        <?php $cart=mysql_num_rows(mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and sid>0"));
					?>
            <div class="col-xs-12 no-padd">
                
                <?php $wat=0;
				$credit=mysql_fetch_array(mysql_query("select sum(points) from wallet where userid='$_COOKIE[sessid]' and status='Credit'"));
				$debit=mysql_fetch_array(mysql_query("select sum(points) from wallet where userid='$_COOKIE[sessid]' and status='Debit'"));
				$wat=$credit[0]-$debit[0];?>
                
                <div class="col-xs-12 padd-sm text-small" align="center"><br />
                    <ul class="list-group">
                      <?php if($cart>0){$m=0;$total=0;$discount=0;
						   $qry=mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and sid>0") or die('error');
			  while($row=mysql_fetch_assoc($qry))
			  {$m++;$total=$total+$row['ctotal'];
				   $chk=mysql_fetch_array(mysql_query("select * from storeproducts where guid='$row[sid]'"));
				   $discount=$discount+(($chk['sprice']-$chk['mprice'])*$row['cquantity']);?><li class="list-group-item">
                          <span class="pull-left"><?php echo $m;?>. <?php echo $chk['name'];?> (<?php echo $row['cquantity'];?>)</span>
                          <span class="pull-right"><i class="fa fa-inr"></i> <?php echo $row['ctotal'];?></span>
                          <div class="clearfix"></div>
                      </li><?php }} ?>
                      <li class="list-group-item list-group-item-success">
                          <b><span class="pull-left">Total</span>
                          <span class="pull-right"><i class="fa fa-inr"></i> <?php echo $total;?></span>
                          <div class="clearfix"></div></b>
                      </li>
                    </ul>
                </div>
                <div class="col-xs-12 padd-sm text-small" align="center">
                    <ul class="list-group">
                      <li class="list-group-item list-group-item-success">
                          <span class="pull-left">Free Food Points</span>
                          <span class="pull-right">&nbsp;</span>
                          <div class="clearfix"></div>
                      </li>
                      <li class="list-group-item">
                          <span class="pull-left"><i class="fa fa-database"></i> <?php echo $wat; ?></span>
                          <span class="pull-right"><input type="checkbox" name="points" value="yes" />
                          <input type="hidden" name="discount" value="<?php echo $discount;?>" /></span>
                          <div class="clearfix"></div>
                      </li>
                    </ul>
                </div>
               
                <div class="col-xs-12 padd-sm text-small" align="center">
					<a class="btn btn-success col-xs-12" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><span class="pull-left">Delivery Address</span> <span class="pull-right"><i class="fa fa-edit"></i></span></a>
					<div class="collapse" id="collapseExample">
					  <div class=""><br><br>
						<ul class="list-group">
						  <li class="list-group-item">
                          <input type="hidden" class="form-control" placeholder="deliverytime" name="deliverytime" id="deliverytime" value="<?php echo date('d-m-y',$todate);?> 7.30PM-10.00PM">
							  <input type="text" class="form-control" placeholder="Full Name" name="name" required value="<?php echo $details['name'];?>"><br>
							  <div class="col-xs-6 no-padd"><input type="email" class="form-control" placeholder="Email" name="email" readonly required value="<?php echo $details['email'];?>"><br></div>
							  <div class="col-xs-6 no-padd"><input type="number" class="form-control" placeholder="Mobile" name="mobile"  required value="<?php echo $details['mobile'];?>"><br></div>
							  <input type="text" class="form-control" placeholder="Address" name="address" required value="<?php echo $details['address'];?>"><br>
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
					<a href="javascript:void0;"  data-toggle="modal" data-target=".bs-example-modal-sm" class="btn btn-success col-xs-12">
                    <span class="pull-left delivery"><?php echo date('D',$date);echo ","; echo date('d-m-y',$date);?> 7.30PM-10.00PM</span> <span class="pull-right"><i class="fa fa-edit"></i></span></a>
				</div>
            </div>
        </article>
    </section>
	<div class="clearfix"></div><br><br><br>
	
	<section>
		<article>
			<div class="cart-value1">
				<div class="col-xs-12 foot-c gap-top" align="center">
					<button type="submit" name="submit" value="proceed" class="btn btn-primary  checkout">&nbsp;&nbsp;<b>Checkout</b>&nbsp;&nbsp;</button>
				</div>
			</div>
		</article>
	</section>
    </form>
  <script src="assets/js/animsition.min.js" charset="utf-8"></script>
    <script>
	  function myFunction()
	  {
	  	$('#myModal').modal();
   

	  }
    </script>
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
  $('.deliverytime').click(function(){
	  var vals=document.form2.delivery.value;
	  if(vals==''){alert("Please Choose Delivery Time");
	  window.location="store-checkout.php";}
	  $('.delivery').html(vals);
	  $('#deliverytime').val(vals);
	  });
  </script>
  
  
  
</body>
</html>