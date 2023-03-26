(function ($) {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {

        // Cache DOM elements
        var $customButton = $('.egap-custom-button');

        // Add click event listener to the custom button
        $customButton.on('click', function () {
            alert('Custom button clicked!');
        });

    });

})(jQuery);

document.addEventListener('DOMContentLoaded', function() {
    const trackingCodeFields = document.querySelectorAll('.egap-tracking-code-field');
    const livePreview = document.querySelector('.egap-live-preview');

    trackingCodeFields.forEach(field => {
        field.addEventListener('input', updateLivePreview);
    });

    function updateLivePreview() {
        let trackingCodes = '';
        trackingCodeFields.forEach(field => {
            trackingCodes += field.value + '\n';
        });
        livePreview.textContent = trackingCodes;
    }

    updateLivePreview();
});
