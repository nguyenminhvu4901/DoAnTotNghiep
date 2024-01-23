$(document).ready(function () {
    $('.status-order').on('change', function (e) {
        let currentStatus = $(this).data('current-status');

        if (currentStatus == 5) {
            Swal.fire({
                icon: 'error',
                title: "The order has been successfully delivered, so you cannot update",
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
                title: 'Update status successfully',
                confirmButtonText: "OK",
            }).then(function () {
                location.reload();
            });
        }).fail(function (error) {
            Swal.fire({
                icon: 'error',
                title: "Update failed",
                text: "OK",
            }).then(function () {
                location.reload();
            });
        })
    })
});