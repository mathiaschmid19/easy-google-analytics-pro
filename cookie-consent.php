<?php

function egap_cookie_consent_banner() {
    $egap_settings = get_option('egap_settings');
    $cookie_banner_enabled = isset($egap_settings['cookie_banner_enabled']) ? $egap_settings['cookie_banner_enabled'] : false;

    if ($cookie_banner_enabled && (!isset($_COOKIE['egap_cookie_consent']) || $_COOKIE['egap_cookie_consent'] !== 'accepted')) {
        ?>
        <div id="egap-cookie-consent" class="egap-cookie-consent">
            <p><?php _e('We use cookies to analyze our website traffic and improve your experience. By using our site, you agree to our use of cookies.', 'easy-google-analytics-pro'); ?></p>
            <button id="egap-cookie-consent-accept"><?php _e('Accept', 'easy-google-analytics-pro'); ?></button>
            <button id="egap-cookie-consent-decline"><?php _e('Decline', 'easy-google-analytics-pro'); ?></button>
        </div>
        <?php
    }
}
add_action('wp_footer', 'egap_cookie_consent_banner');


function egap_enqueue_cookie_consent_assets() {
    if (!isset($_COOKIE['egap_cookie_consent']) || $_COOKIE['egap_cookie_consent'] !== 'accepted') {
        wp_enqueue_style('egap-cookie-consent-style', plugin_dir_url(__FILE__) . 'assets/css/cookie-consent-style.css', array(), '1.0.5');
        wp_enqueue_script('egap-cookie-consent-script', plugin_dir_url(__FILE__) . 'assets/js/cookie-consent-script.js', array(), '1.0.5', true);
    }
}
add_action('wp_enqueue_scripts', 'egap_enqueue_cookie_consent_assets');


