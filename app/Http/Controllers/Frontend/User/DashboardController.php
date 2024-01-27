<?php

namespace App\Http\Controllers\Frontend\User;

use App\Domains\Category\Services\CategoryService;
use App\Domains\Coupon\Services\CouponService;
use App\Domains\Product\Services\ProductService;
use App\Domains\ProductDetail\Services\ProductDetailService;
use App\Domains\ProductImage\Services\ProductImageService;
use App\Domains\Sale\Services\SaleService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class DashboardController.
 */
class DashboardController
{
    protected SaleService $saleService;
    protected CategoryService $categoryService;
    protected ProductService $productService;
    protected CouponService $couponService;


    public function __construct(
        CategoryService $categoryService,
        ProductService  $productService,
        CouponService   $couponService,
        SaleService     $saleService
    )
    {
        $this->saleService = $saleService;
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
        $coupons = $this->couponService->searchInDashboard($request->all());

        return view('frontend.user.dashboard', [
            'categories' => $categories,
            'products' => $products,
            'coupons' => $coupons
        ]);
    }

    public function indexProduct(Request $request)
    {
        $categories = $this->categoryService->all();
        $products = $this->productService->searchInDashboard($request->all());

        return view('frontend.customers.products.index', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    public function detailProduct(int $id)
    {
        $product = $this->productService->getById($id);
        $categories = $this->categoryService->getAllCategories();
        abort_if(!$product, Response::HTTP_INTERNAL_SERVER_ERROR);
        $productDetails = app()->make(ProductDetailService::class)->getProductDetails($product->id);
        $productImages = app()->make(ProductImageService::class)->getProductDetails($product->id);

        $similarProducts = $this->productService->getAllProductsByCategory($product);

        return view(
            'frontend.customers.products.detail',
            [
                'product' => $product,
                'categories' => $categories,
                'productDetails' => $productDetails,
                'productImages' => $productImages,
                'similarProducts' => $similarProducts
            ]
        );
    }

    public function indexCoupon(Request $request)
    {
        $coupons = $this->couponService->searchInDashboard($request->all());

        return view('frontend.customers.coupons.index', ['coupons' => $coupons]);
    }

    public function detailCoupon(string $slug)
    {
        $coupon = $this->couponService->getBySlug($slug);
        abort_if(!$coupon, Response::HTTP_INTERNAL_SERVER_ERROR);

        return view('frontend.customers.coupons.detail', ['coupon' => $coupon]);
    }

    public function indexSale(Request $request)
    {
        $sales = $this->saleService->searchDashboard($request->all());
//        $sales = $this->saleService->getDiscount($sales);
        $products = $this->productService->getAllProducts();

        return view('frontend.customers.sales.index', ['sales' => $sales, 'products' => $products]);
    }
}
