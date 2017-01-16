/********************************************************************************
* This script is brought to you by Vasplus Programming Blog
* Website: www.vasplus.info
* Email: info@vasplus.info
*********************************************************************************/

//This does the file Uploads
jQuery(document).ready(function()
{
	var uploaded_files_location = "../../android/uploaded_files";
	new AjaxUpload(jQuery('#vpb_upload_button'), 
	{
		action: 'uploader.php',
		name: 'file_to_upload',
		 dataType:'json',
		onSubmit: function(file, file_extensions)
		{
			jQuery('.vpb_main_demo_wrapper').show(); //This is the main wrapper for the uploaded items which is hidden by default
			
			//Allowed file formats jpg|png|jpeg|gif|pdf|docx|doc|rtf|txt - You can add as more file formats or remove as you wish.
			if ((file_extensions && /^(jpg|png|jpeg|gif)jQuery/.test(file_extensions)))
			{
			//alert(file_extensions);	//If file format is not allowed then, display an error message to the user
				jQuery('#vpb_uploads_error_displayer').html('<div class="vpb_error_info" align="left">Sorry, you can only upload the following file formats:  JPG, PNG and GIF. Thanks...</div>');
				return false;
			}
			else
			{
			  jQuery('#vpb_uploads_error_displayer').html('<div class="uplading_image">Uploading <img src="images/loadings.gif" align="absmiddle" /></div>');
			  return true;
			}
		},
		onComplete: function(file, response1)
		{
			console.log(response1);
			var parsed_array=JSON.parse(response1);
			file  = parsed_array['name'];
			response = parsed_array['retmsg'];
			if(response === "file_uploaded_successfully")
			{
				jQuery('#vpb_uploads_error_displayer').html(''); //Empty the error message box
				
				
				//Check the type of file uploaded and display it rightly on the screen to the user and that's cool man
				var type_of_file_uploaded = file.substring(file.lastIndexOf('.') + 1); //Get files extensions
				
				var files_name_without_extensions = file.substr(0, file.lastIndexOf('.')) || file;
				vpb_file_names = files_name_without_extensions.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '');
				
				if(type_of_file_uploaded == "gif" || type_of_file_uploaded == "GIF" || type_of_file_uploaded == "JPEG" || type_of_file_uploaded == "jpeg" || type_of_file_uploaded == "jpg" || type_of_file_uploaded == "JPG" || type_of_file_uploaded == "png" || type_of_file_uploaded == "PNG")
				{
					jQuery('#vpb_uploads_displayer').append('<div class="vpb_image_wrappers" id="fileID'+vpb_file_names+'" align="center"><div class="vpb_image_names">'+file+'</div><img src="'+uploaded_files_location+'/'+file+'" class="vpb_image_design" /><div id="vpb_remove_button'+vpb_file_names+'" class="vpb_remove_button" onclick="remove_unwanted_file(\''+vpb_file_names+'\',\''+file+'\');">Remove</div></div>');
				} 
				else if(type_of_file_uploaded == "doc" || type_of_file_uploaded == "docx" || type_of_file_uploaded == "rtf" || type_of_file_uploaded == "DOC" || type_of_file_uploaded == "DOCX" || type_of_file_uploaded == "RTF")
				{
					jQuery('#vpb_uploads_displayer').append("<div class='vpb_image_wrappers' id='fileID"+vpb_file_names+"' style='padding-top:60px;padding-bottom:70px;' align='center'><span class='ccc'><a href='"+uploaded_files_location+"/"+file+"' target='_blank'>Microsoft Word Document<br><br>Click here to download it</a></span><div id='vpb_remove_button"+vpb_file_names+"' class='vpb_remove_button' onclick='remove_unwanted_file(\""+vpb_file_names+"\",\""+file+"\");'>Remove</div></div>");
				}
				else if(type_of_file_uploaded == "pdf" || type_of_file_uploaded == "PDF")
				{
					jQuery('#vpb_uploads_displayer').append("<div class='vpb_image_wrappers' id='fileID"+vpb_file_names+"' style='padding-top:60px;padding-bottom:70px;' align='center'><span class='ccc'><a href='"+uploaded_files_location+"/"+file+"' target='_blank'>PDF Document<br><br>Click here to view it</a></span><div id='vpb_remove_button"+vpb_file_names+"' class='vpb_remove_button' onclick='remove_unwanted_file(\""+vpb_file_names+"\",\""+file+"\");'>Remove</div></div>");
				}
				else if(type_of_file_uploaded == "txt" || type_of_file_uploaded == "TXT")
				{
					jQuery('#vpb_uploads_displayer').append("<div class='vpb_image_wrappers' id='fileID"+vpb_file_names+"' style='padding-top:60px;padding-bottom:70px;' align='center'><span class='ccc'><a href='"+uploaded_files_location+"/"+file+"' target='_blank'>Text File Document<br><br>Click here to view it</a></span><div id='vpb_remove_button"+vpb_file_names+"' class='vpb_remove_button' onclick='remove_unwanted_file(\""+vpb_file_names+"\",\""+file+"\");'>Remove</div></div>");
				}
				else
				{
					jQuery('#vpb_uploads_displayer').append("<div class='vpb_image_wrappers' id='fileID"+vpb_file_names+"' style='padding-top:80px;padding-bottom:90px;' align='center'>"+file+" uploaded<br clear='all'><div id='vpb_remove_button"+vpb_file_names+"' class='vpb_remove_button' onclick='remove_unwanted_file(\""+vpb_file_names+"\",\""+file+"\");'>Remove</div></div>");
				}
			} 
			else
			{
				jQuery('#vpb_uploads_error_displayer').html('<div class="vpb_error_info" align="left">Sorry, your file upload was unsuccessful. Please reduce the size of your file and try again or contact this site admin to report this error message if the problem persist. Thanks...</div>');
			}
		}
	});
	
});


//This removes all unwanted files
function remove_unwanted_file(id,file)
{
	if(confirm("If you are sure that you really want to remove the file "+file+" then click on OK otherwise, Cancel it."))
	{
		var dataString = "file_to_remove=" + file;
		jQuery.ajax({
			type: "POST",
			url: "remove_unwanted_files.php",
			data: dataString,
			cache: false,
			beforeSend: function() 
			{
				jQuery("#vpb_remove_button"+id).html('<img src="images/loadings.gif" align="absmiddle" />');
			},
			success: function(response) 
			{
				jQuery('div#fileID'+id).fadeOut('slow');	
				//jQuery('.vpb_main_demo_wrapper').hide();
			}
		});
	}
	return false;
}