<?php

namespace App\Domains\ProductOrder\Services;

use App\Services\BaseService;
use App\Domains\ProductOrder\Models\ProductOrder;
use Carbon\Carbon;

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

    public function getMonthlySales(Carbon $time): array
    {
        $startOfMonth = $time->copy()->startOfMonth()->format('Y-m-d 00:00:00');
        $endOfMonth = $time->copy()->endOfMonth()->format('Y-m-d 23:59:59');
        $allOrders = $this->model::whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->get()
            ->sortBy('created_at');
        $numberOfWeeks = Carbon::parse($endOfMonth)->weekOfMonth;
        $ordersByWeek = [];
        for($i = 1; $i <= $numberOfWeeks; $i+=1) {
            $ordersByWeek['week_' . $i] = 0;
        }
        foreach ($allOrders as $order) {
            $weekNumber = Carbon::parse($order->created_at)->weekOfMonth;
            $weekKey = 'week_' . $weekNumber;
            $ordersByWeek[$weekKey] += $order['product_quantity'];
        }
        return $ordersByWeek;
    }
}
