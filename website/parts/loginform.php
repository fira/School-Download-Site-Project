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
		
		db_connect();
		$query = oci_parse($db_id, "SELECT * FROM users WHERE username=:user AND password=:password");
		oci_bind_by_name($query, ':user', $_POST['user']);
		oci_bind_by_name($query, ':password', crypt($_POST['password'], "$2a$08$".$_CONFIG['salt']));
		$result = oci_execute($query);
		db_close();
	
		/* FIXME this part needs to be prooftested with an actual oracle system */
		if(!$result['id_user']) { $loginresult = 2;
		} else { 
			$_SESSION['userid'] = $result['id_user'];
			$_SESSION['username'] = $result['username'];
			
			// FIXME What to do once logged in ???? Should reload the main page, maybe ?
			echo "Erm. Login Successful. Look, a placeholder !";
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
