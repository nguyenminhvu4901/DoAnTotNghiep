<?php

namespace App\Domains\Coupon\Models\Traits\Attribute;

use Carbon\Carbon;

trait CouponAttribute
{
    /**
     * @return string
     */
    public function getFormattedCreatedAtAttribute(): string
    {
        return convert_date_to_string($this->attributes['created_at']);
    }

    /**
     * @return string
     */
    public function getFormattedStartDateAtAttribute(): string
    {
        return convert_date_to_string($this->attributes['start_date']);
    }

    /**
     * @return string
     */
    public function getFormattedExpiryDateAtAttribute(): string
    {
        return convert_date_to_string($this->attributes['expiry_date']);
    }

    /**
     * @return string
     */
    public function getRemainAttribute(): string
    {
        $expiryDate = Carbon::createFromFormat('Y-m-d', $this->expiry_date);
        $createdDate = Carbon::createFromFormat('Y-m-d', $this->start_date);
        $today = Carbon::now();
        $daysRemaining = $today->diffInDays($expiryDate);
        $daysStart = $today->diffInDays($createdDate);
        if ($expiryDate < $today) {
            return __('Expired');
        } else if ($expiryDate->isToday()) {
            return __('Today is the expiration date');
        } else if ($today < $createdDate) {
            return trans('Start in :couponStart days', ['couponStart' => $daysStart]);
        } else if ($expiryDate->isTomorrow()) {
            return __('Discount until the end of the day');
        } else {
            return trans('There are :couponExpiry days left until it expires', ['couponExpiry' => $daysRemaining]);
        }
    }

    // public function getFormattedTypeCouponAttribute()
    // {
    //     if ($this->attributes['type'] == 0) {
    //         return '%';
    //     } else {
    //         return __('Number');
    //     }
    // }

    public function getFormattedTypeCouponAttribute()
    {
        if ($this->attributes['type'] == 0) {
            return '%';
        } else {
            return __('đ');
        }
    }
}
