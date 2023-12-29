<?php

namespace App\Domains\Staff\Models;

use App\Domains\Staff\Models\Traits\Attribute\StaffAttribute;
use App\Domains\Staff\Models\Traits\Relationship\StaffRelationship;
use App\Domains\Staff\Models\Traits\Scope\StaffScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Announcement.
 */
class Staff extends Model
{
    use HasFactory, SoftDeletes, StaffRelationship, StaffScope, StaffAttribute;

    protected $table = "staff";

    protected $fillable = [
        'user_id',
        'gender',
        'birthday',
        'phone',
        'bio',
    ];
}
