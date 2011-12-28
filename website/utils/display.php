<?php
	/* Shows a JQuery Error box widget with the specified content */
	function widget_errorbox($input, $big=0) { ?>
		<div class="ui-widget">
			<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
				<?php if($big) echo "<p>"; ?>
				<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
				<?php echo $input; if($big) echo "</p>"; ?>
			</div>
		</div>

<?php 	return; }

	/* Shows a JQuery Info box widget with the specified content */
	function widget_infobox($input, $big=0) { ?>
		<div class="ui-widget">
			<div class="ui-state-highlight ui-corner-all" style="margin-top: 10px; padding: 0 .4em;"> 
				<?php if($big) echo "<p>"; ?>
				<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .2em;"></span>
				<?php echo $input; if($big) echo "</p>"; ?>
			</div>
		</div>
<?php	return; } 

?>
