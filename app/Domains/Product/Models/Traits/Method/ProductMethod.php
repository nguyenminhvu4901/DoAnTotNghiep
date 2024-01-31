<?php

namespace App\Domains\Product\Models\Traits\Method;

trait ProductMethod
{
    /**
     * @return int
     */
    public function scopeGetSaleCount(): int
    {
        return $this->orders->where('status', '!=', 0)->reduce(fn(
            $carry,
            $order
        ) => $order->product_quantity + $carry, 0);
    }
}
