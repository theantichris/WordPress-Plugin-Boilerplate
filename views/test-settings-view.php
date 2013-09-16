<form method="POST" action="options.php">
	<?php
	settings_fields( 'submenu-page' );
	do_settings_sections( 'submenu-page' );
	submit_button();
	?>
</form>