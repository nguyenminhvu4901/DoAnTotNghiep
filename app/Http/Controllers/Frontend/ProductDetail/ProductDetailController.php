<?php

namespace App\Http\Controllers\Frontend\ProductDetail;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Domains\Product\Services\ProductService;
use App\Domains\Category\Services\CategoryService;
use App\Http\Requests\Frontend\ProductDetail\StoreRequest;
use App\Domains\ProductDetail\Services\ProductDetailService;
use App\Http\Requests\Frontend\ProductDetail\UpdateRequest;

class ProductDetailController extends Controller
{
    protected ProductDetailService $productDetailService;
    protected ProductService $productService;
    protected CategoryService $categoryService;
    public function __construct(
        ProductDetailService $productDetailService,
        CategoryService $categoryService,
        ProductService $productService
    ) {
        $this->productDetailService = $productDetailService;
        $this->categoryService = $categoryService;
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $productDetails = $this->productDetailService->search($request->all());
        $categories = $this->categoryService->getAllCategories();
        $products = $this->productService->getAllProducts();

        return view('frontend.pages.product-detail.index', ['productDetails' => $productDetails, 'categories' => $categories, 'products' => $products]);
    }

    public function create(string $slug)
    {
        $product = $this->productService->getBySlug($slug);
        abort_if(!$product, Response::HTTP_INTERNAL_SERVER_ERROR);
        
        return view('frontend.pages.product-detail.create', ['product' => $product]);
    }

    public function store(StoreRequest $storeRequest, int $productId)
    {
        $product = $this->productService->getById($productId);
        abort_if(!$product, Response::HTTP_INTERNAL_SERVER_ERROR);

        $this->productDetailService->create($storeRequest->all(), $productId);

        return redirect(route('frontend.productDetails.index'))->withFlashSuccess(__('Successfully created.'));
    }

    public function edit(string $slug, int $id)
    {
        $product = $this->productService->getBySlug($slug);

        $productDetail = $this->productDetailService->getById($id);
        abort_if(!$product && !$productDetail, Response::HTTP_INTERNAL_SERVER_ERROR);

        return view('frontend.pages.product-detail.edit', ['product' => $product, 'productDetail' => $productDetail]);
    }

    public function update(UpdateRequest $request, int $productId, int $productDetailId)
    {
        $product = $this->productService->getById($productId);

        $productDetail = $this->productDetailService->getById($productDetailId);
        abort_if(!$product && !$productDetail, Response::HTTP_INTERNAL_SERVER_ERROR);

        $this->productDetailService->update($request->all(), $productId, $productDetail);

        return redirect(route('frontend.productDetails.index'))->withFlashSuccess(__('Successfully updated.'));
    }

    public function destroy(int $productDetailId)
    {
        $productDetail = $this->productDetailService->getById($productDetailId);
        abort_if(!$productDetail, Response::HTTP_INTERNAL_SERVER_ERROR);

        $this->productDetailService->delete($productDetail);

        return redirect(route('frontend.productDetails.index'))->withFlashSuccess(__('Successfully deleted.'));
    }

    public function getAllProductDetailInTrash(Request $request)
    {
        $products = $this->productService->getAllProducts();
        $categories = $this->categoryService->getAllCategories();
        $productDetails = $this->productDetailService->searchWithTrash($request->all());

        return view('frontend.pages.product-detail.trash', ['products' => $products, 'categories' => $categories, 'productDetails' => $productDetails]);
    }

    public function restoreProductDetail(int $id)
    {
        $productDetail = $this->productDetailService->getByIdWithTrash($id);
        abort_if(!$productDetail, Response::HTTP_INTERNAL_SERVER_ERROR);

        $this->productDetailService->restore($productDetail);

        return redirect()->route('frontend.productDetails.index')->withFlashSuccess(__('Successfully restored.'));
    }

    public function forceDeleteProductDetail(int $id)
    {
        $productDetail = $this->productDetailService->getByIdWithTrash($id);
        abort_if(!$productDetail, Response::HTTP_INTERNAL_SERVER_ERROR);

        $this->productDetailService->forceDelete($productDetail);

        return redirect()->route('frontend.productDetails.trash')->withFlashSuccess(__('Successfully deleted.'));
    }
}
