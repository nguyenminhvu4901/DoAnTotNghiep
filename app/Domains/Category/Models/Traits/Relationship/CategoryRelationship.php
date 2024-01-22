<?php

namespace App\Domains\Category\Models\Traits\Relationship;

use App\Domains\Auth\Models\User;
use App\Domains\Product\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Domains\CategoryProduct\Models\CategoryProduct;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait CategoryRelationship
{
    /**
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, CategoryProduct::class);
    }

    public function syncProducts($products): void
    {
        $this->products()->sync($products);
    }

    public function attachProducts($products): void
    {
        $this->products()->attach($products);
    }
}
