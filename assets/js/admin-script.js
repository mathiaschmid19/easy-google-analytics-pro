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