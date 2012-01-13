<?php
	/* parts/download.php 
		Downloads a file! That's it!
	*/

	require_once("../utils/display.php");
	require_once("../utils/config.php");
	require_once("../utils/database.php");
	
	/* Converts a file size in bytes to an human-readable format - Source: PHP.net, rommel@rommelsantor.com */
	function human_filesize($bytes, $decimals = 2) {
		$sz = 'BKMGTP';
  		$factor = floor((strlen($bytes) - 1) / 3);
  		return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
	}

	/* Only proceed if the user is logged in and a file ID is provided */
	if(!isset($_SESSION['userid']) || !$_SESSION['userid'] || !isset($_GET['id'])) exit();
	
	db_connect();
	
	/* Step 1: Check if the user can download the file - based on the download flow restriction */
	$query = oci_parse($db_id, "SELECT SUM(filesize) FROM downloads, files WHERE downloads.id_user = :iduser AND downloads.id_file = files.id_file AND downloads.download_date > " . (time()-$_CONFIG['download-maxtime']));
	oci_bind_by_name($query, ':iduser', $_SESSION['userid']);
	oci_execute($query);
	$result = oci_fetch_array($query);
	if($result[0] > $_CONFIG['download-maxsize']) {
		// FIXME Would be nice actually showing the time to the user.
		echo "Sorry you reached the downlaod treshold, having already downloaded " . human_filesize($result[0]) . " in the specified time. Try again later.";
		exit();
	}
	
	/* Step 2: Check if he can download - based this time on the amount of downloads in last 24 hours */
	$query = oci_parse($db_id, "SELECT COUNT(*) FROM downloads, files WHERE downloads.id_user = :iduser AND downloads.id_file = files.id_file AND downloads.download_date > " . (time()-86400));
	oci_bind_by_name($query, ':iduser', $_SESSION['userid']);
	$count = oci_execute($query);
	$result = oci_fetch_array($query);
	if($result[0] >= $_CONFIG['download-maxamount']) {
		echo "Sorry you already downloaded a total of " . $result[0] . " files in last 24 hours, which exceed the limit.";
		exit();
	}
	
	/* Step 3: Get the file name */
	$query = oci_parse($db_id, "SELECT name FROM files WHERE id_file=:id");
	oci_bind_by_name($query, ':id', $_GET['id']);
	oci_execute($query);
	$result = oci_fetch_array($query);
	if(!$result) { 
		echo "The file you specified doesn't exist!";
		exit();
	}
	$filename = $result[0];
	
	/* Step 4: Increment the download count */
	$query = oci_parse($db_id, "UPDATE files SET downloads=downloads+1 WHERE id_file=:id");
	oci_bind_by_name($query, ':id', $_GET['id']);
	oci_execute($query);
	
	/* Step 5: Add an entry in the downloads table */
	$query = oci_parse($db_id, "INSERT INTO downloads (id_download, id_user, id_file, download_date) VALUES(downloadsIDs.NEXTVAL, ". $_SESSION['userid']. ",". $_GET['id']. ", " . time() .")" );
	oci_execute($query);
	
	/* Step 6: Redirect the user */
	header("Location: ../uploads/$filename"); 
	
?>
