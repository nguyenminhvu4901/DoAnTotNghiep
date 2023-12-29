$(document).ready(function () {
    let proQty = $('.pro-qty');

    $('.delete-product').click(function () {
        var productDetailIdToDelete = $(this).data('product-id');
        var cartIdToDelete = $(this).data('cart-id');
        var urlDelete = $(this).data('action');
        $(`#modalDelete-${cartIdToDelete}`).modal('show');

        $(`#modalDelete-${cartIdToDelete}`).on('click', '#confirmDelete', function () {
            deleteProduct(productDetailIdToDelete, cartIdToDelete, urlDelete);
        });
    });

    proQty.on('click', '.qtybtn', function () {
        var productDetailIdToUpdateWhenClick = $(this).data('product-id');
        var cartIdToUpdateWhenClick = $(this).data('cart-id');
        var urlUpdateSingle = $(this).data('action');
        var newQuantitySingle = $(`.quantityInput-${productDetailIdToUpdateWhenClick}`).val();
        var oldQuantitySingle = $(this).data('initial-quantity');
        var urlDeleteSingle = $(this).data('action-delete-single');
        if (newQuantitySingle < 1) {
            $(`#modalDelete-${cartIdToUpdateWhenClick}`).modal('show');

            $(`#modalDelete-${cartIdToUpdateWhenClick}`).on('click', '#confirmDelete', function () {
                deleteProduct(productDetailIdToUpdateWhenClick, cartIdToUpdateWhenClick, urlDeleteSingle);
            });

            $(`#modalDelete-${cartIdToUpdateWhenClick}`).on('click', '#cancelDelete', function () {
                $(`.quantityInput-${productDetailIdToUpdateWhenClick}`).val(oldQuantitySingle);
            });
        } else {
            updateProductInCart(productDetailIdToUpdateWhenClick, cartIdToUpdateWhenClick, urlUpdateSingle, newQuantitySingle, oldQuantitySingle)
        }
    });

    function updateQuantityDirect(inputElement) {
        var maxQuantity = parseInt(inputElement.data('max-quantity'));
        var quantityNewMultiple = parseInt(inputElement.val());
        var oldQuantityMultiple = parseInt(inputElement.data('initial-quantity'));
        var productDetailIdToUpdateWhenChange = inputElement.data('product-id');
        var cartId = inputElement.data('cart-id');
        var urlDeleteInput = inputElement.data('action-delete');
        var urlUpdateMultiple = inputElement.data('action');

        if (isNaN(quantityNewMultiple) || quantityNewMultiple < 1) {
            $(`#modalDelete-${cartId}`).modal('show');

            $(`#modalDelete-${cartId}`).on('click', '#confirmDelete', function () {
                deleteProduct(productDetailIdToUpdateWhenChange, cartId, urlDeleteInput);
            });

            $(`#modalDelete-${cartId}`).on('click', '#cancelDelete', function () {
                $(`.quantityInput-${productDetailIdToUpdateWhenChange}`).val(oldQuantityMultiple);
            });
        } else if (quantityNewMultiple > maxQuantity) {
            $(`#modalMaxQuantity-${cartId}`).modal('show');

            $(`#modalMaxQuantity-${cartId}`).on('click', '#confirmMaxQuantity', function () {
                $(`.quantityInput-${productDetailIdToUpdateWhenChange}`).val(maxQuantity);

                $(`.quantityInput-${productDetailIdToUpdateWhenChange}`).data('timer', setTimeout(function () {
                    updateProductInCart(productDetailIdToUpdateWhenChange, cartId, urlUpdateMultiple, maxQuantity, oldQuantityMultiple);
                }, 1000));
            });
        } else {
            $(`.quantityInput-${productDetailIdToUpdateWhenChange}`).data('timer', setTimeout(function () {
                updateProductInCart(productDetailIdToUpdateWhenChange, cartId, urlUpdateMultiple, quantityNewMultiple, oldQuantityMultiple);
            }, 1000));
        }
    }

    $('.input-quantity').on('change', function () {
        updateQuantityDirect($(this));
    });

    function deleteProduct(productDetailId, cartId, url) {
        actions.ajaxCall({
            url: url,
            type: 'DELETE',
            data: {
                productDetailId: productDetailId,
                cartId: cartId
            },
        }).done(function (response) {

            Swal.fire({
                icon: 'success',
                title: 'Xoá thành công',
                confirmButtonText: "Rất giỏi",
            }).then(function () {
                location.reload();
            });
        }).fail(function (error) {
            Swal.fire({
                icon: 'error',
                title: "Xoá không thành công",
                text: "Rất non",
            }).then(function () {
                location.reload();
            });
        })
    }

    function updateProductInCart(productDetailId, cartId, url, newQuantitySingle, oldQuantitySingle) {
        actions.ajaxCall({
            url: url,
            type: 'PUT',
            data: {
                productDetailId: productDetailId,
                cartId: cartId,
                newQuantity: newQuantitySingle,
                oldQuantity: oldQuantitySingle
            },
        }).done(function (response) {
            // Swal.fire({
            //     icon: 'success',
            //     title: 'Cập nhật thành công',
            //     confirmButtonText: "Rất giỏi",
            // }).then(function () {
                // $('#renderCart').html(response.html);
                location.reload();
            // });
        }).fail(function (error) {
            Swal.fire({
                icon: 'error',
                title: "Cập nhật không thành công",
                text: "Rất non",
            }).then(function () {
                location.reload();
            });
        })
    }

    $('input').on('keypress', function (event) {
        if (event.which == 13) {
            $(this).blur();
            event.preventDefault();
        }

    })
});