$(document).ready(function () {
    $('.check-login').click(function () {
        $('#loginModal').modal('show');
    });

    $('.close-login-modal').click(function() {
        $('#loginModal').modal('hide');
    });

    $('.close-login-modal-and-redirect-login').click(function() {
        $('#loginModal').modal('hide');
        let urlLogin =  $('.close-login-modal-and-redirect-login').data('url');
        window.location.href = urlLogin;
    });
})