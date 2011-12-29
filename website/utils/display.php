<?php
	/* utils/display.php
		Display related PHP Functions
		eg. easy embedding of JQuery Widgets
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
	function widget_infobox($input, $big=0) { ?>
		<div class="ui-widget">
			<div class="ui-state-highlight ui-corner-all" style="margin-top: 10px; padding: 0 .4em;"> 
				<?php if($big) echo "<p>"; ?>
				<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .2em;"></span>
				<?php echo $input; 
				if($big) echo "</p>"; ?>
			</div>
		</div>
<?php	return; } 

?>
