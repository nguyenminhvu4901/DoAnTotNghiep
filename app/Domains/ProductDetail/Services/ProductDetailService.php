<?php

namespace App\Domains\ProductDetail\Services;

use App\Domains\ProductSale\Models\ProductSale;
use Exception;
use App\Services\BaseService;
use App\Domains\Sale\Models\Sale;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Domains\ProductDetail\Models\ProductDetail;

/**
 * Class CategoryService.
 */
class ProductDetailService extends BaseService
{
    protected Sale $sale;
    protected ProductSale $productSale;

    public function __construct(ProductDetail $productDetail, Sale $sale, ProductSale $productSale)
    {
        $this->model = $productDetail;
        $this->sale = $sale;
        $this->productSale = $productSale;
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
            ->latest('id')
            ->whereHas('product', function ($query) {
                $query->whereNotNull('product_id');
            })
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
        if (isset($data['sale'])) {
        }
        return $this->model->create([
            'product_id' => $productId,
            'size' => $data['size'],
            'color' => $data['color'],
            'quantity' => $data['quantity'],
            'price' => $data['price'],
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
            $productDetailSale = $this->productSale->where('product_detail_id', $productDetail->id)->first();
            if ($productDetailSale != null) {
                $productDetailSale->update([
                    'type_sale' => 1//Ẩn sản phẩm
                ]);
            }

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
            $productDetailSale = $this->productSale->where('product_detail_id', $productDetail->id)->first();

            if ($productDetailSale != null) {
                $productDetailSale->update([
                    'type_sale' => 0//Hiển thị sản phẩm giảm giá
                ]);
            }

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

    public function getProductDetails(int $productId)
    {
        $productDetails = $this->model->where('product_id', $productId)->get();

        foreach ($productDetails as $productDetail) {
            if (!$productDetail->saleOption->isEmpty()) {
                if ($productDetail->saleOption->first()->type == config('constants.type_sale.percent')) {
                    $productDetail->salePrice = $productDetail->price - $productDetail->price * ($productDetail->saleOption->first()->value / 100);
                    if ($productDetail->salePrice < 0) {
                        $productDetail->salePrice = 0;
                    }
                } else {
                    $productDetail->salePrice = $productDetail->price - $productDetail->saleOption->first()->value;
                    if ($productDetail->salePrice < 0) {
                        $productDetail->salePrice = 0;
                    }
                }
                $productDetail->reducedValue = $productDetail->saleOption->first()->value;
                $productDetail->reducedType = $productDetail->saleOption->first()->type;
            } else if (!$productDetail->product->saleGlobal->isEmpty()) {
                if ($productDetail->product->saleGlobal->first()->type == config('constants.type_sale.percent')) {
                    $productDetail->salePriceGlobal = $productDetail->price - $productDetail->price * ($productDetail->product->saleGlobal->first()->value / 100);
                    if ($productDetail->salePriceGlobal < 0) {
                        $productDetail->salePriceGlobal = 0;
                    }
                } else {
                    $productDetail->salePriceGlobal = $productDetail->price - $productDetail->product->saleGlobal->first()->value;
                    if ($productDetail->salePriceGlobal < 0) {
                        $productDetail->salePriceGlobal = 0;
                    }
                }
                $productDetail->reducedValue = $productDetail->product->saleGlobal->first()->value;
                $productDetail->reducedType = $productDetail->product->saleGlobal->first()->type;
            }
        }

        return $productDetails;
    }

    public function getDiscount($productDetails = [])
    {
        foreach ($productDetails as $productDetail) {
            if (!$productDetail->saleOption->isEmpty()) {
                if ($productDetail->saleOption->first()->type == config('constants.type_sale.percent')) {
                    $productDetail->salePrice = $productDetail->price - $productDetail->price * ($productDetail->saleOption->first()->value / 100);
                    if ($productDetail->salePrice < 0) {
                        $productDetail->salePrice = 0;
                    }
                } else {
                    $productDetail->salePrice = $productDetail->price - $productDetail->saleOption->first()->value;
                    if ($productDetail->salePrice < 0) {
                        $productDetail->salePrice = 0;
                    }
                }
                $productDetail->reducedValue = $productDetail->saleOption->first()->value;
                $productDetail->reducedType = $productDetail->saleOption->first()->type;
            } else if (!$productDetail->product->saleGlobal->isEmpty()) {
                if ($productDetail->product->saleGlobal->first()->type == config('constants.type_sale.percent')) {
                    $productDetail->salePriceGlobal = $productDetail->price - $productDetail->price * ($productDetail->product->saleGlobal->first()->value / 100);
                    if ($productDetail->salePriceGlobal < 0) {
                        $productDetail->salePriceGlobal = 0;
                    }
                } else {
                    $productDetail->salePriceGlobal = $productDetail->price - $productDetail->product->saleGlobal->first()->value;
                    if ($productDetail->salePriceGlobal < 0) {
                        $productDetail->salePriceGlobal = 0;
                    }
                }
                $productDetail->reducedValue = $productDetail->product->saleGlobal->first()->value;
                $productDetail->reducedType = $productDetail->product->saleGlobal->first()->type;
            }
        }

        return $productDetails;
    }
}
