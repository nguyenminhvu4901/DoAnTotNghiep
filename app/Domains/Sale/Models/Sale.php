<?php

namespace App\Domains\Sale\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Domains\Sale\Models\Traits\Relationship\SaleRelationship;

/**
 * Class Announcement.
 */
class Sale extends Model
{
    use HasFactory,
        SaleRelationship;

    protected $table = "sales";

    protected $fillable = [
        'type',
        'value',
        'is_active',
        'start_date',
        'expiry_date'
    ];

    protected $dates = ['deleted_at'];
}
