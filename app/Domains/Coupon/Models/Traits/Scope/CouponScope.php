<?php

namespace App\Domains\Coupon\Models\Traits\Scope;

trait CouponScope
{
    /**
     * @param $query
     * @param $term
     * @return mixed
     */
    public function scopeSearch($query, $term): mixed
    {
        return $query->where(fn ($query) => $query->where('name', 'like', '%' . $term . '%'));
    }
}
