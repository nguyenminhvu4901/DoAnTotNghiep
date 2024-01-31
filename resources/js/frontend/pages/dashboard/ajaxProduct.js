$(document).ready(function () {

    $('#order-by-dashboard-product').on('change', function () {
        let url = $(this).data('url');
        let currentValue = $(this).val();

        console.log(currentValue);
        actions.ajaxCall({
            url: url,
            type: 'GET',
            data: {
                order_by: currentValue
            }
        }).done(function (response) {
            window.location.reload(true);
        }).fail(function (error) {
            Swal.fire({
                icon: 'error',
                title: "Không hợp lệ",
            }).then(function () {
                location.reload();
            });
        })
    });
})