<?php

namespace App\Domains\Category\Models\Traits\Relationship;

use App\Domains\Auth\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CategoryRelationship
{
    /**
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }
}
