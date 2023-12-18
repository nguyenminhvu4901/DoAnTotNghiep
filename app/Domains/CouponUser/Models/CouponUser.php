<?php

namespace App\Domains\CouponUser\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Announcement.
 */
class CouponUser extends Model
{
    use HasFactory;

    protected $table = 'coupon_user';
    
    protected $fillable = [
        'coupon_id',
        'user_id',
        'order_id',
        'value',
        'is_used',
    ];
}
