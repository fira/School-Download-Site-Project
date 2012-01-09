<?php
	require_once("utils/database.php");
	require_once("utils/display.php");

	/* Login info */
	if(!isset($_SESSION['userid'])) { ?>
		<div id="reg-dialog" title="Signing up"></div>
		<div id="login-dialog" title="Signing in"></div>
		<button id="reg-button">Sign up</button>
		<button id="login-button">Sign in</button>
	<?php } else { ?>
		<button id="logout-button">Log out</button><br /><br />
	<?php } 
	
	/* Actual page body - to be displayed only to registered users */ 
	if(isset($_SESSION['userid'])) {	?>
				
		<fieldset style="overflow: hidden; float: left;">
			<legend>Upload a file</legend>
			<div id="upload" title="File Upload">
				<form enctype="multipart/form-data" action="parts/uploader.php" method="POST">
					<table><tr><td>
					<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
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
					<td rowspan="2"><input type="image" alt="Upload" width="158" height="45" src="images/upload/upload_button.png"/></td>
					</tr>
					<tr><td>
					<label for="desc">Description: </label>
					<?php insertField("desc", true, false, " id='desc' size='40' maxlength='40'"); ?>
					</td></tr>
					</table>
				</form>
			</div>
		</fieldset>

		<?php } else { ?>
		You are not logged in! Please login with the buttons at the top of the page
		<?php } 

?>
