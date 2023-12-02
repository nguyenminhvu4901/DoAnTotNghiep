<?php

namespace App\Domains\Coupon\Models\Traits\Relationship;

use App\Domains\Auth\Models\User;
use App\Domains\CouponUser\Models\CouponUser;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait CouponRelationship
{
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, CouponUser::class);
    }

    public function syncUser($user): void
    {
        $this->users()->sync($user);
    }

    public function detachUser($user): void
    {
        $this->users()->detach($user);
    }
}
