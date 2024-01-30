<?php

namespace App\Domains\Category\Models\Traits\Relationship;

use App\Domains\Auth\Models\User;
use App\Domains\Product\Models\Product;
use App\Domains\ProductSale\Models\ProductSale;
use App\Domains\Sale\Models\Sale;
use Carbon\Carbon;
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

    public function saleCategory(): BelongsToMany
    {
        return $this->belongsToMany(Sale::class, ProductSale::class)
            ->whereNull('product_sale.product_detail_id')
            ->where('start_date', '<=', Carbon::now())
            ->where('expiry_date', '>=', Carbon::now())
            ->where('is_active', '!=', config('constants.is_active.false'))
            ->where('product_sale.type_sale', '!=', 1);
    }

    public function sale(): BelongsToMany
    {
        return $this->belongsToMany(Sale::class, ProductSale::class);
    }
}
