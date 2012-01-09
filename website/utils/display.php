<?php
	/* utils/display.php
		Display related PHP Functions
		
		eg. easy embedding of JQuery Widgets,
		or simply to have a cleaner way of inserting PHP in HTML code
	*/



	/* Shows a JQuery Error box widget with the specified content 
	The big argument encloses the content and icon into a <p> block, effectively
	adding blank lines at top and bottom of the box. */
	function widget_errorbox($input, $big=0) { ?>
		<div class="ui-widget">
			<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
				<?php if($big) echo "<p>"; ?>
				<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
				<?php echo $input; 
				if($big) echo "</p>"; ?>
			</div>
		</div>
<?php 	return; }

	
	/* Shows a JQuery Info box widget with the specified content 
	See previous function */
	function widget_infobox($input, $big=false) { ?>
		<div class="ui-widget">
			<div class="ui-state-highlight ui-corner-all" style="margin-top: 10px; padding: 0 .4em;"> 
				<?php if($big) echo "<p>"; ?>
				<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .2em;"></span>
				<?php echo $input; 
				if($big) echo "</p>"; ?>
			</div>
		</div>
<?php	return; } 

	/* insertField
		Inserts a field with given $name and JQuery-UI style
		If autoReset is set to true (default), the field will retain previous POST values if applicable
		The type is "text" by default, set $password to true to make it a password field instead
	*/
	function insertField($name, $autoReset=true, $password=false, $opt="") {
		/* Inserts the field type */
		echo "<input type='";
		if($password) echo "password"; else echo "text";
		/* Copy over the provided name */
		echo "' name=$name";
		/* If its an autoReset'd field, add the value attribute with previous value */
		if($autoReset && isset($_POST[$name])) echo " value='" . $_POST[$name] . "'";
		/* Finally adds JQuery-UI classes to make it have the selected theme */
		echo " class='text ui-widget-content ui-corner-all' $opt/>";
		return;
	}

?>
