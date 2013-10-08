<?php
/**
 * A class for creating top level WordPress pages and adding them to the menu on the object level.
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

class Object_Page extends Page {
	/**
	 * Add the page to WordPress.
	 *
	 * @since 4.0.0
	 *
	 * @return void
	 */
	public function add_page() {
		add_object_page( $this->page_title, $this->page_title, $this->capability, $this->page_slug, array( $this, 'display_page' ), $this->icon_url );
	}
}