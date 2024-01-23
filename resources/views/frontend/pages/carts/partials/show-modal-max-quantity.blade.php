<div id="modalMaxQuantity-{{ $cartId }}" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="fas fa-times-circle" style="color: #f50000;"></i>
                </div>
            </div>
            <div class="modal-body">
                <p>@lang('Unfortunately, you can only purchase a maximum of :maxQuantity products', ['maxQuantity' => $maxQuantity])</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" id="confirmMaxQuantity"
                    data-dismiss="modal">@lang('OK')</button>
            </div>
        </div>
    </div>
</div>
