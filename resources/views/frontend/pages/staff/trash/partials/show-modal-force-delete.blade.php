<div id="modalDelete-{{ $staffId }}" class="modal fade">
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
                <p>@lang('Do you really want to delete staff? This process cannot be undo.')</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Cancel')</button>
                <button type="submit" class="btn btn-danger" id="a">@lang('Delete')</button>
            </div>
        </div>
    </div>
</div>
