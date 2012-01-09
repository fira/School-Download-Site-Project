<?php
	/* index.php
		The website main page. That's pretty much the only page the user should see directly.
		All the other pages and files are either loaded through AJAX on the Index page,
		or included via PHP.
	*/ 
	
	// We have to include all the neccessary files
	require_once("utils/database.php");
	require_once("utils/display.php");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/html4/loose.dtd">

<html>
	<head>
		<title><?php echo $_CONFIG['title']; ?></title>

		<!-- JQuery script -->
		<script type="text/javascript" src="js/jquery-1.7.min.js"></script>

		<!-- JQuery-UI script and theme -->
		<link type="text/css" href="<?php echo $_CONFIG['jqui-theme']; ?>" rel="stylesheet"/>
		<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>

		<!-- JQuery Tablesorter plugin and its theme, to be used on the downloads list -->
		<link type="text/css" href="css/tablesorter-blue.css" rel="stylesheet"/>
		<script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
		
		<!-- JQuery Form plugin to handle forms more easily -->
		<script type="text/javascript" src="js/jquery.form.js"></script>
		
		<!-- Website main style -->
		<link type="text/css" href="css/style.css" rel="stylesheet"/>

		<!-- JavaScript for the index page, doing AJAX requests, displaying JQuery widgets... etc -->
		<script type="text/javascript" src="js/global.js"></script>
	</head>



	<!-- 
		Note that because most elements are embedded via AJAX, or handled by JQuery, 
		the body of the main page should be fairly simple. 
	-->

	<body>
		<?php 
			/* Banner should be here */
	
			/* Page header, showing the login info */
			if(!isset($_SESSION['userid'])) { ?>
				<div id="reg-dialog" title="Signing up"></div>
				<div id="login-dialog" title="Signing in"></div>
				<button id="reg-button">Sign up</button>
				<button id="login-button">Sign in</button>
			<?php } else { ?>
				Logged in as: <?php echo $_SESSION['username']; ?>
				<button id="logout-button">Log out</button>
			<?php } 

	
			/* Actual page body - to be displayed only to registered users */
			?><div id="contents">
			<?php if(isset($_SESSION['userid'])) {	?>
				
				<div id="upload" title="File Upload">
		
					<form enctype="multipart/form-data" action="parts/uploader.php" method="POST">
						<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
						Choose a file to upload: <input name="uploadedfile" type="file"/><br />
						<input type="image" alt="Upload" width="158" height="45" src="images/upload/upload_button.png"/>
		
						<label for="file_cat">File's Type</label><br />
						<select name="file_cat" id="category">
							<option value="archive">Archive (RAR, ZIP...)</option>
							<option value="book">Book (PDF, DOC...)</option>
							<option value="video">Video (AVI, MP4...)</option>
							<option value="music">Music (MP3, WMA...)</option>
							<option value="soft">Software (EXE, MSI...)</option>
							<option value="picture">Picture (JPEG, PNG...)</option>
						</select>
			
						<label for="desc">File's Description</label>
						<input type="text" name="desc" id="desc" placeholder="Maximum 40 characters" size="40" maxlength="40" />		   
					</form>
				</div>

			<?php } else { ?>
			You are not logged in! Please login with the buttons at the top of the page
			<?php } ?>
			</div>
	</body>
</html>
