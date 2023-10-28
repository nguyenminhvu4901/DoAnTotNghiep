<?php

namespace App\Http\Controllers\Frontend\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Domains\Product\Services\ProductService;
use App\Domains\Category\Services\CategoryService;
use App\Http\Requests\Frontend\Product\StoreRequest;
use App\Http\Requests\Frontend\Product\UpdateRequest;
use App\Domains\ProductDetail\Services\ProductDetailService;

class ProductController extends Controller
{
    protected ProductService $productService;
    protected CategoryService $categoryService;

    public function __construct(
        ProductService $productService,
        CategoryService $categoryService
    ) {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $products = $this->productService->search($request->all());
        $categories = $this->categoryService->getAllCategories();
        return view('frontend.pages.products.index', ['products' => $products, 'categories' => $categories]);
    }

    public function create()
    {
        $categories = $this->categoryService->getAllCategories();

        return view('frontend.pages.products.create', ['categories' => $categories]);
    }

    public function store(StoreRequest $request)
    {
        $this->productService->store($request->all());

        return redirect(route('frontend.products.index'))->withFlashSuccess(__('Successfully created.'));
    }

    public function edit($slug)
    {
        $product = $this->productService->getBySlug($slug);
        $categories = $this->categoryService->getAllCategories();
        abort_if(!$product, Response::HTTP_INTERNAL_SERVER_ERROR);

        return view('frontend.pages.products.edit', ['product' => $product, 'categories' => $categories]);
    }

    public function update(UpdateRequest $request, $slug)
    {
        $product = $this->productService->getBySlug($slug);
        abort_if(!$product, Response::HTTP_INTERNAL_SERVER_ERROR);
        $this->productService->update($product, $request->all());

        return redirect(route('frontend.products.index'))->withFlashSuccess(__('Successfully updated.'));
    }

    public function destroy($slug)
    {
        $product = $this->productService->getBySlug($slug);
        abort_if(!$product, Response::HTTP_INTERNAL_SERVER_ERROR);
        $this->productService->delete($product);

        return redirect(route('frontend.products.index'))->withFlashSuccess(__('Successfully deleted.'));
    }

    public function getAllProductInTrash(Request $request)
    {
        $products = $this->productService->searchWithTrash($request->all());
        $categories = $this->categoryService->getAllCategories();

        return view('frontend.pages.products.trash', ['products' => $products, 'categories' => $categories]);
    }

    public function restoreProduct(int $id)
    {
        $product = $this->productService->getByIdWithTrash($id);
        abort_if(!$product, Response::HTTP_INTERNAL_SERVER_ERROR);

        $this->productService->restore($product);

        return redirect()->route('frontend.products.index')->withFlashSuccess(__('Successfully restored.'));
    }

    public function forceDeleteProduct(int $id)
    {
        $product = $this->productService->getByIdWithTrash($id);
        abort_if(!$product, Response::HTTP_INTERNAL_SERVER_ERROR);

        $this->productService->forceDelete($product);

        return redirect()->route('frontend.products.trash')->withFlashSuccess(__('Successfully deleted.'));
    }
}
