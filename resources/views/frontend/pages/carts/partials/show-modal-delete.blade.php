<div id="modalDelete-{{ $cartId }}" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="fas fa-times-circle" style="color: #f50000;"></i>
                </div>
                <h4 class="modal-title w-100">@lang('Are you sure?')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>@lang('Do you want to remove the product from the shopping cart? This process cannot be undone.')</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" id="cancelDelete" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete" data-dismiss="modal">Delete</button>
            </div>
        </div>
    </div>
</div>
