<?php
	/* parts/regform.php
		Registration form and its processing
		This page should normally be loaded through AJAX onto the main page, in a div
		As such we have to re-include any useful PHP file
		On the other hand it won't need a header, and the scripts and stylesheets are
		already included on the main page.
	*/
	
	require_once("../utils/display.php");

	/* Used here only: inserts an errorBox in the table */
	function regform_widget_errorbox($content) {
		echo "<tr><td colspan='2'>";
		widget_errorbox($content);
		echo "</td></tr>";
	}

	/* Check for the entered fields contents if there's some */
	if(isset($_POST['user']) && (strlen($_POST['user']) <= 3)) $fieldError['user'] = 1;
	if(isset($_POST['password']) && $_POST['password'] == "") $fieldError['password'] = 1;
	if(isset($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $fieldError['email'] = 1;
	if(isset($_POST['firstname']) && $_POST['firstname'] == "") $fieldError['firstname'] = 1;
	if(isset($_POST['lastname']) && $_POST['lastname'] == "") $fieldError['lastname'] = 1;

	/* If the fields are valid, we can go on to the registration process */
	if(isset($_POST['user'], $_POST['password'], $_POST['email'], $_POST['firstname'], $_POST['lastname']) && !(isset($fieldError))) {

		/* FIXME Need to query the database to add the user here */
		echo "I think i lost the database address. Sorry. Yeah, this is a bad placeholder, i know.";


	/* If the fields are invalid or empty, we display the form
	and the associated errors if there's some */
	} else {
		/* Display an infobox to tell the user he should login instead of registering if applicable.
		The scripts allows to swap from the registration dialog to the login dialog once clicked. */
		widget_infobox("<strong><a href='#' onclick=\"$('#reg-dialog').dialog('destroy'); initLoginDialog();\">Got an account? Sign in!</a></strong>", true); ?>
		<br />

		<form id="reg-form" method="post" action="parts/regform.php">
			<fieldset>
				<legend>Login Info</legend>
						
				<table>
					<tr><td width='200px'><label for="user">Username:</label></td>
						<td><?php insertField("user");?></td>
					</tr>

					<?php /* In case there's an error, add an errorBox to display it */
						if(isset($fieldError['user'])) regform_widget_errorbox("Username must be at least 3 chars long"); 
					?>
			
					<!-- Just a separation line. Probably not the right way to do it? -->
					<tr height="10px"></tr>
		
					<tr><td><label for="password">Password:</label></td>
						<td><?php insertField("password", true, true);?></td>
					</tr>

					<?php if(isset($fieldError['password'])) regform_widget_errorbox("You have to enter a password!"); ?>
				</table>

			</fieldset>
			<br />
			<fieldset>
				<legend>Personal Info</legend>

				<table>
					<tr><td width="200px"><label for="email">E-Mail Address:</label></td>
						<td><?php insertField("email");?></td>
					</tr>

					<?php if(isset($fieldError['email'])) regform_widget_errorbox("Please enter a valid email"); ?>
					<tr height="10px"></tr>

					<tr><td><label for="firstname">First Name:</label></td>
					<td><?php echo insertField("firstname");?></td>
					</tr>

					<?php if(isset($fieldError['firstname'])) regform_widget_errorbox("Please enter a name"); ?>
			
					<tr height="10px"></tr>

					<tr><td><label for="lastname">Last Name:</label></td>
					<td><?php echo insertField("lastname");?></td>
					</tr>

					<?php if(isset($fieldError['lastname'])) regform_widget_errorbox("Please enter a name"); ?>
				</table>
			</fieldset>
		</form>

<?php } ?>
