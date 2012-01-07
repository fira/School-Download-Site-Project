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

	/* Check if a file (with its description and category) was browsed to be uploaded */
	
	if(isset($_POST['file_cat'], $_POST['desc'] && (($_POST['file_cat']) && $_POST['desc'])) {
	
	$exist = 'SELECT COUNT(name) FROM files WHERE name =' .$_FILES['name'];
	$same_files = oci_execute($exist)
	if ($same_files != 0) {
		$_FILES['name'] = $same_files."-"$_FILES['name'];
		}

	if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
		echo "The file ".  basename( $_FILES['uploadedfile']['name']). 
    " has been uploaded";
	} else{
		echo "There was an error uploading the file, please try again!";
	}

	if(!db_connect()) { echo "Error while connecting to the database. Try again later? <br />"; 
		} else {
			/* Constructs the query and send it to the database */	
	
	$query = oci_parse($db_id, "INSERT INTO files(name,type,filesize,id_user,id_file,upload_date,downloads,description) VALUES('" . $_FILES['name'] . "','" . $_POST['file_cat'] . "','" . $_FILES['size'] . "', , filesIDs.NEXTVAL, '" . date("F j, Y, g:i a") . "', ,'" . $_POST['desc'] . "')");


?>
