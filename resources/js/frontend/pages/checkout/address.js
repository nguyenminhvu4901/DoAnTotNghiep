(function (yourcode) {
    yourcode(window.jQuery, window, document);
}(function ($, window, document) {

    function ajaxRenderDistrict(element) {
        let provinceId = $(element).val();
        $('#select-district').val('');
        $('#select-ward').val('');
        if (provinceId == "default") {
            let totalCost = $(`#select-province`).data('total-cost');
            $('#district-render').html(`<select class="form-control filter-select" id="select-district">
            <option value="default">Choose District</option>
        </select>`);
            $('#ward-render').html(`<select class="form-control filter-select" id="select-ward">
            <option value="default">Choose Ward</option>
        </select>`);
            $('#fee-ship').html(`<div class="checkout__order__total">Total
            <span>${Math.round(totalCost).toLocaleString('en-US').replace(/,/g, '.')}</span>
    </div>`);
        } else {
            let url = $(`.province-option-${provinceId}`).data('url');
            let totalCost = $(`.province-option-${provinceId}`).data('total-cost');
            let provinceName = $(`.province-option-${provinceId}`).data('province-name');
            district = null;
            const storedData = localStorage.getItem('formData');

            if (storedData) {
                const formData = JSON.parse(storedData);
                district = formData.district;
            }

            actions.ajaxCall({
                url: url,
                type: 'GET',
                data: {
                    provinceId: provinceId,
                    totalCost: totalCost,
                    district: district || null
                },
            }).done(function (response) {
                $('#district-render').html(response.data);
                $('#selected-province-name').val(provinceName);

                if ($('#select-district').val() != null) {
                    ajaxRenderWard('#select-district')
                }

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
    }

    function ajaxRenderWard(element) {
        let districtId = $(element).val();
        let districtIdInLocalStorage = JSON.parse(localStorage.getItem('formData')).district
        let totalCost = $(element).data('total-cost');
        $('#select-ward').val('');

        if (districtId == "default" && districtIdInLocalStorage == null) {
            $('#ward-render').html(`<select class="form-control filter-select" id="select-ward">
                <option value="default">Choose Ward</option>
            </select>`);
            $('#fee-ship').html(`<div class="checkout__order__total">Total
            <span>${Math.round(totalCost).toLocaleString('en-US').replace(/,/g, '.')}</span>
            </div>`);
        } else if (districtId) {
            let url = $(`.district-option-${districtId}`).data('url');
            let districtName = $(`.district-option-${districtId}`).data('district-name');
            const storedData = localStorage.getItem('formData');
            ward = null;
            if (storedData) {
                const formData = JSON.parse(storedData);
                ward = formData.ward;
            }
            actions.ajaxCall({
                url: url,
                type: 'GET',
                data: {
                    districtId: districtId,
                    totalCost: totalCost,
                    ward: ward || null
                },
            }).done(function (response) {
                if (districtId != "default") {
                    $('#ward-render').html(response.data);
                    $('#selected-district-name').val(districtName);
                    if ($('#select-ward').val() != null) {
                        ajaxRenderFee('#select-ward')
                    }
                } else {
                    $('#ward-render').html(`<select class="form-control filter-select" id="select-ward">
                    <option value="default">Choose Ward</option>
                </select>`);
                }
            }).fail(function (error) {
                Swal.fire({
                    icon: 'error',
                    title: "Cập nhật không thành công",
                    text: "Rất non",
                }).then(function () {
                    location.reload();
                });
            })
        } else {
            let url = $(`.district-option-${districtIdInLocalStorage}`).data('url');
            let districtName = $(`.district-option-${districtIdInLocalStorage}`).data('district-name');
            const storedData = localStorage.getItem('formData');
            ward = null;
            if (storedData) {
                const formData = JSON.parse(storedData);
                ward = formData.ward;
            }
            actions.ajaxCall({
                url: url,
                type: 'GET',
                data: {
                    districtId: districtIdInLocalStorage,
                    totalCost: totalCost,
                    ward: ward || null
                },
            }).done(function (response) {
                $('#ward-render').html(response.data);
                $('#selected-district-name').val(districtName);
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
    }

    function ajaxRenderFee(element) {
        let wardCode = $(element).val();
        let totalCost = $(element).data('total-cost');
        if (wardCode == "default") {
            $('#fee-ship').html(`<div class="checkout__order__total">Total
                <span>${Math.round(totalCost).toLocaleString('en-US').replace(/,/g, '.')}</span>
            </div>`);
        } else {
            let districtId = $(`.ward-option-${wardCode}`).data('district-id');
            let wardName = $(`.ward-option-${wardCode}`).data('ward-name');
            let url = $(`.ward-option-${wardCode}`).data('url');
            actions.ajaxCall({
                url: url,
                type: 'GET',
                data: {
                    districtId: districtId,
                    wardCode: wardCode,
                    totalCost: totalCost,
                },
            }).done(function (response) {
                $('#fee-ship').html(response.data);
                $('#selected-ward-name').val(wardName);
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
    }

    $('#select-province').on('change', function (e) {
        ajaxRenderDistrict('#select-province');
    })

    $('#select-district').on('change', function (e) {
        ajaxRenderWard($('#select-district'));
    })

    $('#select-ward').on('change', function (e) {
        ajaxRenderFee($('#select-ward'));
    })

    window.addEventListener('load', function () {
        if ($('#select-province').val() != "default" && $('#select-province').val() != "" && $('#select-province') != null) {
            ajaxRenderDistrict($('#select-province'));
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('form-checkout');

        form.addEventListener('submit', function (event) {

            const formData = new FormData(form);
            const formValues = {};

            for (let [key, value] of formData.entries()) {
                formValues[key] = value;
            }

            localStorage.setItem('formData', JSON.stringify(formValues));
        });
    });
}))