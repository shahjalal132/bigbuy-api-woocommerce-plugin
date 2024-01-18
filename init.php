<?php
/*
 * Plugin Name:       Bigbuy API
 * Plugin URI:        https://bigbuy.api.com
 * Description:       Bigbuy API
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Imjol
 * Author URI:        https://imjol.com/
 */

// Define plugin path
if (!defined('PLUGIN_PATH')) {
    define('PLUGIN_PATH', untrailingslashit(plugin_dir_path(__FILE__)));
}

// Define plugin url
if (!defined('PLUGIN_URI')) {
    define('PLUGIN_URI', untrailingslashit(plugin_dir_url(__FILE__)));
}

// Register the activation hook
register_activation_hook(__FILE__, 'bigbuy_db_products_table_create');
// Register the deactivation hook
register_deactivation_hook(__FILE__, 'bigbuy_db_products_table_remove');

// Require file
require_once PLUGIN_PATH . '/inc/bigbuy_products_api.php';
require_once PLUGIN_PATH . '/inc/bigbuy_insert_products_wooco.php';

     