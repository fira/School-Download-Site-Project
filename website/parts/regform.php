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
		echo "I think i lost the database address. Sorry. Yeah, this is a bad placeholder, i know.";

	/* If the fields are invalid or empty, we display the form
	and the associated errors if there's some */
	} else { ?>
	<?php widget_infobox("<strong><a href='#' onclick=\"$('#reg-dialog').dialog('destroy'); initLoginDialog();\">Got an account? Sign in!</a></strong>", 1); ?>
	<br />

	<form id="reg-form" method="post" action="parts/regform.php">
		<fieldset>
			<legend>Login Info</legend>
						
			<table>
			<tr><td width='200px'><label for="user">Username:</label></td>
			<td><input type="text" name="user" class="text ui-widget-content ui-corner-all" /></td></tr>
			<?php if(isset($fieldError['user'])) {
				echo "<tr><td colspan='2'>";
				widget_errorbox("Username must be at least 3 chars long"); 
				echo "</td></tr>"; } ?>
			
			<tr height="10px"></tr>
		
			<tr><td><label for="password">Password:</label></td>
			<td><input type="password" name="password" class="text ui-widget-content ui-corner-all" /></td></tr>
			<?php if(isset($fieldError['password'])) {
				echo "<tr><td colspan='2'>";
				widget_errorbox("You have to enter a password!"); 
				echo "</td></tr>"; } ?>
			</table>

		</fieldset>
		
		<br />

		<fieldset>
			<legend>Personal Info</legend>

			<table>
			<tr><td width="200px"><label for="email">E-Mail Address:</label></td>
			<td><input type="text" name="email" class="text ui-widget-content ui-corner-all" /></td></tr>
			<?php if(isset($fieldError['email'])) {
				echo "<tr><td colspan='2'>";
				widget_errorbox("Please enter a valid e-mail address"); 
				echo "</td></tr>"; } ?>

			<tr height="10px"></tr>

			<tr><td><label for="firstname">First Name:</label></td>
			<td><input type="text" name="firstname" class="text ui-widget-content ui-corner-all" /></td></tr>
			<?php if(isset($fieldError['firstname'])) {
				echo "<tr><td colspan='2'>";
				widget_errorbox("Please enter a name"); 
				echo "</td></tr>"; } ?>
			
			<tr height="10px"></tr>

			<tr><td><label for="lastname">Last Name:</label></td>
			<td><input type="text" name="lastname" class="text ui-widget-content ui-corner-all" /></td></tr>
			<?php if(isset($fieldError['lastname'])) {
				echo "<tr><td colspan='2'>";
				widget_errorbox("Please enter a name"); 
				echo "</td></tr>"; } ?>

			</table>
		</fieldset>
	</form>

<?php } ?>
