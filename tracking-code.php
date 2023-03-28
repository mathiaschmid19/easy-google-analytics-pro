<?php

// Add Google Analytics tracking code to the website.
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

function egap_opt_out_box() {
    ob_start();
    ?>
    <div class="egap-opt-out-box">
        <p><?php _e('To opt-out of Google Analytics tracking, please check the box below.', 'easy-google-analytics-pro'); ?></p>
        <input type="checkbox" id="egap-opt-out" />
        <label for="egap-opt-out"><?php _e('Opt-out of Google Analytics tracking', 'easy-google-analytics-pro'); ?></label>
    </div>
    <script>
        document.getElementById('egap-opt-out').addEventListener('change', function() {
            if (this.checked) {
                window['ga-disable-UA-XXXXX-Y'] = true; // Replace 'UA-XXXXX-Y' with your Google Analytics tracking ID
            } else {
                window['ga-disable-UA-XXXXX-Y'] = false;
            }
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('egap_opt_out_box', 'egap_opt_out_box');

