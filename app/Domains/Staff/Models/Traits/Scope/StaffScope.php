<?php

namespace App\Domains\Staff\Models\Traits\Scope;

trait StaffScope
{
    /**
     * @param $query
     * @param $term
     * @return mixed
     */
    public function scopeWithNameOrEmail($query, $term)
    {
        return $query->where(function ($query) use ($term) {
            $query->whereHas('user', fn($query) => $query
                ->where('name', 'like', '%' . $term . '%')
                ->orWhere('email', 'like', '%' . $term . '%')
            );
        });
    }

    /**
     * @param $query
     * @param $term
     * @return mixed
     */
    public function scopeWithNameOrEmailIncludingTrash($query, $term)
    {
        return $query->where(function ($query) use ($term) {
            $query->whereHas('user', fn($query) => $query
                ->where('name', 'like', '%' . $term . '%')
                ->orWhere('email', 'like', '%' . $term . '%')
                ->withTrashed()
            );
        })->withTrashed();
    }
}
