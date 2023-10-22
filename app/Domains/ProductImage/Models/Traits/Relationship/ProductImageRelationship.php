<?php

namespace App\Domains\ProductDetail\Models\Traits\Relationship;

use App\Domains\Product\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait ProductImageRelationship
{
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
