<?php

namespace App\Domains\Coupon\Models;

use App\Domains\Coupon\Models\Traits\Attribute\CouponAttribute;
use App\Domains\Coupon\Models\Traits\Scope\CouponScope;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Announcement.
 */
class Coupon extends Model
{
    use HasFactory,
        HasSlug,
        CouponScope,
        CouponAttribute;

    protected $table = "coupons";

    protected $fillable = [
        'name',
        'slug',
        'type',
        'value',
        'start_date',
        'expiry_date',
        'quantity',
        'description'
    ];

    protected $dates = ['deleted_at'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
