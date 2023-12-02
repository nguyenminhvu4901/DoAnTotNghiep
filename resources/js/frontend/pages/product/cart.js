'use strict';

(function ($) {
    /*-------------------
        Quantity change
    --------------------- */
    $(document).ready(function () {
        let proQty = $('.pro-qty');

        proQty.on('click', '.qtybtn', function () {
            let button = $(this);
            var maxQuantity = $(this).data('max-quantity');
            let quantityInput = $(`.quantityInput-${button.data('product-id')}`);
            var oldValue = parseInt(quantityInput.val());
            if (button.hasClass(`inc-${button.data('product-id')}`)) {
                var newVal = oldValue + 1;
                if (newVal > maxQuantity) {
                    newVal = maxQuantity;
                }
            } else if (button.hasClass(`dec-${button.data('product-id')}`)) {
                var newVal = oldValue - 1;
                newVal = Math.max(newVal, 0);
            }

            quantityInput.val(newVal);
            updateQuantityButtons(quantityInput);
        });

        proQty.on('change', 'input', function () {
            var input = $(this);
            var maxQuantity = parseInt(input.data('max-quantity'));
            var enteredQuantity = parseFloat(input.val());

            if (enteredQuantity > maxQuantity) {
                input.val(maxQuantity);
            } else if (enteredQuantity < 0) {
                input.val(0);
            }

            updateQuantityButtons(input);
        });

        function updateQuantityButtons(input) {
            var maxQuantity = parseInt(input.data('max-quantity'));
            var enteredQuantity = parseFloat(input.val());

            input.siblings(`.inc-${maxQuantity}`).prop('disabled', enteredQuantity >= maxQuantity);
            input.siblings(`.dec-${maxQuantity}`).prop('disabled', enteredQuantity <= 0);
        }
    });

    $('.input-quantity-in-product-detail').on('input', function () {
        var maxQuantity = parseInt($(this).data('max-quantity'));
        var enteredQuantity = parseInt($(this).val());
        var productDetailIdInProduct = $(this).data('product-id');
        if (isNaN(enteredQuantity) || enteredQuantity < 0) {
            $(this).val(0);
        } else if (enteredQuantity > maxQuantity) {
            $(`#modalMaxQuantity-${productDetailIdInProduct}`).modal('show');

            $(`#modalMaxQuantity-${productDetailIdInProduct}`).on('click', '#confirmMaxQuantity', function () {
                $('.input-quantity-in-product-detail').val(maxQuantity);
            });

            $(`#modalMaxQuantity-${productDetailIdInProduct}`).on('click', '.close-modal-children', function () {
                $(`#modalMaxQuantity-${productDetailIdInProduct}`).modal('hide');
            });
        }
    });

    $('.close-add-to-cart').on('click', function () {
        $('.input-quantity-in-product-detail').val(0);
    });
})(jQuery);