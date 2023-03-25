<?php
/**
 * Plugin Name: Easy Google Analytics Pro
 * Plugin URI: #
 * Description: A lightweight and fast plugin for integrating Google Analytics into your WordPress website, with customizable features and advanced tracking options.
 * Version: 1.0.0
 * Author: Amine Ouhannou
 * Author URI: #
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: easy-google-analytics-pro
 * Domain Path: /languages
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

// Enqueue the admin CSS and JavaScript files.
function egap_enqueue_admin_assets($hook) {
    // Only load assets on the plugin settings page.
    if ('settings_page_easy-google-analytics-pro' !== $hook) {
        return;
    }

    wp_enqueue_style('egap-admin-style', plugin_dir_url(__FILE__) . 'assets/css/admin-style.css', array(), '1.0.0');
    wp_enqueue_script('egap-admin-script', plugin_dir_url(__FILE__) . 'assets/js/admin-script.js', array('jquery'), '1.0.0', true);
}
add_action('admin_enqueue_scripts', 'egap_enqueue_admin_assets');


// Include required files.
require_once plugin_dir_path(__FILE__) . 'settings.php';
require_once plugin_dir_path(__FILE__) . 'tracking-code.php';
require_once plugin_dir_path(__FILE__) .  'dashboard-widget.php';

// Register the settings.
function egap_register_settings() {
    register_setting('egap_settings_group', 'egap_settings', 'egap_sanitize_settings');
}
add_action('admin_init', 'egap_register_settings');

// Load plugin text domain for translations.
function egap_load_textdomain() {
    load_plugin_textdomain('easy-google-analytics-pro', false, basename(dirname(__FILE__)) . '/languages/');
}
add_action('plugins_loaded', 'egap_load_textdomain');

