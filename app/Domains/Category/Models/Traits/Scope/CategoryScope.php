<?php

namespace App\Domains\Category\Models\Traits\Scope;

trait CategoryScope
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
}
