<!-- Sidebar  -->
<nav id="sidebar-container" class="default-sidebar d-flex justify-content-center align-items-center 80-vh 60-vw">
    <div id="sidebar" class="sidebar-with-divider bg-white sidebar-setting">
        <div class="w-100">
            <div class="d-flex justify-content-center">
                <img id="sidebar-nix-logo" class="nix-logo" src="{{ asset('img/logo/logo-bg-white.png') }}" alt="Logo">
            </div>
            <div class="mb-3 d-flex justify-content-center">
                <img id="sidebar-avatar" class="sidebar-avatar rounded-circle" src="{{ $logged_in_user->avatar }}"
                     alt="avatar">
            </div>
            <div class="mb-5 pb-3">
                <div class="mb-1 d-flex justify-content-center">
                    <div id="sidebar-name">{{ $logged_in_user->name }}</div>
                </div>
                <div class="d-flex justify-content-center">
                    <div id="sidebar-role">{{ $logged_in_user->current_role }}</div>
                </div>
            </div>
            <div class="mb-5 px-xl-5 px-3 sidebar-show overflow-hidden sidebar-item">
                @if(auth()->user()->isRoleCustomer())
                    @include('frontend.includes.partials.sidebar-items-customer')
                @else
                    @include('frontend.includes.partials.sidebar-items-staff')
                @endif
            </div>
        </div>
    </div>
    <div class="show-icon-chevron-right d-none btn-student-sidebar-expand w-100 pl-4">
        <i class="fa-solid fa-chevron-right bg-white p-2 fa-1x cursor-pointer"></i>
    </div>
</nav>
