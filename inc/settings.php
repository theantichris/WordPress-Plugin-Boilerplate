<?php
/**
 * Class for creating WordPress settings.
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
 * @since 5.0.0
 */

/*
 * Outline
 *
 * 1. add_settings_section( $id = 'eg_setting_section', $title = 'Example settings section in reading', $callback = 'eg_setting_section_callback_function', $page = 'reading' )
 * 2. add_settings_field( $id = 'eg_setting_name', $title = 'Example setting Name', $callback = 'eg_setting_callback_function', $page = 'reading', $section = 'eg_setting_section', $args = array() )
 * 		$page should equal $page in add_settings_section()
 * 		$section should equal $id in add_settings_section()
 * 3. register_setting( $option_group = 'reading', $option_name = 'eg_setting_name', $sanitize_callback = null )
 * 		$option_group should equal the values for $page in the other functions
 * 		$option_name should equal $id in add_settings_field()
 */

class Settings {
	/** @var string The WordPress page slug the settings will appear on. */
	private $page = 'general';

	/**
	 * Class constructor.
	 *
	 * @since 5.0.0
	 *
	 * @param string $page
	 */
	function __construct( $page = 'general' ) {
		if ( '' != trim( $page ) ) {
			$this->page = $page;
		}
	}

}