<?php
	/* parts/rereg.php
	*/

	require_once("../utils/database.php");
	
	/* Check the user is logged in and the information is valid */
	if(!isset($_SESSION['userid']) || !$_SESSION['userid']
	|| !isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) header("Location: ../index.php");

	/* Update the user entry with his new email, and set his account as valid again */
	db_connect();
	$query = oci_parse($db_id, "UPDATE users SET mail=:email, lastlogin=" . time() . " WHERE id_user=:id");
	oci_bind_by_name($query, ':email', $_POST['email']);
	oci_bind_by_name($query, ':id', $_SESSION['userid']);
	oci_execute($query);
	
	/* Change the session vars so that his account is valid again */
	$_SESSION['outdated'] = false;
	
	/* Send him back to the main page */
	header("Location: ../index.php");
	
?>
