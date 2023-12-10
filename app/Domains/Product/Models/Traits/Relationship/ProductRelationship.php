<?php

namespace App\Domains\Product\Models\Traits\Relationship;

use App\Domains\Auth\Models\User;
use App\Domains\Sale\Models\Sale;
use App\Domains\Category\Models\Category;
use App\Domains\ProductSale\Models\ProductSale;
use App\Domains\ProductImage\Models\ProductImage;
use App\Domains\ProductDetail\Models\ProductDetail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Domains\CategoryProduct\Models\CategoryProduct;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait ProductRelationship
{
    /**
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, CategoryProduct::class);
    }

    public function productDetail(): HasMany
    {
        return $this->hasMany(ProductDetail::class);
    }

    public function productImages(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function sale(): BelongsToMany
    {
        return $this->belongsToMany(Sale::class, ProductSale::class);
    }

    public function saleGlobal(): BelongsToMany
    {
        return $this->belongsToMany(Sale::class, ProductSale::class)
                    ->whereNull('product_sale.product_detail_id');
    }

    public function attachCategories(array $categories): void
    {
        $this->categories()->attach($categories);
    }

    public function detachCategories(array $categories): void
    {
        $this->categories()->detach($categories);
    }

    public function syncCategories($categories): void
    {
        $this->categories()->sync($categories);
    }
}
