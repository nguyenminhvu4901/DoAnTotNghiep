<?php

namespace App\Domains\ProductDetail\Models\Traits\Relationship;

use App\Domains\Sale\Models\Sale;
use App\Domains\Product\Models\Product;
use App\Domains\Category\Models\Category;
use App\Domains\ProductSale\Models\ProductSale;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Domains\CategoryProduct\Models\CategoryProduct;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function sale(): BelongsToMany
    {
        return $this->belongsToMany(Sale::class, ProductSale::class);
    }
}
