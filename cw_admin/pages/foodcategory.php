<?php ob_start();
session_start();$date=date('Y-m-d');extract($_POST);extract($_GET);
include 'secure.php';include '../../config.php';
function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 } 
if(isset($_GET) && $_GET[deleteid]!='')
{
mysql_query("delete from foodcategory where guid='$_GET[deleteid]'");
header('location:foodcategory.php');	
}
if(isset($_POST) && $_POST[refid]!='' && $_POST[hidid]=='')
{
	
	if($topic!='' && $refid!='')
	{
		$uploaded_files_location = '../../android/uploaded_files/'; 
$picname=basename($_FILES['file_to_upload']['name']);
if($picname!='')
{
$picname = time().'_'.$picname;
$picname=str_replace(" ","_","$picname");
$final_location = $uploaded_files_location .$picname; 
$return_array = array();

$image =$_FILES["file_to_upload"]["name"];
	$uploadedfile = $_FILES['file_to_upload']['tmp_name'];
 	if ($image) 
 	{
 	
 		$filename = stripslashes($_FILES['file_to_upload']['name']);
  		$extension = getExtension($filename);
 		$extension = strtolower($extension);
if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
 		{
		
 			$change='<div class="msgdiv">Unknown Image extension </div> ';
 			$errors=1;
 		}
 		else
 		{

if($extension=="jpg" || $extension=="jpeg" )
{
$uploadedfile = $_FILES['file_to_upload']['tmp_name'];
$src = imagecreatefromjpeg($uploadedfile);

}
else if($extension=="png")
{
$uploadedfile = $_FILES['file_to_upload']['tmp_name'];
$src = imagecreatefrompng($uploadedfile);

}
else 
{
$src = imagecreatefromgif($uploadedfile);
}

echo $scr;

list($width,$height)=getimagesize($uploadedfile);


$newwidth=300;
$newheight=329;
$tmp=imagecreatetruecolor($newwidth,$newheight);
imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
$filename = "../../android/uploaded_files/".$picname;
imagejpeg($tmp,$filename,50);
imagedestroy($src);
imagedestroy($tmp);
}}}
		
mysql_query("INSERT INTO `foodcategory` (`name` ,`refid`,`image`) VALUES ('$topic','$refid','$picname')");
	}
	
header('location:foodcategory.php');	
}
if(isset($_POST) && $_POST[hidid]!='')
{
	$uploaded_files_location = '../../android/uploaded_files/'; 
$picname=basename($_FILES['file_to_upload']['name']);
if($picname!='')
{
$picname = time().'_'.$picname;
$picname=str_replace(" ","_","$picname");
$final_location = $uploaded_files_location .$picname; 
$return_array = array();

$image =$_FILES["file_to_upload"]["name"];
	$uploadedfile = $_FILES['file_to_upload']['tmp_name'];
 	if ($image) 
 	{
 	
 		$filename = stripslashes($_FILES['file_to_upload']['name']);
  		$extension = getExtension($filename);
 		$extension = strtolower($extension);
if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
 		{
		
 			$change='<div class="msgdiv">Unknown Image extension </div> ';
 			$errors=1;
 		}
 		else
 		{

if($extension=="jpg" || $extension=="jpeg" )
{
$uploadedfile = $_FILES['file_to_upload']['tmp_name'];
$src = imagecreatefromjpeg($uploadedfile);

}
else if($extension=="png")
{
$uploadedfile = $_FILES['file_to_upload']['tmp_name'];
$src = imagecreatefrompng($uploadedfile);

}
else 
{
$src = imagecreatefromgif($uploadedfile);
}

echo $scr;

list($width,$height)=getimagesize($uploadedfile);


$newwidth=300;
$newheight=329;
$tmp=imagecreatetruecolor($newwidth,$newheight);
imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
$filename = "../../android/uploaded_files/".$picname;
imagejpeg($tmp,$filename,50);
imagedestroy($src);
imagedestroy($tmp);
}}
mysql_query("update `foodcategory` set `image`='$picname' where guid='$hidid'");
}
mysql_query("update `foodcategory` set `name`='$topic',`refid`='$refid' where guid='$hidid'");
header('location:foodcategory.php');	
}
?><!DOCTYPE html>
<html>
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
                        Food Sub Categories
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Admin</li>
                    </ol>
                </section>

                <!-- Main content -->
                <?php if(isset($_GET) && $_GET[action]=='add'){?>
				
				<form action="foodcategory.php" method="post" name="form1" onSubmit="return valid()" enctype="multipart/form-data">
               <table class="table table-responsive table-bordered">

                     <tr><td>Category</td>
                     <td><select class="form-control" name="refid" required>
             <option value="">Select Category</option>
              <?php $qry=mysql_query("select * from category order by name asc");
			  while($row=mysql_fetch_assoc($qry))
			  {
				echo "<option value='$row[guid]'>$row[name]</option>";  
			  }?>            	 	
			</select></td></tr>     
                    <tr><td>Sub Categories</td><td>
                        <input type="text" name="topic" class="form-control" placeholder="Sub Category"/>
                    </td></tr>
                    <tr><td>Image</td><td><input type="file" name="file_to_upload"/></td></tr>
               <tr><td colspan="2">                                                            
                    <button type="submit" name="Submit" value="Update" class="btn bg-yellow btn-block">Add Sub Category</button>  
                </td></tr></table>
            </form>
				<?php }elseif(isset($_GET) && $_GET[action]=='edit'){
					$det=mysql_fetch_array(mysql_query("select * from foodcategory where guid='$guid'"));?>
				
				<form action="foodcategory.php" method="post" name="form1" onSubmit="return valid()">
               <table class="table table-responsive table-bordered">

                          <tr><td>Category</td>
                     <td><select class="form-control" name="refid" required>
             <option value="">Select Category</option>
              <?php $qry=mysql_query("select * from category order by name asc");
			  while($row=mysql_fetch_assoc($qry))
			  {
				?><option value='<?php echo $row[guid];?>' <?php if($det[refid]==$row[guid]){?> selected<?php } ?>><?php echo $row[name];?></option><?php
			  }?>            	 	
			</select></td></tr>
            <tr><td>Sub Category</td><td>
                        <input type="text" name="topic" class="form-control" placeholder="Sub Category" value="<?php echo $det[name];?>"/>
                    </td></tr>
                        <tr><td>Image</td><td>
                        <input type="file" name="file_to_upload"/><br>
                        <img src="../../android/uploaded_files/<?php echo $det['image'];?>" width="100" height="100">
                    </td></tr>       
                    
               <tr><td colspan="2">  
               <input type="hidden" name="hidid" value="<?php echo $det[guid];?>">                                                          
                    <button type="submit" name="Submit" value="Update" class="btn bg-yellow btn-block">Update Sub Category</button>  
                </td></tr></table>
            </form><?php }else{?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="foodcategory.php?action=add"><button type="button" class="btn btn-success">Add sub Category</button></a>
                <section class="content">

				 <!-- top row -->
                   <table class="table table-responsive table-bordered">

                    	<thead>

                          <tr>

                        	

                            <th>Sno</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Image</th>
                            <th>Edit</th>
 <th>Delete</th>
                           
                           </tr>

                        </thead>

                        <tbody>

                         <?php 
include 'pageing.php';
						    $gridId = $_GET[guid];
							$limit = 90; 								

$filePath="foodcategory.php";

if($page) 
{
$start = ($page - 1) * $limit; 			
}
else
{
$start = 0;						
$page=1;
}
$query_clients="SELECT * FROM `foodcategory`  order by guid desc  Limit $start, $limit ";

$query_clients=mysql_query($query_clients);

$select1="SELECT * FROM `foodcategory`";

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
								$det=mysql_fetch_array(mysql_query("select * from category where guid='$client_count[refid]'"));?>

                        	<tr>

                            	<td><?php echo $m; ?></td>

                                 <td><?php echo $det[name];?></td>
                                  <td><?php echo $client_count[name];?></td>
                                  <td><img src="../../android/uploaded_files/<?php echo $client_count['image'];?>" width="100" height="100"></td>
                               
                               <td><a href="foodcategory.php?action=edit&guid=<?php echo $client_count[guid]; ?>"><button type="button" class="btn btn-default">Edit</button></a></td>
                                <td><a href="foodcategory.php?action=delete&deleteid=<?php echo $client_count[guid]; ?>" onClick="return delete1();"><button type="button" class="btn btn-danger">Delete</button></a></td>

                            </tr>

                          <?php $m++;} ?>

                        </tbody>

                        <tfoot>

                        	<tr>

                            	<th colspan="6"> Showing <?php echo $page;?> of <?php echo $totals;?> Pages </th>

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
    </body>
</html>