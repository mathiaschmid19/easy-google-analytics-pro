<?php

// Create the settings page.
function egap_create_settings_page() {
    add_options_page(
        'Easy Google Analytics Pro',
        'Easy Google Analytics Pro',
        'manage_options',
        'easy-google-analytics-pro',
        'egap_render_settings_page'
    );
}
add_action('admin_menu', 'egap_create_settings_page');

// Render the settings page.
function egap_render_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields('egap_settings_group');
            do_settings_sections('easy-google-analytics-pro');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Add settings sections and fields.
function egap_initialize_plugin_options() {
    add_settings_section(
        'egap_general_settings',
        __('General Settings', 'easy-google-analytics-pro'),
        'egap_general_settings_callback',
        'easy-google-analytics-pro'
    );

    add_settings_field(
        'egap_tracking_id',
        __('Google Analytics Tracking ID', 'easy-google-analytics-pro'),
        'egap_tracking_id_callback',
        'easy-google-analytics-pro',
        'egap_general_settings'
    );
}
add_action('admin_init', 'egap_initialize_plugin_options');

// Callback functions for settings sections and fields.
function egap_general_settings_callback() {
    echo '<p>' . __('Enter your Google Analytics tracking ID and customize the tracking settings.', 'easy-google-analytics-pro') . '</p>';
}

function egap_tracking_id_callback() {
    $options = get_option('egap_settings');
    $tracking_id = isset($options['egap_tracking_id']) ? $options['egap_tracking_id'] : '';
    echo '<input type="text" id="egap_tracking_id" name="egap_settings[egap_tracking_id]" value="' . esc_attr($tracking_id) . '">';
}

// Add this new function at the beginning of the file
function egap_add_settings_fields() {
    // ... (all the add_settings_field() and add_settings_section() calls)
    add_settings_section(
        'egap_general_settings',
        __('General Settings', 'easy-google-analytics-pro'),
        'egap_general_settings_callback',
        'easy-google-analytics-pro'
    );

    add_settings_field(
        'egap_tracking_id',
        __('Google Analytics Tracking ID', 'easy-google-analytics-pro'),
        'egap_tracking_id_callback',
        'easy-google-analytics-pro',
        'egap_general_settings'
    );
    
}
// Hook the new function to the admin_init action
add_action('admin_init', 'egap_add_settings_fields');


// Callback function for the new settings field
function egap_auto_display_opt_out_callback() {
    $options = get_option('egap_settings');
    $auto_display_opt_out = isset($options['egap_auto_display_opt_out']) ? $options['egap_auto_display_opt_out'] : '';
    echo '<input type="checkbox" id="egap_auto_display_opt_out" name="egap_settings[egap_auto_display_opt_out]" value="1"' . checked(1, $auto_display_opt_out, false) . '>';
    echo '<label for="egap_auto_display_opt_out">' . __('Display Opt-Out Box automatically', 'easy-google-analytics-pro') . '</label>';
}

function egap_auto_display_opt_out() {
    $options = get_option('egap_settings');
    if (isset($options['egap_auto_display_opt_out']) && $options['egap_auto_display_opt_out']) {
        add_action('wp_footer', 'egap_opt_out_box');
    }
}
add_action('wp_loaded', 'egap_auto_display_opt_out');


function egap_anonymize_ip_callback() {
    $options = get_option('egap_settings');
    $anonymize_ip = isset($options['egap_anonymize_ip']) ? $options['egap_anonymize_ip'] : '';
    echo '<input type="checkbox" id="egap_anonymize_ip" name="egap_settings[egap_anonymize_ip]" value="1"' . checked(1, $anonymize_ip, false) . '>';
    echo '<label for="egap_anonymize_ip">' . __('Anonymize IP addresses for Google Analytics tracking', 'easy-google-analytics-pro') . '</label>';
}

function egap_output_tracking_code() {
    $options = get_option('egap_settings');
    $tracking_id = isset($options['egap_tracking_id']) ? $options['egap_tracking_id'] : '';
    $anonymize_ip = isset($options['egap_anonymize_ip']) ? $options['egap_anonymize_ip'] : '';

    if (!$tracking_id) {
        return;
    }

    ?>
    <!-- Google Analytics -->
    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', '<?php echo esc_js($tracking_id); ?>', 'auto');
    <?php if ($anonymize_ip) : ?>
    ga('set', 'anonymizeIp', true);
    <?php endif; ?>
    ga('send', 'pageview');
    </script>
    <!-- End Google Analytics -->
    <?php
}
