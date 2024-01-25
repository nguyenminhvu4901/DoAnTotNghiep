<?php

namespace App\Domains\ProductOrder\Models;

use App\Domains\ProductOrder\Models\Traits\Relationship\ProductOrderRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Announcement.
 */
class ProductOrder extends Model
{
    use HasFactory,
        ProductOrderRelationship;

    protected $table = "product_order";
    protected $fillable = [
        'user_id',
        'product_id',
        'order_id',
        'product_name',
        'product_quantity',
        'product_size',
        'product_color',
        'product_price',
    ];
}
