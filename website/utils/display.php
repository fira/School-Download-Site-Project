<?php
	/* Shows a JQuery Error box widget with the specified content */
	function widget_errorbox($input) { ?>
		<div class="ui-widget">
			<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
				<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
				<?php echo $input; ?>
			</div>
		</div>

<?php 	return; }

	/* Shows a JQuery Info box widget with the specified content */
	function widget_infobox($input) { ?>
		<div class="ui-widget">
			<div class="ui-state-highlight ui-corner-all" style="margin-top: 10px; padding: 0 .4em;"> 
				<span class="ui-icon ui-icon-info" style="float: left; margin-right: .2em;"></span>
				<?php echo $input; ?>
			</div>
		</div>
<?php	return; } 

?>
