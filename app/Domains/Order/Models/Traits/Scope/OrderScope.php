<?php

namespace App\Domains\Order\Models\Traits\Scope;

trait OrderScope
{
    /**
     * @param $query
     * @param $term
     * @return mixed
     */
    public function scopeSearch($query, $term): mixed
    {
        return $query->where(fn($query) => $query->where('code_order', 'like', '%' . $term . '%')
            ->orWhere('customer_name', 'like', '%' . $term . '%'));
    }

    /**
     * @param $query
     * @param $term
     * @return mixed
     */
    public function scopeFilterByPaymentMethod($query, array $term): mixed
    {
        return $query->where(fn($query) => $query->whereIn('payment_method', $term));
    }

    /**
     * @param $query
     * @param $term
     * @return mixed
     */
    public function scopeFilterByStatus($query, array $term): mixed
    {
        return $query->where(fn($query) => $query->whereIn('status', $term));
    }

    /**
     * @param $query
     * @param $term
     * @return mixed
     */
    public function scopeFilterByStatusReturnOrder($query, array $term): mixed
    {
        return $query->where(fn($query) => $query->whereIn('status_return_order', $term));
    }
}
