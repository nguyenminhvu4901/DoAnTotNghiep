<?php

namespace App\Domains\Product\Models\Traits\Relationship;

use App\Domains\Auth\Models\User;
use App\Domains\Category\Models\Category;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Domains\CategoryProduct\Models\CategoryProduct;
use App\Domains\ProductDetail\Models\ProductDetal;
use App\Domains\ProductImage\Models\ProductImage;
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

    public function productDetails(): HasMany
    {
        return $this->hasMany(ProductDetal::class,'product_id','id');
    }

    public function productImages(): HasMany
    {
        return $this->hasMany(ProductImage::class,'product_id','id');
    }

    public function attachCategories(array $categories): void
    {
        $this->categories()->attach($categories);
    }
    
    public function detachCategories(array $categories): void
    {
        $this->categories()->detach($categories);
    }

    public function syncCategories(array $categories): void
    {
        $this->categories()->sync($categories);
    }
}
