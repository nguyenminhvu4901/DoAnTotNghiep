<?php

namespace App\Domains\ProductSale\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Announcement.
 */
class ProductSale extends Model
{
    use HasFactory;

    protected $table = "product_sale";

    protected $fillable = [
        'product_detail_id',
        'sale_id',
        'product_id',
        'type_sale'
    ];

    protected $dates = ['deleted_at'];
}
