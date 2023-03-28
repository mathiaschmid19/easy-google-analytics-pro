document.addEventListener('DOMContentLoaded', function () {
    var consentBanner = document.getElementById('egap-cookie-consent');
    var acceptButton = document.getElementById('egap-cookie-consent-accept');
    var declineButton = document.getElementById('egap-cookie-consent-decline');

    if (!document.cookie.includes('egap_cookie_consent=accepted')) {
        consentBanner.style.display = 'block';
    }

    acceptButton.addEventListener('click', function () {
        document.cookie = 'egap_cookie_consent=accepted; max-age=31536000; path=/';
        consentBanner.style.display = 'none';
    });

    declineButton.addEventListener('click', function () {
        document.cookie = 'egap_cookie_consent=declined; max-age=31536000; path=/';
        consentBanner.style.display = 'none';
    });
});
