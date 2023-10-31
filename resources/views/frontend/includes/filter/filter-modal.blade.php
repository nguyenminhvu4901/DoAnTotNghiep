<div class="px-2 icon-search-color" data-toggle="modal" data-target="#filter-modal">
    <i class="fas fa-filter cursor-pointer"></i>
</div>
<!-- Modal -->
<div class="modal fade" id="filter-modal" data-keyboard="false" data-backdrop="static" aria-hidden="true"
     @isset($closeOnSubmit) data-no-reset="1" @endisset>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header custom-modal-header py-2">
                <h5 class="modal-title text-white align-middle my-1">
                    @lang('Filter')
                </h5>
                <button type="button" class="close close-modal-in-class" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="fa-solid fa-xmark text-white my-1"></i>
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group m-0">
                    @yield('selection-body')
                </div>
            </div>
            <div class="modal-footer d-flex align-items-center justify-content-center">
                <a class="btn-footer-modal mx-2 btn btn-danger rounded-10 text-nowrap font-weight-600 cancel-button-in-class"
                   type="button" data-dismiss="modal">
                    @lang('Cancel')
                </a>
                <button class="btn-footer-modal ml-2 btn btn-primary rounded-10 text-nowrap font-weight-600"
                        type="submit">
                    @lang('Filter')
                </button>
            </div>
        </div>
    </div>
</div>
