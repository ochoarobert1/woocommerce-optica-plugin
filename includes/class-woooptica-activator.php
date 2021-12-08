<?php

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    WooOptica
 * @subpackage WooOptica/includes
 * @author     Robert Ochoa <contacto@robertochoaweb.com>
 */

 // If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}
class WooOptica_Activator
{

    /**
     * Check active plugins funcion
     *
     * Check if woocommerce is active in order to activate this plugin.
     *
     * @since    1.0.0
     */
    public static function activate()
    {
        // Test to see if WooCommerce is active (including network activated).
        if (class_exists('WooCommerce')) {
            // Refresh Permalinks Rules
            flush_rewrite_rules();
        } else {
            // Deactivate current plugin
            require_once 'class-woooptica-deactivator.php';
            WooOptica_Deactivator::deactivate();
            // Send a global warning message
            wp_die(__('Woocommerce debe estar activo para usar este plugin.', 'woo-optica'));
        }
    }
}
