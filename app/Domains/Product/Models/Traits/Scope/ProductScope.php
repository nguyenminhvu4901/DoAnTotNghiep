<?php

namespace App\Domains\Product\Models\Traits\Scope;

trait ProductScope
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
