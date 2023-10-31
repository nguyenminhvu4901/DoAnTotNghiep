<?php

namespace App\Http\Controllers\Frontend\ProductImage;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Domains\Product\Services\ProductService;
use App\Domains\Category\Services\CategoryService;
use App\Http\Requests\Frontend\ProductImage\StoreRequest;
use App\Domains\ProductImage\Services\ProductImageService;
use App\Http\Requests\Frontend\ProductImage\UpdateRequest;

class ProductImageController extends Controller
{
    protected ProductImageService $productImageService;
    protected ProductService $productService;
    protected CategoryService $categoryService;
    public function __construct(
        ProductImageService $productImageService,
        CategoryService $categoryService,
        ProductService $productService
    ) {
        $this->productImageService = $productImageService;
        $this->categoryService = $categoryService;
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $productImages = $this->productImageService->search($request->all());
        $categories = $this->categoryService->getAllCategories();
        $products = $this->productService->getAllProducts();

        return view('frontend.pages.product-image.index', ['productImages' => $productImages, 'categories' => $categories, 'products' => $products]);
    }

    public function create(string $slug)
    {
        $product = $this->productService->getBySlug($slug);

        abort_if(!$product, Response::HTTP_INTERNAL_SERVER_ERROR);

        return view('frontend.pages.product-image.create', ['product' => $product]);
    }

    public function store(StoreRequest $storeRequest, int $productId)
    {
        $product = $this->productService->getById($productId);

        abort_if(!$product, Response::HTTP_INTERNAL_SERVER_ERROR);
        $this->productImageService->create($storeRequest, $productId);

        return redirect(route('frontend.productImages.index'))->withFlashSuccess(__('Successfully created.'));
    }

    public function edit(string $slug, int $id)
    {
        $product = $this->productService->getBySlug($slug);

        $productImage = $this->productImageService->getById($id);
        abort_if(!$product && !$productImage, Response::HTTP_INTERNAL_SERVER_ERROR);

        return view('frontend.pages.product-image.edit', ['product' => $product, 'productImage' => $productImage]);
    }

    public function update(UpdateRequest $request, int $productId, int $productImageId)
    {
        $product = $this->productService->getById($productId);

        $productImage = $this->productImageService->getById($productImageId);
        abort_if(!$product && !$productImage, Response::HTTP_INTERNAL_SERVER_ERROR);

        $this->productImageService->update($request, $productId, $productImage);

        return redirect(route('frontend.productImages.index'))->withFlashSuccess(__('Successfully updated.'));
    }

    public function destroy(int $id)
    {
        $productImage = $this->productImageService->getById($id);
        abort_if(!$productImage, Response::HTTP_INTERNAL_SERVER_ERROR);

        $this->productImageService->delete($productImage);

        return redirect(route('frontend.productImages.index'))->withFlashSuccess(__('Successfully deleted.'));
    }

    public function getAllProductImageInTrash(Request $request)
    {
        $productImages = $this->productImageService->searchWithTrash($request->all());
        $categories = $this->categoryService->getAllCategories();
        $products = $this->productService->getAllProducts();

        return view('frontend.pages.product-image.trash', ['products' => $products, 'categories' => $categories, 'productImages' => $productImages]);
    }

    public function restoreProductImage(int $id)
    {
        $productDetail = $this->productImageService->getByIdWithTrash($id);
        abort_if(!$productDetail, Response::HTTP_INTERNAL_SERVER_ERROR);

        $this->productImageService->restore($productDetail);

        return redirect()->route('frontend.productImages.index')->withFlashSuccess(__('Successfully restored.'));
    }

    public function forceDeleteProductImage(int $id)
    {
        $productDetail = $this->productImageService->getByIdWithTrash($id);
        abort_if(!$productDetail, Response::HTTP_INTERNAL_SERVER_ERROR);

        $this->productImageService->forceDelete($productDetail);

        return redirect()->route('frontend.productImages.trash')->withFlashSuccess(__('Successfully deleted.'));
    }
}
