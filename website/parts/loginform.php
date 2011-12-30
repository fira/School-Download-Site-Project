<?php
	/* parts/loginform.php 
		Login form and its processing
		To be loaded thru AJAX: no headers, no scripts, no stylsheets, but PHP includes.
	*/

	require_once("../utils/display.php");

	/* If we validated the form already */
	if(isset($_POST['user']) && (isset($_POST['password'])) && $_POST['user'] != "" && $_POST['password'] != "") {

		/* We have to do the Database Query and check here */
		//echo "Plaaaaaaace...wait for it...holder!<br />";
		/* For the sake of testing, we'll assume it's always invalid */
		$loginresult = 2;

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
