<?php ob_start();
session_start();$date=date('Y-m-d');extract($_POST);extract($_GET);
include 'secure.php';include '../../config.php'; 
if(isset($_GET) && $_GET[action]=='delete')
{
mysql_query("delete from storeproducts where guid='$_GET[deleteid]'");
header('location:storeproducts.php');	
}
if(isset($_GET) && $_GET[action]=='deleteimage')
{
mysql_query("delete from imagefiles where guid='$_GET[deleteid]'");
header('location:storeproducts.php?action=edit&guid='.$pid);	
}
if(isset($_POST) && $_POST[category]!='' && $_POST[hidid]=='')
{
	//print_r($_POST);
	if($category!='' && $subcategory!='')
	{
	$pname=str_replace("'","*_*",$pname);
	$description=str_replace("'","*_*",$description);
mysql_query("INSERT INTO `storeproducts` (`category` ,`subcategory` ,`name` ,`quantity`,`vprice` ,`description`,`status`,`date`,`mprice`,`sprice`) VALUES ('$category','$subcategory','$pname' ,'$quantity','$vprice' ,'$description','Active','$date','$mprice','$sprice')");
	}
	$pp=mysql_insert_id();
	$upload_imgs_array =  explode(";",$_SESSION['upload_imgs']);

	//print_r($upload_imgs_array);

	for($i=0;$i<count($upload_imgs_array);$i++){

		if(!empty($upload_imgs_array[$i]))

		{

			mysql_query("INSERT INTO `imagefiles` (`image` ,`date`,`sid`)VALUES ('".mysql_real_escape_string($upload_imgs_array[$i])."', '$date','$pp');");

		}

	}

	unset($_SESSION['upload_imgs']);
	
header('location:storeproducts.php');	
}
if(isset($_POST) && $_POST[hidid]!='')
{
	$pname=str_replace("'","*_*",$pname);
	$description=str_replace("'","*_*",$description);
mysql_query("update `storeproducts` set `category`='$category' ,`subcategory`='$subcategory' ,`name`='$pname' ,`quantity`='$quantity',`vprice`='$vprice',`mprice`='$mprice',`sprice`='$sprice' ,`description`='$description',`status`='$status' where guid='$hidid'");
header('location:storeproducts.php');
	$upload_imgs_array =  explode(";",$_SESSION['upload_imgs']);

	//print_r($upload_imgs_array);

	for($i=0;$i<count($upload_imgs_array);$i++){

		if(!empty($upload_imgs_array[$i]))

		{

			mysql_query("INSERT INTO `imagefiles` (`image` ,`date`,`sid`)VALUES ('".mysql_real_escape_string($upload_imgs_array[$i])."', '$date','$hidid');");

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
                        Store Products
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Admin</li>
                    </ol>
                </section>

                <!-- Main content -->
                <?php if(isset($_GET) && $_GET[action]=='add'){?>
				
				<form action="storeproducts.php" method="post" name="form1" onSubmit="return valid()" enctype="multipart/form-data">
               <table class="table table-responsive table-bordered">

                     <tr><td><label>Category</label></td>
                     <td colspan="2"><select class="form-control" name="category" required onChange="return subcategories(this.value);">
             <option value="">Select Category</option>
              <?php $qry=mysql_query("select * from storecategory order by name asc");
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

  <tr><td><label>Quantity</label></td><td>
                        <input type="text" name="quantity" class="form-control" placeholder="Quantity"/>
                    </td></tr>

                   <tr><td><label>Vendor Price</label></td>
                       <td><div class="input-group">
      <div class="input-group-addon">Rs</div>
      <input type="text" class="form-control" id="mrpprice" name="vprice" placeholder="Vendor Price">
    </div>
                    </td></tr>
                    <tr><td><label>Selling Price</label></td>
                       <td><div class="input-group">
      <div class="input-group-addon">Rs</div>
      <input type="text" class="form-control" id="price" name="sprice" placeholder="Selling Price">
    </div>
                    </td></tr>
                    <tr><td><label>Min Selling Price</label></td>
                       <td><div class="input-group">
      <div class="input-group-addon">Rs</div>
      <input type="text" class="form-control" id="price" name="mprice" placeholder="Minimum Selling Price">
    </div>
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
</div></td></tr><tr><td><label>Images </label></td><td><div>
        <div id="vpb_upload_button">Browse Files</div>

</div></td></tr>
               <tr><td colspan="2">                                                            
                    <button type="submit" name="Submit" value="Update" class="btn bg-yellow btn-block">Add Product</button>  
                </td></tr></table>
            </form>
				<?php }elseif(isset($_GET) && $_GET[action]=='edit'){
					$det=mysql_fetch_array(mysql_query("select * from storeproducts where guid='$guid'"));
					$pname=str_replace("*_*","'",$det['name']);
                                        $quantity=str_replace("*_*","'",$det['quantity']);
					$description=str_replace("*_*","'",$det['description']);
					$features=str_replace("*_*","'",$det['features']);
					$specification=str_replace("*_*","'",$det['specification']);?>
				
				<form action="storeproducts.php" method="post" name="form1" onSubmit="return valid()">
               <table class="table table-responsive table-bordered">

                          <tr><td>Category</td>
                     <td><select class="form-control" name="category" required onChange="return subcategories(this.value);">
             <option value="">Select Category</option>
              <?php $qry=mysql_query("select * from storecategory order by name asc");
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

<tr><td><label>Quantity</label></td><td>
             <input type="text" name="quantity" class="form-control" placeholder="Quantity" value="<?php echo $quantity; ?>"/>
                    </td></tr>
                    <tr><td><label>Vendor Price</label></td>
                       <td><div class="input-group">
      <div class="input-group-addon">Rs</div>
      <input type="text" class="form-control" id="mrpprice" name="vprice" placeholder="Vendor Price" value="<?php echo $det['vprice'];?>">
    </div>
                    </td></tr>
                    <tr><td><label>Selling Price</label></td>
                       <td><div class="input-group">
      <div class="input-group-addon">Rs</div>
      <input type="text" class="form-control" id="price" name="sprice" placeholder="Selling Price" value="<?php echo $det['sprice'];?>">
    </div>
                    </td></tr>
                    <tr><td><label>Min Selling Price</label></td>
                       <td><div class="input-group">
      <div class="input-group-addon">Rs</div>
      <input type="text" class="form-control" id="price" name="mprice" placeholder="Minimum Selling Price" value="<?php echo $det['mprice'];?>">
    </div>
                    </td></tr>
                    <tr><td><label>Description</label></td><td>
                        <textarea type="text" name="description" id="description" rows="5" style="width:800px;" placeholder="Descritpion"><?php echo $description;?></textarea>
                    </td></tr>
                    
                        <tr><td colspan="2"><?php $qry=mysql_query("select * from imagefiles where sid='$det[guid]'");
			  while($row=mysql_fetch_assoc($qry))
			  {
				 $str=substr($row[image],-3);
				 if($str!='pdf'){?><img src="../../android/uploaded_files/<?php echo $row[image];?>" width="100" height="100">
                 <a href="storeproducts.php?action=deleteimage&deleteid=<?php echo $row[guid]; ?>&pid=<?php echo $det[guid]; ?>" onClick="return delete1();">
                 <i class="fa fa-trash-o"></i></a>
				 <?php echo "&nbsp;&nbsp;&nbsp;";}else{echo "<br>";
					 $spt=split('_',$row[image]);for($i=1;$i<count($spt);$i++){echo $spt[$i];}?>
                     <a href="storeproducts.php?action=deleteimage&deleteid=<?php echo $row[guid]; ?>&pid=<?php echo $det[guid]; ?>" onClick="return delete1();">
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
</div></td></tr><tr><td><label>Images </label></td><td><div>
        <div id="vpb_upload_button">Browse Files</div>

</div></td></tr>      
                    
               <tr><td colspan="2">  
               <input type="hidden" name="hidid" value="<?php echo $det[guid];?>">                                                          
                    <button type="submit" name="Submit" value="Update" class="btn bg-yellow btn-block">Update Product</button>  
                </td></tr></table>
            </form><?php }else{?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="storeproducts.php?action=add"><button type="button" class="btn btn-success">Add Product</button></a>
                <section class="content">

				 <!-- top row -->
                   <form method="get" action="storeproducts.php"><table class="table table-responsive table-bordered">
                   <tr><td><select class="form-control" name="category" required onChange="return subcategories(this.value);">
             <option value="">Select Category</option>
              <?php $qry=mysql_query("select * from storecategory order by name asc");
			  while($row=mysql_fetch_assoc($qry))
			  {
				?><option value='<?php echo $row['guid'];?>' <?php if($row['guid']==$category){?>selected<?php } ?>><?php echo $row['name'];?></option>  
			  <?php }?>            	 	
			</select></td>
            <td><span id="subcagtegory"><select class="form-control" name="subcategory">
             <option value="">Select Sub Category</option>
              <?php $qry=mysql_query("select * from subcategory where refid='$category' order by name asc");
			  while($row=mysql_fetch_assoc($qry))
			  {
				?><option value='<?php echo $row['guid'];?>' <?php if($row['guid']==$subcategory){?>selected<?php } ?>><?php echo $row['name'];?></option> 
			  <?php }?>            	 	
			</select></span></td><td><button type="submit" name="Search" value="Search" class="btn btn-warning">Search</button></td></tr></table></form>
            <table class="table table-responsive table-bordered">

                    	<thead>

                          <tr>

                        	

                            <th>Sno</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Product Name</th>
                            <th>Vendor Price</th>
                            <th>Selling Price</th>
                            <th>Min. Price</th>
                            <th>Edit</th>
 <th>Delete</th>
                           
                           </tr>

                        </thead>

                        <tbody>

                         <?php 
include 'pageing.php';
						    $gridId = $_GET[guid];
							$limit = 90; 								

$filePath="storeproducts.php";

if($page) 
{
$start = ($page - 1) * $limit; 			
}
else
{
$start = 0;						
$page=1;
}
if($Search!='')
{
	if($category!='' && $subcategory!='')
	{
$query_clients="SELECT * FROM `storeproducts` where category='$category' and subcategory='$subcategory' order by guid desc  Limit $start, $limit ";

$select1="SELECT * FROM `storeproducts` where category='$category' and subcategory='$subcategory'";
	}
	elseif($category!='' && $subcategory=='')
	{
		$query_clients="SELECT * FROM `storeproducts` where category='$category' order by guid desc  Limit $start, $limit ";

$select1="SELECT * FROM `storeproducts` where category='$category'";
	}
}
else{
	
$query_clients="SELECT * FROM `storeproducts`  order by guid desc  Limit $start, $limit ";

$select1="SELECT * FROM `storeproducts`";
}
$query_clients=mysql_query($query_clients);

$total=mysql_num_rows(mysql_query($select1));

$otherParams="category=$category&subcategory=$subcategory&Search=$Search";

@$divs=$total%$limit;

	if($divs==0)

	{

	@$totals=(int)($total/$limit);

	}else{

	@$totals=(int)($total/$limit) + 1;

	}$m=1;
						    while($client_count = mysql_fetch_assoc($query_clients)){
								$cat=mysql_fetch_array(mysql_query("select * from storecategory where guid='$client_count[category]'"));
								$sub=mysql_fetch_array(mysql_query("select * from subcategory where guid='$client_count[subcategory]'"));
								$pname=str_replace("*_*","'",$client_count['name']);
$quantity=str_replace("*_*","'",$client_count['quantity']);
					?>

                        	<tr>

                            	<td><?php echo $m; ?></td>

                                 <td><?php echo $cat['name'];?></td>
                                  <td><?php echo $sub['name'];?></td>
                                  <td><?php echo $pname;?></td>
                                  <td><?php echo $client_count['vprice'];?></td>
                               <td><?php echo $client_count['sprice'];?></td>
                               <td><?php echo $client_count['mprice'];?></td>
                               <td><a href="storeproducts.php?action=edit&guid=<?php echo $client_count[guid]; ?>"><button type="button" class="btn btn-default">Edit</button></a></td>
                                <td><a href="storeproducts.php?action=delete&deleteid=<?php echo $client_count[guid]; ?>" onClick="return delete1();"><button type="button" class="btn btn-danger">Delete</button></a></td>

                            </tr>

                          <?php $m++;} ?>

                        </tbody>

                        <tfoot>

                        	<tr>

                            	<th colspan="10"> Showing <?php echo $page;?> of <?php echo $totals;?> Pages </th>

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
       
       <script type="text/javascript" src="jquery_1.5.2.js" ></script>
       <script type="text/javascript" src="ajaxupload.3.5.js" ></script>

<script type="text/javascript" src="uploader.js" ></script>
<script>
function subcategories(s)
{//alert(s);
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
</script><?php include "footer-scripts.php" ?>
    </body>
</html>