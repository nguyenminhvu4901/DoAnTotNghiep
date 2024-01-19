<?php

namespace App\Domains\Sale\Services;

use Exception;
use Illuminate\Http\Request;
use App\Services\BaseService;
use App\Domains\Sale\Models\Sale;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Domains\Product\Models\Product;
use App\Domains\ProductSale\Models\ProductSale;
use App\Domains\ProductDetail\Models\ProductDetail;

/**
 * Class CategoryService.
 */
class SaleService extends BaseService
{
    protected Product $product;
    protected ProductDetail $productDetail;
    protected ProductSale $productSale;

    public function __construct(
        Sale          $sale,
        Product       $product,
        ProductDetail $productDetail,
        ProductSale   $productSale
    )
    {
        $this->model = $sale;
        $this->product = $product;
        $this->productDetail = $productDetail;
        $this->productSale = $productSale;
    }

    public function search($data)
    {
        return $this->model
            ->when(isset($data['search']), function ($query) use ($data) {
                $query->search($data['search']);
            })
            ->when(isset($data['products']), function ($query) use ($data) {
                $query->filterByProduct($data['products']);
            })->whereHas('product', function ($query) {
                $query->whereNotNull('product_id');
            })
            ->where(function ($query) {
                $query->whereHas('productSale', function ($query) {
                    $query->where('type_sale', '!=', 1);
                })
                    ->orWhereDoesntHave('productSale');
            })
            ->latest('id')->paginate(config('constants.paginate'));
    }

    public function getProductById(int $productId)
    {
        return $this->product->findOrFail($productId);
    }

    public function getProductDetailById(int $productDetail)
    {
        return $this->productDetail->findOrFail($productDetail);
    }

    public function createProductSaleGlobal($data = [], int $productId)
    {
        $sale = $this->model->create([
            'type' => $data['type'],
            'value' => $data['value'],
            'start_date' => $data['start_date'],
            'expiry_date' => $data['expiry_date'],
            'is_active' => isset($data['is_active']) ? config('constants.is_active.true') : config('constants.is_active.false')
        ]);

        $sale->syncProduct($productId);

        return $sale;
    }

    public function createProductSaleOption($data = [], int $productDetailId)
    {
        $sale = $this->model->create([
            'type' => $data['type'],
            'value' => $data['value'],
            'start_date' => $data['start_date'],
            'expiry_date' => $data['expiry_date'],
            'is_active' => isset($data['is_active']) ? config('constants.is_active.true') : config('constants.is_active.false')
        ]);

        $productDetail = $this->getProductDetailById($productDetailId);

        $sale->syncProductDetailWithProductGlobal($productDetail->product_id, $productDetailId);

        return $sale;
    }

    public function updateSale($data = [], Sale $sale)
    {
        $sale->update([
            'type' => $data['type'],
            'value' => $data['value'],
            'start_date' => $data['start_date'],
            'expiry_date' => $data['expiry_date'],
            'is_active' => isset($data['is_active']) ? config('constants.is_active.true') : config('constants.is_active.false')
        ]);
    }

    public function delete(Sale $sale)
    {
        DB::beginTransaction();
        try {
            $sale->delete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem deleting product. Please try again.'));
        }

        return $sale;
    }

    public function updateActive($data = [], Sale $sale)
    {
        if ($data['isActive'] == config('constants.is_active.true')) {
            $data['isActive'] = config('constants.is_active.false');
        } else {
            $data['isActive'] = config('constants.is_active.true');
        }
        $sale->update([
            'is_active' => $data['isActive']
        ]);
    }

    public function checkSaleGlobalExist(int $productId)
    {
        return $this->productSale
            ->where('product_id', $productId)
            ->where('product_detail_id', null)
            ->first();
    }
}
