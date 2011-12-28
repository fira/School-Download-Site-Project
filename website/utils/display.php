<?php
	function widget_errorbox($input) { ?>
		<div class="ui-widget">
			<div class="ui-state-error"> 
				<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
				<?php echo $input; ?>
			</div>
		</div>

<?php 	return; }
