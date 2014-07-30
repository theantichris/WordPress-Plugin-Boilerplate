<?php

/*
  Plugin Name: WordPress Plugin Boilerplate
  Plugin URI: https://github.com/theantichris/wordpress-plugin-boilerplate
  Description: An object oriented boilerplate for developing a WordPress plugin.
  Version: 6.0.0
  Author: Christopher Lamm
  Author URI: http://www.theantichris.com
  License: GPL V3
 */

class WordPress_Plugin_Boilerplate {
	private static $instance = null;
	private $plugin_path;
	private $plugin_url;
    private $text_domain = '';

	/**
	 * Creates or returns an instance of this class.
	 */
	public static function get_instance() {
		// If an instance hasn't been created and set to $instance create an instance and set it to $instance.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Initializes the plugin by setting localization, hooks, filters, and administrative functions.
	 */
	private function __construct() {
		$this->plugin_path = plugin_dir_path( __FILE__ );
		$this->plugin_url  = plugin_dir_url( __FILE__ );

		load_plugin_textdomain( $this->text_domain, false, $this->plugin_path . '/lang' );

		add_action( 'admin_enqueue_scripts', array( $this, 'register_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_styles' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_styles' ) );

		register_activation_hook( __FILE__, array( $this, 'activation' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivation' ) );

		$this->run_plugin();
	}

	public function get_plugin_url() {
		return $this->plugin_url;
	}

	public function get_plugin_path() {
		return $this->plugin_path;
	}

    /**
     * Place code that runs at plugin activation here.
     */
    public function activation() {

	}

    /**
     * Place code that runs at plugin deactivation here.
     */
    public function deactivation() {

	}

    /**
     * Enqueue and register JavaScript files here.
     */
    public function register_scripts() {

	}

    /**
     * Enqueue and register CSS files here.
     */
    public function register_styles() {

	}

    /**
     * Place code for your plugin's functionality here.
     */
    private function run_plugin() {

	}
}

WordPress_Plugin_Boilerplate::get_instance();
