<?php

namespace App\Domains\Customer\Models\Traits\Attribute;

trait CustomerAttribute
{
    /**
     * @return string
     */
    public function getFormattedCreatedAtAttribute(): string
    {
        return convert_date_to_string($this->attributes['created_at']);
    }
}
