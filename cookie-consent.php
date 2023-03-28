<?php

function egap_insert_tracking_code() {
    if (!isset($_COOKIE['egap_cookie_consent']) || $_COOKIE['egap_cookie_consent'] !== 'accepted') {
        return;
    }

    $egap_settings = get_option('egap_settings');
    $tracking_id = isset($egap_settings['tracking_id']) ? $egap_settings['tracking_id'] : '';

    // Check if the tracking ID is set.
    if ($tracking_id) {
        // Your tracking code output here.
    }
}
add_action('wp_footer', 'egap_insert_tracking_code');
