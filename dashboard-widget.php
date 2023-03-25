<?php
// Add the custom dashboard widget.
function egap_add_dashboard_widget() {
    wp_add_dashboard_widget(
        'egap_dashboard_widget',
        __('Easy Google Analytics Pro - Overview', 'easy-google-analytics-pro'),
        'egap_dashboard_widget_callback'
    );
}
add_action('wp_dashboard_setup', 'egap_add_dashboard_widget');

// Display the dashboard widget content.
function egap_dashboard_widget_callback() {
    // Your dashboard widget content here
}
