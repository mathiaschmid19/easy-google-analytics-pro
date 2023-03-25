<?php

// Add the settings menu.
function egap_add_settings_menu() {
    add_options_page(
        __('Easy Google Analytics Pro', 'easy-google-analytics-pro'),
        __('Easy Google Analytics Pro', 'easy-google-analytics-pro'),
        'manage_options',
        'easy-google-analytics-pro',
        'egap_settings_page'
    );
}
add_action('admin_menu', 'egap_add_settings_menu');

// Display the settings page.
function egap_settings_page() {
    // Your settings page content here
}
