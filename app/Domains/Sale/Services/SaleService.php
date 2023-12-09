<?php

namespace App\Domains\Sale\Services;

use App\Domains\Product\Models\Product;
use Illuminate\Http\Request;
use App\Services\BaseService;
use App\Domains\Sale\Models\Sale;

/**
 * Class CategoryService.
 */
class SaleService extends BaseService
{
    protected Product $product;
    public function __construct(Sale $sale, Product $product)
    {
        $this->model = $sale;
        $this->product = $product;
    }

    public function getProductById(int $productId)
    {
        return $this->product->findOrFail($productId);
    }
}
