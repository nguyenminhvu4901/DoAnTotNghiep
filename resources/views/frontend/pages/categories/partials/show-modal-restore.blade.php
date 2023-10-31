<div id="modalRestore-{{ $categoryId }}" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="fas fa-trash-restore" style="color: #00ff33;"></i>
                </div>
                <h4 class="modal-title w-100">@lang('Are you sure?')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>@lang('Do you really want to restore record? This process cannot be undone.')</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Cancel')</button>
                <button type="submit" class="btn btn-success">@lang('Restore')</button>
            </div>
        </div>
    </div>
</div>
