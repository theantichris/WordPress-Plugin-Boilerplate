<?php

/**
 * Contains a static function that allows rendering of a HTML template from anywhere within a plugin.
 *
 * @author    Christopher Lamm chris@theantichris.com
 * @copyright 2013 Christopher Lamm
 * @license   GNU General Public License, version 3
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link      http://www.theantichris.com
 *
 * @package    WordPress
 * @subpackage WordPressPluginFramework
 *
 * @since 4.0.0
 */

/*
 * TODO: Replace "WordPressPluginFramework" with "PluginName".
 */

class View {
	/**
	 * A static function that allows rendering of a HTML template from anywhere within a plugin.
	 *
	 * @since 2.0.0
	 *
	 * @param string $view_path The path to the template file in the view folder.
	 * @param array  $view_data Any variables that the templates need access to in an associative array.
	 *
	 * @return string
	 */
	public static function render( $view_path, $view_data = null ) {
		// Check if any data was sent.
		if ( $view_data ) {
			extract( $view_data );
		}

		ob_start(); // Start the output buffer.

		include_once( $view_path ); // Include the template.

		$template = ob_get_contents(); // Add the template contents to the output buffer.

		ob_end_clean(); // End the output buffer.

		return $template;
	}
}