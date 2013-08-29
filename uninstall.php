<?php

/**
 * The code in this file runs when a plugin is uninstalled from the WordPress dashboard.
 *
 * @author Christopher Lamm chris@theantichris.com
 * @copyright 2013 Christopher Lamm
 * @license GNU General Public License, version 3
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link http://www.theantichris.com
 */

/* If uninstall is not called from WordPress exit. */
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit ();
}

/* Place uninstall code below here. */