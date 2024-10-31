<?php
/*
 * Plugin Name: muv - Hide Preview
 * Plugin URI: https://wordpress.org/plugins/muv-hide-preview
 * Description: Versteckt in der Entwicklungsphase befindende einzelne Seiten, Unterordner oder auch ganze Websites vor den Augen nicht befugter Dritter!
 * Version: 1.7.1
 * Requires at least: 4.7
 * Tested up to: 5.4.2
 * Author: Meins und Vogel
 * Author URI: https://muv.com
 * Text Domain: muv-hide-preview
 * Domain Path: /languages 
 * License: GPLv2 or later
 */

/*
 * muv - Hide Preview
 * Copyright (C) 2016 - 2020, Meins und Vogel GmbH / muv.com - info@muv.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/*
 * Zugriff nur als Plugin innerhalb von Wordpress
 */
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

/*
 * benötigte Konstanten 
 */

/* Der Dateiname (inkl. Pfad) */
if ( ! defined( 'MUV_HP_FILE' ) ) {
	define( 'MUV_HP_FILE', __FILE__ );
}

/* Der Ordner */
if ( ! defined( 'MUV_HP_DIR' ) ) {
	define( 'MUV_HP_DIR', dirname( __FILE__ ) );
}

/* Der UNTER-Order inkl Dateiname des Plugins */
if ( ! defined( 'MUV_HP_BASE' ) ) {
	define( 'MUV_HP_BASE', plugin_basename( __FILE__ ) );
}

/* Die URL zu den Plugin-Dateien */
if ( ! defined( 'MUV_HP_URL' ) ) {
	define( 'MUV_HP_URL', plugins_url( dirname( MUV_HP_BASE ) ) );
}

/* Der inlcude - Ordner, der die Klassen beinhaltet */
if ( ! defined( 'MUV_HP_INC' ) ) {
	define( 'MUV_HP_INC', MUV_HP_DIR . '/includes/' );
}

/* Die Update-Kennung innerhalb unserer Update-Tabelle */
if ( ! defined( 'MUV_HP_UPATE_IDENTIFIER' ) ) {
	define( 'MUV_HP_UPATE_IDENTIFIER', 'muv-hide-preview' );
}


/* Autoload */
spl_autoload_register( 'muv_hp_autoload' );


/* Hooks */
register_activation_hook( MUV_HP_FILE, array( muv\HidePreview\Wordpress\Install::class, 'install' ) );
add_action( 'wpmu_new_blog', array( muv\HidePreview\Wordpress\Install::class, 'newBlog'), 10, 6);

register_deactivation_hook( MUV_HP_FILE, array( muv\HidePreview\Wordpress\Deactivate::class, 'deactivate' ) );

add_action( 'delete_blog', array( muv\HidePreview\Wordpress\Uninstall::class, 'deleteBlog'));
register_uninstall_hook( MUV_HP_FILE, array( muv\HidePreview\Wordpress\Uninstall::class, 'uninstall' ) );

/* Go... */
add_action( 'plugins_loaded', array( muv\HidePreview\Plugin\Main::class, 'init' ) );

function muv_hp_autoload( $class ) {
	if ( strpos( $class, 'muv\HidePreview' ) === 0 ) {
		$libFile = MUV_HP_INC . $class . '.class.php';
		$libFile = str_replace( '\\', '/', $libFile );
		if ( file_exists( $libFile ) ) {
			require_once( $libFile );
		}
	}
}
