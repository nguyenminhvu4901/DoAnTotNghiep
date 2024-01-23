<?php

namespace App\Domains\Staff\Models\Traits\Attribute;

trait StaffAttribute
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
    public function getNameAttribute(): string
    {
        return $this->userWithTrashed ? $this->userWithTrashed->name : '';
    }

    /**
     * @return string
     */
    public function getEmailAttribute(): string
    {
        return $this->userWithTrashed ? $this->userWithTrashed->email : '';
    }

    /**
     * @return string
     */
    public function getGenderLabelAttribute(): string
    {
        return config('constants.gender')[$this['gender']];
    }
}
