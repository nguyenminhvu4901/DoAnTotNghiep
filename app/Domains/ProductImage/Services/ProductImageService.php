<?php

namespace App\Domains\ProductImage\Services;

use Exception;
use Illuminate\Http\Request;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Domains\ProductImage\Models\ProductImage;
use App\Domains\ProductImage\Models\Traits\ImageProcess;

/**
 * Class CategoryService.
 */
class ProductImageService extends BaseService
{
    use ImageProcess;

    public function __construct(ProductImage $productImage)
    {
        $this->model = $productImage;
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
            ->whereHas('product', function ($query) {
                $query->whereNotNull('product_id');
            })
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
            ->whereHas('product', function ($query) {
                $query->whereNotNull('product_id');
            })
            ->latest('id')
            ->onlyTrashed()
            ->paginate(config('constants.paginate'));
    }

    public function create(Request $request, int $productId)
    {
        DB::beginTransaction();
        try {
            $productImage = $this->createproductImage($request, $productId);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating product image. Please try again.'));
        }

        return $productImage;
    }

    protected function createproductImage(Request $request, $productId): ProductImage
    {
        $data = $request->all();
        $imageProduct = $this->saveImage($request, 'image_path');

        if ($data['order'] == 0) {
            $data['order'] =  $this->maxProductImageOrder($productId) + 1;
        }

        return $this->model->create([
            'product_id' => $productId,
            'name' => $data['name'],
            'order' => $data['order'],
            'image_path' => $imageProduct,
        ]);
    }

    public function update(Request $request, int $productId, ProductImage $productImage): ProductImage
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $imageProduct = $this->updateImage($request, 'image_path');

            if ($data['order'] == 0) {
                $data['order'] =  $this->maxProductImageOrder($productId) + 1;
            }

            $productImage->update([
                'product_id' => $productId,
                'name' => $data['name'],
                'order' => $data['order'],
                'image_path' => $imageProduct,
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating product image. Please try again.'));
        }

        return $productImage;
    }

    public function delete(ProductImage $productImage): ProductImage
    {
        DB::beginTransaction();
        try {
            $productImage->delete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem deleting product image. Please try again.'));
        }

        return $productImage;
    }

    public function restore(ProductImage $productImage): ProductImage
    {
        DB::beginTransaction();
        try {
            $productImage->restore();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem restoring product image. Please try again.'));
        }

        return $productImage;
    }

    public function forceDelete(ProductImage $productImage): ProductImage
    {
        DB::beginTransaction();
        try {
            $productImage->forceDelete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem deleting product image. Please try again.'));
        }

        return $productImage;
    }

    /**
     * @return int
     */
    public function maxProductImageOrder(int $imageProduct): int
    {
        return $this->model->where('product_id', $imageProduct)->max('order') ?? 0;
    }

    public function getProductDetails(int $productId)
    {
        return $this->model->where('product_id', $productId)->get();
    }
}
