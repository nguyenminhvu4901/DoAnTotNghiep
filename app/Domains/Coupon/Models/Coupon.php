<?php

namespace App\Domains\Coupon\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Domains\Coupon\Models\Traits\Scope\CouponScope;
use App\Domains\Coupon\Models\Traits\Attribute\CouponAttribute;
use App\Domains\Coupon\Models\Traits\Relationship\CouponRelationship;

/**
 * Class Announcement.
 */
class Coupon extends Model
{
    use HasFactory,
        HasSlug,
        CouponScope,
        CouponAttribute,
        CouponRelationship,
        SoftDeletes;

    protected $table = "coupons";

    protected $fillable = [
        'name',
        'slug',
        'type',
        'value',
        'start_date',
        'expiry_date',
        'quantity',
        'description',
        'is_active'
    ];

    protected $dates = ['deleted_at'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
