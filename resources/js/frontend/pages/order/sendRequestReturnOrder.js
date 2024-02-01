$(document).ready(function () {
    var sub = $('.sub-js').data('sub');
    $('#sendRequestReturnOrder').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        let url = $(this).data('url');

        actions.ajaxCall({
            url: url,
            type: 'PATCH'
        }).done(function (response) {
            Swal.fire({
                icon: 'success',
                title: sub['success'],
                confirmButtonText: "OK",
            }).then(function () {
                location.reload();
            });
            console.log(response);
        }).fail(function (error) {
            Swal.fire({
                icon: 'error',
                title: sub['unsuccess'],
                text: "OK",
            }).then(function () {
                location.reload();
            });
            console.error(error);
        });
    });

    $('#confirmRequestReturnOrder').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        let url = $(this).data('url');
        console.log(url);
        actions.ajaxCall({
            url: url,
            type: 'PATCH'
        }).done(function (response) {
            Swal.fire({
                icon: 'success',
                title: sub['success'],
                confirmButtonText: "OK",
            }).then(function () {
                location.reload();
            });
            console.log(response);
        }).fail(function (error) {
            Swal.fire({
                icon: 'error',
                title: sub['unsuccess'],
                text: "OK",
            }).then(function () {
                location.reload();
            });
            console.error(error);
        });
    });

    $('#noConfirmRequestReturnOrder').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        let url = $(this).data('url');

        actions.ajaxCall({
            url: url,
            type: 'PATCH'
        }).done(function (response) {
            Swal.fire({
                icon: 'success',
                title: sub['success'],
                confirmButtonText: "OK",
            }).then(function () {
                location.reload();
            });
            console.log(response);
        }).fail(function (error) {
            Swal.fire({
                icon: 'error',
                title: sub['unsuccess'],
                text: "OK",
            }).then(function () {
                location.reload();
            });
            console.error(error);
        });
    });

    $('.status-return-order').on('change', function (e) {
        let currentStatus = $(this).data('current-status');

        if (currentStatus == 5) {
            Swal.fire({
                icon: 'error',
                title: sub['done5'],
                confirmButtonText: "OK",
            }).then(function () {
                location.reload();
            });
            return;
        }

        let orderReturnStatus = $(this).val();
        let url = $(this).data('url');

        actions.ajaxCall({
            url: url,
            type: 'PATCH',
            data: {
                orderReturnStatus: orderReturnStatus,
            },
        }).done(function (response) {
            Swal.fire({
                icon: 'success',
                title: sub['success'],
                confirmButtonText: "OK",
            }).then(function () {
                location.reload();
            });
            console.log(response);
        }).fail(function (error) {
            Swal.fire({
                icon: 'error',
                title: sub['unsuccess'],
                text: "OK",
            }).then(function () {
                location.reload();
            });
            console.error(error);
        });
    });
});
