<?php
/**
 * An abstract class for creating WordPress pages.
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

abstract class Page {
	/** @var string User readable title for the page and menu item. */
	private $page_title;
	/** @var string Unique ID for the page. */
	private $page_slug;
	/** @var string The capability required for the menu item to be displayed to the user. */
	private $capability = 'manage_options';

	/**
	 * Class constructor.
	 *
	 * @since 4.0.0
	 *
	 * @param string $page_title User readable title for the page and menu item.
	 * @param string $capability The capability required for the menu item to be displayed to the user.
	 *
	 * @return Page
	 */
	public function __construct( $page_title, $capability = null ) {
		$this->page_title = $page_title;
		$this->page_slug  = WordPress_Plugin_Framework::make_slug( $page_title );

		if ( !empty( $capability ) ) {
			$this->capability = $capability;
		}
	}

	/**
	 * Registers the page with WordPress.
	 *
	 * @since 4.0.0
	 *
	 * @return void
	 */
	abstract public function register_page();
}