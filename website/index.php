<?php
	/* index.php
		The website main page. That's pretty much the only page the user should see directly.
		All the other pages and files are either loaded through AJAX on the Index page,
		or included via PHP.
	*/ 
	
	// We have to include all the neccessary files
	require_once("utils/display.php");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/html4/loose.dtd">

<html>
	<head>
		<title></title>

		<!-- JQuery script -->
		<script type="text/javascript" src="js/jquery-1.7.min.js"></script>

		<!-- JQuery-UI script and theme -->
		<link type="text/css" href="jquery-ui-theme/custom-theme/jquery-ui-1.8.16.custom.css" rel="stylesheet"/>
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
		<div id="reg-dialog" title="Signing up"></div>
		<div id="login-dialog" title="Signing in"></div>

		<button id="reg-button">Sign up</button>
		<button id="login-button">Sign in</button>
	</body>
</html>
