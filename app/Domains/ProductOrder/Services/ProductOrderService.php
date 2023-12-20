<?php

namespace App\Domains\ProductOrder\Services;

use App\Services\BaseService;
use App\Domains\ProductOrder\Models\ProductOrder;

/**
 * Class CategoryService.
 */
class ProductOrderService extends BaseService
{
    /**
     * ProductOrderService constructor.
     */
    public function __construct(
        ProductOrder $productOrder
    ) {
        $this->model = $productOrder;
    }
}
