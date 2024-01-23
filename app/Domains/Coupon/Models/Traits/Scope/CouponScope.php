<?php

namespace App\Domains\Coupon\Models\Traits\Scope;

use Carbon\Carbon;

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

    public function scopeFirstWithExpiryDate($query, string $name)
    {
        return $query->where('name', $name)
            ->whereDoesntHave('users', fn ($q) => $q->where('users.id', auth()->user()->id))
            ->where('start_date', '<=', Carbon::now())
            ->where('expiry_date', '>=', Carbon::now())
            ->where('quantity', '>', 0)
            ->where('is_active', config('constants.is_active.true'))
            ->first();
    }

    public function scopeGetCouponByName($query, $name)
    {
        return $query->where('name', $name)->first();
    }
}
