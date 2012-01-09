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

	<body>
		<!-- Banner should be here -->
	
		<div id="contents">
			<?php include("parts/main.php"); ?>
		</div>
	</body>
</html>
