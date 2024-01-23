<?php

namespace App\Domains\Sale\Models\Traits\Scope;

trait SaleScope
{
    /**
     * @param $query
     * @param $term
     * @return mixed
     */
    public function scopeSearch($query, $term): mixed
    {
        return $query->whereHas('product', function ($query) use ($term) {
            $query->where('name', 'like', '%' . $term . '%');
        });
    }

    /**
     * @param $query
     * @param array $product
     * @param $operator
     * @return mixed|void
     */
    public function scopeFilterByProduct($query, array $product)
    {
        return $query->whereHas('product', function ($query) use ($product) {
            $query->whereIn('slug', $product);
        });
    }
}
