<?php
	/* parts/download.php 
		Downloads a file! That's it!
	*/

	require_once("../utils/display.php");
	require_once("../utils/config.php");
	require_once("../utils/database.php");

	/* Only proceed if the user is logged in and a file ID is provided*/
	if(!isset($_SESSION['userid']) || !$_SESSION['userid'] || !isset($_GET['id'])) exit();
	
	db_connect();
	
	/* Step 1: Get the file name */
	$query = oci_parse($db_id, "SELECT name FROM files WHERE id_file=:id");
	oci_bind_by_name($query, ':id', $_GET['id']);
	oci_execute($query);
	$result = oci_fetch_array($query);
	if(!$result) { 
		echo "The file you specified doesn't exist!";
		exit();
	}
	$filename = $result[0];
	
	/* Step 2: Increment the download count */
	$query = oci_parse($db_id, "UPDATE files SET downloads=downloads+1 WHERE id_file=:id");
	oci_bind_by_name($query, ':id', $_GET['id']);
	oci_execute($query);
	
	/* Step 3: Add an entry in the downloads table */
	$query = oci_parse($db_id, "INSERT INTO downloads (id_download, id_user, id_file, download_date) VALUES(downloadsIDs.NEXTVAL, ". $_SESSION['userid']. ",". $_GET['id']. ", " . time() .")" );
	oci_execute($query);
	
	/* Step 4: Redirect the user */
	header("Location: ../uploads/$filename"); 
	
?>
