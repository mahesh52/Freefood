<?php ob_start();
session_start();$date=date('Y-m-d');extract($_POST);extract($_GET);
include 'secure.php';include '../../config.php'; 
if(isset($_GET) && $_GET[action]=='delete')
{
mysql_query("delete from products where guid='$_GET[deleteid]'");
header('location:products.php');	
}
if(isset($_GET) && $_GET[action]=='deleteimage')
{
mysql_query("delete from imagefiles where guid='$_GET[deleteid]'");
header('location:products.php?action=edit&guid='.$pid);	
}
if(isset($_POST) && $_POST[category]!='' && $_POST[hidid]=='')
{
	//print_r($_POST);
	if($category!='' && $subcategory!='')
	{
	$pname=str_replace("'","*_*",$pname);
	$description=str_replace("'","*_*",$description);
mysql_query("INSERT INTO `products` (`category` ,`subcategory` ,`name` ,`price` ,`description`,`pincode`,`status`,`date`,`mrpprice`) VALUES ('$category','$subcategory','$pname' ,'$price' ,'$description','$pincode','Active','$date','$mrpprice')");
	}
	$pp=mysql_insert_id();
	$upload_imgs_array =  explode(";",$_SESSION['upload_imgs']);

	//print_r($upload_imgs_array);

	for($i=0;$i<count($upload_imgs_array);$i++){

		if(!empty($upload_imgs_array[$i]))

		{

			mysql_query("INSERT INTO `imagefiles` (`image` ,`date`,`cid`)VALUES ('".mysql_real_escape_string($upload_imgs_array[$i])."', '$date','$pp');");

		}

	}

	unset($_SESSION['upload_imgs']);
	
header('location:products.php');	
}
if(isset($_POST) && $_POST[hidid]!='')
{
	$pname=str_replace("'","*_*",$pname);
	$description=str_replace("'","*_*",$description);
mysql_query("update `products` set `category`='$category' ,`subcategory`='$subcategory' ,`name`='$pname' ,`price`='$price',`mrpprice`='$mrpprice' ,`description`='$description',`pincode`='$pincode',`status`='$status' where guid='$hidid'");
header('location:products.php');
	$upload_imgs_array =  explode(";",$_SESSION['upload_imgs']);

	//print_r($upload_imgs_array);

	for($i=0;$i<count($upload_imgs_array);$i++){

		if(!empty($upload_imgs_array[$i]))

		{

			mysql_query("INSERT INTO `imagefiles` (`image` ,`date`,`cid`)VALUES ('".mysql_real_escape_string($upload_imgs_array[$i])."', '$date','$hidid');");

		}

	}

	unset($_SESSION['upload_imgs']);	
}
?><!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="styles.css" />
         <?php include "styles-files.php";
		 ?>
         <script type="text/javascript">
		 function delete1()
{
  if(window.confirm("Confirm delete"))
  {
  return true;
   }
 else
   return false;
}
		 </script>
         <script type="text/javascript" src="nicEdit.js"></script>
         <script type="text/javascript">
