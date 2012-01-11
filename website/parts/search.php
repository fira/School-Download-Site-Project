<?php
	/* parts/search.php
		Searches for a file in the databasee
	*/

	require_once("../utils/display.php");
	require_once("../utils/config.php");
	require_once("../utils/database.php");


	/* Get the status of the radio buttons */
	if($_POST['selection'] == "user") {
		$filter = " AND id_user = " . $_SESSION['userid'];
	} else { $filter = ""; }

	$request = '%' . $_POST['text'] . '%';

	db_connect();
	$query = oci_parse($db_id, "SELECT * FROM files WHERE name LIKE :request" . $filter);
	oci_bind_by_name($query, ':request', $request);
	
	if(!oci_execute($query)) exit();

?>	<table class="tablesorter" id="resultstable">
			<thead>
				<tr>
					<th>File Name</th>
					<th>Category</th>
					<th>Size</th>
					<th>Date</th>
					<th>Downloads</th>
					<th>Description</th>
					<th></th>
				</tr>
			</thead>

			<tbody>	
<?php	
	while($entry = oci_fetch_array($query)) {
		echo "<tr>";
		echo "<td>" . $entry['NAME'] . "</td>";
		echo "<td>" . $entry['TYPE'] . "</td>";
		echo "<td>" . $entry['FILESIZE'] . "</td>";
		echo "<td>" . $entry['UPLOAD_DATE'] . "</td>";
		echo "<td>" . $entry['DOWNLOADS'] . "</td>";
		echo "<td>" . $entry['DESCRIPTION'] . "</td>";
		echo "<td><a href='parts/download.php?id=" . $entry['ID_FILE'] . "'>Download!</a></td>";
		echo "</tr>";
	}

	db_close();
?>


			</tbody>
	</table>



