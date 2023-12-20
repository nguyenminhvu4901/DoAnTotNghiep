<?php

namespace App\Domains\Order\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Announcement.
 */
class Order extends Model
{
    use HasFactory;

    protected $table = "orders";

    protected $fillable = [
        'user_id',
        'address_order_id',
        'status',
        'payment_method',
        'total',
        'ship',
        'customer_name',
        'customer_email',
        'customer_phone',
        'note'
    ];
}
