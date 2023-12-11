<?php

namespace App\Domains\Sale\Models;

use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Domains\Sale\Models\Traits\Attribute\SaleAttribute;
use App\Domains\Sale\Models\Traits\Relationship\SaleRelationship;
use App\Domains\Sale\Models\Traits\Scope\SaleScope;

/**
 * Class Announcement.
 */
class Sale extends Model
{
    use HasFactory,
        SaleRelationship,
        SaleAttribute,
        HasRelationships,
        SaleScope;

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
