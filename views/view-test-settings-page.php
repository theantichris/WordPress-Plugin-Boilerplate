<h2><?php echo esc_html( $page_title ); ?></h2>

<form method="POST" action="options.php">
	<?php
	settings_fields( $page_title );
	do_settings_sections( $page_title );
	submit_button();
	?>
</form>