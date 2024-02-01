$(function () {
    const filterModal = $('#filter-modal')
    $('.filter-select').select2({
        width: '100%',
        placeholder: $(this).data('placeholder')
    });


    filterModal.on('hidden.bs.modal', function () {
        if ($(this).data('no-reset')) return
        const classSelect = $('#class-select')
        $(this).find('select').each(function () {
            const dataSelected = $(this).data('selected')
            if (classSelect) {
                const data = [{oldValue: classSelect.data('selected')}]
                $(this).val(dataSelected).trigger('change', data)
            } else {
                $(this).val(dataSelected).trigger('change')
            }
        })
    })

    $(document).on('click', '.remove-search-filter', function () {
        const inputName = $(this).data('name')
        const inputValue = $(this).data('value')
        filterModal.find(`select[name="${inputName}"] option[value="${inputValue}"]`).prop('selected', false).trigger('change')
        filterModal.find(`input[name="${inputName}"][value="${inputValue}"]`)
            .val('')
            .trigger('change')
        $('#search-form').submit()
    })
})
