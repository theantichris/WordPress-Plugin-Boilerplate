<?php

/*
  Plugin Name: WordPress Plugin Framework
  Plugin URI: https://github.com/theantichris/WordPress-Plugin-Framework
  Description: My own framework for making the WordPress plugins the way I do.
  Version: 1.0.0
  Author: Christopher Lamm
  Author URI: http://www.theantichris.com
  License: GPL V2
 */

/**
 * Class WordPress_Plugin_Framework
 *
 * @since 1.0.0
 */
class WordPress_Plugin_Framework {
	/** @var null|WordPress_Plugin_Framework Refers to a single instance of this class. */
	private static $instance = null;
	/** @var  string The path to the plugin file. */
	private $plugin_path;
	/** @var  string The URL to the plugin file. */
	private $plugin_url;

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
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 *
	 * @since 1.0.0
	 */
	private function __construct() {
		/* Set properties. */
		$this->plugin_path = dirname( __FILE__ );
		$this->plugin_url = WP_PLUGIN_URL . '/wordpress-plugin-framework';

		/* Register activation and deactivation hooks. */
		register_activation_hook( __FILE__, array( $this, 'activation' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivation' ) );
	}

	/**
	 * This method runs at plugin activation.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	private function activation() {

	}

	/**
	 * This method runs at plugin deactivation.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	private function deactivation() {

	}
}

WordPress_Plugin_Framework::get_instance();