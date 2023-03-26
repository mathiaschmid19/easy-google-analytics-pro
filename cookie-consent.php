<?php
function egap_cookie_consent_banner() {
    if (!isset($_COOKIE['egap_cookie_consent']) || $_COOKIE['egap_cookie_consent'] !== 'accepted') {
        ?>
        <div id="egap-cookie-consent" class="egap-cookie-consent">
            <p><?php _e('We use cookies to analyze our website traffic and improve your experience. By using our site, you agree to our use of cookies.', 'easy-google-analytics-pro'); ?></p>
            <button id="egap-cookie-consent-accept"><?php _e('Accept', 'easy-google-analytics-pro'); ?></button>
        </div>
        <style>
            .egap-cookie-consent {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                padding: 15px;
                background-color: #333;
                color: #fff;
                text-align: center;
                z-index: 1000;
                display: none;
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var consentBanner = document.getElementById('egap-cookie-consent');
                var acceptButton = document.getElementById('egap-cookie-consent-accept');

                if (!document.cookie.includes('egap_cookie_consent=accepted')) {
                    consentBanner.style.display = 'block';
                }

                acceptButton.addEventListener('click', function() {
                    document.cookie = 'egap_cookie_consent=accepted; max-age=31536000; path=/';
                    consentBanner.style.display = 'none';
                });
            });
        </script>
        <?php
    }
}
add_action('wp_footer', 'egap_cookie_consent_banner');
