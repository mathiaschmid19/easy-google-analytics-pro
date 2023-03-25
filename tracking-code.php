<?php

// Add Google Analytics tracking code to the website.
function egap_insert_tracking_code() {
    $egap_settings = get_option('egap_settings');
    $tracking_id = isset($egap_settings['tracking_id']) ? $egap_settings['tracking_id'] : '';

    // Check if the tracking ID is set.
    if ($tracking_id) {
        // Your tracking code output here.
    }
}
add_action('wp_footer', 'egap_insert_tracking_code');
