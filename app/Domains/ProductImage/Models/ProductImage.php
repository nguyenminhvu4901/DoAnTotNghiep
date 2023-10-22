<?php

namespace App\Domains\ProductImage\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Domains\ProductDetail\Models\Traits\Relationship\ProductImageRelationship;

/**
 * Class Announcement.
 */
class ProductImage extends Model
{
    use HasFactory,
        SoftDeletes,
        ProductImageRelationship;

    protected $table = "product_image";

    protected $fillable = [
        'name',
        'product_id',
        'text',
        'order'
    ];

    protected $dates = ['deleted_at'];
}
