<?php	
	/* We need the database information present in the config file */
	require_once(__DIR__ . "/config.php");

	function db_connect() {
		global $db_id;
		global $_CONFIG;

		/* If already connected, return the current connection ID */
		if(isset($db_id)) return $db_id;
		$db_id = oci_connect($_CONFIG['oracle-user'], $_CONFIG['oracle-passwd'], $_CONFIG['oracle-host'] . '/' . $_CONFIG['oracle-id']);

		/* Connection error handling */
		if(!$db_id) {
			unset($db_id);
			return false;
		}

		return $db_id;
	}

	function db_close() {
		global $db_id;

		if(!isset($db_id)) return;
		oci_close($db_id);
		unset($db_id);
	}

?>
