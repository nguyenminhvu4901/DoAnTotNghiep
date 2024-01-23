<?php

namespace App\Domains\Auth\Models\Traits\Relationship;

use App\Domains\Auth\Models\PasswordHistory;

/**
 * Class UserRelationship.
 */
trait UserRelationship
{
    /**
     * @return mixed
     */
    public function passwordHistories()
    {
        return $this->morphMany(PasswordHistory::class, 'model');
    }

    /**
     * @return hasOne
     */
    public function staffInfo()
    {
        return $this->hasOne(PasswordHistory::class);
    }

    /**
     * @return hasOne
     */
    public function customerInfo()
    {
        return $this->hasOne(PasswordHistory::class);
    }
}
