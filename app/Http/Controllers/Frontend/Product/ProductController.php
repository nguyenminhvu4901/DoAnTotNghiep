<?php

namespace App\Http\Controllers\Frontend\Product;

use App\Domains\Category\Services\CategoryService;
use App\Domains\Product\Services\ProductService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ProductService $productService;
    protected CategoryService $categoryService;

    public function __construct(
        ProductService $productService,
        CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $products = $this->productService->search($request->all());
        $categories = $this->categoryService->getAllCategories();
        return view('frontend.pages.products.index', ['products'=> $products, 'categories'=> $categories]);
    }

    public function create()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('frontend.pages.products.create', ['categories'=> $categories]);
    }
}
