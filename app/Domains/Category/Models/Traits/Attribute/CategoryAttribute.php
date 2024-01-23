<?php

namespace App\Domains\Category\Models\Traits\Attribute;

trait CategoryAttribute
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
    public function getFormattedDeletedAtAttribute(): string
    {
        return convert_date_to_string($this->attributes['deleted_at']);
    }

    /**
     * @return ?string
     */
    public function getCreatedByAttribute(): ?string
    {
        return optional($this->owner)->name;
    }
}
