<?php

namespace App\Domains\Sale\Models\Traits\Scope;

trait SaleScope
{
    /**
     * @param $query
     * @param $term
     * @return mixed
     */
    public function scopeSearch($query, $term): mixed
    {
        return $query->whereHas('product', function ($query) use ($term) {
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
            $query->whereIn('slug', $product);
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
        return $query->whereHas('category', function ($query) use ($categories) {
            $query->whereIn('slug', $categories);
        })
            ->orWhereHas('product.productDetail.product.categories', function ($query) use ($categories) {
                $query->whereIn('slug', $categories);
            });
    }

    /**
     * @param $query
     * @param array $categories
     * @param $operator
     * @return mixed|void
     */
    public function scopeFilterByColors($query, array $colors)
    {
        return $query->whereHas('productDetail', function ($query) use ($colors) {
            $query->whereIn('color', $colors);
        })
            ->orWhereHas('product.productDetail.product.productDetail', function ($query) use ($colors) {
                $query->whereIn('color', $colors);
            });
    }

    /**
     * @param $query
     * @param array $categories
     * @param $operator
     * @return mixed|void
     */
    public function scopeFilterBySizes($query, array $size)
    {
        return $query->whereHas('productDetail', function ($query) use ($size) {
            $query->whereIn('size', $size);
        })
            ->orWhereHas('product.productDetail.product.productDetail', function ($query) use ($size) {
                $query->whereIn('size', $size);
            });
    }

}
