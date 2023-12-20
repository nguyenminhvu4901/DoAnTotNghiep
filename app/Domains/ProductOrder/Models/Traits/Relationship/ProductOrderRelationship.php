<?php

namespace App\Domains\ProductOrder\Models\Traits\Relationship;

use App\Domains\Product\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


trait ProductOrderRelationship
{
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
