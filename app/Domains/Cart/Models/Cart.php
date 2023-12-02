<?php

namespace App\Domains\Cart\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Domains\Cart\Models\Traits\Attribute\CartAttribute;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use App\Domains\Cart\Models\Traits\Relationship\CartRelationship;

/**
 * Class Announcement.
 */
class Cart extends Model
{
    use HasFactory, 
    HasRelationships,
    CartRelationship,
    CartAttribute;

    protected $table = "carts";

    protected $fillable = [
        'user_id',
        'product_detail_id',
        'product_quantity',
        'product_size',
        'product_color',
        'product_price'
    ];
}
