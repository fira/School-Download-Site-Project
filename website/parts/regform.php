<?php 
	if(isset($_POST['user'], $_POST['password'], $_POST['email'], $_POST['firstname'], $_POST['lastname'])) {
		echo "hi";
	} else {
?>
	<form id="reg-form" method="post" action="parts/regform.php">
		<fieldset>
			<legend>Login Info</legend>
			
			<label for="user">Username:</label><br />
			<input type="text" name="user" class="text ui-widget-content ui-corner-all" /><br /><br />
		
			<label for="password">Password:</label><br />
			<input type="password" name="password" class="text ui-widget-content ui-corner-all" /><br />

		</fieldset>
		
		<br />

		<fieldset>
			<legend>Personal Info</legend>
			
			<label for="email">E-Mail Address:</label><br />
			<input type="text" name="email" class="text ui-widget-content ui-corner-all" /><br /><br />
			<label for="firstname">First Name:</label><br />
			<input type="text" name="firstname" class="text ui-widget-content ui-corner-all" /><br /><br />
			<label for="lastname">Last Name:</label><br />
			<input type="text" name="lastname" class="text ui-widget-content ui-corner-all" /><br />

		</fieldset>
	</form>

	<br />

	<div class="ui-widget">
		<div class="ui-state-highlight ui-corner-all" style="margin-top: 10px; padding: 0 .4em;"> 
			<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .2em;"></span>
			<a href="#" onclick="$('#reg-dialog').dialog('destroy'); initLoginDialog();">Got an account? Sign in!</a></p>
		</div>
	</div>

<?php } ?>
