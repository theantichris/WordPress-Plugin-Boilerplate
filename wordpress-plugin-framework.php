<?php

/*
  Plugin Name: WordPress Plugin Framework
  Plugin URI: https://github.com/theantichris/WordPress-Plugin-Framework
  Description: My own framework for making WordPress plugins the way I do.
  Version: 4.1.0
  Author: Christopher Lamm
  Author URI: http://www.theantichris.com
  License: GPL V2
 */

/*
 * TODO: Replace plugin information header above.
 * TODO: Replace "WordPress Plugin Framework" with "Plugin Name".
 * TODO: Replace "WordPress_Plugin_Framework" with "Plugin_Name".
 * TODO: Replace "wordpress-plugin-framework" with "plugin-name".
 * TODO: Replace "WordPressPluginFramework" with "PluginName".
 */

/**
 * Class WordPress_Plugin_Framework
 *
 * @package    WordPress
 * @subpackage WordPressPluginFramework
 *
 * @since      1.0.0
 */
class WordPress_Plugin_Framework {
	/** @var null|WordPress_Plugin_Framework Refers to a single instance of this class. */
	private static $instance = null;
	/** @var  string The path to the plugin file. */
	private $plugin_path;
	/** @var  string The URL to the plugin file. */
	private $plugin_url;
	/** @var Custom_Post_Type[] Custom post type objects used by the plugin. */
	private $custom_post_types = array();
	/** @var Taxonomy[] Taxonomies objects used by the plugin. */
	private $taxonomies = array();
	/** @var Page[] Page objects used by the plugin. */
	private $pages = array();

	/**
	 * Creates or returns an instance of this class.
	 *
	 * @since 1.0.0
	 *
	 * @return WordPress_Plugin_Framework A single instance of this class.
	 */
	public static function get_instance() {
		// If an instance hasn't been create and set to $instance create an instance and set it to $instance.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Initializes the plugin by setting localization, hooks, filters, and administrative functions.
	 *
	 * @since 1.0.0
	 *
	 * @return WordPress_Plugin_Framework
	 */
	private function __construct() {
		/* Includes */
		include_once 'inc/custom-post-type.php';
		include_once 'inc/page.php';
		include_once 'inc/menu-page.php';
		include_once 'inc/object-page.php';
		include_once 'inc/sub-menu-page.php';
		include_once 'inc/utility-page.php';
		include_once 'inc/taxonomy.php';
		include_once 'inc/view.php';

		/* Set properties. */
		$this->plugin_path = plugin_dir_path( __FILE__ );
		$this->plugin_url  = plugin_dir_url( __FILE__ );

		/* Load text domain. */
		load_plugin_textdomain( 'wordpress-plugin-framework', false, $this->plugin_path . '/lang' );

		/* Load scripts and styles */
		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_styles' ) );

		/* Register activation and deactivation hooks. */
		register_activation_hook( __FILE__, array( $this, 'activation' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivation' ) );

		/* Run plugin. */

		$this->run_plugin();
	}

	/**
	 * This method runs at plugin activation.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function activation() {

	}

	/**
	 * This method runs at plugin deactivation.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function deactivation() {

	}

	/**
	 * Place any scripts that need to be registered with WordPress in this method.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function register_scripts() {

	}

	/**
	 * Place any styles that need to be registered with WordPress in this method.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function register_styles() {

	}

	/**
	 * Method containing the plugin functionality. Place your code here.
	 *
	 * @since 4.1.0
	 *
	 * @return void
	 */
	private function run_plugin() {
		$this->pages[ 'menu-page' ]    = new Menu_Page( 'Menu Page', $this->plugin_path . '/views/test-view.php' );
		$this->pages[ 'submenu-page' ] = new Sub_Menu_Page( 'Submenu Page', $this->plugin_path . '/views/test-view.php', $capability = null, $icon_url = null, $position = null, $view_data = array(), $parent_slug = $this->pages[ 'menu-page' ]->get_page_slug() );
	}

	/**
	 * If WordPress debugging is turned on this method will write data to debug.log located in the wp-content directory.
	 *
	 * Add the following lines to wp-config.php:
	 *
	 * define( 'WP_DEBUG', true );  // Turn debugging ON
	 * define( 'SAVEQUERIES', true );
	 * define( 'WP_DEBUG_DISPLAY', false ); // Turn forced display OFF
	 * define( 'WP_DEBUG_LOG', true );  // Turn logging to wp-content/debug.log ON
	 *
	 * @since 1.0.0
	 *
	 * @param mixed $message Message to pass to the error log.
	 *
	 * @return void
	 */
	public static function print_to_log( $message ) {
		if ( true === WP_DEBUG ) {
			if ( is_array( $message ) || is_object( $message ) ) {
				error_log( print_r( $message ), true );
			} else {
				error_log( $message );
			}
		}
	}

	/**
	 * Takes a plural string and returns the singular version.
	 *
	 * Solution found at https://sites.google.com/site/chrelad/notes-1/pluraltosingularwithphp.
	 *
	 * @since 2.0.0
	 *
	 * @param string $word Plural string to make singular.
	 *
	 * @return string
	 */
	public static function make_singular( $word ) {
		$rules = array(
			'ss'  => false,
			'os'  => 'o',
			'ies' => 'y',
			'xes' => 'x',
			'oes' => 'o',
			'ves' => 'f',
			's'   => ''
		);

		// Loop through all the rules and do the replacement.
		foreach ( array_keys( $rules ) as $key ) {
			// If the end of the word doesn't match the key, it's not a candidate for replacement. Move on to the next plural ending.

			if ( substr( $word, ( strlen( $key ) * -1 ) ) != $key ) {
				continue;
			}

			// If the value of the key is false, stop looping and return the original version of the word.
			if ( $key === false ) {
				return $word;
			}

			// We've made it this far, so we can do the replacement.
			return substr( $word, 0, strlen( $word ) - strlen( $key ) ) . $rules[ $key ];
		}

		return $word;
	}

	/**
	 * Makes WordPress slug by making the string lowercase and replacing spaces with hyphens.
	 *
	 * @since 3.1.0
	 *
	 * @param $string String to make a slug out of.
	 *
	 * @return string
	 */
	public static function make_slug( $string ) {
		return str_replace( ' ', '-', strtolower( $string ) );
	}
}

WordPress_Plugin_Framework::get_instance();