$(document).ready(function() {
    $('.copy-name-coupon').on('click', function(e) {
        var text = $('.name-coupon').text();

        navigator.clipboard.writeText(text).then(function() {
            $('.fbm-copied-message').html($('.copy-name-coupon').data('sub')['copy']);
            setTimeout(function() {
                $('.fbm-copied-message').html('');
            }, 5000);
        });
    });
});