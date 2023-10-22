<?php

namespace App\Domains\Product\Services;

use Exception;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Domains\Product\Models\Product;
use App\Domains\Category\Models\Category;

/**
 * Class CategoryService.
 */
class ProductService extends BaseService
{
    protected Category $category;

    /**
     * CategoryService constructor.
     *
     * @param Category $category
     * @param Product $product
     */
    public function __construct(
        Product $product,
        Category $category
    ) {
        $this->model = $product;
        $this->category = $category;
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
}
