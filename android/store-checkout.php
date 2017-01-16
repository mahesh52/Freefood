<?php
ob_start();
include 'config.php';
$date_new = date("Y-m-d");
 $date_new = strtotime(date("Y-m-d", strtotime($date_new)) . " +1 day");

$details = mysql_fetch_array(mysql_query("select * from register where guid='$_COOKIE[sessid]'"));
if ($details['guid'] == '') {
    header('location:login.php');
}
?>
<?php include 'header.php'; ?>
<script type="text/javascript" src="assets/js/jquery-2.1.4.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />

      
        <style>
            .button_full{
                 background-color: #b40406;
    border: 0 none !important;
    clear: both;
    float: left;
    font-size: 14px;
    font-weight: 700;
    margin: 0 41px 16px 36px;
    padding: 7px 0 7px 2%;
    width: 99%;
            }
            h4.checkout_title{
                margin-left:43px;
            }
           .modal-backdrop{
                z-index:11 !important;
            }
        </style>
        
<?php

$cartqntynew = mysql_fetch_array(mysql_query("select sum(cquantity) as items from cart where session_id='$_COOKIE[sessid]' and order_id='' and sid>0"));

if($_COOKIE["sessid"] == ""){
    $cart = 0;
}else{
   $cart = mysql_num_rows(mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and sid>0"));
}


?>

<div class="pages">
     
     <form name="form2" method="post" action="storeorder.php" >
    <div data-page="cart" class="page no-toolbar no-navbar">
       
        <div class="page-content">

            <div class="navbarpages whitebg bottomborder">
                <div class="navbar_left">
                    <div class="logo_image"><a href="index.php"><img src="images/logo-small.png" alt="" title=""/></a></div>
                </div>			
                <a href="#" data-panel="left" class="open-panel">
                    <div class="navbar_right"><img src="images/icons/black/menu.png" alt="" title="" /></div>
                </a>
                 <?php if($_COOKIE["sessid"] == ""){ ?>
                    <a href="login.php" class="close-panel" data-view=".view-main">
                    <div class="navbar_right whitebg"><img src="images/icons/black/cart.png" alt="" title="" /><span class='badge' id ="cartview" ><?php echo $cart; ?></span></div>
                </a>
                <?php } else{ ?>
                <a href="store-checkout.php" class="close-panel" data-view=".view-main">
                    <div class="navbar_right whitebg"><img src="images/icons/black/cart.png" alt="" title="" /><span class='badge' id ="cartview" ><?php echo $cart; ?></span></div>
                </a>
                 <?php }  ?>						
            </div>

            <div class="col-xs-10 text-small" align="center"><?php
                if (isset($_GET['msg']) && $_GET['msg'] != '') {
                    echo $_GET['msg'];
                } else {
                    echo "Checkout";
                }
                ?></div> 
          
            <?php
            $wat = 0;
            $credit = mysql_fetch_array(mysql_query("select ifnull(sum(points),0) from wallet where userid='$_COOKIE[sessid]' and status='Credit'"));
            $debit = mysql_fetch_array(mysql_query("select ifnull(sum(points),0) from wallet where userid='$_COOKIE[sessid]' and status='Debit'"));
            $wat = $credit[0] - $debit[0];
            ?>

            <div id="pages_maincontent">
<h2 class="page_title2"><a href="home-store.php"><i class="fa fa-angle-left" aria-hidden="true"></i><i class="fa fa-angle-left" aria-hidden="true"></i><i class="fa fa-angle-left" aria-hidden="true"></i><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                    <span class="page-title-head">&nbsp;&nbsp;Store</span></h2>
                <h2 class="page_title">Shopping Cart <span> <?php echo $cart; ?> Item (s) </span></h2>


                <div class="page_single layout_fullwidth_padding">	
                    <?php
                    if ($cart > 0) {
                        $m = 0;
                        $total = 0;
                        $discount = 0;
                        $qry = mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and sid>0") or die('error');
                        while ($row = mysql_fetch_assoc($qry)) {
                            $m++;
                            $total = $total + $row['ctotal'];
                            $chk = mysql_fetch_array(mysql_query("select * from storeproducts where guid='$row[sid]'"));
                            $img = mysql_fetch_array(mysql_query("select * from imagefiles where sid='$chk[guid]'"));
                            $discount = $discount + (($chk['sprice'] - $chk['mprice']) * $row['cquantity']);
                            ?>
                            <div class = "cartcontainer">
                                <div class = "cart_item" id = "cartitem1">
                                    <div class = "item_title"><span><?php echo $m; ?>.</span> <?php echo $chk['name']; ?></div>
                                    <?php
                                    $fqty = 0;
                                    $chkqty[0] = 0;
                                    $cartqty[0] = 0;
                                    $chkqty = mysql_fetch_array(mysql_query("select sum(quantity) from store_vendor_quantity where product_id='$chk[guid]'"));
                                    $cartqty = mysql_fetch_array(mysql_query("select sum(cquantity) from cart where sid='$chk[guid]' and order_id!=''"));
                                    $fqty = $chkqty[0] - $cartqty[0];
                                    ?>

                                    <div class = "item_price"><i class="fa fa-inr"></i><span id="ctot<?php echo $chk['guid']; ?>"><?php echo $row['ctotal']; ?></span></div>
                                    <div class = "item_thumb"><a href = "#" class = "close-panel">
                                            <img height ="120px" width = "120px" src="uploaded_files/<?php echo $img['image']; ?>"  alt = "" title = "" />
                                        </a></div>
                                    <div class = "item_qnty">

                                        <label>Quntity</label>
                                        <input type = "button" value = "-" class = "qntyminus removeproduct" id="<?php echo $chk['guid']; ?>" field = "quantity" />
                                        <input id="product<?php echo $chk['guid']; ?>" type = "text" name = "quantity" value = "<?php if (empty($chk['guid'])) {
                                echo "0";
                            } else {
                                echo $row['cquantity'];
                            }
                            ?>" class = "qnty" />
                                        <input type = "button" value = "+" class = "qntyplus addproduct" id="<?php echo $chk['guid']; ?>" field = "quantity" />
                                        <input type="hidden" name="product_<?php echo $chk['guid']; ?>" id="product_<?php echo $chk['guid']; ?>" value="<?php if (empty($chk['guid'])) {
                                echo "0";
                            } else {
                                echo $row['cquantity'];
                            } ?>">
                                        <input type="hidden" name="price_<?php echo $chk['guid']; ?>" id="price_<?php echo $chk['guid']; ?>" value="<?php echo $chk['sprice']; ?>">
                                        <input type="hidden" name="qty_<?php echo $row['guid']; ?>" id="qty_<?php echo $chk['guid']; ?>" value="<?php echo $fqty; ?>">
                                    </div>

                                </div>


                            </div>
        <?php
    }
}
?>
                    <div class="carttotal">
                        <div class="carttotal_row">
                            <div class="carttotal_left">Cart Total</div>  <div class="carttotal_right">
                                <i class="fa fa-inr"></i> <span class="total_shipping"><?php echo $total; ?></span>
                            </div>
                             <?php if($wat>0){?>
                            <div class="carttotal_row">
                                <div class="carttotal_left">Free Food Points</div>  <div class="carttotal_right"><?php //echo $wat; ?>
                                <input type="radio" name="points" value="yes" />
                                </div>
                                
                            </div>
                             <input type="hidden" name="discount" value="<?php echo $discount;?>" />
                              <?php }?>
                             <?php 
				$cmn=mysql_fetch_array(mysql_query("select * from commissions order by guid desc limit 0,1"));
		$credit1=mysql_fetch_array(mysql_query("select sum(points) from virtualwallet where userid='$_COOKIE[sessid]' and status='Credit'"));
		$debit1=mysql_fetch_array(mysql_query("select sum(points) from virtualwallet where userid='$_COOKIE[sessid]' and status='Debit'"));
		$wat1=$credit1[0]-$debit1[0];
		if($wat1>=$cmn['amount'] && $wat1>0){?>
                        
                             <input type="hidden" name="special_discount" value="<?php echo $wat1;?>" />
                        <?php }?>
                        </div>
                        <div class="carttotal_row_last">
                            <div class="carttotal_left">Total</div> <div class="carttotal_right"><i class="fa fa-inr"></i> <span class="total_shipping"><?php echo $total; ?></span></div>
                            <div class="carttotal_left" style="font-size:12px; font-weight:normal; color:gray;">Total No of Items</div>  <div class="carttotal_right"  style="font-size:12px; font-weight:bold; color:gray;"><?php echo $cartqntynew["items"] ?></div>
							<div class="carttotal_left" style="font-size:12px; font-weight:normal; color:gray;width:100%;">(For items below INR 250 purchase, INR 20 will be charged extra)</div>  
                        </div>
                        
                    </div>

                </div>
              
                
                    <div align="center" style="width: 85%;" >
                        
                            <a  role="button" data-toggle="collapse" 
                               href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                <h4 class="checkout_title">Delivery Address <i class="fa fa-edit"></i></h4>
                            </a>
                       
                       
                            <div class="collapse" id="collapseExample">
                                 <div class="contactform" style = "margin-left:10%" >
                                     <input type="hidden" class="form-control" placeholder="deliverytime" name="deliverytime" id="deliverytime" value="<?php echo date('d-m-y',$todate);?> 7.30PM-10.00PM">
                                            <input type="text" class="form_input required" placeholder="Full Name" name="name" required value="<?php echo $details['name']; ?>"><br>
                                            
                                            <input type="email" class="form_input required" placeholder="Email" name="email"  readonly required value="<?php echo $details['email']; ?>">
                                            <input type="number" class="form_input required" placeholder="Mobile" name="mobile" readonly required value="<?php echo $details['mobile']; ?>">
                                            <input type="text" class="form_input required" placeholder="Address" name="address" required value="<?php echo $details['address']; ?>"><br>
                                            <input type="text" class="form_input required" placeholder="Pincode" name="pincode" required value="<?php echo $details['pincode']; ?>"><br>
                                            <input type="text" class="form_input required" placeholder="City" name="city" required value="<?php echo $details['city']; ?>"><br>
                                            <input type="text" class="form_input required"  placeholder="Area" name="state" required value="<?php echo $details['state']; ?>"><br>
                                           Set as Delivery Address <input type="checkbox" checked>
                             
                               
                               
                                 
                               

                            </div>
                                 </div>
                         <a style="margin-left: 14%; width: 95%; text-decoration: none; padding: 7px;" class="button_full btyellow" href="javascript:void0;"  data-toggle="modal" data-target=".bs-example-modal-sm" >
                    <span class="delivery"><?php echo date('D',$date_new);echo ","; echo date('d-m-y',$date_new);?> 7.30PM-10.00PM</span>
                    <i class="fa fa-edit"></i></a>
     <button  type="submit" name="submit" value="proceed" class="button_full btyellow">Proceed</button>
                        </div>

            </div>
             
        </div>
    </div>
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
  </form>