bkLib.onDomLoaded(function() {
new nicEditor({fullPanel : true}).panelInstance('description');
new nicEditor({fullPanel : true}).panelInstance('features');
new nicEditor({fullPanel : true}).panelInstance('specifications');
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
                        Products
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Admin</li>
                    </ol>
                </section>

                <!-- Main content -->
                <?php if(isset($_GET) && $_GET[action]=='add'){?>
				
				<form action="products.php" method="post" name="form1" onSubmit="return valid()" enctype="multipart/form-data">
               <table class="table table-responsive table-bordered">

                     <tr><td><label>Category</label></td>
                     <td colspan="2"><select class="form-control" name="category" required onChange="return subcategories(this.value);">
             <option value="">Select Category</option>
              <?php $qry=mysql_query("select * from category order by name asc");
			  while($row=mysql_fetch_assoc($qry))
			  {
				echo "<option value='$row[guid]'>$row[name]</option>";  
			  }?>            	 	
			</select></td></tr>     
                    <tr><td><label>Sub Category</label></td><td>
                        <span id="subcagtegory"><select class="form-control" name="subcategory" required>
             <option value="">Select Sub Category</option>
			</select></span>
                    </td></tr>
                      <tr><td><label>Product Name</label></td><td>
                        <input type="text" name="pname" class="form-control" placeholder="Product Name"/>
                    </td></tr>
                    <tr><td><label>MRP Price</label></td>
                       <td><div class="input-group">
      <div class="input-group-addon">Rs</div>
      <input type="text" class="form-control" id="mrpprice" name="mrpprice" placeholder="MRP Price">
    </div>
                    </td></tr>
                    <tr><td><label>Our Price</label></td>
                       <td><div class="input-group">
      <div class="input-group-addon">Rs</div>
      <input type="text" class="form-control" id="price" name="price" placeholder="Our Price">
    </div>
                    </td></tr>
                    <tr><td><label>Pincode</label></td><td>
                        <input type="text" name="pincode" class="form-control" placeholder="Pincode"/>
                    </td></tr>
                    <tr><td><label>Description</label></td><td>
                        <textarea type="text" name="description" id="description" rows="5" style="width:800px;" placeholder="Descritpion"></textarea>
                    </td></tr>
                    
                    <tr><td colspan="2"><div align="left">



    <!-- This is the upload button, you can change the ID to any variable of your choice but also change it in the JS and CSS files-->

    <center>

    <div class="vpb_main_demo_wrapper" align="center"><!-- Main Wrapper -->

    <div id="vpb_uploads_error_displayer"></div><!-- Error Message Displayer -->

    <div id="vpb_uploads_displayer"></div><!-- Success Message (Files) Displayer -->

    <br clear="all" />

    </div><br clear="all" />

    </center>
</div></td></tr><tr><td><label>Images / PDF's</label></td><td><div>
        <div id="vpb_upload_button">Browse Files</div>

</div></td></tr>
               <tr><td colspan="2">                                                            
                    <button type="submit" name="Submit" value="Update" class="btn bg-yellow btn-block">Add Product</button>  
                </td></tr></table>
            </form>
				<?php }elseif(isset($_GET) && $_GET[action]=='edit'){
					$det=mysql_fetch_array(mysql_query("select * from products where guid='$guid'"));
					$pname=str_replace("*_*","'",$det['name']);
					$description=str_replace("*_*","'",$det['description']);
					$features=str_replace("*_*","'",$det['features']);
					$specification=str_replace("*_*","'",$det['specification']);?>
				
				<form action="products.php" method="post" name="form1" onSubmit="return valid()">
               <table class="table table-responsive table-bordered">

                          <tr><td>Category</td>
                     <td><select class="form-control" name="category" required onChange="return subcategories(this.value);">
             <option value="">Select Category</option>
              <?php $qry=mysql_query("select * from category order by name asc");
			  while($row=mysql_fetch_assoc($qry))
			  {
				?><option value='<?php echo $row[guid];?>' <?php if($det[category]==$row[guid]){?> selected<?php } ?>><?php echo $row[name];?></option><?php
			  }?>            	 	
			</select></td></tr>
                 
                    <tr><td><label>Sub Category</label></td><td>
                        <span id="subcagtegory"><select class="form-control" name="subcategory" required>
             <option value="">Select Sub Category</option>
             <?php $qry=mysql_query("select * from subcategory order by name asc");
			  while($row=mysql_fetch_assoc($qry))
			  {
				?><option value='<?php echo $row[guid];?>' <?php if($det[subcategory]==$row[guid]){?> selected<?php } ?>><?php echo $row[name];?></option><?php
			  }?>  
			</select></span>
                    </td></tr>
                      <tr><td><label>Product Name</label></td><td>
                        <input type="text" name="pname" class="form-control" placeholder="Product Name" value="<?php echo $pname;?>"/>
                    </td></tr>
                    <tr><td><label>MRP Price</label></td>
                       <td><div class="input-group">
      <div class="input-group-addon">Rs</div>
      <input type="text" class="form-control" id="mrpprice" name="mrpprice" placeholder="MRP Price" value="<?php echo $det[mrpprice];?>">
    </div>
                    </td></tr>
                    <tr><td><label>Our Price</label></td>
                       <td><div class="input-group">
      <div class="input-group-addon">Rs</div>
      <input type="text" class="form-control" id="price" name="price" placeholder="Our Price" value="<?php echo $det[price];?>">
    </div>
                    </td></tr>
                    <tr><td><label>Pincode</label></td><td>
                        <input type="text" name="pincode" class="form-control" placeholder="Pincode" value="<?php echo $det[pincode];?>"/>
                    </td></tr>
                    <tr><td><label>Description</label></td><td>
                        <textarea type="text" name="description" id="description" rows="5" style="width:800px;" placeholder="Descritpion"><?php echo $description;?></textarea>
                    </td></tr>
                    
                        <tr><td colspan="2"><?php $qry=mysql_query("select * from imagefiles where cid='$det[guid]'");
			  while($row=mysql_fetch_assoc($qry))
			  {
				 $str=substr($row[image],-3);
				 if($str!='pdf'){?><img src="../../android/uploaded_files/<?php echo $row[image];?>" width="100" height="100">
                 <a href="products.php?action=deleteimage&deleteid=<?php echo $row[guid]; ?>&pid=<?php echo $det[guid]; ?>" onClick="return delete1();">
                 <i class="fa fa-trash-o"></i></a>
				 <?php echo "&nbsp;&nbsp;&nbsp;";}else{echo "<br>";
					 $spt=split('_',$row[image]);for($i=1;$i<count($spt);$i++){echo $spt[$i];}?>
                     <a href="products.php?action=deleteimage&deleteid=<?php echo $row[guid]; ?>&pid=<?php echo $det[guid]; ?>" onClick="return delete1();">
                 <i class="fa fa-trash-o"></i></a>
				 <?php echo "&nbsp;&nbsp;&nbsp;";
					 //print_r($spt);
					 } ?>
                
                
                <?php } ?><div align="left">



    <!-- This is the upload button, you can change the ID to any variable of your choice but also change it in the JS and CSS files-->

    <center>

    <div class="vpb_main_demo_wrapper" align="center"><!-- Main Wrapper -->

    <div id="vpb_uploads_error_displayer"></div><!-- Error Message Displayer -->

    <div id="vpb_uploads_displayer"></div><!-- Success Message (Files) Displayer -->

    <br clear="all" />

    </div><br clear="all" />

    </center>
</div></td></tr><tr><td><label>Images / PDF's</label></td><td><div>
        <div id="vpb_upload_button">Browse Files</div>

</div></td></tr>      
                    
               <tr><td colspan="2">  
               <input type="hidden" name="hidid" value="<?php echo $det[guid];?>">                                                          
                    <button type="submit" name="Submit" value="Update" class="btn bg-yellow btn-block">Update Product</button>  
                </td></tr></table>
            </form><?php }else{?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="products.php?action=add"><button type="button" class="btn btn-success">Add Product</button></a>
                <section class="content">

				 <!-- top row -->
                   <table class="table table-responsive table-bordered">

                    	<thead>

                          <tr>

                        	

                            <th>Sno</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Product Name</th>
                            <th>MRP Price</th>
                            <th>Our Price</th>
                            <th>Edit</th>
 <th>Delete</th>
                           
                           </tr>

                        </thead>

                        <tbody>

                         <?php 
include 'pageing.php';
						    $gridId = $_GET[guid];
							$limit = 90; 								

$filePath="products.php";

if($page) 
{
$start = ($page - 1) * $limit; 			
}
else
{
$start = 0;						
$page=1;
}
$query_clients="SELECT * FROM `products`  order by guid desc  Limit $start, $limit ";

$query_clients=mysql_query($query_clients);

$select1="SELECT * FROM `products`";

$total=mysql_num_rows(mysql_query($select1));

$otherParams="";

@$divs=$total%$limit;

	if($divs==0)

	{

	@$totals=(int)($total/$limit);

	}else{

	@$totals=(int)($total/$limit) + 1;

	}$m=1;
						    while($client_count = mysql_fetch_assoc($query_clients)){
								$cat=mysql_fetch_array(mysql_query("select * from category where guid='$client_count[category]'"));
								$sub=mysql_fetch_array(mysql_query("select * from subcategory where guid='$client_count[subcategory]'"));
								$pname=str_replace("*_*","'",$client_count['name']);
					?>

                        	<tr>

                            	<td><?php echo $m; ?></td>

                                 <td><?php echo $cat['name'];?></td>
                                  <td><?php echo $sub['name'];?></td>
                                  <td><?php echo $pname;?></td>
                               <td><?php echo $client_count['mrpprice'];?></td>
                               <td><?php echo $client_count['price'];?></td>
                               <td><a href="products.php?action=edit&guid=<?php echo $client_count[guid]; ?>"><button type="button" class="btn btn-default">Edit</button></a></td>
                                <td><a href="products.php?action=delete&deleteid=<?php echo $client_count[guid]; ?>" onClick="return delete1();"><button type="button" class="btn btn-danger">Delete</button></a></td>

                            </tr>

                          <?php $m++;} ?>

                        </tbody>

                        <tfoot>

                        	<tr>

                            	<th colspan="8"> Showing <?php echo $page;?> of <?php echo $totals;?> Pages </th>

                            </tr>

                        </tfoot>

                    </table>
                     <ul class="pagination">

                       <?php make_pages($page,$limit,$total,$filePath,$otherParams); ?>
                       

                    </ul></section><?php } ?>
            </aside><!-- /.right-side -->
        </div>
        <!-- ./wrapper -->
        <!-- add new calendar event modal -->
       <?php include "footer-scripts.php" ?>
       <script type="text/javascript" src="jquery_1.5.2.js" ></script>
       <script type="text/javascript" src="ajaxupload.3.5.js" ></script>

<script type="text/javascript" src="uploader.js" ></script>
<script>
function subcategories(s)
{
 $.ajax({
  type:"get",
  dataType:"text",
  url:"sub.php",
  data:  "val="+s,
  success: function(response){
	  $('#subcagtegory').html(response);
  }
 });
}
</script>
    </body>
</html>