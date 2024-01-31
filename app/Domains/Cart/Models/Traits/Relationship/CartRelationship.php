<?php

namespace App\Domains\Cart\Models\Traits\Relationship;

use App\Domains\Auth\Models\User;
use App\Domains\Category\Models\Category;
use App\Domains\CategoryProduct\Models\CategoryProduct;
use App\Domains\Product\Models\Product;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use App\Domains\ProductDetail\Models\ProductDetail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CartRelationship
{
    /**
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function productDetail(): BelongsTo
    {
        return $this->belongsTo(ProductDetail::class, 'product_detail_id', 'id');
    }

    public function product(): HasManyDeep
    {
        return $this->hasManyDeep(
            Product::class,
            [ProductDetail::class],
            ['id', 'id'],
            ['product_detail_id', 'product_id']
        )->withPivot('name');
    }

    public function category(): HasManyDeep
    {
        return $this->hasManyDeep(
            Category::class,
            [ProductDetail::class, Product::class, CategoryProduct::class],
            ['id', 'id', 'product_id', 'id'],
            ['product_detail_id', 'product_id', 'id', 'category_id']
        )->withPivot('name');
    }
}
