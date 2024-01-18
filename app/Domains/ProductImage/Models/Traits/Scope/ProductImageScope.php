<?php

namespace App\Domains\ProductImage\Models\Traits\Scope;

trait ProductImageScope
{
    /**
     * @param $query
     * @param $term
     * @return mixed
     */
    public function scopeSearch($query, $term): mixed
    {
        return $query->where(fn($query) => $query->where('name', 'like', '%' . $term . '%'))
            ->orwhereHas('product', function ($query) use ($term) {
                $query->where('name', 'like', '%' . $term . '%');
            });
    }

    /**
     * @param $query
     * @param array $product
     * @param $operator
     * @return mixed|void
     */
    public function scopeFilterByProduct($query, array $product)
    {
        return $query->whereHas('product', function ($query) use ($product) {
            $query->whereIn('products.slug', $product);
        });
    }

    /**
     * @param $query
     * @param array $categories
     * @param $operator
     * @return mixed|void
     */
    public function scopeFilterByCategories($query, array $categories)
    {
        return $query->whereHas('categories', function ($query) use ($categories) {
            $query->whereIn('categories.slug', $categories);
        });
    }
}
