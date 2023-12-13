<?php

namespace App\Domains\Order\Services;

use App\Services\BaseService;
use App\Domains\Order\Models\Order;

/**
 * Class CategoryService.
 */
class OrderService extends BaseService
{
    /**
     * OrderService constructor.
     */
    public function __construct(
        Order $order
    ) {
        $this->model = $order;
    }
}
