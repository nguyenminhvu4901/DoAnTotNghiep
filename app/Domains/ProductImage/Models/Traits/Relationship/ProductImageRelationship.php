<?php

namespace App\Domains\ProductImage\Models\Traits\Relationship;

use App\Domains\Product\Models\Product;
use App\Domains\Category\Models\Category;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use App\Domains\ProductImage\Models\ProductImage;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Domains\CategoryProduct\Models\CategoryProduct;
use App\Domains\ProductDetail\Models\ProductDetail;

trait ProductImageRelationship
{
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function categories(): HasManyDeep
    {
        return $this->hasManyDeep(
            Category::class,
            [Product::class, CategoryProduct::class],
            ['id', 'product_id', 'id'],
            ['product_id', 'id', 'category_id']
        )->withPivot('name');
    }

    public function productImage(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function productDetail(): HasMany
    {
        return $this->hasMany(ProductDetail::class);
    }
}
