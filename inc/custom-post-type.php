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

class CustomPostType {
	/** @var  string User readable name of the post type. */
	private $post_type_name;
	/** @var  string WordPress ID of the post type. */
	private $post_type_slug;
	/** @var  array Arguments for the register_post_type() function. */
	private $post_type_args;

	function __construct( $post_type_name ) {
		$this->post_type_name = $post_type_name;
		$this->post_type_slug = str_replace( ' ', '-', strtolower( $post_type_name ) );
		$this->post_type_args = array( 'public' => true, 'label' => $this->post_type_name );

		add_action( 'init', array( $this, 'register_custom_post_type' ) );
	}

	/**
	 * Registers the custom post type with WordPress.
	 *
	 * @since 2.0.0
	 *
	 * @return void
	 */
	public function register_custom_post_type() {
		register_post_type( $this->post_type_slug, $this->post_type_args );
	}
}