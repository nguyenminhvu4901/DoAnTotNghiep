<?php

namespace App\Domains\ProductDetail\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Domains\ProductDetail\Models\Traits\Scope\ProductDetailScope;
use App\Domains\ProductDetail\Models\Traits\Relationship\ProductDetailRelationship;

/**
 * Class ProductDetail.
 */
class ProductDetail extends Model
{
    use HasFactory,
        HasRelationships,
        SoftDeletes,
        ProductDetailRelationship,
        ProductDetailScope;

    protected $table = "product_detail";

    protected $fillable = [
        'product_id',
        'size',
        'color',
        'quantity',
        'price',
        'sale'
    ];

    protected $dates = ['deleted_at'];
}
