<?php

namespace App\Domains\Product\Models\Traits\Method;

trait ProductMethod
{
    /**
     * @return int
     */
    public function scopeGetSaleCount(): int
    {
        return $this->orders->reduce(fn(
            $carry,
            $order
        ) => $order->product_quantity + $carry, 0);
    }
}
