<?php ob_start();
session_start();$date=date('Y-m-d');extract($_POST);extract($_GET);
include 'secure.php';include '../../config.php'; 
if(isset($_GET) && $_GET[deleteid]!='')
{
mysql_query("delete from storecategory where guid='$_GET[deleteid]'");
header('location:storecategory.php');	
}
	 function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
if(isset($_POST) && $_POST[event]!='' && $_POST[hidid]=='')
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
$area='';
for($i=0;$i<count($areas);$i++)
	{
	$chk=mysql_fetch_array(mysql_query("select * from area where guid='$areas[$i]'"));
	if($areas[$i]!='')
	{
	$area.=$areas[$i].',';
	}
	}
	$area = rtrim($area, ',');
mysql_query("INSERT INTO `storecategory` (`name`,`image`,areas) VALUES ('$event','$picname','$area')");
header('location:storecategory.php');	
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

//echo $qry="update `storecategory` set `image`='$picname', where guid='$hidid'";exit;

mysql_query("update `storecategory` set `image`='$picname' where guid='$hidid'");
}
$area='';
for($i=0;$i<count($areas);$i++)
	{
	$chk=mysql_fetch_array(mysql_query("select * from area where guid='$areas[$i]'"));
	if($areas[$i]!='')
	{
	$area.=$areas[$i].',';
	}
	}
	 $area = rtrim($area, ',');
mysql_query("update `storecategory` set `name`='$event',areas = '$area' where guid='$hidid'");
header('location:storecategory.php');	
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
                       Store Categories
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Admin</li>
                    </ol>
                </section>

                <!-- Main content -->
                <?php if(isset($_GET) && $_GET[action]=='add'){?>
				
				<form action="storecategory.php" method="post" name="form1" onSubmit="return valid()" enctype="multipart/form-data">
               <table class="table table-responsive table-bordered">

                          <tr><td>Category Name</td><td>
                        <input type="text" name="event" class="form-control" placeholder="Category Name"/>
                    </td></tr>
					<tr><td>Area's
					<!--input type="button" name="CheckAll" value="Select All" onClick="checkedAll(frm1)"-->
					</td><td>
					
					
                              <?php $m=0;$news1=mysql_query("select * from area order by name asc ");
					
while ($state=mysql_fetch_assoc($news1)) {$m++;
if($m%8==0){echo "<br>";}?><label>
<input type="checkbox" name="areas[]" class = "checkboxarea"  value="<?php echo $state['guid'];?>"><?php echo $state['name'];?></label>&nbsp;
                <?php } ?></td></tr>
                             
                    <tr><td>Image</td><td>
                        <input type="file" name="file_to_upload"/>
                    </td></tr>
                    
               <tr><td colspan="2">                                                            
                    <button type="submit" name="Submit" value="Update" class="btn bg-yellow btn-block">Add Category Name</button>  
                </td></tr></table>
            </form>
				<?php }elseif(isset($_GET) && $_GET[action]=='edit'){
					$det=mysql_fetch_array(mysql_query("select * from storecategory where guid='$guid'"));?>
				
				<form action="storecategory.php" method="post" name="form1" onSubmit="return valid()" enctype="multipart/form-data">
               <table class="table table-responsive table-bordered">

                          <tr><td>Category Name</td><td>
                        <input type="text" name="event" class="form-control" placeholder="Category Name" value="<?php echo $det['name'];?>"/>
                    </td></tr>
					<tr><td>Area's
					<!--input type="button" name="CheckAll" value="Select All" onClick="checkedAll(frm1)"-->
					</td><td>
					
					
                              <?php $m=0;$news1=mysql_query("select * from area order by name asc ");
					$spt=split(',',$det['areas']);
while ($state=mysql_fetch_assoc($news1)) {$m++;
if($m%8==0){echo "<br>";}?><label>
<input type="checkbox" name="areas[]" class = "checkboxarea" <?php if(in_array($state['guid'],$spt)){?> checked<?php } ?> value="<?php echo $state['guid'];?>"><?php echo $state['name'];?></label>&nbsp;
                <?php } ?></td></tr>
                     <tr><td>Image</td><td>
                        <input type="file" name="file_to_upload"/><br>
                        <img src="../../android/uploaded_files/<?php echo $det['image'];?>">
                    </td></tr>        
                    
               <tr><td colspan="2">  
               <input type="hidden" name="hidid" value="<?php echo $det['guid'];?>">                                                          
                    <button type="submit" name="Submit" value="Update" class="btn bg-yellow btn-block">Update Category Name</button>  
                </td></tr></table>
            </form><?php }else{?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="storecategory.php?action=add"><button type="button" class="btn btn-success">Add Category</button></a>
                <section class="content">

				 <!-- top row -->
                   <table class="table table-responsive table-bordered">

                    	<thead>

                          <tr>

                        	

                            <th>Sno</th>
                            <th>Category</th><th>Area's</th>
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
$filePath="storecategory.php";

if($page) 
{
$start = ($page - 1) * $limit; 			
}
else
{
$start = 0;						

$page=1;
}
$query_clients="SELECT * FROM `storecategory`  order by guid desc  Limit $start, $limit ";

$query_clients=mysql_query($query_clients);

$select1="SELECT * FROM `storecategory`";

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
								//$check=mysql_fetch_array(mysql_query("select * from category where guid='$client_count[referral]'"));
								$spt=split(',',$client_count['areas']);
								?>

                        	<tr>

                            	<td><?php echo $m; ?></td>

                                <td><?php echo $client_count['name'];?></td>
								<td><?php  
								  for($j=0;$j<count($spt);$j++){if($spt[$j]!=''){
								  $csk=mysql_fetch_array(mysql_query("select * from area where guid='$spt[$j]'"));
								  ?>
                               <?php echo $j+1;echo ". "; echo $csk['name'];?><?php echo "<br>";}}?></td>
                               <td><?php if($client_count['image']!=''){?><img src="../../android/uploaded_files/<?php echo $client_count['image'];?>" width="100" height="100"><?php } ?></td>
							   
                               <td><a href="storecategory.php?action=edit&guid=<?php echo $client_count[guid]; ?>"><button type="button" class="btn btn-default">Edit</button></a></td>
                                
                                <td><a href="storecategory.php?action=delete&deleteid=<?php echo $client_count[guid]; ?>" onClick="return delete1();"><button type="button" class="btn btn-danger">Delete</button></a></td>

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
    </body>
</html>
