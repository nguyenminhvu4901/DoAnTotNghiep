<?php

namespace App\Domains\Product\Models;

use App\Domains\Product\Models\Traits\Method\ProductMethod;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Domains\Product\Models\Traits\Scope\ProductScope;
use App\Domains\Product\Models\Traits\Attribute\ProductAttribute;
use App\Domains\Product\Models\Traits\Relationship\ProductRelationship;

/**
 * Class Announcement.
 */
class Product extends Model
{
    use HasFactory,
        HasSlug,
        SoftDeletes,
        ProductAttribute,
        ProductRelationship,
        ProductScope,
        ProductMethod;

    protected $table = "products";

    protected $fillable = [
        'name',
        'slug',
        'description',
        'creator_id',
    ];

    protected $dates = ['deleted_at'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * @return int
     */
    public function getSaleCount(): int
    {
        return $this->orders->reduce(fn(
            $carry,
            $order
        ) => $order->product_quantity + $carry, 0);
    }
}
