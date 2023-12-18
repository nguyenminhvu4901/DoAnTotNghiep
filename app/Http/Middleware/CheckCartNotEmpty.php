<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Domains\Cart\Models\Cart;

class CheckCartNotEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $cart = Cart::where('user_id', auth()->user()->id)->count();
        if ($cart < 1) {
            return redirect()->route('frontend.carts.index')->withFlashDanger(__('Giỏ hàng của bạn đang trống.'));
        }

        return $next($request);
    }
}
