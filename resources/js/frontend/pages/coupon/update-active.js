$(document).ready(function () {
    $('.is-active-coupon').click(function () {
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
                title: 'Cập nhật thành công',
                confirmButtonText: "Rất giỏi",
            }).then(function () {
                location.reload();
            });
        }).fail(function (error) {
            Swal.fire({
                icon: 'error',
                title: "Cập nhật không thành công",
                text: "Rất non",
            }).then(function () {
                location.reload();
            });
        })
    })
});