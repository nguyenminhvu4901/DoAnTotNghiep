<?php

namespace App\Http\Controllers\Frontend\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Domains\Category\Services\CategoryService;
use App\Http\Requests\Frontend\Category\StoreRequest;
use App\Http\Requests\Frontend\Category\UpdateRequest;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $categories = $this->categoryService->search($request->all());
        return view('frontend.pages.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('frontend.pages.categories.create');
    }

    public function store(StoreRequest $request)
    {
        $this->categoryService->store($request->all());

        return redirect()->route('frontend.categories.index')->withFlashSuccess(__('Successfully created.'));
    }

    public function edit(string $categorySlug)
    {
        $category = $this->categoryService->getBySlug($categorySlug);
        abort_if(!$category, Response::HTTP_INTERNAL_SERVER_ERROR);
        return view('frontend.pages.categories.edit', ['category' => $category]);
    }

    public function update(UpdateRequest $request, string $slug)
    {
        $category = $this->categoryService->getBySlug($slug);
        abort_if(!$category, Response::HTTP_INTERNAL_SERVER_ERROR);

        $this->categoryService->update($category, $request->all());

        return redirect()->route('frontend.categories.index')->withFlashSuccess(__('Successfully updated.'));
    }

    public function destroy(int $id)
    {
        $category = $this->categoryService->getById($id);
        abort_if(!$category, Response::HTTP_INTERNAL_SERVER_ERROR);

        $this->categoryService->delete($category);

        return redirect()->route('frontend.categories.index')->withFlashSuccess(__('Successfully deleted.'));
    }

    public function getAllCategoryInTrash(Request $request)
    {
        $categories = $this->categoryService->searchWithTrash($request->all());
        return view('frontend.pages.categories.trash', compact('categories'));
    }

    public function restoreCategory($id)
    {
        $category = $this->categoryService->getByIdWithTrash($id);
        abort_if(!$category, Response::HTTP_INTERNAL_SERVER_ERROR);

        $this->categoryService->restore($category);

        return redirect()->route('frontend.categories.index')->withFlashSuccess(__('Successfully restored.'));
    }

    public function forceDeleteCategory($id)
    {
        $category = $this->categoryService->getByIdWithTrash($id);
        abort_if(!$category, Response::HTTP_INTERNAL_SERVER_ERROR);

        $this->categoryService->forceDelete($category);

        return redirect()->route('frontend.categories.trash')->withFlashSuccess(__('Successfully deleted.'));
    }
}
