<?php

namespace App\Domains\Customer\Models;

use App\Domains\Staff\Models\Traits\Attribute\StaffAttribute;
use App\Domains\Staff\Models\Traits\Relationship\StaffRelationship;
use App\Domains\Staff\Models\Traits\Scope\StaffScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Announcement.
 */
class Customer extends Model
{
    use HasFactory, SoftDeletes, StaffRelationship, StaffScope, StaffAttribute;

    protected $table = "customer";

    protected $fillable = [
        'user_id',
        'gender',
        'birthday',
        'phone',
        'bio',
    ];
}
