<?php

namespace App\Domains\Sale\Models\Traits\Attribute;

trait SaleAttribute
{
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

    public function getFormattedTypeSaleAttribute()
    {
        if ($this->attributes['type'] == 0) {
            return '%';
        } else {
            return __('VND');
        }
    }
}
