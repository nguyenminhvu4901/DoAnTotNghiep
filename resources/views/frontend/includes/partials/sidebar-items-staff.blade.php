<a class="d-flex mb-3 menu-parent @if (isCurrentRouteInRoutes('frontend.user.dashboard') || isCurrentRouteInRoutes('admin.dashboard')) sidebar-route-selected @else sidebar-route-normal @endif text-lg"
   href="{{ route('frontend.user.dashboard') }}">
    <div class="d-flex align-items-center">
        <i class="fas fa-columns  fa-lg sidebar-icon"></i>
        <div class="text-sky-700 fw-bold fs-5 ml-3">@lang('Dashboard')</div>
    </div>
</a>
@canany(['user.category.view', 'user.category.detail'])
    <a class="d-flex mb-3 @if (isCurrentRouteInRoutes('frontend.categories.*')) sidebar-route-selected @else sidebar-route-normal @endif text-lg"
       href="{{ route('frontend.categories.index') }}">
        <div class="d-flex align-items-center">
            <i class="fa-solid fas fa-store fa-lg sidebar-icon"></i>
            <div class="text-sky-700 fw-bold fs-5 ml-3">@lang('Category')</div>
        </div>
    </a>
@endcanany
@canany(['user.product.view', 'user.product.detail'])
    <a class="d-flex mb-3 sidebar-route-normal text-lg menu-parent" data-toggle="collapse" role="button"
       href="#course-management-items">
        <div class="d-flex align-items-center">
            <i class="fa-solid fas fa-store fa-lg sidebar-icon"></i>
            <div class="text-sky-700 fw-bold fs-5 ml-3">@lang('Product Management')</div>
            <i class="ml-2 fa fa-angle-down " aria-hidden="true"></i>
        </div>
    </a>
    <div id="course-management-items"
         class="sidebar-items-collapse collapse pl-4 @if (isCurrentRouteInRoutes('frontend.products.*') ||
            isCurrentRouteInRoutes('frontend.productDetails.*') ||
            isCurrentRouteInRoutes('frontend.productImages.*')) show @endif text-lg">
        <a class="d-flex mb-3 sidebar-route-normal @if (isCurrentRouteInRoutes('frontend.products.*')) sidebar-route-selected @else sidebar-route-normal @endif text-lg"
           href="{{ route('frontend.products.index') }}">
            <div class="d-flex align-items-center">
                <i class="fas fa-box fa-lg sidebar-icon"></i>
                <div class="text-sky-700 fw-bold fs-5 pl-3">@lang('All Products')</div>
            </div>
        </a>
        <a class="d-flex mb-3 sidebar-route-normal @if (isCurrentRouteInRoutes('frontend.productDetails.*')) sidebar-route-selected @else sidebar-route-normal @endif text-lg"
           href="{{ route('frontend.productDetails.index') }}">
            <div class="d-flex align-items-center">
                <i class="fas fa-info fa-lg sidebar-icon"></i>
                <div class="text-sky-700 fw-bold fs-5 pl-3">@lang('All Product Details')</div>
            </div>
        </a>
        <a class="d-flex mb-3 sidebar-route-normal @if (isCurrentRouteInRoutes('frontend.productImages.*')) sidebar-route-selected @else sidebar-route-normal @endif text-lg"
           href="{{ route('frontend.productImages.index') }}">
            <div class="d-flex align-items-center">
                <i class="fas fa-images fa-lg sidebar-icon"></i>
                <div class="text-sky-700 fw-bold fs-5 pl-3">@lang('All Product Images')</div>
            </div>
        </a>
    </div>
@endcanany
{{--@canany(['user.cart'])--}}
{{--    <a class="d-flex mb-3 sidebar-route-normal @if (isCurrentRouteInRoutes('frontend.carts.*')) sidebar-route-selected @else sidebar-route-normal @endif text-lg"--}}
{{--       href="{{ route('frontend.carts.index') }}" href="{{ route('frontend.carts.index') }}">--}}
{{--        <div class="d-flex align-items-center">--}}
{{--            <i class="fa-solid fas fa-shopping-cart fa-lg sidebar-icon"></i>--}}
{{--            <div class="text-sky-700 fw-bold fs-5 ml-3">@lang('Cart') ({{ countProductInCart() ?? 0 }})</div>--}}
{{--        </div>--}}
{{--    </a>--}}
{{--@endcanany--}}
@canany(['user.coupon.view'])
    <a class="d-flex mb-3 sidebar-route-normal @if (isCurrentRouteInRoutes('frontend.coupons.*')) sidebar-route-selected @else sidebar-route-normal @endif text-lg"
       href="{{ route('frontend.coupons.index') }}">
        <div class="d-flex align-items-center">
            <i class="fa-solid fas fa-tags fa-lg sidebar-icon"></i>
            <div class="text-sky-700 fw-bold fs-5 ml-3">@lang('Coupon')</div>
        </div>
    </a>
