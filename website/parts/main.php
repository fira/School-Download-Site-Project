<?php
	require_once("utils/database.php");
	require_once("utils/display.php");

	/* Login info */
	if(!isset($_SESSION['userid'])) { ?>
		You are not logged in! Please login with the buttons at the top of the page
		
		
	<?php } elseif(isset($_SESSION['outdated']) && $_SESSION['outdated']) {
		/* In this case, the user has to reenter his informations to proceed */
		db_connect();
		$query = oci_parse($db_id, "SELECT * FROM users WHERE id_user = " . $_SESSION['userid']);
		oci_execute($query);
		$data = oci_fetch_array($query);
		
	?><form id="rereg-form" method="POST" action="parts/rereg.php">
		<p>You have not logged in 30 days.<br />Please update your login information below<br /></p>
		<fieldset class="mainfieldset">
			<table>
				<tr><td width='200px'><label for="email">Email:</label></td>
					<td><?php insertField("email", false, false, " value='" . $data['MAIL']. "'"); ?></td>
				</tr>
			</table><br />
			<input type="submit" id="validbutton" />
		</fieldset>
	</form>
		
		
<?php		
	} else { ?>

		<?php widget_infobox("Currently logged in as: ". $_SESSION['username'], true, "userinfobox"); ?><br />
				
		<fieldset class="mainfieldset">
			<legend>Upload a file</legend>
			<div id="upload">
				<form enctype="multipart/form-data" action="parts/uploader.php" method="POST">
					<table><tr><td>
					<select name="file_cat" id="category">
						<option value="undefined">--Type--</option>
						<option value="archive">Archive (RAR, ZIP...)</option>
						<option value="book">Book (PDF, DOC...)</option>
						<option value="video">Video (AVI, MP4...)</option>
						<option value="music">Music (MP3, WMA...)</option>
						<option value="soft">Software (EXE, MSI...)</option>
						<option value="picture">Picture (JPEG, PNG...)</option>
					</select>
					<input name="uploadedfile" type="file"/></td>
					<td rowspan="2"><input onclick="this.form.target='_blank';return true;" type="image" alt="Upload" width="158" height="45" src="images/upload/upload_button.png" /></td>
					</tr>
					<tr><td>
					<label for="desc">Description: </label>
					<?php insertField("desc", true, false, " id='desc' size='40' maxlength='40'"); ?>
					</td></tr>
					</table>
				</form>
			</div>
		</fieldset>

		<br /><br />

		<fieldset class="mainfieldset">
			<legend>Search for files</legend>
			<form id="search-form" method="POST" action="parts/search.php">
				<table width="100%"><tr>
					<td><?php insertField("text"); ?></td>
					<div id="searchradio">
						<td><input type="radio" id="searchradio-all" name="selection" value="all" checked="checked" /><label for="searchradio-all">All files</label></td>
						<td><input type="radio" id="searchradio-user" name="selection" value="user" /><label for="searchradio-user">My Files</label></td>
					</div>
					<td><input type="image" alt="Search" src="images/upload/search_button.png" /></td>
				</tr></table>
			</form>
		</fieldset>

		<br />
		
				<span id="searchresults">
				</span>

<?php } ?>
