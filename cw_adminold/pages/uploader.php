<?php ob_start();
session_start();
 function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
$uploaded_files_location = '../../android/uploaded_files/'; 
$picname=basename($_FILES['file_to_upload']['name']);
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


$newwidth=460;
$newheight=460;
$tmp=imagecreatetruecolor($newwidth,$newheight);
imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
$filename = "../../android/uploaded_files/small".$picname;
imagejpeg($tmp,$filename,50);
imagedestroy($src);
imagedestroy($tmp);
}}

if (move_uploaded_file($_FILES['file_to_upload']['tmp_name'], $final_location)) 
{
	 $return_array  = array('name' =>$picname , 'retmsg'=>'file_uploaded_successfully');
	if(isset($_SESSION['upload_imgs']))
		$_SESSION['upload_imgs'] = $_SESSION['upload_imgs'].$picname.";";
	else
		$_SESSION['upload_imgs'] = $picname.";";
} 
else 
{
	 $return_array  = array('name' =>$picname , 'retmsg'=>'file_upload_was_unsuccessful');
}
echo json_encode($return_array );
?>