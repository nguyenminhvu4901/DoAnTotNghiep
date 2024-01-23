<?php

namespace App\Domains\ProductImage\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Domains\ProductImage\Models\Traits\Attribute\ProductImageAttribute;
use App\Domains\ProductImage\Models\Traits\Relationship\ProductImageRelationship;
use App\Domains\ProductImage\Models\Traits\Scope\ProductImageScope;

/**
 * Class Announcement.
 */
class ProductImage extends Model
{
    use HasFactory,
        HasRelationships,
        SoftDeletes,
        ProductImageRelationship,
        ProductImageAttribute,
        ProductImageScope;

    protected $table = "product_image";

    protected $fillable = [
        'name',
        'product_id',
        'image_path',
        'order'
    ];

    protected $dates = ['deleted_at'];
}
