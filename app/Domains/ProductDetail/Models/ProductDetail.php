<?php

namespace App\Domains\ProductDetail\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Domains\ProductDetail\Models\Traits\Relationship\ProductDetailRelationship;

/**
 * Class Announcement.
 */
class ProductDetal extends Model
{
    use HasFactory,
        SoftDeletes,
        ProductDetailRelationship;

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
