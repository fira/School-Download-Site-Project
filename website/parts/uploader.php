<?php

	/* parts/uploader.php
	This page will process the form data from the index page, store the information and the type
	of the files in an array and save the uploaded files in the /uploads directory
	*/
	
	require_once("../utils/config.php");
	require_once("../utils/database.php");

	// Where the file is going to be placed 
	$target_path = __DIR__ . "/../uploads/";
	
	/* Add the original filename to our target path.  
	Result is "uploads/filename.extension" */
	
	$userid = $_SESSION['userid'];						
	$filename = $_FILES['uploadedfile']['name'];		// The file's original name (as sent by the user)
	$filesize = $_FILES['uploadedfile']['size'];		// The file size in bytes
	$filetmp = $_FILES['uploadedfile']['tmp_name'];		// The file's current name in the temporary directory
	$filetype = $_POST['file_cat'];						// The uploaded file's type 

	/* FIXME We should check if the file's too big before proceeding */

	if(!$filename) exit();

	/* Check if a file (with its description and category) was browsed to be uploaded */
	if(!isset($_POST['desc'])) $_POST['desc'] = "";

	$searchpattern = "%$filename";
	
	db_connect();	
	$exist = oci_parse($db_id, 'SELECT COUNT(name) FROM files WHERE name LIKE :name');
	oci_bind_by_name($exist, ':name', $searchpattern);
	if(!oci_execute($exist)) { echo "Couldn't upload the file!"; exit(); }
	$result = oci_fetch_row($exist);

	if ($result[0]) {
		$filename = $result[0] . "-" . $filename;
	}

	$target_path = $target_path . basename($filename); 

	/* Constructs the query and send it to the database */	
	if(move_uploaded_file($filetmp, $target_path)) {
		echo "The file ".  basename($filename). " has been uploaded";
	} else {
		echo "There was an error uploading the file, please try again!";
	}

	$query = oci_parse($db_id, "INSERT INTO files(name,type,filesize,id_user,id_file,upload_date,downloads,description) VALUES('" . $filename . "','" . $filetype . "','" . $filesize . "','" . $_SESSION['userid'] . "', filesIDs.NEXTVAL, '" . time() . "', 0 ,'" . $_POST['desc'] . "')"); 
	$result = oci_execute($query);

	db_close();
?>
