<?php
error_reporting(0);
ob_start();
session_start();
$date = date('Y-m-d');
extract($_POST);
extract($_GET);
include 'secure.php';
include '../../config.php';
if (isset($_GET) && $_GET[action] == 'delete') {
    mysql_query("delete from coupons where guid='$_GET[deleteid]'");
    header('location:coupons.php');
}

if (isset($_POST) && $_POST[category] != '' && $_POST[hidid] == '') {
    
    $area = '';
    //print_r($_POST);
    if ($category != '') {
        $pname = str_replace("'", "*_*", $pname);
        $description = str_replace("'", "*_*", $description);
        for ($i = 0; $i < count($areas); $i++) {
            $chk = mysql_fetch_array(mysql_query("select * from area where guid='$areas[$i]'"));
            if ($areas[$i] != '') {
                $area.=$areas[$i] . ',';
            }
        }

        mysql_query("INSERT INTO `coupons` (`category` ,`name` ,`quantity`,`vprice` ,`description`,`status`,`date`,`sprice`,`mprice`,`state`,`area`,`zonal`,`town`,coupon_vendor,coupon_type,coupon_value,validity) VALUES ('$category','$pname' ,'$quantity','$vprice' ,'$description','$status','$date','$sprice','$mprice','$state','$area','$zonal','$town','$coupons_vendor','$coupon_type','$coupon_value','$validity')");
    }
   
    header('location:coupons.php');
}
if (isset($_POST) && $_POST[hidid] != '') {
    $area = '';
    for ($i = 0; $i < count($areas); $i++) {
        $chk = mysql_fetch_array(mysql_query("select * from area where guid='$areas[$i]'"));
        if ($areas[$i] != '') {
            $area.=$areas[$i] . ',';
        }
    }

    $pname = str_replace("'", "*_*", $pname);
    $description = str_replace("'", "*_*", $description);
    mysql_query("update `coupons` set `category`='$category' ,`name`='$pname' ,`quantity`='$quantity',`vprice`='$vprice',`mprice`='$mprice' ,`sprice`='$sprice' ,`description`='$description',`status`='$status',`zonal`='$zonal',`town`='$town',`state`='$state',`area`='$area',coupon_vendor = '$coupons_vendor',coupon_type = '$coupon_type',coupon_value = '$coupon_value',validity='$validity' where guid='$hidid'");

    header('location:coupons.php');
}
?><!DOCTYPE html>
<html>
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <?php include "styles-files.php";
    ?>
    <script type="text/javascript">
        function delete1()
        {
            if (window.confirm("Confirm delete"))
            {
                return true;
            } else
                return false;
        }
    </script>
    <script type="text/javascript" src="nicEdit.js"></script>
    <script type="text/javascript">
        bkLib.onDomLoaded(function () {
            new nicEditor({fullPanel: true}).panelInstance('description');
            new nicEditor({fullPanel: true}).panelInstance('features');
            new nicEditor({fullPanel: true}).panelInstance('specifications');
        });
    </script>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php include "header.php"; ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include "side-nav.php"; ?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Coupons
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Admin</li>
                    </ol>
                </section>

                <!-- Main content -->
                <?php if (isset($_GET) && $_GET[action] == 'add') { ?>

                    <form action="coupons.php" method="post" name="form1" id="frm1" onSubmit="return valid()" enctype="multipart/form-data">
                        <table class="table table-responsive table-bordered">
						 <tr><td>Coupons Type</td>
                                <td><select class="form-control" name="coupon_type" id="coupon_type" required >
                                        <option value="">Select Coupons Type</option>
                                        <option value ="Online" >Online</option>      
<option value ="Offline" >Offline</option> <option value ="Food" >Food</option>                                              
                                    </select></td></tr>
 <tr><td>Coupons Partner</td>
                                <td><select class="form-control" name="coupons_vendor" required >
                                        <option value="">Select Coupons Partner</option>
                                        <?php
                                        $qry11 = mysql_query("select * from couponsvendor order by name asc");
                                        while ($row11 = mysql_fetch_assoc($qry11)) {
                                            echo "<option value='$row11[guid]'>$row11[name]</option>";
                                        }
                                        ?>            	 	
                                    </select></td></tr>
                            <tr><td>State Partner</td>
                                <td><select class="form-control" name="state" required onChange="return subzone(this.value);">
                                        <option value="">Select State Partner</option>
                                        <?php
                                        $qry = mysql_query("select * from statepart order by name asc");
                                        while ($row = mysql_fetch_assoc($qry)) {
                                            echo "<option value='$row[guid]'>$row[name]</option>";
                                        }
                                        ?>            	 	
                                    </select></td></tr>
                            <tr><td>Zonal Partner</td>
                                <td><span id="subzone"><select class="form-control" name="zonal" required onChange="return subcity(this.value);">
                                            <option value="">Select Zonal Partner</option>
                                        </select></span></td></tr>
                            <tr><td>Town Partner</td>
                                <td><span id="subcity"><select class="form-control" name="town" required onChange="return subcategories(this.value);">
                                            <option value="">Select Town Partner</option>
                                        </select></span></td></tr> 
                            <tr><td>Area's
                                    <input type="button" name="CheckAll" value="Select All" onClick="checkedAll(frm1)"></td>
                                <td><span id="subcagtegory"><select class="form-control" name="city" required>
                                            <option value="">Select Area</option>

                                        </select></span></td></tr>
    <!--                            <tr><td><label>Category</label></td>
                                <td colspan="2">
                                    <select class="form-control" name="category" required onChange="return subcat(this.value);">
                                        <option value="">Select Category</option>
                            <?php
                            //$qry = mysql_query("select * from storecategory order by name asc");
                            //while ($row = mysql_fetch_assoc($qry)) {
                            //    echo "<option value='$row[guid]'>$row[name]</option>";
                            // }
                            ?>            	 	
                                    </select>
                                </td></tr>     -->
    <!--                            <tr>
                                <td><label>Sub Category</label></td><td>
                                    <span id="subcat"><select class="form-control" name="subcategory" required>
                                            <option value="">Select Sub Category</option>
                                        </select></span>
                                </td>
                            </tr>-->
                            <tr><td><label>Coupon Code</label></td><td>
                                    <input type="text" name="pname" id="pname" class="form-control" style ="width:50%;" placeholder="Coupon Code" required/><a href = "javascript:generatecoupon();" >Generate</a>
                                </td></tr>
<tr><td><label>Quantity</label></td>
                                <td><div class="input-group">
                                        
                                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Quantity" required  >
                                    </div>
                                </td></tr>

                            <tr><td><label>Vendor Price</label></td>
                                <td><div class="input-group">
                                        <div class="input-group-addon">Rs</div>
                                        <input type="text" class="form-control" id="mrpprice" name="vprice" placeholder="Vendor Price" required onBlur="return sellprice();">
                                    </div>
                                </td></tr>
                            <tr><td><label>Selling Price</label></td>
                                <td><div class="input-group">
                                        <div class="input-group-addon">Rs</div>
                                        <input type="text" class="form-control" id="price" name="sprice" placeholder="Selling Price" required onBlur="return sellprice();" >
                                    </div>
                                </td></tr>
                            <tr><td><label>Min Selling Price</label></td>
                                <td><div class="input-group">
                                        <div class="input-group-addon">Rs</div>
                                        <input type="text" class="form-control" id="mprice" name="mprice" placeholder="Minimum Selling Price" readonly required>
                                    </div>
                                </td></tr>
                             <tr><td><label>Coupon Value</label></td>
                                <td><div class="input-group">
                                        <div class="input-group-addon">Rs</div>
                                        <input type="text" class="form-control" id="coupon_value" name="coupon_value" placeholder="Coupon Value"  required>
                                    </div>
                                </td></tr>
                            <tr><td><label>Category</label></td>
                                <td><div class="input-group">
                                        <p id = "category_name">N/A</p>
                                        <input type="hidden" class="form-control" name="category" id="category" required>
                                    </div>
                                </td></tr>
                            <tr><td><label>Description</label></td><td>
                                    <textarea type="hidden" name="description" id="description" rows="5" style="width:800px;" placeholder="Descritpion"></textarea>
                                </td></tr>

                           

                            <tr><td>Status</td><td>
                                    <input type="radio" name="status"  value="Active" checked/> Active
                                    <input type="radio" name="status"  value="InActive"/> InActive
                                </td></tr> 
                           
									<tr><td>Validity</td>
                                <td><select class="form-control" name="validity"  >
                                        <option value="">Select Validity</option>
                                        <option value ="1" >1 Month</option>      
										<option value ="2" >2 Months</option> 
									<option value ="3" >3 Months</option>
<option value ="6" >6 Months</option><option value ="12" >1 Year</option>										
                                    </select></td></tr>
                            <tr><td colspan="2">                                                            
                                    <button type="submit" name="Submit" value="Update" class="btn bg-yellow btn-block">Add Coupon</button>  
                                </td></tr></table>
                    </form>
                    <?php
                } elseif (isset($_GET) && $_GET[action] == 'edit') {
                    $det = mysql_fetch_array(mysql_query("select * from coupons where guid='$guid'"));
                    $pname = str_replace("*_*", "'", $det['name']);
                    $quantity = str_replace("*_*", "'", $det['quantity']);
                    $description = str_replace("*_*", "'", $det['description']);
                    $features = str_replace("*_*", "'", $det['features']);
                    $specification = str_replace("*_*", "'", $det['specification']);
                    ?>

                    <form action="coupons.php" method="post" name="form1" id="frm1" onSubmit="return valid()">
                        <table class="table table-responsive table-bordered">
                              <tr><td>Coupons Type</td><?php //echo $det['coupon_type']; ?>
                                <td><select class="form-control" name="coupon_type" id="coupon_type"  required >
                                        <option value="">Select Coupons Type</option>
                                        <option value ="Online"  <?php
                                    if ($det['coupon_type'] == 'Online') {
                                        echo "selected";
                                    }
                                    ?> >Online</option>      
<option value ="Offline"  <?php
                                    if ($det['coupon_type'] == 'Offline') {
                                        echo "selected";
                                    }
                                    ?> >Offline</option>  
<option value ="Food"  <?php
                                    if ($det['coupon_type'] == 'Food') {
                                        echo "selected";
                                    }
                                    ?> >Food</option>  									
                                    </select></td></tr>
							 <tr><td>Coupons Partner</td>
                                <td><select class="form-control" name="coupons_vendor" required >
                                        <option value="">Select Coupons Partner</option>
                                        <?php
                                        $qry11 = mysql_query("select * from couponsvendor order by name asc");
                                       while ($row11 = mysql_fetch_assoc($qry11)) {
                                            ?><option value="<?php echo $row11['guid']; ?>" <?php if ($det['coupon_vendor'] == $row11['guid']) { ?> selected<?php } ?>><?php echo $row11['name']; ?></option><?php }
                                          
                                        ?>            	 	
                                    </select></td></tr>
                            <tr><td>State Partner</td>
                                <td><select class="form-control" name="state" required onChange="return subzone(this.value);">
                                        <option value="">Select State Partner</option>
                                        <?php
                                        $qry = mysql_query("select * from statepart order by name asc");
                                        while ($row = mysql_fetch_assoc($qry)) {
                                            ?><option value="<?php echo $row['guid']; ?>" <?php if ($det['state'] == $row['guid']) { ?> selected<?php } ?>><?php echo $row['name']; ?></option><?php }
                                        ?>            	 	
                                    </select></td></tr>
                            <tr><td>Zonal Partner</td>
                                <td><span id="subzone"><select class="form-control" name="zonal" required onChange="return subcity(this.value);">
                                            <option value="">Select Zonal Partner</option>
                                            <?php
                                            $qry = mysql_query("select * from zonal where state='$det[state]' order by name asc");
                                            while ($row = mysql_fetch_assoc($qry)) {
                                                ?><option value="<?php echo $row['guid']; ?>" <?php if ($det['zonal'] == $row['guid']) { ?> selected<?php } ?>><?php echo $row['name']; ?></option><?php }
                                            ?>            	 	
                                        </select></span></td></tr>
                            <tr><td>Town Partner</td>
                                <td><span id="subcity"><select class="form-control" name="town" required onChange="return subcategories(this.value);">
                                            <option value="">Select Town Partner</option>
                                            <?php
                                            $qry = mysql_query("select * from town where zonal='$det[zonal]' order by name asc");
                                            while ($row = mysql_fetch_assoc($qry)) {
                                                ?><option value="<?php echo $row['guid']; ?>" <?php if ($det['town'] == $row['guid']) { ?> selected<?php } ?>><?php echo $row['name']; ?></option><?php }
                                            ?>            	 	
                                        </select></span></td></tr>
                            <tr><td>Area's
                                    <input type="button" name="CheckAll" value="Select All" onClick="checkedAll(frm1)"></td>
                                <td><span id="subcagtegory">
                                        <?php
                                        $st = mysql_fetch_array(mysql_query("select * from town where guid='$det[town]'"));
                                        $spt = split(',', $det['area']);
                                        $m = 0;
                                        $news1 = mysql_query("select * from area order by name asc ");
                                        while ($state = mysql_fetch_assoc($news1)) {
                                            $m++;
                                            if ($m % 8 == 0) {
                                                echo "<br>";
                                            }
                                            ?><label>
                                                <input type="checkbox" name="areas[]" value="<?php echo $state['guid']; ?>" <?php if (in_array($state['guid'], $spt)) { ?> checked<?php } ?>><?php echo $state['name']; ?></label>&nbsp;
                                        <?php } ?></span></td></tr>
    <!--                            <tr><td>Category</td>
                            <td>
                                
                                
                                <select class="form-control" name="category" required onChange="return subcat(this.value);">
                                    <option value="">Select Category</option>
                            <?php
                            // $qry = mysql_query("select * from storecategory order by name asc");
                            // while ($row = mysql_fetch_assoc($qry)) {
                            ?><option value='<?php echo $row[guid]; ?>' <?php if ($det[category] == $row[guid]) { ?> selected<?php } ?>><?php echo $row[name]; ?></option><?php //}
                            ?>            	 	
                                </select></td></tr>-->

    <!--                            <tr><td><label>Sub Category</label></td><td>
                                        <span id="subcat"><select class="form-control" name="subcategory" required>
                                                <option value="">Select Sub Category</option>
                            <?php
                            // $qry = mysql_query("select * from subcategory order by name asc");
                            // while ($row = mysql_fetch_assoc($qry)) {
                            ?><option value='<?php echo $row[guid]; ?>' <?php if ($det[subcategory] == $row[guid]) { ?> selected<?php } ?>><?php echo $row[name]; ?></option><?php //}
                            ?>  
                                            </select></span>
                                    </td></tr>-->
                            <tr><td><label>Coupon Code</label></td><td>
                                    <input type="text" name="pname" class="form-control" placeholder="Product Name" value="<?php echo $pname; ?>" required/>
                                </td></tr>
                            <tr><td><label>Quantity</label></td>
                                <td><div class="input-group">
                                        
                                        <input type="number" class="form-control" id="quantity"  value="<?php echo $det['quantity']; ?>" name="quantity" placeholder="Quantity" required  >
                                    </div>
                                </td></tr>

                            <tr><td><label>Vendor Price</label></td>
                                <td><div class="input-group">
                                        <div class="input-group-addon">Rs</div>
                                        <input type="text" class="form-control" id="mrpprice" name="vprice" placeholder="Vendor Price" value="<?php echo $det['vprice']; ?>" onBlur="return sellprice();" required>
                                    </div>
                                </td></tr>
                            <tr><td><label>Selling Price</label></td>
                                <td><div class="input-group">
                                        <div class="input-group-addon">Rs</div>
                                        <input type="text" class="form-control" id="price" name="sprice" placeholder="Selling Price" value="<?php echo $det['sprice']; ?>" onBlur="return sellprice();"required>
                                    </div>
                                </td></tr>
                            <tr><td><label>Min Selling Price</label></td>
                                <td><div class="input-group">
                                        <div class="input-group-addon">Rs</div>
                                        <input type="text" class="form-control" id="mprice" name="mprice" placeholder="Minimum Selling Price" value="<?php echo $det['mprice']; ?>" readonly required>
                                    </div>
                                </td></tr>
                             <tr><td><label>Coupon Value</label></td>
                                <td><div class="input-group">
                                        <div class="input-group-addon">Rs</div>
                                        <input type="text" class="form-control" id="coupon_value" name="coupon_value" placeholder="Coupon Value"  value="<?php echo $det['coupon_value']; ?>"  required>
                                    </div>
                                </td></tr>
                            <tr><td><label>Category</label></td>
                                <td><div class="input-group">
                                        <?php
                                        $qry = mysql_query("select * from storecategory order by name asc");
                                        while ($row = mysql_fetch_assoc($qry)) {
                                            if ($det[category] == $row[guid]) {
                                                $category_name = $row["name"];
                                                $category_id = $det["category"];
                                                break;
                                            }
                                        }
                                        ?>
                                         
                                        <p id = "category_name"><?php echo $category_name; ?></p>
                                        <input type="hidden" class="form-control" name="category" id="category" required value ="<?php echo $category_id; ?>">
                                    </div>
                                </td></tr>
                            <tr><td><label>Description</label></td><td>
                                    <textarea type="text" name="description" id="description" rows="5" style="width:800px;" placeholder="Descritpion"><?php echo $description; ?></textarea>
                                </td></tr>

                              
                            <tr><td>Status</td><td>
                                    <input type="radio" name="status"  value="Active" <?php
                                    if ($det['status'] == 'Active') {
                                        echo "checked";
                                    }
                                    ?>/> Active
                                    <input type="radio" name="status"  value="InActive" <?php
                                    if ($det['status'] == 'InActive') {
                                        echo "checked";
                                    }
                                    ?>/> InActive
                                </td></tr>  
                           
									<tr><td>Validity</td>
                                <td><select class="form-control" name="validity"  >
                                        <option value="">Select Validity</option>
                                        <option value ="1" <?php
                                    if ($det['validity'] == '1') {
                                        echo "selected";
                                    }
                                    ?> >1 Month</option>      
										<option value ="2" <?php
                                    if ($det['validity'] == '2') {
                                        echo "selected";
                                    }
                                    ?> >2 Months</option> 
									<option value ="3" <?php
                                    if ($det['validity'] == '3') {
                                        echo "selected";
                                    }
                                    ?> >3 Months</option>
<option value ="6" <?php
                                    if ($det['validity'] == '6') {
                                        echo "selected";
                                    }
                                    ?> >6 Months</option>
									<option value ="12" <?php
                                    if ($det['validity'] == '12') {
                                        echo "selected";
                                    }
                                    ?> >1 Year</option>										
                                    </select></td></tr>
                            <tr><td colspan="2">  
                                    <input type="hidden" name="hidid" value="<?php echo $det[guid]; ?>">                                                          
                                    <button type="submit" name="Submit" value="Update" class="btn bg-yellow btn-block">Update Coupon</button>  
                                </td></tr></table>
                    </form><?php } else { ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="coupons.php?action=add"><button type="button" class="btn btn-success">Add Coupon</button></a>
                    <section class="content">

                        <!-- top row -->
                   
                        
                        <table class="table table-responsive table-bordered">

                            <thead>

                                <tr>



                                    <th>Sno</th>
                                    <th>Category</th>
                                   
                                    <th>Coupon Code</th>
                                    <th>Vendor Price</th>
                                    <th>Selling Price</th>
                                    <th>Min. Price</th>
                                    <th>Coupon Value</th>
                                    <th>Available Qty</th><th>Type</th>
                                    <th>Edit</th>
                                    <th>Delete</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php
                                include 'pageing.php';
                                $gridId = $_GET[guid];
                                $limit = 90;

                                $filePath = "coupons.php";

                                if ($page) {
                                    $start = ($page - 1) * $limit;
                                } else {
                                    $start = 0;
                                    $page = 1;
                                }
                                if ($Search != '') {
                                    if ($category != '' && $subcategory != '') {
                                        $query_clients = "SELECT * FROM `coupons` where category='$category' and subcategory='$subcategory' order by guid desc  Limit $start, $limit ";

                                        $select1 = "SELECT * FROM `coupons` where category='$category' and subcategory='$subcategory'";
                                    } elseif ($category != '' && $subcategory == '') {
                                        $query_clients = "SELECT * FROM `coupons` where category='$category' order by guid desc  Limit $start, $limit ";

                                        $select1 = "SELECT * FROM `coupons` where category='$category'";
                                    }
                                } else {

                                    $query_clients = "SELECT * FROM `coupons`  order by guid desc  Limit $start, $limit ";

                                    $select1 = "SELECT * FROM `coupons`";
                                }
                                $query_clients = mysql_query($query_clients);

                                $total = mysql_num_rows(mysql_query($select1));

                                $otherParams = "category=$category&subcategory=$subcategory&Search=$Search";

                                @$divs = $total % $limit;

                                if ($divs == 0) {

                                    @$totals = (int) ($total / $limit);
                                } else {

                                    @$totals = (int) ($total / $limit) + 1;
                                }$m = 1;
                                while ($client_count = mysql_fetch_assoc($query_clients)) {
                                    $cat = mysql_fetch_array(mysql_query("select * from storecategory where guid='$client_count[category]'"));
                                   // $sub = mysql_fetch_array(mysql_query("select * from subcategory where guid='$client_count[subcategory]'"));
                                    $pname = str_replace("*_*", "'", $client_count['name']);
                                    $quantity = str_replace("*_*", "'", $client_count['quantity']);
                                    ?>

                                    <tr>

                                        <td><?php echo $m; ?></td>

                                        <td><?php echo $cat['name']; ?></td>
                                       
                                        <td><?php echo $pname; ?></td>
                                        <td><?php echo $client_count['vprice']; ?></td>
                                        <td><?php echo $client_count['sprice']; ?></td>
                                        <td><?php echo $client_count['mprice']; ?></td>
                                        <td><?php echo $client_count['coupon_value']; ?> </td>
                                        <td><?php echo $client_count['quantity']; ?></td>
                                        <td><?php echo $client_count['coupon_type']; ?></td>
                                        <td><a href="coupons.php?action=edit&guid=<?php echo $client_count[guid]; ?>"><button type="button" class="btn btn-default">Edit</button></a></td>
                                        <td><a href="coupons.php?action=delete&deleteid=<?php echo $client_count[guid]; ?>" onClick="return delete1();"><button type="button" class="btn btn-danger">Delete</button></a></td>

                                    </tr>

                                    <?php
                                    $m++;
                                }
                                ?>

                            </tbody>

                            <tfoot>

                                <tr>

                                    <th colspan="10"> Showing <?php echo $page; ?> of <?php echo $totals; ?> Pages </th>

                                </tr>

                            </tfoot>

                        </table>
                        <ul class="pagination">

                            <?php make_pages($page, $limit, $total, $filePath, $otherParams); ?>


                        </ul></section><?php } ?>
            </aside><!-- /.right-side -->
        </div>
        <div id = "min_selling_price_div"></div>
        <!-- ./wrapper -->
        <!-- add new calendar event modal -->
        <?php //$sellprice = mysql_fetch_array(mysql_query("select * from commissions order by guid desc limit 0,1"));  ?>
        <script type="text/javascript" src="jquery_1.5.2.js" ></script>
        <script type="text/javascript" src="ajaxupload.3.5.js" ></script>

        <script type="text/javascript" src="uploader.js" ></script>
        <script>
            
                                            checked = false;
                                            function checkedAll(frm1) {
                                                var aa = document.getElementById('frm1');
                                                if (checked == false)
                                                {
                                                    checked = true
                                                } else
                                                {
                                                    checked = false
                                                }
                                                for (var i = 0; i < aa.elements.length; i++)
                                                {
                                                    aa.elements[i].checked = checked;
                                                }
                                            }
                                            function subzone(s)
                                            {//alert(s);
                                                $.ajax({
                                                    type: "get",
                                                    dataType: "text",
                                                    url: "subzone1.php",
                                                    data: "val=" + s,
                                                    success: function (response) {
                                                        $('#subzone').html(response);
                                                    }
                                                });
                                            }
                                            function subcity(s)
                                            {//alert(s);
                                                $.ajax({
                                                    type: "get",
                                                    dataType: "text",
                                                    url: "subzone5.php",
                                                    data: "val=" + s,
                                                    success: function (response) {
                                                        $('#subcity').html(response);
                                                    }
                                                });
                                            }
                                            
                                            function subcategories(s)
                                            {//alert(s);
                                                $.ajax({
                                                    type: "get",
                                                    dataType: "text",
                                                    url: "subarea.php",
                                                    data: "val=" + s,
                                                    success: function (response) {
                                                        $('#subcagtegory').html(response);
                                                    }
                                                });
                                            }
                                            function subcat(s)
                                            {//alert(s);
                                                $.ajax({
                                                    type: "get",
                                                    dataType: "text",
                                                    url: "sub.php",
                                                    data: "val=" + s,
                                                    success: function (response) {
                                                        $('#subcat').html(response);
                                                    }
                                                });
                                            }
                                            function sellprice()
                                            {
                                                var mrpprice = $("#mrpprice").val();
                                                var price = $("#price").val();
												var coupon_type = $("#coupon_type").val();
                                                if (mrpprice != "" && price != "") {
                                                    if (parseFloat(price) >= parseFloat(mrpprice)) {

                                                        $.ajax({
                                                            type: "post",
                                                            url: "getCouponMinSellingprice.php",
                                                            data: "val=" + mrpprice + "&price=" + price+"&coupon_type="+coupon_type,
                                                            success: function (response) {
                                                                $('#min_selling_price_div').html(response);
                                                            }
                                                        });
                                                    } else {
                                                        $("#price").val('')
                                                        alert("Selling price must be greater than vendor price");
                                                    }

                                                }

                                            }
                                            function generatecoupon(){
                                                 $.ajax({
                                                    type: "get",
                                                    url: "generatecoupon.php",
                                                    data: "",
                                                    success: function (response) {
                                                        $('#pname').val(response);
                                                    }
                                                });
                                            }
        </script><?php include "footer-scripts.php" ?>
    </body>
</html>
