<?php

namespace App\Http\Controllers\Frontend\Favourite;

use App\Domains\Category\Services\CategoryService;
use App\Domains\Favourite\Services\FavouriteService;
use App\Domains\ProductDetail\Models\ProductDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavouriteController extends Controller
{
    protected FavouriteService $favouriteService;
    protected CategoryService $categoryService;

    public function __construct(
        FavouriteService $favouriteService,
        CategoryService  $categoryService
    )
    {
        $this->favouriteService = $favouriteService;
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $favourites = $this->favouriteService->search($request->all());
        $categories = $this->categoryService->getAllCategories();
        $productDetailColors = ProductDetail::distinct()->pluck('color');
        $productDetailSizes = ProductDetail::distinct()->pluck('size');

        return view('frontend.pages.favourites.index', [
            'favourites' => $favourites,
            'categories' => $categories,
            'productDetailColors' => $productDetailColors,
            'productDetailSizes' => $productDetailSizes
        ]);
    }

    public function addToFavourite(int $productId)
    {
        $this->favouriteService->saveProductIntoFavourite($productId);

        return redirect()->back()->withFlashSuccess(__('Added product to favorites successfully'));
    }

    public function deleteFavourite(int $productId)
    {
        $this->favouriteService->deleteProductIntoFavouriteWithUserId($productId);

        return redirect()->back()->withFlashSuccess(__('Delete products into favorites successfully'));
    }
}
