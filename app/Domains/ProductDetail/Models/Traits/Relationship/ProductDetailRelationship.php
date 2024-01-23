<?php

namespace App\Domains\ProductDetail\Models\Traits\Relationship;

use Carbon\Carbon;
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

    public function saleOption(): BelongsToMany
    {
        return $this->belongsToMany(Sale::class, ProductSale::class)
            ->whereNotNull('product_sale.product_detail_id')
            ->where('start_date', '<=', Carbon::now())
            ->where('expiry_date', '>=', Carbon::now())
            ->where('is_active', '!=', config('constants.is_active.false'))
            ->where('product_sale.type_sale', '!=', 1);
    }
}
