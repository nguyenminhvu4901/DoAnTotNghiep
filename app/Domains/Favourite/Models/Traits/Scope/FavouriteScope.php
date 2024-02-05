<?php

namespace App\Domains\Favourite\Models\Traits\Scope;

trait FavouriteScope
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
     * @param array $categories
     * @param $operator
     * @return mixed|void
     */
    public function scopeFilterByCategories($query, $categories, $operator = null)
    {
        return $query->whereHas('product.categories', function ($query) use ($categories) {
            $query->whereIn('categories.slug', $categories);
        });
    }

    /**
     * @param $query
     * @param array $colorName
     * @param $operator
     * @return mixed|void
     */
    public function scopeFilterByColors($query, $colorName, $operator = null)
    {
        return $query->whereHas('product.productDetail', function ($query) use ($colorName) {
            $query->whereIn('product_detail.color', $colorName);
        });
    }

    /**
     * @param $query
     * @param array $sizeName
     * @param $operator
     * @return mixed|void
     */
    public function scopeFilterBySizes($query, $sizeName, $operator = null)
    {
        return $query->whereHas('product.productDetail', function ($query) use ($sizeName) {
            $query->whereIn('product_detail.size', $sizeName);
        });
    }

    /**
     * @param $query
     * @param array $category
     * @param $operator
     * @return mixed|void
     */
    public function scopeFilterProductDashboardByCategories($query, string $category, $operator = null)
    {
        return $category == "all" ? $query :
            $query->whereHas('product.categories', function ($query) use ($category) {
                $query->where('categories.slug', $category);
            });
    }

    /**
     * @param $query
     * @param array $category
     * @param $operator
     * @return mixed|void
     */
    public function scopeFilterOrderBy($query, string $orderBy)
    {
        if ($orderBy == '0') {
            return $query->inRandomOrder();
        } elseif ($orderBy == '1') {
            return $query->orderBy('avg_price', 'asc');
        } elseif ($orderBy == '2') {
            return $query->orderBy('avg_price', 'desc');
        } elseif ($orderBy == '3') {
            return $query->orderBy('name', 'asc');
        } elseif ($orderBy == '4') {
            return $query->orderBy('name', 'desc');
        } elseif ($orderBy == '5') {
            return $query->oldest('id');
        } elseif ($orderBy == '6') {
            return $query->latest('id');
        } else {
            return $query->latest('id');
        }
    }

    public function scopeFilterByRangePrice($query, $minPrice = 0, $maxPrice = 9999999999)
    {
        return $query->whereHas('product.productDetail', function ($query) use ($minPrice, $maxPrice) {
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        });
    }
}
