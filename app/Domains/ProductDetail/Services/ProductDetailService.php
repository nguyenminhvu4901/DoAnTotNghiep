<?php

namespace App\Domains\ProductDetail\Services;

use Exception;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Domains\Product\Models\Product;
use App\Domains\Category\Models\Category;
use App\Domains\ProductDetail\Models\ProductDetail;

/**
 * Class CategoryService.
 */
class ProductDetailService extends BaseService
{
    public function __construct(ProductDetail $productDetail)
    {
        $this->model = $productDetail;
    }

    public function search(array $data = [])
    {
        return $this->model->when(isset($data['search']), function ($query) use ($data) {
                $query->search($data['search']);
            })
            ->when(isset($data['products']), function ($query) use ($data) {
                $query->filterByProduct($data['products']);
            })->when(isset($data['categories']), function ($query) use ($data) {
                $query->filterByCategories($data['categories']);
            })
            ->latest('id')
            ->paginate(config('constants.paginate'));
    }

    public function searchWithTrash(array $data = [])
    {
        return $this->model->when(isset($data['search']), function ($query) use ($data) {
                $query->search($data['search']);
            })
            ->when(isset($data['products']), function ($query) use ($data) {
                $query->filterByProduct($data['products']);
            })->when(isset($data['categories']), function ($query) use ($data) {
                $query->filterByCategories($data['categories']);
            })
            ->latest('id')
            ->onlyTrashed()
            ->paginate(config('constants.paginate'));
    }

    public function create(array $data, int $productId)
    {
        DB::beginTransaction();
        try {
            $productDetail = $this->createProductDetail($data, $productId);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating product. Please try again.'));
        }

        return $productDetail;
    }

    protected function createProductDetail(array $data = [], $productId): ProductDetail
    {
        return $this->model->create([
            'product_id' => $productId,
            'size' => $data['size'],
            'color' => $data['color'],
            'quantity' => $data['quantity'],
            'price' => $data['price'],
            'sale' => $data['sale'] ?? null,
        ]);
    }

    public function update(array $data, int $productId, ProductDetail $productDetail): ProductDetail
    {
        DB::beginTransaction();
        try {
            $productDetail->update([
                'product_id' => $productId,
                'size' => $data['size'],
                'color' => $data['color'],
                'quantity' => $data['quantity'],
                'price' => $data['price'],
                'sale' => $data['sale'] ?? null,
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating product. Please try again.'));
        }

        return $productDetail;
    }

    public function delete(ProductDetail $productDetail): ProductDetail
    {
        DB::beginTransaction();
        try {
            $productDetail->delete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating product. Please try again.'));
        }

        return $productDetail;
    }

    public function restore(ProductDetail $productDetail): ProductDetail
    {
        DB::beginTransaction();
        try {
            $productDetail->restore();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem update course. Please try again.'));
        }

        return $productDetail;
    }

    public function forceDelete(ProductDetail $productDetail): ProductDetail
    {
        DB::beginTransaction();
        try {
            $productDetail->forceDelete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem update course. Please try again.'));
        }

        return $productDetail;
    }
}
