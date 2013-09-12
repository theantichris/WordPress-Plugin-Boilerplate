<?php
/**
 * A class for creating top level WordPress pages.
 *
 * @author    Christopher Lamm chris@theantichris.com
 * @copyright 2013 Christopher Lamm
 * @license   GNU General Public License, version 3
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link      http://www.theantichris.com
 */

/*
 * TODO: Replace "wordpress-plugin-framework" with "plugin-name".
 */

class Menu_Page extends Page {
	/**
	 * Registers the page with WordPress.
	 *
	 * @since 4.0.0
	 *
	 * @return void
	 */
	public function register_page() {
		add_menu_page( $this->page_title, $this->page_title, $this->capability, $this->page_slug, array( $this, 'display_page' ), $this->icon_url, $this->position );
	}

	/**
	 * Displays the HTML output of the page.
	 *
	 * @since 4.0.0
	 *
	 * @return void
	 */
	public function display_page() {
		if ( !current_user_can( $this->capability ) ) {
			wp_die( __( 'You do not have sufficient permissions to access this page.', 'wordpress-plugin-framework' ) );
		}
	}
}