<?php
ob_start();
session_start();
if(isset($_POST["file_to_remove"]) && !empty($_POST["file_to_remove"]))
{
	$uploaded_files_location = '../../android/uploaded_files/'.strip_tags($_POST["file_to_remove"]);
	@chmod($uploaded_files_location,0777);
	@unlink($uploaded_files_location);
	
	$filenameremove='small'.$_POST["file_to_remove"];
	$uploaded_files_location1 = '../../android/uploaded_files/'.strip_tags($filenameremove);
	@chmod($uploaded_files_location1,0777);
	@unlink($uploaded_files_location1);
	
	$remove_item =strip_tags($_POST["file_to_remove"]).";";
	$_SESSION['upload_imgs'] = str_replace($remove_item, "",$_SESSION['upload_imgs']);
}
?>