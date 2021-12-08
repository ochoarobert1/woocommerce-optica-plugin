<?php
/**
* Woocommerce Plugin para Óptica
*
* @package WooOptica
* @author Robert Ochoa
* @copyright 2021 Artness Company SPA
* @license GPL-2.0-or-later
*
* @wordpress-plugin
* Plugin Name: Woocommerce Plugin para Óptica
* Plugin URI: https://artnessco.cl/woocommerce-optica-plugin/
* Description: Plugin de Woocommerce para venta de lentes con atributos personalizables.
* Version: 1.0.0
* Requires at least: 5.2
* Requires PHP: 7.2
* Author: Robert Ochoa
* Author URI: https://artnessco.cl/
* Text Domain: woooptica
* License: GPL v2 or later
* License URI: http://www.gnu.org/licenses/gpl-2.0.txt
* Update URI: https://artnessco.cl/woocommerce-optica-plugin/
*
*
* Woocommerce Plugin para Óptica is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 2 of the License, or
* any later version.
*
* Woocommerce Plugin para Óptica is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with Woocommerce Plugin para Óptica. If not, see http://www.gnu.org/licenses/gpl-2.0.txt.
*
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WOO_OPTICA_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woooptica-activator.php
 */
function activate_woooptica() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woooptica-activator.php';
	WooOptica_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woooptica-deactivator.php
 */
function deactivate_woooptica() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woooptica-deactivator.php';
	WooOptica_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_woooptica' );
register_deactivation_hook( __FILE__, 'deactivate_woooptica' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woooptica.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woooptica() {

	$plugin = new WooOptica();
	$plugin->run();

}
run_woooptica();
