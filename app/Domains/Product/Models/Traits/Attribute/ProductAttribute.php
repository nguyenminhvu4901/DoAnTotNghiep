<?php

namespace App\Domains\Product\Models\Traits\Attribute;

trait ProductAttribute
{
    /**
     * @return string
     */
    public function getFormattedCreatedAtAttribute(): string
    {
        return convert_date_to_string($this->attributes['created_at']);
    }

    /**
     * @return ?string
     */
    public function getCreatedByAttribute(): ?string
    {
        return optional($this->owner)->name;
    }

}
