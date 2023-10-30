<?php

namespace App\Domains\ProductImage\Models\Traits\Relationship;

use App\Domains\Product\Models\Product;
use App\Domains\Category\Models\Category;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Domains\CategoryProduct\Models\CategoryProduct;

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
            ['product_id', 'id', 'id']
        )->withPivot('name');
    }
}
