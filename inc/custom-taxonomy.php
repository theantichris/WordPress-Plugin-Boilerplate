<?php
/**
 * Class for creating a Taxonomies.
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

class Custom_Taxonomy {
	/** @var string User readable name for the taxonomy. */
	private $taxonomy_name;
	/** @var string WordPress ID for the taxonomy. */
	private $taxonomy_slug;
	/** @var array|string What post types the taxonomy will be registered to. */
	private $post_types = 'post';
	/** @var array Arguments to pass to register_taxonomy(). */
	private $taxonomy_args;
	/** @var array UI labels for the taxonomy. */
	private $taxonomy_labels;

	/**
	 * Class constructor.
	 *
	 * @since 3.0.0
	 *
	 * @param string            $taxonomy_name User readable name for the taxonomy.
	 * @param string|array|null $post_types    What post types to register the taxonomy with.
	 *
	 * @return Custom_Taxonomy
	 */
	public function __construct( $taxonomy_name, $post_types = null ) {
		$this->taxonomy_name = $taxonomy_name;
		$this->taxonomy_slug = str_replace( ' ', '-', strtolower( $taxonomy_name ) );

		// If $post_types is specified, set it. Otherwise it will default to 'post'.
		if ( !empty( $post_types ) ) {
			$this->post_types = $post_types;
		}

		$singular = WordPress_Plugin_Framework::make_singular( $taxonomy_name );

		$this->taxonomy_labels = array(
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

		$this->taxonomy_args = array(
			'labels' => $this->taxonomy_labels
		);

		add_action( 'init', array( $this, 'register_custom_taxonomy' ) );
	}

	/**
	 * Registers the taxonomy with WordPress.
	 *
	 * @since 3.0.0
	 *
	 * @return void
	 */
	public function register_custom_taxonomy() {
		if ( !taxonomy_exists( $this->taxonomy_slug ) ) {
			register_taxonomy( $this->taxonomy_slug, $this->post_types, $this->taxonomy_args );
		}
	}
} 