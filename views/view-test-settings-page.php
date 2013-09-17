<h2><?php echo esc_html( $page_title ); ?></h2>

<form method="POST" action="options.php">
	<?php
	settings_fields( $slug );
	do_settings_sections( $slug );
	submit_button();
	?>
</form>