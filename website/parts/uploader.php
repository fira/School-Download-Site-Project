<?php

	/* parts/uploader.php
	This page will process the form data from the index page, store the information and the type
	of the files in an array and save the uploaded files in the /uploads directory
	*/
	
	// Where the file is going to be placed 
	
	$target_path = "uploads/";

	/* Add the original filename to our target path.  
	Result is "uploads/filename.extension" */
	
	$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 
	
	$target_path = "uploads/";

	$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 

	if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
		echo "The file ".  basename( $_FILES['uploadedfile']['name']). 
    " has been uploaded";
	} else{
		echo "There was an error uploading the file, please try again!";
	}