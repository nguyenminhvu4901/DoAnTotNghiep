<?php

namespace App\Http\Controllers\Frontend\User;

use App\Domains\Category\Services\CategoryService;
use App\Domains\Coupon\Services\CouponService;
use App\Domains\Product\Services\ProductService;
use Illuminate\Http\Request;

/**
 * Class DashboardController.
 */
class DashboardController
{
    protected CategoryService $categoryService;
    protected ProductService $productService;
    protected CouponService $couponService;

    public function __construct(
        CategoryService $categoryService,
        ProductService  $productService,
        CouponService   $couponService
    )
    {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
        $this->couponService = $couponService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $categories = $this->categoryService->all();
        $products = $this->productService->searchInDashboard($request->all());
        $coupons = $this->couponService->search($request->all());

        return view('frontend.user.dashboard', [
            'categories' => $categories,
            'products' => $products,
            'coupons' => $coupons
        ]);
    }
}
