$(document).ready(function () {
    var sub = $('.sub-js').data('sub');
    $('.is-active-sale').click(function () {
        let url = $(this).data('url');
        let isActive = $(this).val();
        actions.ajaxCall({
            url: url,
            type: 'PATCH',
            data: {
                isActive: isActive,
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