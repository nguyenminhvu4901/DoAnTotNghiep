<nav class="navbar sticky-top navbar-expand-lg d-flex justify-content-center" style="color: #FFFFFF; background-color: #FFFFFF;">

    <a class="navbar-brand nav-customer-pro @if (isCurrentRouteInRoutes('frontend.user.dashboard')) active @endif"
       onmouseover="this.style.color='#8ab54d'" onmouseout="this.style.color='@if (isCurrentRouteInRoutes('frontend.user.dashboard')) #8ab54d @else black @endif'"
       href="{{ route('frontend.user.dashboard') }}" style="font-size: 18px; margin-right: 30px; @if (isCurrentRouteInRoutes('frontend.user.dashboard')) color: #8ab54d !important; @else color: black !important; @endif text-decoration: none;">@lang('Home')</a>

    <a class="navbar-brand nav-customer-pro @if (isCurrentRouteInRoutes('frontend.dashboard.products.*')) active @endif"
       onmouseover="this.style.color='#8ab54d'" onmouseout="this.style.color='@if (isCurrentRouteInRoutes('frontend.dashboard.products.*')) #8ab54d @else black @endif'"
       href="{{ route('frontend.dashboard.products.index') }}" style="font-size: 18px; margin-right: 30px; @if (isCurrentRouteInRoutes('frontend.dashboard.products.*')) color: #8ab54d !important; @else color: black !important; @endif text-decoration: none;">@lang('Product')</a>

    <a class="navbar-brand nav-customer-pro @if (isCurrentRouteInRoutes('frontend.dashboard.coupons.*')) active @endif"
       onmouseover="this.style.color='#8ab54d'" onmouseout="this.style.color='@if (isCurrentRouteInRoutes('frontend.dashboard.coupons.*')) #8ab54d @else black @endif'"
       href="{{ route('frontend.dashboard.coupons.index') }}" style="font-size: 18px; margin-right: 30px; @if (isCurrentRouteInRoutes('frontend.dashboard.coupons.*')) color: #8ab54d !important; @else color: black !important; @endif text-decoration: none;">@lang('Coupon')</a>

    <a class="navbar-brand nav-customer-pro @if (isCurrentRouteInRoutes('frontend.dashboard.sales.*')) active @endif"
       onmouseover="this.style.color='#8ab54d'" onmouseout="this.style.color='@if (isCurrentRouteInRoutes('frontend.dashboard.sales.*')) #8ab54d @else black @endif'"
       href="{{ route('frontend.dashboard.sales.index') }}" style="font-size: 18px; margin-right: 30px; @if (isCurrentRouteInRoutes('frontend.dashboard.sales.*')) color: #8ab54d !important; @else color: black !important; @endif text-decoration: none;">@lang('Sale off')</a>

    @auth
        <a class="navbar-brand nav-customer-pro @if (isCurrentRouteInRoutes('frontend.orders.*')) active @endif"
           onmouseover="this.style.color='#8ab54d'" onmouseout="this.style.color='@if (isCurrentRouteInRoutes('frontend.orders.*')) #8ab54d @else black @endif'"
           href="{{ route('frontend.orders.index') }}" style="font-size: 18px; margin-right: 30px; @if (isCurrentRouteInRoutes('frontend.orders.*')) color: #8ab54d !important; @else color: black !important; @endif text-decoration: none;">@lang('Order')</a>

        @if(auth()->user()->isRoleCustomer())
            <a class="navbar-brand nav-customer-pro @if (isCurrentRouteInRoutes('frontend.carts.*')) active @endif"
               onmouseover="this.style.color='#8ab54d'" onmouseout="this.style.color='@if (isCurrentRouteInRoutes('frontend.carts.*')) #8ab54d @else black @endif'"
               href="{{ route('frontend.carts.index') }}" style="font-size: 18px; margin-right: 30px; @if (isCurrentRouteInRoutes('frontend.carts.*')) color: #8ab54d !important; @else color: black !important; @endif text-decoration: none;">@lang('Cart')</a>
        @endif
    @endauth
</nav>
