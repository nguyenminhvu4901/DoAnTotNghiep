<?php

namespace App\Domains\Order\Models;

use App\Domains\Order\Models\Traits\Attribute\OrderAttribute;
use App\Domains\Order\Models\Traits\Relationship\OrderRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Announcement.
 */
class Order extends Model
{
    use HasFactory,
    OrderAttribute,
    OrderRelationship;

    protected $table = "orders";

    protected $fillable = [
        'code_order',
        'user_id',
        'address_order_id',
        'status',
        'payment_method',
        'total',
        'sub_total',
        'ship',
        'customer_name',
        'customer_email',
        'customer_phone',
        'note'
    ];
}
