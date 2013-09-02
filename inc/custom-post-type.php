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

class Custom_Post_Type {
	/** @var  string User readable name of the post type. Must be plural. */
	private $post_type_name;
	/** @var  string WordPress ID of the post type. */
	private $post_type_slug;
	/** @var  array Arguments for the register_post_type() function. */
	private $post_type_args = array();
	/** @var array Labels for the post type. */
	private $post_type_labels = array();

	/**
	 * Class constructor.
	 *
	 * @since 2.0.0
	 *
	 * @param string $post_type_name User readable name of the post type. Must be plural.
	 */
	function __construct( $post_type_name ) {
		$this->post_type_name = $post_type_name;
		$this->post_type_slug = str_replace( ' ', '-', strtolower( $post_type_name ) );

		$singular = WordPress_Plugin_Framework::make_singular( $this->post_type_name );

		$this->post_type_labels = array(
			'name' => $this->post_type_name,
			'singular_name' => $singular,
			'add_new' => 'Add New',
			'add_new_item' => 'Add New ' . $singular,
			'edit_item' => 'Edit ' . $singular,
			'new_item' => 'New ' . $singular,
			'all_items' => 'All ' . $this->post_type_name,
			'view_item' => 'View ' . $singular,
			'search_items' => 'Search ' . $this->post_type_name,
			'not_found' => 'No ' . strtolower( $this->post_type_name ) . ' found',
			'not_found_in_trash' => 'No ' . strtolower( $this->post_type_name ) . ' found in Trash',
			'parent_item_colon' => '',
			'menu_name' => $this->post_type_name
		);

		$this->post_type_args = array(
			'labels' => $this->post_type_labels,
			'public' => true
		);

		add_action( 'init', array( $this, 'register_custom_post_type' ) );
	}

	/**
	 * Registers the custom post type with WordPress.
	 *
	 * @since 2.0.0
	 *
	 * @return void
	 */
	public  function register_custom_post_type() {
		register_post_type( $this->post_type_slug, $this->post_type_args );
	}
}