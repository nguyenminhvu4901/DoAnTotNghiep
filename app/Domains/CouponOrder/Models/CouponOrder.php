<?php

namespace App\Domains\CouponOrder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Announcement.
 */
class CouponOrder extends Model
{
    use HasFactory;

    protected $table = "coupon_order";

    protected $fillable = [
        'name',
        'type',
        'value'
    ];
}
