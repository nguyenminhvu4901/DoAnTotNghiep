$(function () {
    $('.filter-select').select2({
        width: '100%',
        placeholder: $(this).data('placeholder')
    });

    $(document).on('click', '.remove-search-filter', function () {
        let newInput = $('<input>').attr('type', 'hidden').attr('name', 'checkDelete').attr('value', 'true');
        $('#checkDeleteCouponInCart').prepend(newInput);
        const inputName = $(this).data('name')
        const inputValue = $(this).data('value')
        $('#search-form').find(`select[name="${inputName}"] option[value="${inputValue}"]`).prop('selected', false).trigger('change');
        $('#search-form').submit()
    })
})
