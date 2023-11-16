<?php

namespace App\Domains\ProductDetail\Models\Traits\Relationship;

use App\Domains\CategoryProduct\Models\CategoryProduct;
use App\Domains\Product\Models\Product;
use App\Domains\Category\Models\Category;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait ProductDetailRelationship
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
}
