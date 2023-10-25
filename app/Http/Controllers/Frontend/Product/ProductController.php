<?php

namespace App\Http\Controllers\Frontend\Product;

use App\Domains\Category\Services\CategoryService;
use App\Domains\Product\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Product\StoreRequest;
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
        // foreach( $products as $product )
        // {
        //     if($product->id == 15)
        //     {
        //         foreach($product->productDetail as $detail)
        //         {
        //             dd($detail->size);
        //         }
        //     }
        // }
        $categories = $this->categoryService->getAllCategories();
        return view('frontend.pages.products.index', ['products'=> $products, 'categories'=> $categories]);
    }

    public function create()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('frontend.pages.products.create', ['categories'=> $categories]);
    }

    public function store(StoreRequest $request)
    {
        $this->productService->store($request->all());

        return redirect(route('frontend.products.index'))->withFlashSuccess(__('Successfully created.'));
    }

    public function edit(Request $request, $slug)
    {

    }

    public function destroy(Request $request, $slug)
    {
        
    }
}
