$(document).ready(function () {
    var sub = $('.sub-js').data('sub');
    $('.status-order').on('change', function (e) {
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
        let orderStatus = $(this).val();
        let url = $(this).data('url');

        actions.ajaxCall({
            url: url,
            type: 'PATCH',
            data: {
                orderStatus: orderStatus,
            },
        }).done(function (response) {
            Swal.fire({
                icon: 'success',
                title: sub['success'],
                confirmButtonText: "OK",
            }).then(function () {
                location.reload();
            });
        }).fail(function (error) {
            Swal.fire({
                icon: 'error',
                title: sub['unsuccess'],
                text: "OK",
            }).then(function () {
                location.reload();
            });
        })
    })
});