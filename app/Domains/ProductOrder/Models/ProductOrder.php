<?php

namespace App\Domains\ProductOrder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Announcement.
 */
class ProductOrder extends Model
{
    use HasFactory;

    protected $table = "product_order";
    protected $fillable = [
        'user_id',
        'product_detail_id',
        'order_id',
        'product_quantity',
        'product_size',
        'product_color',
        'product_price'
    ];
}
