<?php

namespace App\Domains\Product\Models\Traits\Method;

use DB;

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

    public function avgPriceProduct()
    {
        dd($this->productDetail->avg('price'));
        $averages = $this->productDetail()
            ->select('product_id', DB::raw('avg(price) as average_value'))
            ->groupBy('product_id')
            ->get();
        dd($averages);
        return $this->productDetail();
    }
}
