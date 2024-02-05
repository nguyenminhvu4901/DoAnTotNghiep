<nav class="navbar sticky-top navbar-expand-lg d-flex justify-content-center"
     style="color: #FFFFFF; background-color: #b5e4f2;">
    <a class="navbar-brand nav-customer-pro @if (isCurrentRouteInRoutes('frontend.user.dashboard')) active @endif"
       onmouseover="this.style.color='#E4774BFF'; this.style.fontWeight='bold'"
       onmouseout="this.style.color='@if (isCurrentRouteInRoutes('frontend.user.dashboard')) #E4774BFF @else black @endif'; this.style.fontWeight='@if (isCurrentRouteInRoutes('frontend.user.dashboard')) font-weight: bold !important @else normal @endif'"
       href="{{ route('frontend.user.dashboard') }}"
       style="font-size: 18px; margin-right: 30px; @if (isCurrentRouteInRoutes('frontend.user.dashboard')) color: #E4774BFF !important; font-weight: bold !important; @else color: black !important; font-weight: normal !important; @endif text-decoration: none;">@lang('HOME')</a>

    <a class="navbar-brand nav-customer-pro @if (isCurrentRouteInRoutes('frontend.dashboard.products.*')) active @endif"
       onmouseover="this.style.color='#E4774BFF'; this.style.fontWeight='bold'"
       onmouseout="this.style.color='@if (isCurrentRouteInRoutes('frontend.dashboard.products.*')) #E4774BFF @else black @endif'; this.style.fontWeight='@if (isCurrentRouteInRoutes('frontend.user.products.*')) font-weight: bold !important @else normal @endif'"
       href="{{ route('frontend.dashboard.products.index') }}"
       style="font-size: 18px; margin-right: 30px; @if (isCurrentRouteInRoutes('frontend.dashboard.products.*')) color: #e4774b !important; font-weight: bold !important; @else color: black !important; @endif text-decoration: none;">@lang('PRODUCT')</a>

    <a class="navbar-brand nav-customer-pro @if (isCurrentRouteInRoutes('frontend.dashboard.coupons.*')) active @endif"
       onmouseover="this.style.color='#E4774BFF'; this.style.fontWeight='bold'"
       onmouseout="this.style.color='@if (isCurrentRouteInRoutes('frontend.dashboard.coupons.*'))  #E4774BFF @else black @endif'; this.style.fontWeight='@if (isCurrentRouteInRoutes('frontend.user.coupons.*')) font-weight: bold !important @else normal @endif'"
       href="{{ route('frontend.dashboard.coupons.index') }}"
       style="font-size: 18px; margin-right: 30px; @if (isCurrentRouteInRoutes('frontend.dashboard.coupons.*'))  color: #e4774b !important; font-weight: bold !important; @else color: black !important; @endif text-decoration: none;">@lang('COUPON')</a>

    <a class="navbar-brand nav-customer-pro @if (isCurrentRouteInRoutes('frontend.dashboard.sales.*')) active @endif"
       onmouseover="this.style.color='#E4774BFF'; this.style.fontWeight='bold'"
       onmouseout="this.style.color='@if (isCurrentRouteInRoutes('frontend.dashboard.sales.*'))  #E4774BFF @else black @endif'; this.style.fontWeight='@if (isCurrentRouteInRoutes('frontend.user.sales.*')) font-weight: bold !important @else normal @endif'"
       href="{{ route('frontend.dashboard.sales.index') }}"
       style="font-size: 18px; margin-right: 30px; @if (isCurrentRouteInRoutes('frontend.dashboard.sales.*')) color: #e4774b !important; font-weight: bold !important; @else color: black !important; @endif text-decoration: none;">@lang('SALE OFF')</a>

    @auth
        <a class="navbar-brand nav-customer-pro @if (isCurrentRouteInRoutes('frontend.orders.*')) active @endif"
           onmouseover="this.style.color='#E4774BFF'; this.style.fontWeight='bold'"
           onmouseout="this.style.color='@if (isCurrentRouteInRoutes('frontend.orders.*'))  #E4774BFF @else black @endif'; this.style.fontWeight='@if (isCurrentRouteInRoutes('frontend.user.orders.*')) font-weight: bold !important @else normal @endif'"
           href="{{ route('frontend.orders.index') }}"
           style="font-size: 18px; margin-right: 30px; @if (isCurrentRouteInRoutes('frontend.orders.*')) color: #e4774b !important; font-weight: bold !important; @else color: black !important; @endif text-decoration: none;">@lang('ORDER')</a>

        @if(auth()->user()->isRoleCustomer())
            <a class="navbar-brand nav-customer-pro @if (isCurrentRouteInRoutes('frontend.carts.*')) active @endif"
               onmouseover="this.style.color='#E4774BFF'; this.style.fontWeight='bold'"
               onmouseout="this.style.color='@if (isCurrentRouteInRoutes('frontend.carts.*')) #E4774BFF @else black @endif'; this.style.fontWeight='@if (isCurrentRouteInRoutes('frontend.carts.*')) font-weight: bold !important @else normal @endif'"
               href="{{ route('frontend.carts.index') }}"
               style="font-size: 18px; margin-right: 30px; @if (isCurrentRouteInRoutes('frontend.carts.*')) color: #e4774b !important; font-weight: bold !important; @else color: black !important; @endif text-decoration: none;">@lang('CART')</a>
        @endif

    @endauth
</nav>
