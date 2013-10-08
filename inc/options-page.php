<?php
/**
 * A class for creating an options sub menu page in WordPress.
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
 * @since 5.0.0
 */

/*
 * TODO: Replace "WordPressPluginFramework" with "PluginName".
 */

class Options_Page extends Page {
	/**
	 * Add the page to WordPress.
	 *
	 * @since 4.0.0
	 *
	 * @return void
	 */
	public function add_page() {
		add_options_page( $this->page_title, $this->page_title, $this->capability, $this->page_slug, array( $this, 'display_page' ) );
	}
}