<?php
	/* parts/loginform.php 
		Login form and its processing
		To be loaded thru AJAX: no headers, no scripts, no stylsheets, but PHP includes.
	*/

	require_once("../utils/display.php");
	require_once("../utils/config.php");
	require_once("../utils/database.php");

	/* If we validated the form already */
	if(isset($_POST['user']) && (isset($_POST['password'])) && $_POST['user'] != "" && $_POST['password'] != "") {
		
		/* FIXME The query won't work using oci_bind_by_name for some reason?? 
		And this is badly prone to SQL Injection without it */
		db_connect();
		$query = oci_parse($db_id, "SELECT * FROM users WHERE username='". $_POST['user']. "' AND password='" . crypt($_POST['password'], "$2a$08$".$_CONFIG['salt']) . "'" );
		//oci_bind_by_name($query, ':user', $_POST['user']);
		//oci_bind_by_name($query, ':password', crypt($_POST['password'], "$2a$08$".$_CONFIG['salt']));
		$result = oci_execute($query);

		if((!$result) || !($data = oci_fetch_array($query))) { $loginresult = 2;
		} else { 
			$_SESSION['userid'] = $data['ID_USER'];
			$_SESSION['username'] = $data['USERNAME'];
			
			// Also update last login date.. but only if he logged in last month
			// Otherwise we'll show him the re-registration form later
			if((time() - $data['LASTLOGIN']) < 3600*24*30) {
				$query = oci_parse($db_id, "UPDATE users SET lastlogin = " . time() . " WHERE id_user = " . $data['ID_USER']);
				oci_execute($query);
			} else { 
				$_SESSION['outdated'] = true;
			}
			
			// FIXME Should load only the contents id div element instead of reloading the whole page
			?><script type="text/javascript">window.location.reload()</script>
			<?php echo "Log in OK - Reloading the main page...";
			$loginresult = 0;
		}

	} else { $loginresult = 1; }

	/*	$loginresult = 0 : login OK
		$loginresult = 1 : didnt try to login, display the form
		$loginresult = 2 : login error, display the form again + errorbox 	*/

	if($loginresult) {
		/* Info box to tell the user he can also sign up if he dont have an account. */
		widget_infobox("<strong><a href='#' onclick=\"$('#login-dialog').dialog('destroy'); initRegDialog();\">No account? Sign up.</a></strong>", true); 
		echo "<br/ >";

		/* If the previous login failed, we tell the user about it */
		if($loginresult == 2) { 
			widget_errorbox("<strong>Invalid Username or Password !</strong>", true);
			echo "<br />";
		}
	
		?>

		<form id="login-form" method="post" action="parts/loginform.php">
			<fieldset>
				<legend>Login as</legend>
			
				<table>
					<tr><td width='100px'><label for="user">Username:</label></td>
						<td><?php insertField("user"); ?></td>
					</tr>
		
					<tr height='10px'></tr>
			
					<tr><td><label for="password">Password:</label></td>
						<td><?php insertField("password", false, true); ?></td>
					</tr>
				</table>
			</fieldset>
		</form>
		
		<br />

<?php	} 	
?>
