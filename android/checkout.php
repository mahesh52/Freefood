<?php
ob_start();
include 'config.php';
$datenew = date('Y-m-d');
$details = mysql_fetch_array(mysql_query("select * from register where guid='$_COOKIE[sessid]'"));
if ($details['guid'] == '') {
    header('location:login.php');
}
?><!DOCTYPE HTML>
<?php include 'header.php'; ?>

<script type="text/javascript" src="assets/js/jquery-2.1.4.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>

    $(function () {
        //  alert();
        $('.onoffpurpose').bootstrapToggle();
    });




</script>
<style>
    .button_full{
        background-color: #b40406;
    border-left: 0 solid #b40406;
    clear: both;
    float: left;
    font-size: 14px;
    font-weight: 700;
    margin: 0 0 20px;
    padding: 7px 0 7px 4%;
    width: 95%;
	border: 0 none !important;
    }

</style>



<div class="pages">
    <form name="form2" method="post" action="placeorder.php">
        <div data-page="cart" class="page no-toolbar no-navbar">
            <div class="page-content">
                <?php
                if ($_COOKIE["sessid"] == "") {
                    $cart = 0;
                } else {
                   $cart = mysql_num_rows(mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0"));
				  // echo "select sum(cquantity) as items from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0";exit;
                $cartqntynew = mysql_fetch_array(mysql_query("select sum(cquantity) as items from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0"));
                }

                
                ?>
                <div class="navbarpages whitebg bottomborder">
                
                	<h2 class="page_title2">
				
				<a href="index.php" class="back-btn-all"><i class="fa fa-angle-left" aria-hidden="true"></i>
				<i class="fa fa-angle-left" aria-hidden="true"></i></a>
				
                    <span class="page-title-head">&nbsp;&nbsp; Checkout</span></h2>
                    		
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

                <div class="col-xs-10 text-small" align="center"><?php
                    if ($_GET['msg'] != '') {
                        echo $_GET['msg'];
                    } else {
                        echo "";
                    }
                    ?></div>    

                <div id="pages_maincontent">
                
                    <h2 class="page_title">Your Cart <span> <?php echo $cart; ?> Item (s) </span>
                       </h2>
                    
                    

                    <div class="page_single layout_fullwidth_padding">	

                        <div class="cartcontainer">       
                            <?php
                            if ($cart == 0) {
                                echo "<h1>No Products</h1>";
                            } else {
                                $m = 0;
                                $total = 0;
                                $discount = 0;
                                $qry = mysql_query("select * from cart where session_id='$_COOKIE[sessid]' and order_id='' and pid>0") or die('error');
                                while ($row = mysql_fetch_assoc($qry)) {
                                    $chk = mysql_fetch_array(mysql_query("select * from products where guid='$row[pid]'"));
                                    $img = mysql_fetch_array(mysql_query("select * from imagefiles where cid='$chk[guid]'"));
                                    $m++;
                                    $total = $total + $row['ctotal'];
                                    $chk = mysql_fetch_array(mysql_query("select * from products where guid='$row[pid]'"));
                                    $discount = $discount + (($chk['sprice'] - $chk['mprice']) * $row['cquantity']);
                                    ?>

                                    <div class="cart_item" id="cartitem1">
                                        <div class="item_title"><span><?php echo $m; ?>.</span> <?php echo $chk['name']; ?></div>
                                        <div class="item_price" > 

                                            <i class="fa fa-inr" ></i> 
                                            <span id="ctot<?php echo $chk['guid']; ?>"><?php echo $row['ctotal']; ?></span>
                                        </div>
                                        <div class="item_thumb">
                                            <a href="#" class="close-panel">
                                                <img src="uploaded_files/<?php echo $img['image']; ?>"  alt="" title="" /></a></div>
                                        <div class="item_qnty">

                                            <label>Quantity</label>
                                            <input id="<?php echo $chk['guid']; ?>" type="button" value="-" class="qntyminus removeproduct" field="quantity" />
                                            <input id="product<?php echo $chk['guid']; ?>" type="text" name="quantity" value="<?php
                            if (empty($chk['guid'])) {
                                echo "0";
                            } else {
                                echo $row['cquantity'];
                            }
                                    ?>" class="qnty" />
                                            <input type="button" value="+" class="qntyplus addproduct" id="<?php echo $chk['guid']; ?>" field="quantity" />
                                            <?php
                                            $fqty = 0;
                                            $chkqty[0] = 0;
                                            $cartqty[0] = 0;
											$sql_erfv = mysql_fetch_array(mysql_query("select * from vendor where FIND_IN_SET('$_COOKIE[area]',area)"));
										$food_vendor_id = $sql_erfv["guid"];
										$vendor_type = $sql_erfv["vendor_type"];
										if($vendor_type == "ERFV"){
												$chkqty = mysql_fetch_array(mysql_query("select available_qty from erfvstock where product_id='$chk[guid]' and erfv_vendor='$food_vendor_id'"));
											}
											else{
												 $chkqty = mysql_fetch_array(mysql_query("select sum(quantity) from vendor_quantity where product_id='$chk[guid]' and date='$datenew'"));
											}
                                           
                                            $cartqty = mysql_fetch_array(mysql_query("select sum(cquantity) from cart where pid='$chk[guid]' and date='$datenew' and order_id!=''"));
                                            $fqty = $chkqty[0] - $cartqty[0];
                                            ?>
                                            <input type="hidden" name="product_<?php echo $chk['guid']; ?>" id="product_<?php echo $chk['guid']; ?>" value="<?php
                                            if (empty($chk['guid'])) {
                                                echo "0";
                                            } else {
                                                echo $row['cquantity'];
                                            }
                                            ?>">
                                            <input type="hidden" name="price_<?php echo $chk['guid']; ?>" id="price_<?php echo $chk['guid']; ?>" value="<?php echo $chk['sprice']; ?>">
                                            <input type="hidden" name="qty_<?php echo $row['guid']; ?>" id="qty_<?php echo $chk['guid']; ?>" value="<?php echo $fqty; ?>">
                                            </div>
                                     <div>
                                            <label style="margin-left: 10%;" >Spicy Level</label> 
                                            <select align =center name ="spicy_level_<?php echo $chk['guid']; ?>" >
                                                <option value = "Low">Low</option>
                                                <option selected value = "Medium">Medium</option>
                                                <option value = "High" >High</option>
                                            </select>
                                        </div>
                                            <div  style="margin-left: 40%;" >

                                                <label>Deliver Now</label> 
        <?php
        if ($chk['prebook'] == "Yes" && $chk['order_now'] == "Yes") {
            $style = "display:none;";
            ?>
                                                    <input class = "onoffpurpose"  type="checkbox"  onchange ="loadPreorder('<?php echo $chk['guid']; ?>')"  checked   data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-size="mini" >
                                                    <input type ="hidden" name ="pre_order_status_<?php echo $chk['guid']; ?>" id ="pre_order_status_<?php echo $chk['guid']; ?>" value ="1" />
        <?php } ?>
                                                <?php if ($chk['prebook'] == "Yes" && $chk['order_now'] == "No") {
                                                    $style = "";
                                                    ?>
                                                    <input class = "onoffpurpose"  type="checkbox"  onchange ="loadPreorder('<?php echo $chk['guid']; ?>')"   disabled  data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-size="mini" >
                                                    <input type ="hidden" name ="pre_order_status_<?php echo $chk['guid']; ?>" id ="pre_order_status_<?php echo $chk['guid']; ?>" value ="0" />
                                                    <br><p style="font-size:10px">(Only Pre Booking is Available)</p>
                                                <?php } ?>
                                                <?php if ($chk['prebook'] == "No" && $chk['order_now'] == "Yes") {
                                                    $style = "display:none;";
                                                    ?>
                                                    <input class = "onoffpurpose"  type="checkbox"  onchange ="loadPreorder('<?php echo $chk['guid']; ?>')"   disabled  checked data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-size="mini" >
                                                    <input type ="hidden" name ="pre_order_status_<?php echo $chk['guid']; ?>" id ="pre_order_status_<?php echo $chk['guid']; ?>" value ="1" />
                                                    <br><p style="font-size:10px">(Pre Booking is Not Available)</p>
                                                <?php } ?>

                                            </div>
                                            <div  id = "preorder_div_<?php echo $chk['guid']; ?>" style = "<?php echo $style; ?>">
                                                <?php $time_slots = array('7:00 AM - 9:30 AM', '10:00 AM - 12:30 PM', '5:00 PM - 7:30 PM', '7:30 PM - 10:00 PM');
                                                ?> 

                                                <label>Select Delivery Slot</label> 
                                                <span id = "deliverdatediv_<?php echo $chk['guid']; ?>"><?php echo date('D', strtotime(date('Y-m-d', strtotime("+1 days")))) . " " . date('d-m-Y', strtotime(date('Y-m-d', strtotime("+1 days")))); ?></span>
                                                <select style = "margin-left:40%;" id = "optgroup_<?php echo $chk['guid']; ?>" name ="optgroup_<?php echo $chk['guid']; ?>" onchange ="showLabel('<?php echo $chk['guid']; ?>')" >
                                                    <?php
                                                    for ($i = 1; $i < 6; $i++) {
                                                        $date = date('Y-m-d', strtotime("+" . $i . " days"));
                                                        ?>
                                                        <optgroup value = "<?php echo $date; ?>" label="<?php echo date('D', strtotime($date)) . " " . date('d-m-Y', strtotime($date)); ?>">
                                                            <?php for ($j = 0; $j < sizeof($time_slots); $j++) { ?>
                                                                <option <?php if ($j == 0 && $i == 1) { ?> selected <?php } ?>  value = "<?php echo $time_slots[$j]; ?>"><?php echo $time_slots[$j]; ?></option>
                                                            <?php } ?>
                                                        </optgroup>
                                                    <?php } ?>

                                                </select>
                                                <input type ="hidden" name ="deliver_date_<?php echo $chk['guid']; ?>" id ="deliver_date_<?php echo $chk['guid']; ?>" value = "<?php echo date('D', strtotime(date('Y-m-d', strtotime("+1 days")))) . " " . date('d-m-Y', strtotime(date('Y-m-d', strtotime("+1 days")))); ?> <?php echo $time_slots[0]; ?>"/>


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
                                    <div class="carttotal_row">
                                        <div class="carttotal_left">Charges</div>  <div class="carttotal_right"><i class="fa fa-inr"></i><?php if($total < 250){?>20<?php }else{?>0<?php } ?> </div>
                                    </div>
                                </div>
                                <div class="carttotal_row_last">
                                    <div class="carttotal_left">Total</div> <div class="carttotal_right"><i class="fa fa-inr"></i> <span class="total_shipping"><?php if($total < 250){echo $total+20;?><?php }else{echo $total;?><?php } ?></span></div>
                                    <div class="carttotal_left" style="font-size:12px; font-weight:normal; color:gray;">Total No of Items</div>  <div class="carttotal_right"  style="font-size:12px; font-weight:bold; color:gray;"><?php echo $cartqntynew["items"] ?></div>
									<div class="carttotal_left" style="font-size:12px; font-weight:normal; color:gray;width:100%;">(For items below INR 250 purchase, INR 20 will be charged extra)</div>  
                                </div>
                            </div>

                        </div>

                        <div align="center">
                            <a  role="button" data-toggle="collapse" 
                                href="#collapseExample" aria-expanded="true" aria-controls="collapseExample">
                                <h4 class="checkout_title delivery-adress">Delivery Address <i class="fa fa-edit"></i></h4>
                            </a>
                            <div id="collapseExample" class="collapse in" aria-expanded="true" style="">
                                <div class="contactform">

                                    <input type="text" class="form_input required" placeholder="Full Name" name="name" required value="<?php echo $details['name']; ?>"><br>

                                    <input type="email" class="form_input required" placeholder="Email" name="email"  readonly required value="<?php echo $details['email']; ?>">
                                    <input type="number" class="form_input required" placeholder="Mobile" name="mobile" readonly required value="<?php echo $details['mobile']; ?>">
                                    <input type="text" class="form_input required" placeholder="Address" name="address" required value="<?php echo $details['address']; ?>"><br>
                                    <input type="text" class="form_input required" placeholder="Pincode" name="pincode" required value="<?php echo $details['pincode']; ?>"><br>
                                    <!--input type="text" class="form_input required" onChange="return subcategories(this.value);" placeholder="City" name="city" required value="<?php echo $details['city']; ?>"><br-->
									<select style = "width:93%;" class="form_select" name="city" required >
                                                            
                                                            <?php
                                                            $qry_city = mysql_query("select * from city order by name asc") or die('error');
                                                            while ($row_city = mysql_fetch_assoc($qry_city)) {
                                                                echo "<option value='$row_city[name]'>$row_city[name]</option>";
                                                            }
                                                            ?>
                                                        </select>
                                    <!--input type="text" class="form_input required"  placeholder="Area" name="state" required value="<?php echo $details['state']; ?>"--><br>
									<span id="subcagtegory"><!--select style = "width:93%;" class="form_select required" name="state">
                                                                <option value="">Select Area</option>
                                                            </select-->
															 <select  name="state" required class="form_select">

            <option value="">Select Area</option>

            <?php $news1 = mysql_query("select name from area  order by name asc ");

            while ($state = mysql_fetch_assoc($news1)) {
                ?>

                <option value="<?php echo $state['name']; ?>"><?php echo $state['name']; ?></option>

        <?php } ?>

        </select>
															
															</span><br>
                                    Set as Delivery Address <input type="checkbox" checked>
                                </div>
                            </div>


                            <button  type="submit" name="submit" value="proceed" class="button_full btyellow delivery-adress">Proceed</button>


                        </div>


                    </div>

                </div>


            </div>
        </div>
</div>
</form>
</div>



<script>
function subcategories(s)
                {//alert(s);
                    $.ajax({
                        type: "get",
                        dataType: "text",
                        url: "sub.php",
                        data: "val=" + s+"&type=1",
                        success: function (response) {
                            $('#subcagtegory').html(response);
                        }
                    });
                }
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
                url: "cart.php",
                data: "guid=" + thisID + "&qty=" + newprd + "&price=" + prc,
                success: function (response) {
                    var ctot = 'ctot' + thisID;
                    //  alert(ctot);
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
            $('#cartview').html(newcrt);
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
                url: "cart.php",
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
    function loadPreorder(divid) {
        var pre_order_statusip = "#pre_order_status_" + divid;
        var pre_order_status = $(pre_order_statusip).val();
        var preorder_divip = "#preorder_div_" + divid;

        if (pre_order_status == "0") {
            $(pre_order_statusip).val('1');
            $(preorder_divip).hide();
        } else {

            $(preorder_divip).show();
            $(pre_order_statusip).val('0');
        }
    }
    function showLabel(divid) {

        var optgroup = "#optgroup_" + divid + " :selected";
        var selected = $(optgroup);
        var deliver_date = "#deliver_date_" + divid;
        var deliverdatediv = "#deliverdatediv_" + divid;
        var item = selected.text();

        var group = selected.parent().attr('label');

        $(deliverdatediv).html(group);
        $(deliver_date).val(group + ' ' + item);
    }
//                                            $('select[name="optgroup"]').on('change', function () {
//
//                                                var label = this.options[this.selectedIndex].parentNode.label;
//                                                $('#deliverdatediv').html(label);
//                                                $('#deliver_date').val(label + ' ' + this.value);
//                                            });
</script>

<?php include 'footer.php'; ?>