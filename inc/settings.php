<?php
/**
 * Class for creating WordPress settings.
 *
 * @author     Christopher Lamm chris@theantichris.com
 * @copyright  2013 Christopher Lamm
 * @license    GNU General Public License, version 3
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link       http://www.theantichris.com
 *
 * @package    WordPress
 * @subpackage WordPressPluginFramework
 *
 * @since      5.0.0
 */

/*
 * TODO: Replace "WordPress_Plugin_Framework" with "Plugin_Name".
 * TODO: Replace "WordPressPluginFramework" with "PluginName".
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
	/** @var array Information about the settings section if used. */
	private $section = array(
		'title'     => 'Default',
		'id'        => 'default',
		'view_path' => null,
		'view_data' => array()
	);

	/**
	 * Class constructor.
	 *
	 * @since 5.0.0
	 *
	 * @param string $page
	 */
	public function __construct( $page = 'general' ) {
		if ( '' != trim( $page ) ) {
			$this->page = $page;
		}
	}

	/**
	 * Adds a settings section to the object.
	 *
	 * @since 5.0.0
	 *
	 * @param string $title     User readable title for the settings section.
	 * @param string $view_path Path to the settings section's view.
	 * @param array  $view_data Any data that needs to be passed to the view.
	 *
	 * @return void
	 */
	public function add_section( $title, $view_path, $view_data = array() ) {
		if ( ( '' != trim( $title ) ) && ( file_exists( $view_path ) ) ) {
			$this->section[ 'title' ] = $title;
			$this->section[ 'id' ]    = WordPress_Plugin_Framework::make_slug( $title );

			$this->section[ 'view_path' ]            = $view_path;
			$this->section[ 'view_data' ]            = $view_data;
			$this->section[ 'view_data' ][ 'title' ] = $title;

			add_action( 'admin_init', array( $this, 'register_section' ) );
		}
	}

	/**
	 * Registers the settings section with WordPress.
	 *
	 * @since 5.0.0
	 *
	 * @return void
	 */
	public function register_section() {
		add_settings_section( $this->section[ 'id' ], $this->section[ 'title' ], array( $this, 'display_section' ), $this->page );
	}

	/**
	 * Displays the settings section output.
	 *
	 * @since 5.0.0
	 *
	 * @return void
	 */
	public function display_section() {
		echo View::render( $this->section[ 'view_path' ], $this->section[ 'view_data' ] );
	}

	/**
	 * Adds a settings field to the object.
	 *
	 * @since 5.0.0
	 *
	 * @param string $title     User readable name for the field.
	 * @param string $view_path Path to the view for the field
	 * @param array  $view_data Data to pass to the view.
	 * @param array  $args      Optional arguments the field needs in WordPress.
	 *
	 * @return void
	 */
	public function add_field( $title, $view_path, $view_data = array(), $args = array() ) {
		// Make sure both the title and view path are valid.
		if ( ( '' != trim( $title ) ) && ( file_exists( $view_path ) ) ) {
			$page    = $this->page;
			$section = $this->section[ 'id' ];

			// Call hook to register the setting field with WordPress.
			add_action( 'admin_init', function () use ( $title, $view_path, $view_data, $args, $page, $section ) {
				$id = WordPress_Plugin_Framework::make_slug( $title );

				// Add settings field.
				add_settings_field( $id, $title, function () use ( $id, $title, $view_path, $view_data ) {
					// Display the field's view.
					$view_data[ 'title' ] = $title;
					$view_data[ 'id' ]    = $id;
					echo View::render( $view_path, $view_data );
				}, $page, $section, $args );

				// Register setting.
				register_setting( $page, $id );
			} );
		}
	}

	/**
	 * Cleanly removes a setting from WordPress.
	 *
	 * @since 5.0.0
	 *
	 * @param string $page
	 * @param string $id
	 *
	 * @return void
	 */
	public function remove_field( $page, $id ) {
		unregister_setting( $page, $id );
	}
}