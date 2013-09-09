<?php
/**
 * Class for creating a WordPress custom post type.
 *
 * @author    Christopher Lamm chris@theantichris.com
 * @copyright 2013 Christopher Lamm
 * @license   GNU General Public License, version 3
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link      http://www.theantichris.com
 */

/*
 * TODO: Replace "WordPress_Plugin_Framework" with "Plugin_Name".
 */

class Custom_Post_Type {
	/** @var  string User readable name of the post type. Must be plural. */
	private $post_type_name;
	/** @var  string WordPress ID of the post type. */
	private $post_type_slug;
	/** @var  array Arguments for the register_post_type() function. */
	private $post_type_args = array();
	/** @var array Labels for the post type. */
	private $post_type_labels = array();
	/** @var  string URL to the plugin file. */
	private $menu_icon;
	/** @var array Capabilities to set for the post type. */
	private $capabilities = array(
		'edit_post'          => 'edit_post',
		'read_post'          => 'read_post',
		'delete_post'        => 'delete_post',
		'edit_posts'         => 'edit_posts',
		'edit_others_posts'  => 'edit_others_post',
		'publish_posts'      => 'publish_posts',
		'read_private_posts' => 'read_private_posts'
	);
	/** @var array $supports What features the post type supports. */
	private $supports = array( 'title', 'editor' );

	/**
	 * Class constructor.
	 *
	 * @since 2.0.0
	 *
	 * @param string      $post_type_name User readable name of the post type. Must be plural.
	 * @param array|null  $capabilities   Capabilities to set for the post type.
	 * @param array|null  $supports       What features the post type supports.
	 * @param string|null $menu_icon      URL to the post type's menu icon.
	 */
	function __construct( $post_type_name, $capabilities = null, $supports = null, $menu_icon = null ) {
		$this->post_type_name = $post_type_name;
		$this->post_type_slug = str_replace( ' ', '-', strtolower( $post_type_name ) );

		if ( !empty( $capabilities ) ) {
			$this->capabilities = $capabilities;
		}

		if ( !empty( $capabilities ) ) {
			$this->supports = $supports;
		}

		$this->menu_icon = $menu_icon;

		$singular = WordPress_Plugin_Framework::make_singular( $this->post_type_name );

		$this->post_type_labels = array(
			'name'               => $this->post_type_name,
			'singular_name'      => $singular,
			'add_new'            => 'Add New',
			'add_new_item'       => 'Add New ' . $singular,
			'edit_item'          => 'Edit ' . $singular,
			'new_item'           => 'New ' . $singular,
			'all_items'          => 'All ' . $this->post_type_name,
			'view_item'          => 'View ' . $singular,
			'search_items'       => 'Search ' . $this->post_type_name,
			'not_found'          => 'No ' . strtolower( $this->post_type_name ) . ' found.',
			'not_found_in_trash' => 'No ' . strtolower( $this->post_type_name ) . ' found in Trash.',
			'parent_item_colon'  => '',
			'menu_name'          => $this->post_type_name
		);

		$this->post_type_args = array(
			'labels'       => $this->post_type_labels,
			'public'       => true,
			'menu_icon'    => $this->menu_icon,
			'capabilities' => $this->capabilities,
			'supports'     => $this->supports
		);

		add_action( 'init', array( $this, 'register_custom_post_type' ) );
	}

	/**
	 * Registers the custom post type with WordPress if it does not already exists.
	 *
	 * @since 2.0.0
	 *
	 * @return void
	 */
	public function register_custom_post_type() {
		if ( !post_type_exists( $this->post_type_slug ) ) {
			register_post_type( $this->post_type_slug, $this->post_type_args );
		}
	}

	/**
	 * Registers a taxonomy with the custom post type.
	 *
	 * @since 2.3.0
	 *
	 * @param string     $taxonomy_name User readable name for the taxonomy.
	 * @param array|null $args          Arguments to pass to register_taxonomy.
	 *
	 * @return void
	 */
	public function add_taxonomy( $taxonomy_name, $args = null ) {
		$post_type_slug = $this->post_type_slug;
		$taxonomy_slug  = str_replace( ' ', '-', strtolower( $taxonomy_name ) );
		$singular       = WordPress_Plugin_Framework::make_singular( $taxonomy_name );

		$labels = array(
			'name'              => _x( $taxonomy_name, 'taxonomy general name' ),
			'singular_name'     => _x( $singular, 'taxonomy singular name' ),
			'search_items'      => __( 'Search ' . $taxonomy_name ),
			'all_items'         => __( 'All ' . $taxonomy_name ),
			'parent_item'       => __( 'Parent ' . $singular ),
			'parent_item_colon' => __( 'Parent ' . $singular . ':' ),
			'edit_item'         => __( 'Edit ' . $singular ),
			'update_item'       => __( 'Update ' . $singular ),
			'add_new_item'      => __( 'Add New ' . $singular ),
			'new_item_name'     => __( 'New ' . $singular . ' Name' ),
			'menu_name'         => __( $singular ),
		);

		// If no arguments are specified use the WordPress default with the exception of the labels.
		if ( empty( $args ) ) {
			$args = array(
				'labels' => $labels
			);
		}

		// Use an anonymous function to register the action with the hook.
		add_action( 'init', function () use ( $taxonomy_slug, $post_type_slug, $args ) {
			if ( !taxonomy_exists( $taxonomy_slug ) ) {
				register_taxonomy( $taxonomy_slug, $post_type_slug, $args );
			}
		} );
	}
}