</div>
    <script>
        function myFunction()
        {
            $('#myModal').modal();


        }
    </script>
    <script>
       
        $('.deliverytime').click(function () {
            //alert(5);
            var vals = document.form2.delivery.value;
            if (vals == '') {
                alert("Please Choose Delivery Time");
                window.location = "store-checkout.php";
            }
            $('.delivery').html(vals);
            $('#deliverytime').val(vals);
        });
        $('body').on('click', '.addproduct', function () {

            var thisID = $(this).attr('id');
            var chkqty = 'qty_' + thisID;
            var chkqy = $('#' + chkqty).val();
            var pid = 'product_' + thisID;
            var prd = $('#' + pid).val();
            var crt = $('#cart').val();
            if (prd == 0) {
                var newcrt = parseInt(crt) + 1;
                $('#cart').val(newcrt);
                $('#cartview').html(newcrt);
            }
            var newprd = parseInt(prd) + 1;
            if (chkqy >= newprd) {
                $('#' + pid).val(newprd);
                $('#' + 'product' + thisID).val(newprd);
                $('.' + pid).html('<b style="font-size:13px;">' + newprd + '</b>');
                var pic = 'price_' + thisID;
                var prc = $('#' + pic).val();
                var tot = $('#total_price').val();
                var newprice = parseInt(tot) + parseInt(prc);
                $('#total_price').val(newprice);
                $('.total_price').html(newprice);
                var newpic = 'newprice_' + thisID;
                $('.' + newpic).html(newprd * prc);
                if (newprice > 0) {
                    $('#footer').show();
                } else {
                    $('#footer').hide();
                }
                $.ajax({
                    type: "post",
                    dataType: "text",
                    url: "storecart.php",
                    data: "guid=" + thisID + "&qty=" + newprd + "&price=" + prc,
                    success: function (response) {
                        var ctot = 'ctot' + thisID;
                        var spt = response.split('*');
                        $('.total_shipping').html(spt[0]);
                        $('.shipping').html(spt[1]);
                        $('.shipping_total').html(spt[2]);
                        $('#' + ctot).html(spt[4]);


                    }
                });
            } else {
                alert("No More Stock Available");
            }
        });
        $('body').on('click', '.removeproduct', function () {

            var thisID = $(this).attr('id');
            var pid = 'product_' + thisID;
            var ctot = 'ctot' + thisID;
            var prd = $('#' + pid).val();
            var crt = $('#cart').val();
            if (prd == 1) {
                var newcrt = parseInt(crt) - 1;
                $('#cart').val(newcrt);
                $('.cart').html(newcrt);
            }
            if (prd > 0) {
                var newprd = parseInt(prd) - 1;
                $('#' + 'product' + thisID).val(newprd);
                $('#' + pid).val(newprd);
                $('.' + pid).html('<b style="font-size:13px;">' + newprd + '</b>');
                var pic = 'price_' + thisID;
                var prc = $('#' + pic).val();
                var tot = $('#total_price').val();
                var newprice = parseInt(tot) - parseInt(prc);
                $('#total_price').val(newprice);
                $('.total_price').html(newprice);
                var newpic = 'newprice_' + thisID;
                $('.' + newpic).html(newprd * prc);
                if (newprice > 0) {
                    $('#footer').show();
                } else {
                    $('#footer').hide();
                }
                $.ajax({
                    type: "post",
                    dataType: "text",
                    url: "storecart.php",
                    data: "guid=" + thisID + "&qty=" + newprd + "&price=" + prc,
                    success: function (response) {
                        var ctot = 'ctot' + thisID;
                        var spt = response.split('*');
                        $('.total_shipping').html(spt[0]);
                        $('.shipping').html(spt[1]);
                        $('.shipping_total').html(spt[2]);
                        $('#' + ctot).html(spt[4]);

                    }
                });
            }
        });
    </script>
     


</body>
         
            <script type="text/javascript" src="js/framework7.js"></script>
            <script type="text/javascript" src="js/my-app.js"></script>  
</html>