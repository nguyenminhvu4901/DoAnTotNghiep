<?php

namespace App\Domains\Sale\Services;

use App\Domains\Category\Models\Category;
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
    protected Category $category;

    public function __construct(
        Sale          $sale,
        Product       $product,
        ProductDetail $productDetail,
        ProductSale   $productSale,
        Category      $category
    )
    {
        $this->model = $sale;
        $this->product = $product;
        $this->productDetail = $productDetail;
        $this->productSale = $productSale;
        $this->category = $category;
    }

    public function search($data)
    {
        return $this->model
            ->when(isset($data['search']), function ($query) use ($data) {
                $query->search($data['search']);
            })
            ->when(isset($data['products']), function ($query) use ($data) {
                $query->filterByProduct($data['products']);
            })
            ->when(isset($data['categories']), function ($query) use ($data) {
                $query->filterByCategories($data['categories']);
            })
            ->when(isset($data['colors']), function ($query) use ($data) {
                $query->filterByColors($data['colors']);
            })
            ->when(isset($data['sizes']), function ($query) use ($data) {
                $query->filterBySizes($data['sizes']);
            })
//            ->whereHas('product', function ($query) {
//                $query->whereNotNull('product_id');
//            })
            ->where(function ($query) {
                $query->whereHas('productSale', function ($query) {
                    $query->where('type_sale', '!=', 1);
                })
                    ->orWhereDoesntHave('productSale');
            })
            ->latest('id')->paginate(config('constants.paginate'));
    }

    public function searchDashboard($data)
    {
        return $this->model
            ->when(isset($data['search']), function ($query) use ($data) {
                $query->search($data['search']);
            })
            ->when(isset($data['products']), function ($query) use ($data) {
                $query->filterByProduct($data['products']);
            })
            ->when(isset($data['categories']), function ($query) use ($data) {
                $query->filterByCategories($data['categories']);
            })
            ->when(isset($data['colors']), function ($query) use ($data) {
                $query->filterByColors($data['colors']);
            })
            ->when(isset($data['sizes']), function ($query) use ($data) {
                $query->filterBySizes($data['sizes']);
            })
//            ->whereHas('product', function ($query) {
//                $query->whereNotNull('product_id');
//            })
            ->where(function ($query) {
                $query->whereHas('productSale', function ($query) {
                    $query->where('type_sale', '!=', 1);
                })
                    ->orWhereDoesntHave('productSale');
            })->where('is_active', '=', 1)
            ->latest('id')->paginate(config('constants.paginate'));
    }

    public function getProductById($productId)
    {
        return $this->product->findOrFail($productId);
    }

    public function getProductDetailById($productDetail)
    {
        return $this->productDetail->findOrFail($productDetail);
    }

    public function getCategoryById($categoryId)
    {
        return $this->category->findOrFail($categoryId);
    }

    public function createProductSaleGlobal($data = [], int $productId)
    {
        DB::beginTransaction();
        try {
            $sale = $this->model->create([
                'type' => $data['type'],
                'value' => $data['value'],
                'start_date' => $data['start_date'],
                'expiry_date' => $data['expiry_date'],
                'is_active' => isset($data['is_active']) ? config('constants.is_active.true') : config('constants.is_active.false')
            ]);

            $product = $this->getProductById($productId);
            $categoryId = $product->categories->first()->id;

            $sale->syncProductWithCategory($categoryId, $productId);

            DB::commit();
            return $sale;
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating sale product. Please try again.'));

        }
    }

    public function createProductSaleOption($data = [], $productDetailId)
    {
        DB::beginTransaction();
        try {
            $sale = $this->model->create([
                'type' => $data['type'],
                'value' => $data['value'],
                'start_date' => $data['start_date'],
                'expiry_date' => $data['expiry_date'],
                'is_active' => isset($data['is_active']) ? config('constants.is_active.true') : config('constants.is_active.false')
            ]);

            $productDetail = $this->getProductDetailById($productDetailId);
            $product = $this->getProductById($productDetail->product_id);
            $categoryId = $product->categories->first()->id;

            $sale->syncProductDetailWithProductGlobal($categoryId, $productDetail->product_id, $productDetailId);

            DB::commit();
            return $sale;
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating sale option. Please try again.'));
        }
    }

    public
    function createProductSaleCategory($data = [], int $categoryId)
    {
        DB::beginTransaction();
        try {
            $sale = $this->model->create([
                'type' => $data['type'],
                'value' => $data['value'],
                'start_date' => $data['start_date'],
                'expiry_date' => $data['expiry_date'],
                'is_active' => isset($data['is_active']) ? config('constants.is_active.true') : config('constants.is_active.false')
            ]);

            $productDetail = $this->getCategoryById($categoryId);

            $sale->syncCategory($categoryId);

            DB::commit();
            return $sale;
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating sale category. Please try again.'));
        }
    }

    public
    function updateSale($data = [], Sale $sale)
    {
        DB::beginTransaction();
        try {

            $sale->update([
                'type' => $data['type'],
                'value' => $data['value'],
                'start_date' => $data['start_date'],
                'expiry_date' => $data['expiry_date'],
                'is_active' => isset($data['is_active']) ? config('constants.is_active.true') : config('constants.is_active.false')
            ]);

            DB::commit();
            return $sale;
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating sale. Please try again.'));
        }
    }

    public
    function delete(Sale $sale)
    {
        DB::beginTransaction();
        try {
            $sale->delete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem deleting sale. Please try again.'));
        }

        return $sale;
    }

    public
    function updateActive($data = [], Sale $sale)
    {
        DB::beginTransaction();
        try {
            if ($data['isActive'] == config('constants.is_active.true')) {
                $data['isActive'] = config('constants.is_active.false');
            } else {
                $data['isActive'] = config('constants.is_active.true');
            }

            $sale->update([
                'is_active' => $data['isActive'],
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating sale update. Please try again.'));
        }
    }

    public
    function checkSaleGlobalExist(int $productId)
    {
        return $this->productSale
            ->where('product_id', $productId)
            ->where('product_detail_id', null)
            ->first();
    }

    public function getDiscount($sales)
    {
        foreach ($sales as $sale) {
            if ($sale && $sale->productDetail->isNotEmpty() && $firstProductDetail = $sale->productDetail->first() && $sale->productDetail->first()->saleOption->first() != null) {
//                dd($sale->productDetail->first()->saleOption->first());
                if ($sale->productDetail->first()->saleOption->first()->type == config('constants.type_sale.percent')) {
                    $sale->productDetail->first()->salePrice = $sale->productDetail->first()->price - $sale->productDetail->first()->price * ($sale->productDetail->first()->saleOption->first()->value / 100);
                    if ($sale->productDetail->first()->salePrice < 0) {
                        $sale->productDetail->first()->salePrice = 0;
                    }
                } else {
                    $sale->productDetail->first()->salePrice = $sale->productDetail->first()->price - $sale->productDetail->first()->saleOption->first()->value;
                    if ($sale->productDetail->first()->salePrice < 0) {
                        $sale->productDetail->first()->salePrice = 0;
                    }
                }

                $sale->productDetail->first()->reducedValue = $sale->productDetail->first()->saleOption->first()->value;
                $sale->productDetail->first()->reducedType = $sale->productDetail->first()->saleOption->first()->type;
            } else if (
                $sale->productDetail->first() &&
                $sale->productDetail->first()->product &&
                !$sale->productDetail->first()->product->saleGlobal->isEmpty()
            ) {
                if ($sale->productDetail->first()->product->saleGlobal->first()->type == config('constants.type_sale.percent')) {
                    $sale->productDetail->first()->salePriceGlobal = $sale->productDetail->first()->price - $sale->productDetail->first()->price * ($sale->productDetail->first()->product->saleGlobal->first()->value / 100);
                    if ($sale->productDetail->first()->salePriceGlobal < 0) {
                        $sale->productDetail->first()->salePriceGlobal = 0;
                    }
                } else {
                    $sale->productDetail->first()->salePriceGlobal = $sale->productDetail->first()->price - $sale->productDetail->first()->product->saleGlobal->first()->value;
                    if ($sale->productDetail->first()->salePriceGlobal < 0) {
                        $sale->productDetail->first()->salePriceGlobal = 0;
                    }
                }
                $sale->productDetail->first()->reducedValue = $sale->productDetail->first()->product->saleGlobal->first()->value;
                $sale->productDetail->first()->reducedType = $sale->productDetail->first()->product->saleGlobal->first()->type;
            }
        }

        return $sales;
    }
}
