<?php
/**
 * A class for creating top level WordPress pages.
 *
 * @author    Christopher Lamm chris@theantichris.com
 * @copyright 2013 Christopher Lamm
 * @license   GNU General Public License, version 3
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link      http://www.theantichris.com
 *
 * @package    WordPress
 * @subpackage WordPressPluginFramework
 *
 * @since 4.0.0
 */

/*
 * TODO: Replace "WordPressPluginFramework" with "PluginName".
 */

class Menu_Page extends Page {
	/**
	 * Adds the page with WordPress.
	 *
	 * @since 4.0.0
	 *
	 * @return void
	 */
	public function add_page() {
		add_menu_page( $this->page_title, $this->page_title, $this->capability, $this->page_slug, array( $this, 'display_page' ), $this->icon_url, $this->position );
	}

	/**
	 * Removes a page from WordPress.
	 *
	 * @since 4.0.0
	 *
	 * @return void
	 */
	public function remove_page() {
		remove_menu_page( $this->page_slug );
	}
}