@endcanany
@canany(['user.sale.view'])
    <a class="d-flex mb-3 sidebar-route-normal @if (isCurrentRouteInRoutes('frontend.sales.*')) sidebar-route-selected @else sidebar-route-normal @endif text-lg"
       href="{{ route('frontend.sales.index') }}">
        <div class="d-flex align-items-center">
            <i class="fa-solid fas fa-percent fa-lg sidebar-icon"></i>
            <div class="text-sky-700 fw-bold fs-5 ml-3">@lang('Sale Product')</div>
        </div>
    </a>
@endcanany
@canany(['user.order.view'])
    <a class="d-flex mb-3 sidebar-route-normal @if (isCurrentRouteInRoutes('frontend.orders.*')) sidebar-route-selected @else sidebar-route-normal @endif text-lg"
       href="{{ route('frontend.orders.index') }}">
        <div class="d-flex align-items-center">
            <i class="fa-solid fas fa-shipping-fast fa-lg sidebar-icon"></i>
            <div class="text-sky-700 fw-bold fs-5 ml-3">@lang('Order') ({{ countOrderExist() ?? 0 }})</div>
        </div>
    </a>
@endcanany
@canany(['user.management'])
    <a class="d-flex mb-3 sidebar-route-normal text-lg menu-parent" data-toggle="collapse" role="button"
       href="#account-management-items">
        <div class="d-flex align-items-center">
            <i class="fa-solid fas fa-users fa-lg sidebar-icon"></i>
            <div class="text-sky-700 fw-bold fs-5 ml-3">@lang('Account Management')</div>
            <i class="ml-2 fa fa-angle-down " aria-hidden="true"></i>
        </div>
    </a>
    <div id="account-management-items"
         class="sidebar-items-collapse collapse pl-4 @if (isCurrentRouteInRoutes('frontend.staff.*') || isCurrentRouteInRoutes('frontend.customer.*')) show @endif text-lg">
        <a class="d-flex mb-3 sidebar-route-normal @if (isCurrentRouteInRoutes('frontend.staff.*')) sidebar-route-selected @else sidebar-route-normal @endif text-lg"
           href="{{ route('frontend.staff.index') }}">
            <div class="d-flex align-items-center">
                <i class="fas fa-user-tie fa-lg sidebar-icon"></i>
                <div class="text-sky-700 fw-bold fs-5 pl-3">@lang('Staff')</div>
            </div>
        </a>
        <a class="d-flex mb-3 sidebar-route-normal @if (isCurrentRouteInRoutes('frontend.customers.*')) sidebar-route-selected @else sidebar-route-normal @endif text-lg"
           href="{{ route('frontend.customers.index') }}">
            <div class="d-flex align-items-center">
                <i class="fas fa-user-shield fa-lg sidebar-icon"></i>
                <div class="text-sky-700 fw-bold fs-5 pl-3">@lang('Customer')</div>
            </div>
        </a>
    </div>
@endcanany

{{--<a class="d-flex mb-3 sidebar-route-normal @if (isCurrentRouteInRoutes('frontend.productChart.*')) sidebar-route-selected @else sidebar-route-normal @endif text-lg"--}}
{{--   href="{{ route('frontend.productChart.index') }}">--}}
{{--    <div class="d-flex align-items-center">--}}
{{--        <i class="fa-solid fas fa-signal fa-lg sidebar-icon"></i>--}}
{{--        <div class="text-sky-700 fw-bold fs-5 ml-3">@lang('Statistic')</div>--}}
{{--    </div>--}}
{{--</a>--}}

<a class="d-flex mb-3 sidebar-route-normal" href="#"
   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
    <div class="d-flex align-items-center">
        <i class="fas fa-sign-out-alt fa-lg sidebar-icon fa-solid"></i>
        <div class="text-sky-700 fw-bold fs-5 ml-3">@lang('Logout')</div>
    </div>
</a>
