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

class Menu_Page extends Page {
	/** @var string|null The URL to the icon to be used for the menu item. */
	private $icon_url = null;
	/** @var integer|null The position in the menu this page should appear. */
	private $position = null;

	/**
	 * Sets $this->icon_url.
	 *
	 * @since 4.0.0
	 *
	 * @param string|null $icon_url
	 *
	 * @return void
	 */
	public function set_icon_url( $icon_url = null ) {
		if ( empty( $icon_url ) ) {
			$this->icon_url = $icon_url;
		}
	}

	/**
	 * Sets $this->position.
	 *
	 * @since 4.0.0
	 *
	 * @param null $position
	 *
	 * @return void
	 */
	public function set_position( $position = null ) {
		if ( !empty( $position ) ) {
			$this->position = $position;
		}
	}

	/**
	 * Registers the page with WordPress.
	 *
	 * @since 4.0.0
	 *
	 * @return void
	 */
	public function register_page() {

	}
}