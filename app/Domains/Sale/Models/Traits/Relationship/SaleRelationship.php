<?php

namespace App\Domains\Sale\Models\Traits\Relationship;

use App\Domains\Product\Models\Product;
use App\Domains\ProductSale\Models\ProductSale;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
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

    public function productThroghProductDetail(): HasManyDeep
    {
        return $this->hasManyDeep(
            Product::class,
            [ProductSale::class, ProductDetail::class],
            ['sale_id', 'id', 'id'],
            ['id', 'product_detail_id', 'product_id']
        )->withPivot('name');
    }

    public function productSale()
    {
        return $this->hasMany(ProductSale::class);
    }

    public function syncProduct($product): void
    {
        $this->product()->sync($product);
    }

    public function attachProduct($product): void
    {
        $this->product()->attach($product);
    }

    public function detachProduct($product): void
    {
        $this->product()->detach($product);
    }

    public function syncProductDetail($productDetail): void
    {
        $this->productDetail()->sync($productDetail);
    }

    public function attachProductDetail($productDetail): void
    {
        $this->productDetail()->attach($productDetail);
    }

    public function detachProductDetail($productDetail): void
    {
        $this->productDetail()->detach($productDetail);
    }

    public function syncProductDetailWithProductGlobal($productId, $productDetailId)
    {
        $this->productDetail()->sync([$productDetailId => [
            'product_id' => $productId
        ]]);
    }
}
