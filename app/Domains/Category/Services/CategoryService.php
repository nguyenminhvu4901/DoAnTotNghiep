<?php

namespace App\Domains\Category\Services;

use Exception;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Domains\Category\Models\Category;

/**
 * Class CategoryService.
 */
class CategoryService extends BaseService
{
    /**
     * CategoryService constructor.
     *
     * @param Category $category
     */
    public function __construct(
        Category $category,
    ) {
        $this->model = $category;
    }

    public function getLatestCategory()
    {
        return $this->model::latest()->first();
    }

    public function search(array $data = [])
    {
        return $this->model->search($this->escapeSpecialCharacter($data['search'] ?? ''))
            ->latest('id')
            ->paginate(config('constants.paginate'));
    }

    public function searchWithTrash(array $data = [])
    {
        return $this->model->search($this->escapeSpecialCharacter($data['search'] ?? ''))
            ->latest('id')
            ->onlyTrashed()
            ->paginate(config('constants.paginate'));
    }

    public function getAllCategories()
    {
        return $this->model->all();
    }

    public function getAllCategoriesInTrash()
{
    return $this->model->onlyTrashed()->get();
}

    public function store(array $data = []): Category
    {
        DB::beginTransaction();
        try {
            $category = $this->createCategory($data);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating category. Please try again.'));
        }

        return $category;
    }

    public function update(Category $category, array $data = []): Category
    {
        DB::beginTransaction();
        try {
            $category->update([
                'name' => $data['name'],
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem update course. Please try again.'));
        }

        return $category;
    }

    protected function createCategory(array $data = []): Category
    {
        return $this->model->create([
            'name' => $data['name'],
            'creator_id' => auth()->user()->id,
        ]);
    }

    public function delete(Category $category): Category
    {
        DB::beginTransaction();
        try {
            $category->delete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem update course. Please try again.'));
        }

        return $category;
    }

    public function restore(Category $category): Category
    {
        DB::beginTransaction();
        try {
            $category->restore();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem update course. Please try again.'));
        }

        return $category;
    }

    public function forceDelete(Category $category): Category
    {
        DB::beginTransaction();
        try {
            $category->forceDelete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem update course. Please try again.'));
        }

        return $category;
    }

    public function isExistByName(string $name)
    {
        return $this->model->where('name', $name)->first();
    }
}
