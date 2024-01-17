<div id="loginModal" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="fas fa-user-shield"></i>
                    <button type="button" class="close close-login-modal" aria-hidden="true">&times;
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <p>@lang('You need to be logged in to use this feature.')</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="submit" class="btn btn-success close-login-modal-and-redirect-login" data-url="{{ route('frontend.auth.login') }}">
                    @lang('OK')</button>
            </div>
        </div>
    </div>
</div>
