<?php
	require_once("../utils/display.php");

	/* Check for the entered fields contents if there's some */
	if(isset($_POST['user']) && (strlen($_POST['user']) <= 3)) $fieldError['user'] = 1;
	if(isset($_POST['password']) && $_POST['password'] == "") $fieldError['password'] = 1;
	if(isset($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $fieldError['email'] = 1;
	if(isset($_POST['firstname']) && $_POST['firstname'] == "") $fieldError['firstname'] = 1;
	if(isset($_POST['lastname']) && $_POST['lastname'] == "") $fieldError['lastname'] = 1;

	/* If the fields are valid, we can go on to the registration process */
	if(isset($_POST['user'], $_POST['password'], $_POST['email'], $_POST['firstname'], $_POST['lastname']) && !(isset($fieldError))) {
		/* FIXME Need to query the database to add the user here */
		

	/* If the fields are invalid or empty, we display the form
	and the associated errors if there's some */
	} else { ?>
	<form id="reg-form" method="post" action="parts/regform.php">
		<fieldset>
			<legend>Login Info</legend>
			
			<label for="user">Username:</label><br />
			<input type="text" name="user" class="text ui-widget-content ui-corner-all" /><br />
			<?php if(isset($fieldError['user'])) widget_errorbox("Username must be at least 3 characters long"); ?><br />
		
			<label for="password">Password:</label><br />
			<input type="password" name="password" class="text ui-widget-content ui-corner-all" /><br />
			<?php if(isset($fieldError['password'])) widget_errorbox("You have to enter a password!"); ?><br />

		</fieldset>
		
		<br />

		<fieldset>
			<legend>Personal Info</legend>

			<label for="email">E-Mail Address:</label><br />
			<input type="text" name="email" class="text ui-widget-content ui-corner-all" /><br />
			<?php if(isset($fieldError['email'])) widget_errorbox("Please enter a valid e-mail"); ?><br />

			<label for="firstname">First Name:</label><br />
			<input type="text" name="firstname" class="text ui-widget-content ui-corner-all" /><br />
			<?php if(isset($fieldError['firstname'])) widget_errorbox("Please enter a name"); ?><br />
			
			<label for="lastname">Last Name:</label><br />
			<input type="text" name="lastname" class="text ui-widget-content ui-corner-all" /><br />
			<?php if(isset($fieldError['lastname'])) widget_errorbox("Please enter a name"); ?>
		</fieldset>
	</form>

	<br />

	<?php widget_infobox("<a href='#' onclick=\"$('#reg-dialog').dialog('destroy'); initLoginDialog();\">Got an account? Sign in!</a>"); ?>
		</div>
	</div>

<?php } ?>
