'use strict';

(function ($) {
    /*-------------------
        Quantity change
    --------------------- */
    $(document).ready(function () {
        var proQty = $('.pro-qty');
        proQty.prepend('<span class="dec qtybtn">-</span>');
        proQty.append('<span class="inc qtybtn">+</span>');
    
        proQty.on('click', '.qtybtn', function () {
            var $button = $(this);
            var input = $button.siblings('input');
            var maxQuantity = parseInt(input.data('max-quantity'));
            var oldValue = parseFloat(input.val());
    
            if ($button.hasClass('inc')) {
                var newVal = oldValue + 1;
                if (newVal > maxQuantity) {
                    newVal = maxQuantity;
                }
            } else {
                var newVal = oldValue - 1;
                newVal = Math.max(newVal, 0); // Đảm bảo số lượng không nhỏ hơn 0
            }
    
            input.val(newVal);
            updateQuantityButtons(input);
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
    
            input.siblings('.qtybtn.inc').prop('disabled', enteredQuantity >= maxQuantity);
            input.siblings('.qtybtn.dec').prop('disabled', enteredQuantity <= 0);
        }
    });

    $(document).ready(function () {
        $('.quantityInput').on('input', function () {
            var maxQuantity = parseInt($(this).data('max-quantity'));
            var enteredQuantity = parseInt($(this).val());

            if (enteredQuantity > maxQuantity) {
                $(this).val(maxQuantity);
            }
        });
    });
})(jQuery);