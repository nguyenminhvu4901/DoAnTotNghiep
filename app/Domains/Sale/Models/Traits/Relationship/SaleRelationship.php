<?php

namespace App\Domains\Sale\Models\Traits\Relationship;

use App\Domains\Product\Models\Product;
use App\Domains\ProductSale\Models\ProductSale;
use App\Domains\ProductDetail\Models\ProductDetail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait SaleRelationship
{
    public function product(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, ProductSale::class);
    }

    public function productDetail(): BelongsToMany
    {
        return $this->belongsToMany(ProductDetail::class, ProductSale::class);
    }
}
