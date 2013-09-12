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
		$this->post_type_slug = WordPress_Plugin_Framework::make_slug( $post_type_name );

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
	 * Returns $post_type_slug.
	 *
	 * @since 3.0.0
	 *
	 * @return string
	 */
	public function get_post_type_slug() {
		return $this->post_type_slug;
	}
}
