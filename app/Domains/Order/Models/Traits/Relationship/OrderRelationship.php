<?php

namespace App\Domains\Order\Models\Traits\Relationship;

use App\Domains\AddressOrder\Models\AddressOrder;
use App\Domains\Auth\Models\User;
use App\Domains\Coupon\Models\Coupon;
use App\Domains\CouponUser\Models\CouponUser;
use App\Domains\ProductOrder\Models\ProductOrder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait OrderRelationship
{
    /**
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function addressOrder(): BelongsTo
    {
        return $this->belongsTo(AddressOrder::class);
    }

    public function productOrder(): HasMany
    {
        return $this->hasMany(ProductOrder::class);
    }

    public function coupons(): BelongsToMany
    {
        return $this->belongsToMany(Coupon::class, CouponUser::class, 'order_id', 'coupon_id');
    }
}
