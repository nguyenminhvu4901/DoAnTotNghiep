<?php

namespace App\Domains\Coupon\Models\Traits\Attribute;

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

    public function getFormattedTypeCouponAttribute()
    {
        if ($this->attributes['type'] == 0) {
            return '%';
        } else {
            return __('Number');
        }
    }

    public function getFormattedTypeCouponAtAttribute()
    {
        if ($this->attributes['type'] == 0) {
            return '%';
        } else {
            return __('đ');
        }
    }
}
